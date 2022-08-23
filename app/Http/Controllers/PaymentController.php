<?php

namespace App\Http\Controllers;

use App\Models\Banking;
use App\Models\Customer;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $query = Payment::query()->whereHas('repairingRequet', function ($query) use ($request) {
            if ($request->user()->role == 'mechanic') {
                $query->where('mechanic_id', $request->user()->id);
            } elseif ($request->user()->role == 'customer') {
                $query->where('customer_id', $request->user()->id);
            }
        })->with(['repairingRequet.customer', 'repairingRequet.mechanic']);


        return view('payment.index', [

            'payments' => $query->paginate(
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
    public function create(Request $request, Customer $customer)
    {
        $payment = new Payment();
        $customers = Customer::all();
        $banks = Banking::all();
        // dd( $banks);
        return view('payment.edit', compact('payment', 'customer', 'customers', 'banks'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $payment = new Payment();

        //  dd($request->all());
        $data = $request->only($payment->getFillable());
        $payment->fill($data);
        $payment->save();
        return back()->withStatusSuccess(__('Payment created successfully.'));
    }
}
