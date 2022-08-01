<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Vehicle $model)
    {
        return view('vehicle.index', [
            'vehicles' => $model->paginate(
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
        $vehicle = new Vehicle();
        $categories = Category::all();
        $companies = Company::all();
        return view('vehicle.edit', compact('vehicle', 'categories', 'companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vehicle = new Vehicle();

        $data = $request->only($vehicle->getFillable());
        $vehicle->fill($data);
        $vehicle->save();
        return back()->withStatusSuccess(__('Vehicle created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {

        return view('vehicle.view', ["vehicle" => $vehicle]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        $categories = Category::all();
        $companies = Company::all();
        return view('vehicle.edit', compact('vehicle', 'categories', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Vehicle $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $data = $request->only($vehicle->getFillable());

        $vehicle->fill($data);
        $vehicle->save();


        return back()->withStatusSuccess(__('Vehicle Updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Vehicle $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route('vehicle.index')->withStatusSuccess(__('Vehicle deleted successfully.'));
    }
}
