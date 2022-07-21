@extends('layouts.app', ['activePage' => 'banks.create', 'titlePage' => __('Create Bank')])

@section('content')
<div class="content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-md-12">

        @if($bank->id)
        <form method="post" action="{{ route('banks.update', ['bank' => $bank->id]) }}" class="form-horizontal">
          @method('PUT')

          @else
          <form method="post" action="{{ route('banks.store') }}" class="form-horizontal">
            @endif
            @csrf
            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Bank') }}</h4>
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
                  <label class="col-sm-2 col-form-label" for="name">{{ __('Account Type') }}</label>
                  <div class="col-sm-7">
                    <div class="form-check form-check-radio">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="type" id="type1" value="bank" {{($bank->type == 'bank')? 'checked': ''}} >
                        Bank
                        <span class="circle">
                            <span class="check"></span>
                        </span>
                    </label>
                </div>
                <div class="form-check form-check-radio">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="type" id="type2" value="credit-card" {{($bank->type == 'credit-card')? 'checked': ''}}>
                        Credit Card
                        <span class="circle">
                            <span class="check"></span>
                        </span>
                    </label>
                </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="acc_name">{{ __('Account Name') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('acc_name') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('acc_name') ? ' is-invalid' : '' }}" type="text" name="acc_name" id="acc_name" placeholder="{{ __('Account Name') }}" value="{{old('acc_name', $bank->acc_name)}}" required />
                      @if ($errors->has('acc_name'))
                      <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('acc_name') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                 <div class="row">
                  <label class="col-sm-2 col-form-label" for="acc_holder_name">{{ __('Account Holder Name') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('acc_holder_name') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('acc_holder_name') ? ' is-invalid' : '' }}" type="text" name="acc_holder_name" id="acc_holder_name" placeholder="{{ __('Account Holder Name') }}" value="{{old('acc_holder_name', $bank->acc_holder_name)}}" required />
                      @if ($errors->has('acc_holder_name'))
                      <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('acc_holder_name') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="acc_code">{{ __('Account Code') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('acc_code') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('acc_code') ? ' is-invalid' : '' }}" type="text" name="acc_code" id="acc_code" placeholder="{{ __('Account Code') }}" value="{{old('acc_code', $bank->acc_code)}}" required />
                      @if ($errors->has('acc_code'))
                      <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('acc_code') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                  <div class="row">
                  <label class="col-sm-2 col-form-label" for="currency">{{ __('Currency') }}</label>
                    <div class="col-sm-7">
                    <div class="row">
                      <div class="col">
                        <select id="inputState" class="form-control" name="currency" required>
                          <option value="Pak"{{($bank->currency == 'Pak' ? 'selected': '')}}>Pak</option>
                          <option value="Ind"{{($bank->currency == 'Ind' ? 'selected': '')}}>Ind</option>
                          <option value="Afg"{{($bank->currency == 'Afg' ? 'selected': '')}}>Afg</option>
                      </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="acc_num">{{ __('Account Number') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('acc_num') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('acc_num') ? ' is-invalid' : '' }}" type="number" name="acc_num" id="acc_num" placeholder="{{ __('Account Number') }}" value="{{old('acc_num', $bank->acc_num)}}" required />
                      @if ($errors->has('acc_num'))
                      <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('acc_num') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                  <div class="row">
                  <label class="col-sm-2 col-form-label" for="bank_name">{{ __('Bank Name') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('bank_name') ? ' is-invalid' : '' }}" type="text" name="bank_name" id="bank_name" placeholder="{{ __('Bank Name') }}" value="{{old('bank_name', $bank->bank_name)}}" required />
                      @if ($errors->has('bank_name'))
                      <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('bank_name') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="routing_num">{{ __('Routing Number') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('routing_num') ? ' is-invalid' : '' }}" type="number" name="routing_num" id="routing_num" placeholder="{{ __('Routing Number') }}" value="{{old('routing_num', $bank->routing_num)}}" required />
                      @if ($errors->has('routing_num'))
                      <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('routing_num') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="description">{{ __('Description') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" type="text" name="description" id="description" placeholder="{{ __('Description') }}" value="{{old('description', $bank->description)}}" required />
                      @if ($errors->has('description'))
                      <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('description') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
              </div>

            </div>


            <div class="card-footer ml-auto mr-auto ">
              <div class="row">
                <div class="col-4">
                  <a href="{{route('banks.index')}}" class="btn btn-primary">{{ __('Cancel')}}</a>
                </div>
                <div class="col-4 text-center">
                </div>
                <div class="col-4  text-right">
                  <button type="submit" class="btn btn-primary">{{ ($bank->id)? __('Update'): __('Create') }}</button>
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