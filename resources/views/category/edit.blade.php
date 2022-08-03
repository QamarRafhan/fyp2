@extends('layouts.app', ['activePage' => 'category.create', 'titlePage' => __('Create Category')])

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/css/jasny-bootstrap.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/js/jasny-bootstrap.min.js"></script>

<div class="content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-md-12">

        @if($category->id)
        <form method="post" action="{{ route('category.update', ['category' => $category->id]) }}" class="form-horizontal" enctype="multipart/form-data">
          @method('PUT')

          @else
          <form method="post" action="{{ route('category.store') }}" class="form-horizontal" enctype="multipart/form-data">
            @endif
            @csrf
            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Category') }}</h4>
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
                      <input class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" type="title" name="title" id="title" placeholder="{{ __('Title') }}" value="{{old('title', $category->title)}}" required />
                      @if ($errors->has('title'))
                      <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('title') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="description">{{ __('Description') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" type="description" name="description" id="description" placeholder="{{ __('Description') }}" value="{{old('description', $category->description)}}" required />
                      @if ($errors->has('description'))
                      <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('description') }}</span>
                      @endif
                    </div>
                  </div>
                </div>


                <div class='row'>
                  <div class="col-12">
                    <div class='row images-container'>

                      @if($category->images)
                      @foreach ($category->images as $single_image)

                      <div class="col-3">
                        <div class="pd-1 fileinput text-center fileinput-exists" data-provides="fileinput">
                          <div class="fileinput-preview fileinput-exists thumbnail img-raised">
                            <img src="{{($single_image->getFullUrl()) }}">
                          </div>

                        </div>
                      </div>
                      @endforeach
                      @endif
                      <div class="col-3">
                        <div class="pd-1 fileinput fileinput-new text-center" data-provides="fileinput">
                          <div class="fileinput-new thumbnail img-raised">
                            <img src="{{asset('images/placeholder.png')}}" rel="nofollow" alt="...">
                          </div>
                          <div class="fileinput-preview fileinput-exists thumbnail img-raised"></div>
                          <div>
                            <span class="btn btn-raised btn-round btn-rose btn-file">
                              <span class="fileinput-new">Select image</span>
                              <span class="fileinput-exists">Change</span>
                              <input class='images-uplaod' type="file" name="images[]" />
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>




              </div>
            </div>
            <div class="card-footer ml-auto mr-auto ">
              <div class="row">
                <div class="col-4">
                  <a href="{{route('category.index')}}" class="btn btn-primary">{{ __('Cancel')}}</a>
                </div>
                <div class="col-4 text-center">
                </div>
                <div class="col-4  text-right">
                  <button type="submit" class="btn btn-primary">{{ ($category->id)? __('Update'): __('Create') }}</button>
                </div>

              </div>

            </div>
          </form>
      </div>
    </div>

  </div>
  @endsection


  @push('js')
  <script>
    var rangeSlider = function() {
      var slider = $('.range-slider'),
        range = $('.range-slider__range'),
        value = $('.range-slider__value');

      slider.each(function() {

        value.each(function() {
          var value = $(this).prev().attr('value');
          $(this).html(value);
        });
        range.on('input', function() {
          $(this).next(value).html(this.value);
        });
      });
    };

    $(window).on("load", function() {
      rangeSlider();
      // $('.max-width').on('change', function() {
      //   $(".min-width").prop('max', this.value);
      //   $(".min-width").next('.range-slider__value').html(this.value);
      // })
      // $('.min-width').on('change', function() {
      //   $(".max-width").prop('min', this.value);
      //   $(".max-width").next('.range-slider__value').html(this.value);
      // })

    });
  </script>

  @endpush