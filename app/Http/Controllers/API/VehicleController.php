<?php

namespace App\Http\Controllers\Api;


use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\VehicleResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class VehicleController extends Controller
{

    /**
     * Display a listing of the resource.
     * @param Illuminate\Http\Request
     *
     * @return Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        /** @var \App\Models\Vehicle */
        $query = Vehicle::query();

        /** @var App\Http\Resources\CompanyResource */
        return VehicleResource::collection(
            $query->paginate(
                $request->has('per_page') ?
                    $request->input('per_page') :
                    config('app.global.record_per_page')
            )
        );
    }
}
