<?php

namespace App\Http\Controllers;

use App\Models\Problem;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class ProblemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $vehicle_id,  Problem $model)
    {

        $query =  $model->where('vehicle_id', $vehicle_id);
        return view('problem.index', [
            'problems' => $query->paginate(
                $request->has('per_page') ?
                    $request->input('per_page') :
                    config('app.global.record_per_page')
            ),
            'vehicle_id' => $vehicle_id
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($vehicle_id)
    {
        $problem = new Problem();
        $vehicles = Vehicle::all();
        return view('problem.edit', compact('problem', 'vehicles', 'vehicle_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $vehicle_id)
    {
        $problem = new Problem();
        $data = $request->only($problem->getFillable());
        $data['vehicle_id'] = $vehicle_id;
        $problem->fill($data);
        $problem->save();
        return back()->withStatusSuccess(__('Problem created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Problem $problem, $vehicle_id)
    {

        return view('problem.view', ["problem" => $problem]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Problem $problem, $vehicle_id)
    {
        $vehicles = Vehicle::all();
        return view('problem.edit', compact('problem', 'vehicles', 'vehicle_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Problem $problem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Problem $problem)
    {
        $data = $request->only($problem->getFillable());

        $problem->fill($data);
        $problem->save();


        return back()->withStatusSuccess(__('Problem Updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Problem $problem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Problem $problem)
    {
        $problem->delete();
        return redirect()->route('problem.index')->withStatusSuccess(__('Problem deleted successfully.'));
    }
}
