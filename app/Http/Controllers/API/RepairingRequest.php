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
    }
}

