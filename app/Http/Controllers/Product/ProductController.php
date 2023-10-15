<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Stock;
use PhpParser\Node\Stmt\Foreach_;
use App\Models\Tag;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all()->sortByDesc('created_at');
        return view('products.products', ['products' => $products]);
    }

    public function ProductAddPage()
    {
        $categories = Category::all();
        $tags = Tag::all();
        $stocks = Stock::all();
        return view('products.addproduct', ['categories' => $categories, 'tags' => $tags, 'stocks' => $stocks]);
    }

    public function addProduct(Request $request)
    {


        $validatedDate = $request->validate([
            'name' => 'required|unique:products|max:250',
            'category_id' => 'required',
            'date' => 'required',
            'shop_address' => 'max:250',
            'description' => 'max:250',
            'quantity' => 'required|gte:0',
            'price' => 'required|gte:0',
            'stock_id' => 'required',
            'images' => 'required',
            'images.*' => 'image|mimes:jpg,jpeg,png,bmp,tiff',
        ]);

        $product = Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'date' => $request->date,
            'shop_address' => $request->shop_address,
            'link' => $request->link,
            'price' => $request->price
        ]);

        // TO SAVE QUANTITY :
        $product->stocks()->attach([$request->stock_id => ['quantity' => $request->quantity]]);

        // TO SAVE TAGS :
        $tags = Tag::find($request->tags);
        $product->tags()->attach($tags);

        // TO SAVE IMAGES AND FILES :
        if ($request->has('images')) {
            foreach ($request->file('images') as $image) {
                $product->addMedia($image)->toMediaCollection('images');
            }
        }
        if ($request->has('files')) {
            foreach ($request->file('files') as $file) {
                $product->addMedia($file)->toMediaCollection('files');
            }
        }


        session()->flash('Add', 'Successful product addition');
        return redirect('/home/products');
    }

    public function productUpdatePage($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all()->where('id', '!=', $product->category_id);
        $tags = Tag::all();
        $stocks = Stock::all();
        return view('products.modifyproduct', ['product' => $product, 'categories' => $categories, 'tags' => $tags, 'stocks' => $stocks]);
    }

    public function updateProduct($id, Request $request)
    {
        $validatedDate = $request->validate([
            'name' => 'required|max:250|unique:products,name,' . $id,
            'category_id' => 'required',
            'date' => 'required',
            'shop_address' => 'max:250',
            'description' => 'max:250',
            'quantity' => 'required|gte:0',
            'price' => 'required|gte:0',
            'stock_id' => 'required',
        ]);

        $product = Product::find($id);
        $product->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'date' => $request->date,
            'shop_address' => $request->shop_address,
            'link' => $request->link,
            'description' => $request->description,
            'price' => $request->price
        ]);
        $stock = Stock::all()->where('product_id', $request->id)->first();

        // TO SAVE NEW QUANTITY :
        $product->stocks()->detach($product->stocks);
        $product->stocks()->attach([$request->stock_id => ['quantity' => $request->quantity]]);

        // TO SAVE NEW TAGS :
        $tags = Tag::find($request->tags);
        $product->tags()->detach($product->tags);
        $product->tags()->attach($tags);

        // to delete the file delete selected :
        if ($request->has('deletefiles')) {
            foreach ($request->deletefiles as $idFile) {
                Media::find($idFile)->delete();
            }
        }
        if ($request->has('images')) {
            $product->clearMediaCollection('images');
            foreach ($request->file('images') as $image) {
                $product->addMedia($image)->toMediaCollection('images');
            }
        }

        if ($request->has('files')) {
            foreach ($request->file('files') as $file)
                $product->addMedia($file)->toMediaCollection('files');
        }

        session()->flash('Update', 'Successful product update');
        return redirect('/home/products');
    }

    public function deleteProduct(Request $request)
    {
        Product::find($request->id)->delete();
        session()->flash('Delete', 'Successful product delete');
        return redirect('/home/products');
    }

    public function productPage($id)
    {
        $product = Product::findOrFail($id);
        return view('products.product', ['product' => $product]);
    }
}
