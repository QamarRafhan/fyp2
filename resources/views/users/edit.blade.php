@extends('layouts.app', ['activePage' => 'user.create', 'namePage' => __('Create user')])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                @if ($user->id)
                <form method="post" action="{{ route('user.update', ['user' => $user->id]) }}" class="form-horizontal" enctype="multipart/form-data">
                    @method('PUT')
                    @else
                    <form method="post" action="{{ route('user.store') }}" class="form-horizontal" enctype="multipart/form-data">
                        @endif
                        @csrf
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-name">{{ __('user') }}</h4>
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
                                    <label class="col-sm-2 col-form-label" for="name">{{ __('Name') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="name" name="name" id="name" placeholder="{{ __('name') }}" value="{{ old('name', $user->name) }}" required />
                                            @if ($errors->has('name'))
                                            <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label" for="rating">{{ __('Rating') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('rating') ? ' has-danger' : '' }}">
                                            <input 
                                            
                                            min=1
                                            max=5
                                            step="1"
                                            class="form-control{{ $errors->has('rating') ? ' is-invalid' : '' }}" type="number" name="rating" id="rating" placeholder="{{ __('rating') }}" value="{{ old('rating', $user->rating) }}" required />
                                            @if ($errors->has('rating'))
                                            <span id="rating-error" class="error text-danger" for="input-rating">{{ $errors->first('rating') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label" for="price">{{ __('Price') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('price') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" type="number" name="price" id="price" placeholder="{{ __('Price') }}" value="{{ old('price', $user->price) }}" required />
                                            @if ($errors->has('price'))
                                            <span id="price-error" class="error text-danger" for="input-price">{{ $errors->first('price') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer ml-auto mr-auto ">
                                <div class="row">
                                    <div class="col-4">
                                        <a href="{{ route('user.index') }}" class="btn btn-primary">{{ __('Cancel') }}</a>
                                    </div>
                                    <div class="col-4 text-center">
                                    </div>
                                    <div class="col-4  text-right">
                                        <button type="submit" class="btn btn-primary">{{ $user->id ? __('Update') : __('Create') }}</button>
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