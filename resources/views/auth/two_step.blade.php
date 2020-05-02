@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="login card shadow text-center mx-auto mt-md-5 mt-sm-3 pb-3 two-step">

                <div class="card-body">
                    <h5 class="card-title mt-3 mb-5">{{ __('2 step verification') }}</h5>
                    <form method="POST" id="step2Form" action="{{ route('2step') }}">
                        @csrf

                        <div class="form-group row">

                            <div class="col-md-8 mx-auto">
                               @error('_2step')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @if(Session::has('CodeMsg'))
									<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('CodeMsg') }}</p>
								@endif
                                <input id="_2step" type="number" class="form-control @error('_2step') is-invalid @enderror" name="_2step" value="{{ old('_2step') }}" min="0" autocomplete="_2step" autofocus placeholder="6-digit code">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 mx-auto">
                                <button type="submit" class="btn btn-primary mt-2 mb-2 w-100">
                                    {{ __('Submit') }}
                                </button>
                                @if (Route::has('resend2step'))
                                    <a class="btn btn-link" href="{{ route('resend2step') }}">
                                        {{ __('Resend Code') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
