<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RepairingRequetResource;
use App\Models\RepairingRequet;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RepairingRequest extends Controller
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

        /** @var App\Http\Resources\RepairingRequetResource */
        return RepairingRequetResource::collection(
            $query->paginate(
                $request->has('per_page') ?
                    $request->input('per_page') :
                    config('app.global.record_per_page')
            )
        );


         /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\RepairingRequetRequest  $request
     * @return \Illuminate\Http\RepairingRequetResource
     */
    public function store(RepairingRequetStore $request): RepairingRequetResource
    {
        // $this->authorize('create', RepairingRequet::class);
        return DB::transaction(function () use ($request) {
            $attributes = $request->validated();
            $repairingRequest = RepairingRequet::create($attributes);
            /** @var  App\Http\Resources\ProductResource */
            return RepairingRequetResource::make($repairingRequest);
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  RepairingRequet  $repairingRequest
     * @return \Illuminate\Http\RepairingRequetResource
     */
    public function show(RepairingRequet $repairingRequest): RepairingRequetResource
    {
        return RepairingRequetResource::make($repairingRequest);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\RepairingRequetStore  $request
     * @param  RepairingRequet  $repairingRequest
     * @return \Illuminate\Http\Response
     */
    public function update(RepairingRequetStore $request, RepairingRequet $repairingRequest): RepairingRequetResource
    {
        return DB::transaction(function () use ($request, $repairingRequest) {
            $attributes = $request->validated();
            $repairingRequest->fill($attributes);
            $repairingRequest->save();
              $repairingRequest->refresh();
            /** @var  App\Http\Resources\RepairingRequetResource */
            return RepairingRequetResource::make($repairingRequest);
        });
    }
    
}