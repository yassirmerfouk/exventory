<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products_count = DB::table('products')->count();
        $quantity_count = DB::table('product_stock')->sum('quantity');
        $projects_count = DB::table('projects')->count();
        $users_count = DB::table('users')->count();
        return view('home', ['products_count' => $products_count, 'quantity_count' => $quantity_count, 'projects_count' => $projects_count, 'users_count' => $users_count]);
    }
}
