<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;

class ComprobanteCreatetres extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $productSearch = '';
    public $cart = [];
    public $showCart = false;

    protected $updatesQueryString = ['productSearch'];

    public function updatingProductSearch() { $this->resetPage(); }

    public function addToCart($productId)
    {
        $product = Product::find($productId);
        if (!$product) return;

        if (!isset($this->cart[$productId])) {
            $this->cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => (float)$product->saleprice,
                'qty' => 1,
                'image' => $product->image1,
            ];
        } else {
            $this->cart[$productId]['qty']++;
        }
    }

    public function updateQty($productId, $qty)
    {
        if (isset($this->cart[$productId])) {
            $this->cart[$productId]['qty'] = max((int)$qty, 1);
        }
    }

    public function removeFromCart($productId)
    {
        unset($this->cart[$productId]);
    }

    public function getTotalProperty()
    {
        return collect($this->cart ?? [])->sum(fn($i) => $i['price'] * $i['qty']);
    }

    public function loadMore()
    {
        $this->emit('load-more');
    }

    public function render()
    {
        $products = Product::where('company_id', auth()->user()->employee->company_id)
            ->where('state', 1)
            ->when($this->productSearch, fn($q) =>
                $q->where('name', 'like', '%'.$this->productSearch.'%')
                  ->orWhere('codigobarras', 'like', '%'.$this->productSearch.'%')
            )
            ->orderBy('name')
            ->paginate(6);

        return view('livewire.admin.comprobante-createtres', compact('products'));
    }
}
