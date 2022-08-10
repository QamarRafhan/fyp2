<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\RepairingRequet;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RepairingRequetStore;
use App\Http\Resources\RepairingRequestResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RepairingRequestController extends Controller
{

    /**
     * Display a listing of the resource.
     * @param Illuminate\Http\Request
     *
     * @return Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        /** @var \App\Models\Category */
        $query = RepairingRequet::query();

        if ($request->user()->role == 'mechanic') {
            $query->where('mechanic_id', $request->user()->id);
        } else {
            $query->where('customer_id', $request->user()->id);
        }
    
        /** @var App\Http\Resources\RepairingRequestResource */
        return RepairingRequestResource::collection(
            $query->paginate(
                $request->has('per_page') ?
                    $request->input('per_page') :
                    config('app.global.record_per_page')
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\RepairingRequetRequest  $request
     * @return \Illuminate\Http\RepairingRequestResource
     */
    public function store(RepairingRequetStore $request): RepairingRequestResource
    {
        // $this->authorize('create', RepairingRequet::class);
        return DB::transaction(function () use ($request) {
            $attributes = $request->validated();
            $repairingRequest = RepairingRequet::create($attributes);
            /** @var  App\Http\Resources\RepairingRequestResource */
            return RepairingRequestResource::make($repairingRequest);
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  RepairingRequet  $repairingRequest
     * @return \Illuminate\Http\RepairingRequestResource
     */
    public function show(RepairingRequet $repairingRequest): RepairingRequestResource
    {
        return RepairingRequestResource::make($repairingRequest);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\RepairingRequetStore  $request
     * @param  RepairingRequet  $repairingRequest
     * @return \Illuminate\Http\Response
     */
    public function update(RepairingRequetStore $request, RepairingRequet $repairingRequest): RepairingRequestResource
    {
        return DB::transaction(function () use ($request, $repairingRequest) {
            $attributes = $request->validated();
            $repairingRequest->fill($attributes);
            $repairingRequest->save();
            $repairingRequest->refresh();
            /** @var  App\Http\Resources\RepairingRequestResource */
            return RepairingRequestResource::make($repairingRequest);
        });
    }
}
