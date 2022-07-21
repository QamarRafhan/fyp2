@extends('layouts.app', ['activePage' => 'stock.create', 'titlePage' => __('Create Stock')])

@section('content')
<div class="content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-md-12">

        @if($stock->id)
        <form method="post" action="{{ route('stock.update', ['stock' => $stock->id]) }}" class="form-horizontal">
          @method('PUT')

          @else
          <form method="post" action="{{ route('stock.store') }}" class="form-horizontal">
            @endif
            @csrf
            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Stock') }}</h4>
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
                  <label class="col-sm-2 col-form-label" for="stock">{{ __('Stock Name') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('stock') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('stock') ? ' is-invalid' : '' }}" type="text" name="stock_name" id="stock" placeholder="{{ __('Stock Name') }}" value="{{old('stock', $stock->stock_name)}}" required />
                      @if ($errors->has('stock'))
                      <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('stock') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                 <div class="row">
                  <label class="col-sm-2 col-form-label" for="customer_name">{{ __('Vendor Name') }}</label>
                   <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('vendor_name') ? ' has-danger' : '' }}">
                    <select class="form-control{{ $errors->has('vendor_id') ? ' is-invalid' : '' }}" type="text" name="vendor_id" id="vendor_id" value="{{old('vendor_id', $stock->vendor_id)}}" required />
                        @foreach ($vendors as $vendor)
                             <option value=" {{$vendor->id}}"{{( $stock->vendor_id == $vendor->id ? 'selected': '')}}>{{$vendor->f_name}}</option>
                          @endforeach
                    </select>
                     @if ($errors->has('vendor_name'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('vendor_name') }}</span>
                        @endif
                  </div>
                </div>
              </div>
               <div class="row">
                  <label class="col-sm-2 col-form-label" for="product_name">{{ __('Product Name') }}</label>
                   <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('product_name') ? ' has-danger' : '' }}">
                    <select class="form-control{{ $errors->has('product_id') ? ' is-invalid' : '' }}" type="text" name="product_id" id="product_id" value="{{old('product_id', $stock->product_id)}}" required />
                        @foreach ($products as $product)
                             <option value=" {{$product->id}}"{{($stock->product_id == $product->id ? 'selected': '')}}>{{$product->title.' ( Unit: '. $product->unit.')'}} </option>
                          @endforeach
                    </select>
                     @if ($errors->has('product_name'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('product_name') }}</span>
                        @endif
                  </div>
                </div>
              </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label" for="price">{{ __(' Price') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('price') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" type="number" name="price" id="price" placeholder="{{ __(' Price ') }}" value="{{old('price', $stock->price)}}" required />
                      @if ($errors->has('price'))
                      <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('price') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="quantity">{{ __(' Quantity') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('quantity') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}" type="number" name="quantity" id="quantity" placeholder="{{ __(' Quantity ') }}" value="{{old('quantity', $stock->quantity)}}" required />
                      @if ($errors->has('quantity'))
                      <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('quantity') }}</span>
                      @endif
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
                  <a href="{{route('stock.index')}}" class="btn btn-primary">{{ __('Cancel')}}</a>
                </div>
                <div class="col-4 text-center">
                </div>
                <div class="col-4  text-right">
                  <button type="submit" class="btn btn-primary">{{ ($stock->id)? __('Update'): __('Create') }}</button>
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