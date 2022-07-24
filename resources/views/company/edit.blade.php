@extends('layouts.app', ['activePage' => 'product.create', 'titlePage' => __('Create Product')])

@section('content')
<div class="content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-md-12">

        @if($product->id)
        <form method="post" action="{{ route('product.update', ['product' => $product->id]) }}" class="form-horizontal"  enctype="multipart/form-data">
          @method('PUT')

          @else
          <form method="post" action="{{ route('product.store') }}" class="form-horizontal"  enctype="multipart/form-data">
            @endif
            @csrf
            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Product') }}</h4>
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
                      <input class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" type="title" name="title" id="title" placeholder="{{ __('Title') }}" value="{{old('title', $product->title)}}" required />
                      @if ($errors->has('title'))
                      <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('title') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                 <div class="row">
                  <label class="col-sm-2 col-form-label" for="unit">{{ __('Unit') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('unit') ? ' has-danger' : '' }}">
                      <select class="form-control{{ $errors->has('unit') ? ' is-invalid' : '' }}" type="text" name="unit" id="unit" placeholder="{{ __('Saleman Kg') }}" value="{{old('unit', $product->unit)}}" required />
                        <option value="">Select One</option>
                        <option value="Kg"{{($product->unit == 'Kg' ? 'selected': '')}}>Kg</option>
                        <option value="Meter" {{($product->unit == 'Meter' ? 'selected': '')}}>Meter</option>
                        <option value="Gram" {{($product->unit == 'Gram' ? 'selected': '')}}>Gram</option>
                        <option value="Milligram" {{($product->unit == 'Milligram' ? 'selected': '')}}>Milligram</option>
                         <option value="Pound" {{($product->unit == 'Pound' ? 'selected': '')}}>Pound</option>
                    </select>
                      @if ($errors->has('unit'))
                      <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('unit') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                 <div class="row">
                  <label class="col-sm-2 col-form-label" for="description">{{ __('Description') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" type="description" name="description" id="description" placeholder="{{ __('Description') }}" value="{{old('description', $product->description)}}" required />
                      @if ($errors->has('description'))
                      <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('description') }}</span>
                      @endif
                    </div>
                  </div>
                </div>


                <div class="row">
                  <label class="col-sm-2 col-form-label" for="images">{{ __('Select image') }}</label>
                  <div class="col-sm-7">
                  <input class='images-uplaod' type="file" name="images" />
                  </div>
                </div>
             </div>
           </div>
     <div class="card-footer ml-auto mr-auto ">
              <div class="row">
                <div class="col-4">
                  <a href="{{route('product.index')}}" class="btn btn-primary">{{ __('Cancel')}}</a>
                </div>
                <div class="col-4 text-center">
                </div>
                <div class="col-4  text-right">
                  <button type="submit" class="btn btn-primary">{{ ($product->id)? __('Update'): __('Create') }}</button>
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