<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Invoice $model)
    {
        return view('invoices.index', [
            'invoices' => $model->paginate(
                $request->has('per_page') ?
                    $request->input('per_page') :
                    config('app.global.record_per_page')
            )
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $invoice = new Invoice();
        $customers = Customer::select('f_name', 'l_name', 'id')->get();
        $products = Product::select('id', 'title', 'unit')->get();
        return view('invoices.edit', compact('invoice', 'customers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $invoice = new Invoice();
        $data = $request->only($invoice->getFillable());
        $invoice->fill($data);
        $invoice->save();


        $products = [];
        foreach ($request->products as  $index => $product) {
            $products[] = [
                'product_id' => $index,
                'price' =>  Arr::get($product, 'rate', 0),
                'quantity' => Arr::get($product, 'quantity', 0),
                'discount' => Arr::get($product, 'discount', 0),
                'tax' => Arr::get($product, 'tax', 0),

            ];
        }
        if (count($products)>0)
            $invoice->products()->createMany($products);

        return back()->withStatusSuccess(__('Invoice created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {

        return view('invoices.view', ["invoice" => $invoice]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        $customers = Customer::select('f_name', 'l_name', 'id')->get();
        return view('invoices.edit', compact('invoice', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        $data = $request->only($invoice->getFillable());
        $invoice->fill($data);
        $invoice->save();

        return back()->withStatusSuccess(__('Invoice Updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('invoice.index')->withStatusSuccess(__('Invoice deleted successfully.'));
    }

    public function invoice_pdf()
    {
        $pdf = PDF::loadView('invoices.pdf');
        return $pdf->download('invoice.pdf');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function loadStock(Request $request, Product $product)
    {

        return view('invoices.stock', compact('product'))->render();
    }
}
