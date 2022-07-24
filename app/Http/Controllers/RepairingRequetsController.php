<?php

namespace App\Http\Controllers;

use App\Models\RepairingRequet;
use Illuminate\Http\Request;

class RepairingRequetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, RepairingRequet $model)
    {
        return view('repairingRequet.index', [
            'repairingRequets' => $model->paginate(
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
        $repairingRequet = new RepairingRequet();
        return view('repairingRequet.edit', compact('repairingRequet'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $repairingRequet = new RepairingRequet();

        $data = $request->only($repairingRequet->getFillable());
        $repairingRequet->fill($data);
        $repairingRequet->save();
        return back()->withStatusSuccess(__('RepairingRequet created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(RepairingRequet $repairingRequet)
    {

        return view('repairingRequet.view', ["repairingRequet" => $repairingRequet]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(RepairingRequet $repairingRequet)
    {
        return view('repairingRequet.edit', compact('repairingRequet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  RepairingRequet $repairingRequet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RepairingRequet $repairingRequet)
    {
        $data = $request->only($repairingRequet->getFillable());

        $repairingRequet->fill($data);
        $repairingRequet->save();


        return back()->withStatusSuccess(__('RepairingRequet Updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  RepairingRequet $repairingRequet
     * @return \Illuminate\Http\Response
     */
    public function destroy(RepairingRequet $repairingRequet)
    {
        $repairingRequet->delete();
        return redirect()->route('repairingRequet.index')->withStatusSuccess(__('RepairingRequet deleted successfully.'));
    }
}
