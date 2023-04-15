<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('Categories.categories', ['categories' => $categories]);
    }

    public function categoryAddPage()
    {
        return view('Categories.addcategory');
    }

    public function addCategory(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:categories',
            'description' =>  'max:250'
        ]);
        Category::create([
            'name' => $request->name,
            'description' => $request->description
        ]);
        session()->flash('Add', 'Successful category addition');
        return redirect('/home/categories');
    }

    public function categoryUpdatePage($id)
    {
        $category = Category::findOrFail($id);
        return view('Categories.modifycategory', ['category' => $category]);
    }

    public function updateCategory($id, Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:250|unique:categories,name,' . $id,
            'description' =>  'max:250'
        ]);
        $category = Category::find($id);
        $category->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        session()->flash('Update', 'Successful category update');
        return redirect('/home/categories');
    }

    public function deleteCategory($id, Request $request)
    {
        Category::find($id)->delete();
        session()->flash('Delete', 'Successful category delete');
        return redirect('/home/categories');
    }
}
