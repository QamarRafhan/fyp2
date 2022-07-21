<?php

namespace App\Http\Controllers;
use App\Models\Banking;
use Illuminate\Http\Request;

class BankingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Banking $model)
    {
        return view('banks.index', [
            'bank' => $model->paginate(
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
        $bank = new Banking();
        return view('banks.edit', compact('bank'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bank = new Banking();

        $data = $request->only($bank->getFillable());
        $bank->fill($data);
        $bank->save();
        return back()->withStatusSuccess(__('Banking created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Banking $bank)
    {

        return view('banks.view', ["banks" => $bank]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Banking $bank)
    {
        return view('banks.edit', compact('bank'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Banking $bank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banking $bank)
    {
        $data = $request->only($bank->getFillable());

        $bank->fill($data);
        $bank->save();

        return back()->withStatusSuccess(__('Banking Updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Banking $bank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banking $bank)
    {
        $bank->delete();
        return redirect()->route('banks.index')->withStatusSuccess(__('Banking deleted successfully.'));
    }
}
