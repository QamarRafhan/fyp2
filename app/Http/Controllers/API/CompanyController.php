<?php

namespace App\Http\Controllers\API;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CompanyController extends Controller
{

    /**
     * Display a listing of the resource.
     * @param Illuminate\Http\Request
     *
     * @return Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        /** @var \App\Models\Company */
        $query = Company::query();

        /** @var App\Http\Resources\CompanyResource */
        return CompanyResource::collection(
            $query->paginate(
                $request->has('per_page') ?
                    $request->input('per_page') :
                    config('app.global.record_per_page')
            )
        );
    }
}
