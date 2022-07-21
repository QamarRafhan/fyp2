@extends('layouts.app', ['activePage' => 'category.view', 'titlePage' => __('Category Details')])

@section('content')
<div class="content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-md-12">

        <div class="card ">
          <div class="card-header card-header-primary">
            <h4 class="card-title">{{ __('Category') }}</h4>
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
              <label class="col-sm-2 col-form-label  text-primary">Title</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group is-filled">
                  <p>{{$category->title}}</p>
                </div>
              </div>  
            </div>
             <div class="row">
              <label class="col-sm-2 col-form-label  text-primary">Description</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group is-filled">
                  <p>{{$category->description}}</p>
                </div>
              </div> 
            </div>
             <div class="row">
              <label class="col-sm-2 col-form-label  text-primary">Creation date</label>
              <div class="col-sm-7">
                <div class="form-group bmd-form-group is-filled">
                  <p>{{$category->created_at}}</p>
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