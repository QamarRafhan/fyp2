@extends('layouts.app', ['activePage' => 'vehicle.create', 'titlePage' => __('Create vehicle')])

@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">

                    @if ($vehicle->id)
                        <form method="post" action="{{ route('vehicle.update', ['vehicle' => $vehicle->id]) }}"
                            class="form-horizontal" enctype="multipart/form-data">
                            @method('PUT')
                        @else
                            <form method="post" action="{{ route('vehicle.store') }}" class="form-horizontal"
                                enctype="multipart/form-data">
                    @endif
                    @csrf
                    <div class="card ">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">{{ __('vehicle') }}</h4>
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
                                <label class="col-sm-2 col-form-label" for="title">{{ __('Title') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                            type="title" name="title" id="title" placeholder="{{ __('Title') }}"
                                            value="{{ old('title', $vehicle->title) }}" required />
                                        @if ($errors->has('title'))
                                            <span id="name-error" class="error text-danger"
                                                for="input-name">{{ $errors->first('title') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
              
                            <div class="row">
                                <label class="col-sm-2 col-form-label" for="category_id">{{ __('Category') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('category_id') ? ' has-danger' : '' }}">
                                        <select class="form-control{{ $errors->has('category_id') ? ' is-invalid' : '' }}"
                                            type="text" name="category_id" id="category_id" required />
                                        @foreach ($categories as $category)
                                            <option value=" {{ $category->id }}"
                                                {{ $category->id == old('category_id', $vehicle->category_id) ? 'selected' : '' }}>
                                                {{ $category->title }}
                                            </option>
                                        @endforeach
                                        </select>
                                        @if ($errors->has('category_id'))
                                            <span id="name-error" class="error text-danger"
                                                for="input-name">{{ $errors->first('category_id') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <label class="col-sm-2 col-form-label" for="company_id">{{ __('Company') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('company_id') ? ' has-danger' : '' }}">
                                        <select class="form-control{{ $errors->has('company_id') ? ' is-invalid' : '' }}"
                                            type="text" name="company_id" id="category_id" required />
                                        @foreach ($companies as $company)
                                            <option value=" {{ $company->id }}"
                                                {{ $company->id == old('company_id', $company->company_id) ? 'selected' : '' }}>
                                                {{ $company->title }}
                                            </option>
                                        @endforeach
                                        </select>
                                        @if ($errors->has('company_id'))
                                            <span id="name-error" class="error text-danger"
                                                for="input-name">{{ $errors->first('company_id') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
          
                            <div class='row'>
                              <div class="col-12">
                                  <div class='row images-container'>

                                      @if ($vehicle->images)
                                          @foreach ($vehicle->images as $single_image)
                                              <div class="col-3">
                                                  <div class="pd-1 fileinput text-center fileinput-exists"
                                                      data-provides="fileinput">
                                                      <div
                                                          class="fileinput-preview fileinput-exists thumbnail img-raised">
                                                          <img src="{{ $single_image->getFullUrl() }}">

                                                      </div>
                                                      <div>
                                                          <a href="javascript:;"
                                                              class="btn btn-danger btn-round fileinput-exists la-old-media"
                                                              id='{{ $single_image->id }}'>
                                                              <i class="fa fa-times"></i> Remove</a>
                                                      </div>
                                                  </div>
                                              </div>
                                          @endforeach
                                      @endif
                                      <div class="col-3">
                                          <div class="pd-1 fileinput fileinput-new text-center" data-provides="fileinput">
                                              <div class="fileinput-new thumbnail img-raised">
                                                  <img src="{{ asset('images/placeholder.png') }}" rel="nofollow"
                                                      alt="...">
                                              </div>
                                              <div class="fileinput-preview fileinput-exists thumbnail img-raised"></div>
                                              <div>
                                                  <span class="btn btn-raised btn-round btn-rose btn-file">
                                                      <span class="fileinput-new">Select image</span>
                                                      <span class="fileinput-exists">Change</span>
                                                      <input class='images-uplaod' type="file" name="images[]" />
                                                  </span>
                                                  <a href="javascript:;" class="btn btn-danger btn-round fileinput-exists"
                                                      data-dismiss="fileinput">
                                                      <i class="fa fa-times"></i> Remove</a>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>


                            {{-- <div class="row">
                  <label class="col-sm-2 col-form-label" for="images">{{ __('Select image') }}</label>
                <div class="col-sm-7">
                  <input class='images-uplaod' type="file" name="images" />
                </div>
              </div> --}}
                        </div>
                    </div>
                    <div class="card-footer ml-auto mr-auto ">
                        <div class="row">
                            <div class="col-4">
                                <a href="{{ route('vehicle.index') }}" class="btn btn-primary">{{ __('Cancel') }}</a>
                            </div>
                            <div class="col-4 text-center">
                            </div>
                            <div class="col-4  text-right">
                                <button type="submit"
                                    class="btn btn-primary">{{ $vehicle->id ? __('Update') : __('Create') }}</button>
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
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/css/jasny-bootstrap.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/js/jasny-bootstrap.min.js"></script>
@endpush
