<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;


use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Currency;
use App\Models\Tipodocumento; // Para obtener IDs por código (1=DNI, 6=RUC) si lo necesitas
use App\Models\Temporal;
use Livewire\WithPagination;

class ComprobanteCreatedos extends Component
{

    use WithPagination;

    protected $paginationTheme = 'tailwind'; // para usar el estilo Tailwind
    // Cliente
    public string $docInput = ''; // RUC o DNI en un solo input
    public ?string $docTipo = null; // 'DNI' | 'RUC' | null (detectado por longitud)
    public ?int $tipodocumento_id = null; // mapeo con tu tabla Tipodocumento


    public ?int $customer_id = null;
    public string $razon_social = '';
    public string $nombre_comercial = '';
    public string $direccion = '';
    public string $departamento = '';
    public string $provincia = '';
    public string $distrito = '';


    // Defaults de comprobante/venta rápida
    public string $comprobante_default = ''; // 'BOLETA' | 'FACTURA'
    public string $paymenttype = 'CONTADO';
    public string $fechaemision; // hoy
    public string $moneda = 'PEN';
    public string $tipodeoperacion = '1001'; // Venta interna (código SUNAT)
    public string $nota = '';


    // POS: productos
    public string $productSearch = '';
    public array $productResults = [];


    // Carrito sencillo en memoria (también puedes persistir en Temporals si quieres)
    // items: [ product_id => [id, name, image, min_price, price, qty, mtovalorunitario, esbolsa, ...] ]
    public array $cart = [];


    // Totales
    public float $igv = 18.0; // %
    public float $factoricbper = 0.2;


    public function mount()
    {
        $this->fechaemision = Carbon::now()->format('Y-m-d');
        // Si tu empresa usa otra moneda por defecto, puedes leer aquí.
    }


    /**
     * Detecta tipo de documento por longitud y setea defaults de comprobante.
     */
    public function updatedDocInput()
    {
        $len = Str::length(trim($this->docInput));
        $this->docTipo = null;
        $this->comprobante_default = '';
        $this->tipodocumento_id = null;


        if ($len === 8) {
            $this->docTipo = 'DNI';
            $this->comprobante_default = 'BOLETA';
            // Si tienes en tu tabla Tipodocumento el código '1' para DNI:
            $this->tipodocumento_id = Tipodocumento::where('codigo', '1')->value('id');
        } elseif ($len === 11) {
            $this->docTipo = 'RUC';
            $this->comprobante_default = 'FACTURA';
            $this->tipodocumento_id = Tipodocumento::where('codigo', '6')->value('id');
        }
    }



    public function buscarCliente()
    {
        $num = trim($this->docInput);
        if ($num === '') return;


        $this->resetDatosCliente();


        // 1) Validaciones mínimas por longitud
        $len = Str::length($num);
        if ($len !== 8 && $len !== 11) {
            $this->dispatchBrowserEvent('toast', ['type' => 'error', 'message' => 'Ingrese 8 (DNI) u 11 (RUC) dígitos.']);
            return;
        }


        // 2) Buscar en local (por numdoc)
        $local = Customer::where('numdoc', $num)->first();
        if ($local) {
            $this->mapClienteLocal($local);
            return;
        }


        // 3) Consultar APIs.net.pe
        $token = config('services.consulta_ruc.token');
        $base = rtrim(config('services.consulta_ruc.base_url', 'https://api.apis.net.pe/v1'), '/');
        $endpoint = ($len === 11)
            ? "$base/ruc?numero=$num"
            : "$base/dni?numero=$num";


        try {
            $resp = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ])->timeout(10)->get($endpoint);


            if (!$resp->successful()) {
                $this->dispatchBrowserEvent('toast', ['type' => 'error', 'message' => 'APIs.net.pe error (' . $resp->status() . ')']);
                return;
            }


