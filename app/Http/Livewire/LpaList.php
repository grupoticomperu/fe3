<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;
use Livewire\WithPagination;
use App\Models\Productfamilie;
use App\Models\Productatribute;
use App\Models\Localproductatribute;
use Illuminate\Support\Facades\DB;

class LpaList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $subcategoryslug, $localId;

    public function mount(Subcategory $subcategory)
    {
        $this->localId = 1;
        $this->subcategoryslug = $subcategory;

        // $subcategoria = Subcategory::with('productfamilies.productatributes.locales')->find($this->subcategoryId);
    }


    /* public function render()
    {
        $this->localId = 1;
        //$this->subcategoryId = $subcategory_id;
        $subcategoria = Subcategory::with('productfamilies.productatributes.locales')->find($this->subcategoryId);
        //dd($subcategoria);

        if ($subcategoria) {
            foreach ($subcategoria->productfamilies as $productfamilie) {
                foreach ($productfamilie->productatributes as $productatribute) {
                    // Obtén el producto del atributo en el local específico
                    $localProduct = $productatribute->locales->find($this->localId);
                    //dd($productatribute->pivot);
                    if ($localProduct && $localProduct->pivot->stock > 0)
                    {
                        $product = [
                            'name' => $productatribute->slug,
                            'codigo' => $productatribute->codigo,
                            'stock' => $localProduct->pivot->stock ?? 0,
                            'stockmin' => $localProduct->pivot->stockmin,
                            'pricesale' => $localProduct->pivot->pricesale,

                        ];

                        $products[] = $product;
                    }
                }
            }
        }

        $categories = Category::where('state', 1)->get();

        $paginatedProducts = collect($products)->paginate(2);

        return view('livewire.lpa-list', [
            'categories' => $categories,
            'subcategoria' => $subcategoria,
            'products' => $paginatedProducts,
        ])->layout('layouts.appweb');
    } */







    public function getProductFamilies()
    {
        $subcategory = Subcategory::with(['productfamilies' => function ($query) {
            $query->whereHas('productatributes', function ($query) {
                $query->whereHas('locales', function ($query) {
                    $query->where('locals.id', 1) // Reemplaza 'locales.id' con el nombre de la columna 'id' en la tabla 'locales'
                          ->where('local_productatribute.stock', '>', 0); // Asegúrate de usar el nombre correcto de la tabla 'local_productatribute' y la columna 'stock'
                });
            });
        }])
        ->findOrFail($this->subcategoryslug->id);

        return $subcategory->productfamilies;
    }

  /*   public function getProductFamilies()
    {
        $subcategory = Subcategory::with(['productfamilies' => function ($query) {
            $query->whereHas('productatributes', function ($query) {
                $query->whereHas('locales', function ($query) {
                    $query->where('locals.id', 1) // Reemplaza 'locales.id' con el nombre de la columna 'id' en la tabla 'locales'
                        ->whereExists(function ($query) {
                            $query->select(DB::raw('SUM(stock) as total_stock'))
                                ->from('local_productatribute')
                                ->whereColumn('productatributes.id', 'local_productatribute.productatribute_id')
                                ->havingRaw('total_stock > 0');
                        });
                });
            });
        }])
        ->findOrFail($this->subcategoryId);

        return $subcategory->productfamilies;

    } */


    public function render()
    {
        // $this->localId = 1;
        /*         $subcategoria = Subcategory::with('productfamilies.productatributes.locales')->find($this->subcategoryId);
        $query = Productatribute::query();

        if ($subcategoria) {
            $productFamilieIds = $subcategoria->productfamilies->pluck('id')->toArray();
            $query->whereIn('productfamilie_id', $productFamilieIds);
            $query->whereHas('locales', function ($query) {
                $query->where('local_productatribute.stock', '>', 0);
            });
        }
        $products = $query->with('productfamilie')->paginate(2);
        */


        //$products = $query->paginate(10);
        //$products = $query->paginate(2)->appends(['subcategory_id' => $this->subcategoryId]);
        //$products = $query->paginate(2)->withPath(route('product.list.ecommerce.page', ['subcategory_id' => $this->subcategoryId]));


        $products = $this->getProductFamilies();
        //dd($products);
        $categories = Category::where('state', 1)->get();
        $subcategoria = Subcategory::where('id', $this->subcategoryslug->id)->first();
        return view('livewire.lpa-list', [
            'categories' => $categories,
            'subcategoria' => $subcategoria,
            'products' => $products,
        ])->layout('layouts.appweb');
    }
}
