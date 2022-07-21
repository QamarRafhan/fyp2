@extends('layouts.app', ['activePage' => 'vendor.create', 'titlePage' => __('Create vendor')])

@section('content')
<div class="content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-md-12">

        @if($vendor->id)
        <form method="post" action="{{ route('vendor.update', ['vendor' => $vendor->id]) }}" class="form-horizontal">
          @method('PUT')

          @else
          <form method="post" action="{{ route('vendor.store') }}" class="form-horizontal">
            @endif
            @csrf
            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('vendor') }}</h4>
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
                  <label class="col-sm-2 col-form-label" for="name">{{ __('Primery Contact') }}</label>
                    <div class="col-sm-7">
                    <div class="row">
                      <div class="col-2">
                        <select id="inputState" class="form-control" name="salutation" required>
                          <option value="Mr"{{($vendor->salutation == 'mr' ? 'selected': '')}}>Mr</option>
                          <option value="Mrs"{{($vendor->salutation == 'mrs' ? 'selected': '')}}>Mrs</option>
                          <option value="Miss"{{($vendor->salutation == 'miss' ? 'selected': '')}}>Miss</option>
                          <option value="Dr"{{($vendor->salutation == 'dr' ? 'selected': '')}}>Dr</option>
                          <option value="Prof"{{($vendor->salutation == 'prof' ? 'selected': '')}}>Prof</option>
                          <option value="Rev"{{($vendor->salutation == 'rev' ? 'selected': '')}}>Rev</option>
                      </select>
                      </div>
                      <div class="col-5">
                         <div class="form-group{{ $errors->has('f_name') ? ' has-danger' : '' }}">
                          <input class="form-control{{ $errors->has('f_name') ? ' is-invalid' : '' }}" type="text" name="f_name" id="f_name" placeholder="{{ __('First Name') }}" value="{{old('f_name', $vendor->f_name)}}" required />
                          @if ($errors->has('f_name'))
                          <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('f_name') }}</span>
                          @endif
                        </div>
                      </div>
                      <div class="col-5">
                         <div class="form-group{{ $errors->has('l_name') ? ' has-danger' : '' }}">
                          <input class="form-control{{ $errors->has('l_name') ? ' is-invalid' : '' }}" type="text" name="l_name" id="l_name" placeholder="{{ __('Last Name') }}" value="{{old('l_name', $vendor->l_name)}}" required />
                          @if ($errors->has('l_name'))
                          <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('l_name') }}</span>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="company">{{ __('Company Name') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('company') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('company') ? ' is-invalid' : '' }}" type="text" name="company" id="company" placeholder="{{ __('Company Name') }}" value="{{old('company', $vendor->company)}}" required />
                      @if ($errors->has('company'))
                      <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('company') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="d_name">{{ __('Vendor Display Name') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('d_name') ? ' has-danger' : '' }}">
                      <select class="form-control{{ $errors->has('d_name') ? ' is-invalid' : '' }}" type="text" name="d_name" id="d_name" placeholder="{{ __('Vendor Display Name') }}" value="{{old('d_name', $vendor->d_name)}}" required />
                      <option value="u_name" {{($vendor->d_name == 'u_name' ? 'selected': '')}}>Primery Contact</option>
                      <option value="u_company" {{($vendor->d_name == 'u_company' ? 'selected': '')}}>Company</option>
                      </select>
                      @if ($errors->has('d_name'))
                      <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('d_name') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="email">{{ __('Email') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" name="email" id="email" placeholder="{{ __(' Email') }}" value="{{old('email', $vendor->email)}}" required />
                      @if ($errors->has('email'))
                      <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('email') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                   <div class="row">
                  <label class="col-sm-2 col-form-label" for="phone">{{ __('Vendor Phone') }}</label>
                    <div class="col-sm-7">
                    <div class="row">
                      <div class="col-6">
                         <div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                          <input class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" type="number" name="phone" id="phone" placeholder="{{ __('Phone') }}" value="{{old('phone', $vendor->phone)}}" required />
                          @if ($errors->has('phone'))
                          <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('phone') }}</span>
                          @endif
                        </div>
                      </div>
                      <div class="col-6">
                         <div class="form-group{{ $errors->has('mobile') ? ' has-danger' : '' }}">
                          <input class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" type="number" name="mobile" id="mobile" placeholder="{{ __('Mobile') }}" value="{{old('mobile', $vendor->mobile)}}"  />
                          @if ($errors->has('mobile'))
                          <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('mobile') }}</span>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                  <div class="row">
                  <label class="col-sm-2 col-form-label" for="website">{{ __(' Website') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('website') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('website') ? ' is-invalid' : '' }}" type="text" name="website" id="website" placeholder="{{ __('Website ') }}" value="{{old('website', $vendor->website)}}"  />
                      @if ($errors->has('website'))
                      <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('website') }}</span>
                      @endif
                    </div>
                  </div>
                </div>

              </div>

            </div>


            <div class="card-footer ml-auto mr-auto ">
              <div class="row">
                <div class="col-4">
                  <a href="{{route('vendor.index')}}" class="btn btn-primary">{{ __('Cancel')}}</a>
                </div>
                <div class="col-4 text-center">
                </div>
                <div class="col-4  text-right">
                  <button type="submit" class="btn btn-primary">{{ ($vendor->id)? __('Update'): __('Create') }}</button>
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