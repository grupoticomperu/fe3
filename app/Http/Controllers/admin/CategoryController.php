<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    public function mount(){
        $this->getCategories($parent_id = null, $depth = 0);
    }


    public function index()
    {


     $categories = Category::whereNull('category_id')
        ->with('childrenCategories')
        ->paginate(5);
        //->get();
    //return view('categorias', compact('categories'));

    return view('livewire.admin.category-listd', compact('categories'));
    }

    //para usar la libreria  https://github.com/staudenmeir/laravel-adjacency-list


    public function indexxd()
    {

        // Obtener las categorías principales
        //$categories = Category::whereNull('parent_id')->get();
        //$categories = Category::with('descendants')->get();

       /*  $categories = category::whereHas('siblings', function ($query) {//no mostrara damas
            $query->where('name', 'Damas');
        })->get(); */

        /* $categories = Category::tree()->get(); */

        //$categories = $categories->toTree();//muestra los padres

       // $categories = Category::find(2)->descendantsAndSelf()->depthFirst()->get();
       $categories = Category::all();

        $maxDepth = $categories->max('depth');
        //$categories = Category::whereNull('parent_id')->with('descendantsAndSelf')->depthFirst()->get();

        // Cargar las relaciones descendientes solo cuando sea necesario
      /*   foreach ($categories as $category) {
            $category->descendants;
        } */
        //dd($maxDepth);
        //dd($categories);
        return view('admin.categories.index', compact('categories'));
    }




    public function create()
    {
        // Obtener todas las categorías padres disponibles para seleccionar
        $parentCategories = Category::whereNull('parent_id')->get();

        return view('categorias.create', compact('parentCategories'));
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'required|exists:categories,id',
        ]);

        // Crear una nueva instancia de Category con los datos del formulario
        $category = new Category([
            'name' => $validatedData['name'],
            'parent_id' => $validatedData['parent_id'],
        ]);

        // Guardar la nueva categoría en la base de datos
        $category->save();

        // Redireccionar a la página deseada después de crear la categoría
        return redirect()->route('categorias.index')->with('success', 'Categoría creada exitosamente.');
    }


    public function destroy(Category $category)
    {
       // $this->authorize('delete', new Product);

        $category->delete();
        return redirect()->route('category.listd')->with('flash', 'Categoria Eliminada Con éxito');
    }


}
