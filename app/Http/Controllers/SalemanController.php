<?php

namespace App\Http\Controllers;
use App\Models\Saleman;
use Illuminate\Http\Request;

class SalemanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Saleman $model)
    {
        return view('salemans.index', [
            'salemans' => $model->paginate(
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
        $saleman = new Saleman();
        return view('salemans.edit', compact('saleman'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $saleman = new Saleman();

        $data = $request->only($saleman->getFillable());
        $saleman->fill($data);
        $saleman->save();
        return back()->withStatusSuccess(__('Saleman created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Saleman $saleman)
    {

        return view('salemans.view', ["saleman" => $saleman]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Saleman $saleman)
    {
        return view('salemans.edit', compact('saleman'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Saleman $saleman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Saleman $saleman)
    {
        $data = $request->only($saleman->getFillable());

        $saleman->fill($data);
        $saleman->save();

        return back()->withStatusSuccess(__('Saleman Updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Saleman $saleman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Saleman $saleman)
    {
        $saleman->delete();
        return redirect()->route('saleman.index')->withStatusSuccess(__('Saleman deleted successfully.'));
    }
}
