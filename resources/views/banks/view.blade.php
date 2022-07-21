@extends('layouts.app', ['activePage' => 'banks.view', 'titlePage' => __('Banks Details')])

@section('content')
<div class="content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-md-12">

        <div class="card ">
          <div class="card-header card-header-primary">
            <h4 class="card-title">{{ __('Banks') }}</h4>
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
              <label class="col-sm-2 col-form-label  text-primary">Type</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group is-filled">
                  <p>{{$banks->type}}</p>
                </div>
              </div>
            </div>


            <div class="row">
              <label class="col-sm-2 col-form-label  text-primary">Account Name</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group is-filled">
                  <p> {{$banks->acc_name}}</p>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label  text-primary">Account Holder</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group is-filled">
                  <p>{{$banks->acc_holder_name}}</p>
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-sm-2 col-form-label  text-primary">Account Code</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group is-filled">
                  <p>{{$banks->acc_code}}</p>
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-sm-2 col-form-label  text-primary">Currency</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group is-filled">
                  <p>{{$banks->currency}}</p>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label  text-primary">Account Number</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group is-filled">
                  <p>{{$banks->acc_num}}</p>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label  text-primary">Bank Name</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group is-filled">
                  <p>{{$banks->bank_name}}</p>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label  text-primary">Routing Number</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group is-filled">
                  <p>{{$banks->mobile}}</p>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label  text-primary">Description</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group is-filled">
                  <p>{{$banks->description}}</p>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 col-form-label  text-primary">Creation date</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group is-filled">
                  <p>{{$banks->created_at}}</p>
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