            $data = $resp->json();
            if ($len === 11) {
                $this->razon_social = $data['razonSocial'] ?? '';
                $this->nombre_comercial = $data['nombreComercial'] ?? '';
                $this->direccion = $data['direccion'] ?? '';
                $this->departamento = $data['departamento'] ?? '';
                $this->provincia = $data['provincia'] ?? '';
                $this->distrito = $data['distrito'] ?? '';
            } else { // DNI
                $nombres = $data['nombres'] ?? '';
                $apepat = $data['apellidoPaterno'] ?? '';
                $apemat = $data['apellidoMaterno'] ?? '';
                $this->razon_social = trim("$apepat $apemat $nombres");
            }
        } catch (\Throwable $e) {
            $this->dispatchBrowserEvent('toast', ['type' => 'error', 'message' => 'Conexión APIs.net.pe: ' . $e->getMessage()]);
        }
    }

    private function resetDatosCliente(): void
    {
        $this->customer_id = null;
        $this->razon_social = '';
        $this->nombre_comercial = '';
        $this->direccion = '';
        $this->departamento = '';
        $this->provincia = '';
        $this->distrito = '';
    }


    private function mapClienteLocal(Customer $c): void
    {
        $this->customer_id = $c->id;
        $this->razon_social = $c->nomrazonsocial ?? '';
        $this->nombre_comercial = $c->nombrecomercial ?? '';
        $this->direccion = $c->address ?? '';
        $this->departamento = optional($c->department)->name ?? '';
        $this->provincia = optional($c->province)->name ?? '';
        $this->distrito = optional($c->district)->name ?? '';
    }


    public function updatedProductSearch()
    {
        $q = trim($this->productSearch);
        if ($q === '') {
            $this->productResults = [];
            return;
        }
        $this->productResults = Product::where('company_id', auth()->user()->employee->company_id ?? auth()->user()->employee->company->id)
            ->where('state', 1)
            ->where(function ($w) use ($q) {
                $w->where('name', 'like', "%$q%")->orWhere('codigobarras', 'like', "%$q%");
            })
            ->orderBy('name')
            ->take(20)
            ->get()
            ->map(function ($p) {
                return [
                    'id' => $p->id,
                    'name' => $p->name,
                    'image' => $p->image1,
                    'codigobarras' => $p->codigobarras,
                    'price' => (float) $p->saleprice,
                    'min_price' => (float) ($p->mtovalorunitario ? $p->mtovalorunitario * (1 + $this->igv / 100) : $p->saleprice), // ejemplo: mínimo=valor unitario + IGV
                    'mtovalorunitario' => (float) ($p->mtovalorunitario ?? ($p->saleprice / (1 + $this->igv / 100))),
                    'esbolsa' => (int) ($p->esbolsa ?? 0),
                    'um' => optional($p->um)->abbreviation,
                ];
            })
            ->toArray();
    }


    public function addToCartantiguo(int $productId)
    {
        $p = collect($this->productResults)->firstWhere('id', $productId);
        if (!$p) return;


        if (!isset($this->cart[$productId])) {
            $this->cart[$productId] = [
                'id' => $p['id'],
                'name' => $p['name'],
                'image' => $p['image'],
                'qty' => 1,
                'price' => $p['price'],
                'min_price' => $p['min_price'],
                'mtovalorunitario' => $p['mtovalorunitario'],
                'esbolsa' => $p['esbolsa'],
                'codigobarras' => $p['codigobarras'],
                'um' => $p['um'],
            ];
        } else {
            $this->cart[$productId]['qty']++;
        }
    }


    public function updatePrice($productId, $price)
    {
        $price = (float) $price;
        if (isset($this->cart[$productId])) {
            $min = (float) $this->cart[$productId]['salepricemin'];
            if ($price < $min) {
                $price = $min;
                $this->dispatchBrowserEvent('toast', [
                    'type' => 'warning',
                    'message' => 'El precio no puede ser menor al mínimo: S/ ' . number_format($min, 2)
                ]);
            }
            $this->cart[$productId]['price'] = $price;
        }
    }


    public function removeFromCart(int $productId)
    {
        unset($this->cart[$productId]);
    }


    public function updateQty(int $productId, $qty)
    {
        $qty = (int) $qty;
        if ($qty < 1) $qty = 1;
        if (isset($this->cart[$productId])) {
            $this->cart[$productId]['qty'] = $qty;
        }
    }


    /* public function updatePrice(int $productId, $price)
    {
        $price = (float) $price;
        if (isset($this->cart[$productId])) {
            $min = (float) $this->cart[$productId]['min_price'];
            if ($price < $min) {
                
                $this->dispatchBrowserEvent('toast', ['type' => 'warning', 'message' => 'El precio no puede ser menor al mínimo (' . number_format($min, 2) . ').']);
                $price = $min;
            }
            $this->cart[$productId]['price'] = $price;
        }
    } */


    public function getSubtotalProperty(): float
    {
        $sum = 0.0;
        foreach ($this->cart as $item) {
            $sum += ($item['price'] * $item['qty']);
        }
        return round($sum, 2);
    }


    public function getIgvTotalProperty(): float
    {
        // IGV solo para items gravados (aquí asumimos todos gravados 10). Ajusta si manejas exonerados/inafectos.
        $base = 0.0;
        foreach ($this->cart as $item) {
            // aproximación de base imponible
            $base += ($item['price'] * $item['qty']) / (1 + ($this->igv / 100));
        }
        $igv = $this->subtotal - $base;
        return round(max($igv, 0), 2);
    }


    public function getIcbperTotalProperty(): float
    {
        $sum = 0.0;
        foreach ($this->cart as $item) {
            if ((int) ($item['esbolsa'] ?? 0) === 1) {
                $sum += $this->factoricbper * $item['qty'];
            }
        }
        return round($sum, 2);
    }


    public function getTotalProperty(): float
    {
        return round($this->subtotal + $this->icbperTotal, 2); // (Subtotal ya incluye IGV en price)
    }



    public function render()
    {
        $query = Product::where('company_id', auth()->user()->employee->company_id)
            ->where('state', 1)
            ->when($this->productSearch, function ($q) {
                $q->where('name', 'like', '%' . $this->productSearch . '%')
                    ->orWhere('codigobarras', 'like', '%' . $this->productSearch . '%');
            })
            ->orderBy('name');

        $products = $query->paginate(6); // 12 productos por página (4x3)

        return view('livewire.admin.comprobante-createdos', compact('products'));
    }

    public function addToCart($productId)
    {
        $product = Product::find($productId);
        if (!$product) return;

        $minPrice = $product->salepricemin ?? ($product->saleprice * 0.9); // fallback si no existe

        if (!isset($this->cart[$productId])) {
            $this->cart[$productId] = [
                'id' => $product->id,
                'codigobarras' => $product->codigobarras,
                'name' => $product->name,
                'qty' => 1,
                'price' => (float) $product->saleprice,
                'salepricemin' => (float) $minPrice,
                'image' => $product->image1,
                'um' => optional($product->um)->abbreviation,
            ];
        } else {
            $this->cart[$productId]['qty']++;
        }
    }
}
