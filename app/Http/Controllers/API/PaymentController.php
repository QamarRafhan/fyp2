<?php

namespace App\Http\Controllers\api;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\RepairingRequet;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Http\Resources\RepairingRequestResource;

class PaymentController extends Controller
{
    public function store(PaymentRequest $request)
    {
        // $this->authorize('create', RepairingRequet::class);
        return DB::transaction(function () use ($request) {
            $attributes = $request->validated();
            $equest = Payment::create($attributes);
            $repairingRequest=RepairingRequet::find($request->rr_id);
            $repairingRequest->status='Paid';
            return RepairingRequestResource::make($repairingRequest);
        });
    }
}
