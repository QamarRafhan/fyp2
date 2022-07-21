<?php

namespace App\Http\Controllers;
use App\Models\Stock;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Stock $model)
    {
        return view('stock.index', [
            'stock' => $model->paginate(
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
        $stock = new Stock();

        $vendors = Vendor::select('id','f_name')->get();
        $products = Product::select('id','title','unit')->get();

       
        return view('stock.edit', compact('stock','vendors','products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $stock = new Stock();

        $data = $request->only($stock->getFillable());
        $stock->fill($data);
        $stock->save();
        return back()->withStatusSuccess(__('Stock created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {

        return view('stock.view', ["stock" => $stock]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        $vendors = Vendor::select('id','f_name')->get();
        $products = Product::select('id','title')->get();
        return view('stock.edit', compact('stock','vendors','products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Stock $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        $data = $request->only($stock->getFillable());

        $stock->fill($data);
        $stock->save();

        return back()->withStatusSuccess(__('Stock Updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Stock $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        $stock->delete();
        return redirect()->route('stock.index')->withStatusSuccess(__('Stock deleted successfully.'));
    }
}
