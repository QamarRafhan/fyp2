@extends('layouts.app', ['activePage' => 'invoice.create', 'titlePage' => __('Create Invoice')])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                @if ($invoice->id)
                <form method="post" action="{{ route('invoice.update', ['invoice' => $invoice->id]) }}" class="form-horizontal">
                    @method('PUT')
                    @else
                    <form method="post" action="{{ route('invoice.store') }}" class="form-horizontal">
                        @endif
                        @csrf
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Invoice') }}</h4>
                                <p class="card-category">{{ __('create') }}</p>
                            </div>
                            <div class="card-body ">
                                @if (session('status_success'))
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="alert alert-success">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <i class="material-icons">close</i>
                                            </button>
                                            <span>{{ session('status_success') }}</span>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="row">
                                    <label class="col-sm-2 col-form-label" for="customer_name">{{ __('Customer Name') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('customer_name') ? ' has-danger' : '' }}">
                                            <select class="form-control{{ $errors->has('customer_name') ? ' is-invalid' : '' }}" type="text" name="customer_id" id="customer_name" value="{{ old('customer_name', $invoice->customer_name) }}" required />
                                            @foreach ($customers as $customer)
                                            <option value=" {{ $customer->id }}" {{ $invoice->customer_id == $customer->id ? 'selected' : '' }}>
                                                {{ $customer->f_name }}
                                            </option>
                                            @endforeach
                                            </select>
                                            @if ($errors->has('customer_name'))
                                            <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('customer_name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label" for="invoice">{{ __('Invoice') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('invoice') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('invoice') ? ' is-invalid' : '' }}" type="text" name="invoice" id="invoice" placeholder="{{ __('Invoice') }}" value="{{ old('invoice', $invoice->invoice) }}" required />
                                            @if ($errors->has('invoice'))
                                            <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('invoice') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label" for="order_num">{{ __(' Order Number') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('order_num') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('order_num') ? ' is-invalid' : '' }}" type="text" name="order_num" id="order_num" placeholder="{{ __('Order Number ') }}" value="{{ old('order_num', $invoice->order_num) }}" required />
                                            @if ($errors->has('order_num'))
                                            <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('order_num') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label" for="invoice_date">{{ __('Invoice Date') }}</label>
                                    <div class="col-sm-7">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group{{ $errors->has('invoice_date') ? ' has-danger' : '' }}">
                                                    <input class="form-control{{ $errors->has('invoice_date') ? ' is-invalid' : '' }}" type="date" name="invoice_date" id="invoice_date" placeholder="{{ __('Invoice Date') }}" value="{{ old('invoice_date', $invoice->invoice_date) }}" required />
                                                    @if ($errors->has('invoice_date'))
                                                    <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('invoice_date') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group{{ $errors->has('terms') ? ' has-danger' : '' }}">
                                                    <select class="form-control{{ $errors->has('terms') ? ' is-invalid' : '' }}" type="text" name="terms" id="terms" value="{{ old('terms', $invoice->terms) }}" required />
                                                    <option value="">Select Terms</option>
                                                    <option value="Display Name" {{ $invoice->terms == 'Display Name' ? 'selected' : '' }}>Display
                                                        Name
                                                    </option>
                                                    <option value="Company" {{ $invoice->terms == 'Company' ? 'selected' : '' }}>Company</option>
                                                    </select>
                                                    @if ($errors->has('terms'))
                                                    <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('terms') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group{{ $errors->has('due_date') ? ' has-danger' : '' }}">
                                                    <input class="form-control{{ $errors->has('due_date') ? ' is-invalid' : '' }}" type="date" name="due_date" id="due_date" placeholder="{{ __('Due Date') }}" value="{{ old('due_date', $invoice->due_date) }}" required />
                                                    @if ($errors->has('due_date'))
                                                    <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('due_date') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label" for="order_num">{{ __(' Salesperson') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('order_num') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('order_num') ? ' is-invalid' : '' }}" type="text" name="order_num" id="order_num" placeholder="{{ __('Order Number ') }}" value="{{ old('order_num', $invoice->order_num) }}" required />
                                            @if ($errors->has('order_num'))
                                            <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('order_num') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Invoice Products ') }}</h4>
                                <p class="card-category">{{ __('Add') }}</p>
                            </div>
                            <div class="card-body invoice_items">
                                <div class="row ">

                                    <div class="col-4 border-tr p-0">
                                        <h4 class="font-weight-bold p-3 m-0 ">Item Details</h4>
                                    </div>

                                    <div class="col border-tr p-0">
                                        <h4 class="font-weight-bold p-3 m-0">Stock--price</h4>

                                    </div>
                                    <div class="col border-tr p-0">
                                        <h4 class="font-weight-bold p-3 m-0">Quantity</h4>

                                    </div>
                                    <div class="col border-tr p-0">
                                        <h4 class="font-weight-bold p-3 m-0">Rate</h4>

                                    </div>
                                    <div class="col border-tr p-0">
                                        <h4 class="font-weight-bold p-3 m-0">Discount</h4>

                                    </div>
                                    <div class="col border-tr p-0">
                                        <h4 class="font-weight-bold p-3 m-0"> Tax</h4>

                                    </div>
                                </div>





                                <div class="row sssss">


                                   
                                </div>


                                <div class="row ">


                                    <select id='myselect'>

                                        @foreach ($products as $product)
                                        <option value="{{$product->id}}">{{$product->title}}</option>

                                        @endforeach

                                    </select>
                                </div>

                                <div class="row mt-2">

                                    <button type="button" class="btn btn-primary add_product_button">Add New Item</button>




                                </div>
                            </div>
                        </div>

            </div>
        </div>





        <div class="card-footer ml-auto mr-auto ">
              <div class="row">
                <div class="col-4">
                  <a href="{{route('invoice.index')}}" class="btn btn-primary">{{ __('Cancel')}}</a>
                </div>
                <div class="col-4 text-center">
                </div>
                <div class="col-4  text-right">
                  <button type="submit" class="btn btn-primary">{{ ($product->id)? __('Update'): __('Create') }}</button>
                </div>

              </div>

            </div>
          </form>

        </form>
    </div>
</div>
</div>
</div>
@endsection


@push('js')


<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
<script>
    $(window).on("load", function() {

        $('select').select2({
            width: '100%',
            placeholder: "Select an Option",
            allowClear: true
        });

        $('.add_product_button').on('click', function() {


        })
    });


    $(document).ready(function(e) {
        $("#myselect").change(function() {

            query = $(this).val();
            $.ajax({
                type: 'GET',
                url: '/invoice/' + query + '/stock',
                success: function(data) {
                    $(".sssss").append(data);
                }
            });
        });

    });
</script>
<style>
    .border-tr {
        border-top: 1px solid #dee2e6;
        border-right: solid 1px #dee2e6;
        border-bottom: solid 1px #dee2e6;

    }

    .border-tr:last-child {
        border-right: solid 0px;
    }
</style>
@endpush