@extends('layouts.app', ['activePage' => 'payment.create', 'titlePage' => __('Create payment')])

@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">

                    @if ($payment->id)
                        <form method="post" action="{{ route('payment.update', ['customer' =>$customer->id, 'payment' => $payment->id]) }}"
                            class="form-horizontal">
                            @method('PUT')
                        @else
                            <form method="post" action="{{ route('payment.store',['customer' =>$customer->id]) }}" class="form-horizontal">
                    @endif
                    @csrf
                    <div class="card ">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">{{ __('payment') }}</h4>
                            <p class="card-category">{{ __('create') }}</p>
                        </div>
                        <div class="card-body ">
                            @if (session('status_success'))
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="alert alert-success">
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-label="Close">
                                                <i class="material-icons">close</i>
                                            </button>
                                            <span>{{ session('status_success') }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <label class="col-sm-2 col-form-label"
                                    for="customer_name">{{ __('Customer Name') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('customer_name') ? ' has-danger' : '' }}">
                                        <select
                                            class="form-control{{ $errors->has('customer_name') ? ' is-invalid' : '' }}"
                                            type="text" name="customer_id" id="customer_name"
                                            value="{{ old('customer_name', $customer->id) }}" required />
                                        @foreach ($customers as $single)
                                            <option value={{ $single->id }}
                                                {{ $single->customer_id == $customer->id ? 'selected' : '' }}>
                                                {{ $single->f_name }}
                                            </option>
                                        @endforeach
                                        </select>
                                        @if ($errors->has('customer_name'))
                                            <span id="name-error" class="error text-danger"
                                                for="input-name">{{ $errors->first('customer_name') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label"
                                    for="payment_mothod">{{ __('Payment Mothod') }}</label>
                                <div class="col-sm-7">
                                    <div class="row">
                                        <div class="col">
                                            <select id="bank_select" class="form-control" name="payment_mothod" required>
                                                <option value="cod">COD</option>
                                                <option value="bank">BANK</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row banks_listing">
                                <label class="col-sm-2 col-form-label" for="bank">{{ __('Bank') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('bank') ? ' has-danger' : '' }}">
                                        <select class="form-control{{ $errors->has('bank') ? ' is-invalid' : '' }}"
                                            type="text" name="bank_id" id="bank_id" />
                                        @foreach ($banks as $single)
                                            <option value=" {{ $single->id }}"
                                                {{ $single->single_id == $single->id ? 'selected' : '' }}>
                                                {{ $single->bank_name }}
                                            </option>
                                        @endforeach
                                        </select>
                                        @if ($errors->has('customer_name'))
                                            <span id="name-error" class="error text-danger"
                                                for="input-name">{{ $errors->first('customer_name') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <label class="col-sm-2 col-form-label" for="date">{{ __('Date') }}</label>
                                <div class="col-sm-7">
                                    <div class="row">
                                        <div class="col">
                                            <div
                                                class="form-group{{ $errors->has('date') ? ' has-danger' : '' }}">
                                                <input
                                                    class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}"
                                                    type="date" name="date" id="date"
                                                    placeholder="{{ __('payment Date') }}"
                                                    value="{{ old('date', $payment->date) }}" required />
                                                @if ($errors->has('date'))
                                                    <span id="name-error" class="error text-danger"
                                                        for="input-name">{{ $errors->first('date') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label" for="amount">{{ __('Amount') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('amount') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('payment') ? ' is-invalid' : '' }}"
                                            type="number" name="amount" id="amount" placeholder="{{ __(' Amount') }}"
                                            value="{{ old('payment', $payment->payment) }}" required />
                                        @if ($errors->has('amount'))
                                            <span id="name-error" class="error text-danger"
                                                for="input-name">{{ $errors->first('amount') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-2 col-form-label" for="reference">{{ __('Reference') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('reference') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('reference') ? ' is-invalid' : '' }}"
                                            type="text" name="reference" id="reference"
                                            placeholder="{{ __('Reference ') }}"
                                            value="{{ old('reference', $payment->reference) }}" />
                                        @if ($errors->has('reference'))
                                            <span id="name-error" class="error text-danger"
                                                for="input-name">{{ $errors->first('reference') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label"
                                    for="tax_deducted">{{ __('Text Deducted') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-check form-check-radio">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="tax_deducted" id="type1"
                                                value=0>
                                            No Tax Deducted
                                            <span class="circle">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="form-check form-check-radio">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="tax_deducted" id="type2"
                                                value=1>
                                            Yes, TDS
                                            <span class="circle">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>


                    <div class="card-footer ml-auto mr-auto ">
                        <div class="row">
                            <div class="col-4">
                                <a href="{{ route('payment.index', ['customer'=> $customer->id]) }}" class="btn btn-primary">{{ __('Cancel') }}</a>
                            </div>
                            <div class="col-4 text-center">
                            </div>
                            <div class="col-4  text-right">
                                <button type="submit"
                                    class="btn btn-primary">{{ $payment->id ? __('Update') : __('Create') }}</button>
                            </div>

                        </div>

                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('js')

    <script>
        $(window).on("load", function() {
            $('.banks_listing').hide();
            $('#bank_select').on('change', function() {
                if ($(this).find(":selected").val() == 'bank') {

                    $('.banks_listing').slideDown();
                } else {
                    $('.banks_listing').slideUp();
                }
            });
        });
    </script>
@endpush
