@extends('layouts.app', ['activePage' => 'stock.view', 'titlePage' => __('Stock Details')])

@section('content')
<div class="content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-md-12">

        <div class="card ">
          <div class="card-header card-header-primary">
            <h4 class="card-title">{{ __('Stock') }}</h4>
            <p class="card-category">{{ __('details') }}</p>
          </div>
          <div class="card-body ">
            @if (session('status_password'))
            <div class="row">
              <div class="col-sm-12">
                <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="material-icons">close</i>
                  </button>
                  <span>{{ session('status_password') }}</span>
                </div>
              </div>
            </div>
            @endif



            <div class="row">
              <label class="col-sm-2 col-form-label  text-primary">Stock Name</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group is-filled">
                  <p>{{$stock->stock_name}}</p>
                </div>
              </div>
            </div>
  

            <div class="row">
              <label class="col-sm-2 col-form-label  text-primary">Price</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group is-filled">
                  <p>  {{$stock->price}}</p>
                </div>
              </div>
            </div>
   
            <div class="row">
              <label class="col-sm-2 col-form-label  text-primary">Quantity</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group is-filled">
                  <p>{{$stock->quantity}}</p>
                </div>
              </div>
            </div>
           

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection