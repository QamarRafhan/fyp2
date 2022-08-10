<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\MechanicResource;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\Api\MechanicSearchRequest;

class MechanicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MechanicSearchRequest $request)
    {


        $query = User::query()->where('role', 'mechanic');


        $orderby = null;
        if ($request->latitude &&  $request->longitude) {
            $orderby = 'distance';
            $query->select('*',  DB::raw(" ( 6371 * acos( cos( radians($request->latitude) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians($request->longitude) ) + sin( radians($request->latitude) ) * sin( radians( latitude ) ) ) ) As distance"));
        }

        if ($request->category_id) {

            $query->where('category_id', $request->city);
        }
        if ($orderby) {
            $query->orderby($orderby);
        }
        /** @var App\Http\Resources\MechanicResource */
        return MechanicResource::collection(
            $query->paginate(
                $request->has('per_page') ?
                    $request->input('per_page') :
                    config('app.global.record_per_page')
            )
        );
    }




    /**
     * Display the specified resource.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RepairingRequestResource
     */
    public function store(Request $request)
    {
        $user = $request->user();
        $user->fill($request->all());
        $user->save();
    }
}
