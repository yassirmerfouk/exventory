<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Dompdf\Dompdf;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::all();
        return view('invoices.incoices', ['invoices' => $invoices]);
    }

    public function invoiceAddPage()
    {
        $products = Product::all();
        return view('invoices.addinvoice', ['products' => $products]);
    }

    public function addInvoice(Request $request)
    {
        $validatedData = $request->validate([
            'client_name' => 'required|max:250',
            'client_phone' => 'max:250',
            'date' => 'required'
        ]);

        if (empty($request->quantity)) {
            session()->flash('Error quantity', 'You should add quantity');
            return redirect('/home/invoices/add');
        }

        $invoice = Invoice::create([
            'date' => $request->date,
            'client_name' => $request->client_name,
            'client_phone' => $request->client_phone,
            'client_address' => $request->client_address
        ]);

        for ($i = 0; $i < count($request->product_id); $i++) {
            $product = Product::find($request->product_id[$i]);
            $invoice->products()->attach([$request->product_id[$i] => ['quantity' => $request->quantity[$i]]]);
        }

        session()->flash('Add', 'Successful invoice addition');
        return redirect('/home/invoices');
    }

    public function invoiceUpdatePage($id)
    {
        $invoice = Invoice::findOrFail($id);
        $products = Product::all();
        return view('invoices.modifyInvoice', ['invoice' => $invoice, 'products' => $products]);
    }

    public function updateInvoice($id, Request $request)
    {
        $validatedData = $request->validate([
            'client_name' => 'required|max:250',
            'client_phone' => 'max:250',
            'date' => 'required',
            'product_id' => 'required',
            'quantity' => 'required'
        ]);

        $invoice = Invoice::find($id);
        $invoice->update([
            'client_name' => $request->client_name,
            'client_phone' => $request->client_phone,
            'client_address' => $request->client_address
        ]);

        $invoice->products()->detach($invoice->products);

        for ($i = 0; $i < count($request->product_id); $i++) {
            $invoice->products()->attach([$request->product_id[$i] => ['quantity' => $request->quantity[$i]]]);
        }




        session()->flash('Update', 'Successful invoice update');
        return redirect('/home/invoices');
    }

    public function deleteInvoice($id)
    {
        Invoice::find($id)->delete();

        session()->flash('Delete', 'Successful invoice delete');
        return redirect('/home/invoices');
    }

    public function invoicePage($id)
    {
        $invoice = Invoice::FindOrFail($id);
        return view('invoices.invoicepdf', ['invoice' => $invoice]);
    }
}
