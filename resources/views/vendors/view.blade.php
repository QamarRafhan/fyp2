@extends('layouts.app', ['activePage' => 'vendor.view', 'titlePage' => __('vendor Details')])

@section('content')
<div class="content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-md-12">

        <div class="card ">
          <div class="card-header card-header-primary">
            <h4 class="card-title">{{ __('vendor') }}</h4>
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
              <label class="col-sm-2 col-form-label  text-primary">Name</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group is-filled">
                  <p> {{$vendor->salutation}} {{$vendor->f_name}} {{$vendor->l_name}}</p>
                </div>
              </div>
            </div>


            <div class="row">
              <label class="col-sm-2 col-form-label  text-primary">Company</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group is-filled">
                  <p>{{$vendor->company}}</p>
                </div>
              </div>
            </div>
   
            <div class="row">
              <label class="col-sm-2 col-form-label  text-primary">Display</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group is-filled">
                  <p>{{$vendor->d_name}}</p>
                </div>
              </div>
            </div>
             <div class="row">
              <label class="col-sm-2 col-form-label  text-primary">Email</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group is-filled">
                  <p>{{$vendor->email}}</p>
                </div>   
              </div>
            </div>
             <div class="row">
              <label class="col-sm-2 col-form-label  text-primary">Phone</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group is-filled">
                  <p>{{$vendor->phone}}</p>
                </div>
              </div> 
            </div>
             <div class="row">
              <label class="col-sm-2 col-form-label  text-primary">Mobile</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group is-filled">
                  <p>{{$vendor->mobile}}</p>
                </div>
              </div>  
            </div>
             <div class="row">
              <label class="col-sm-2 col-form-label  text-primary">Website</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group is-filled">
                  <p>{{$vendor->website}}</p>
                </div>
              </div> 
            </div>
             <div class="row">
              <label class="col-sm-2 col-form-label  text-primary">Creation date</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group is-filled">
                  <p>{{$vendor->created_at}}</p>
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