<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stock;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::all();
        return view('Stocks.stocks', ['stocks' => $stocks]);
    }

    public function stockAddPage()
    {
        return view('Stocks.addstock');
    }

    public function addStock(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:stocks|max:250',
            'address' => 'required|max:250',
        ]);

        Stock::create([
            'name' => $request->name,
            'address' => $request->address
        ]);

        session()->flash('Add', 'Successful stock addition');
        return redirect('/home/stocks');
    }

    public function stockUpdatePage($id)
    {
        $stock = Stock::findOrFail($id);
        return view('Stocks.modifystock', ['stock' => $stock]);
    }

    public function updateStock($id, Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:250|unique:stocks,name,' . $id,
            'address' => 'required|max:250'
        ]);

        $stock = Stock::find($id);
        $stock->update([
            'name' => $request->name,
            'address' => $request->address
        ]);

        session()->flash('Update', 'Successful stock update');
        return redirect('/home/stocks');
    }

    public function deleteStock($id)
    {
        $stock = Stock::find($id)->delete();
        session()->flash('Delete', 'Successful stock delete');
        return redirect('/home/stocks');
    }
}
