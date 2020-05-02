@extends('layouts.app')

@section('content')
<div class="container-fluid">
<div class="col-md-8 mx-auto">
<div class="wrapper-0ff">
            <div class="inner-ff">
                <form method="POST" id="regForm" action="{{ route('register') }}">
                
                <div id="wizard">
                    
                    <!-- SECTION 1 -->
                    <h4>Register</h4>
                    <section class="register-form bg-white shadow pt-3 pb-5 mx-auto">
                            @csrf
                            <h5 class="card-title mt-3 mb-5 text-center">{{ __('Registeration') }}</h5>
                            <div class="form-group row">

                                <div class="col-md-8 mx-auto">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">

                                <div class="col-md-8 mx-auto">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">

                                <div class="col-md-8 mx-auto">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-8 mx-auto">
                             <button type="button" class="forward btn btn-primary mt-2 mb-2 w-100">Next<i class="zmdi zmdi-long-arrow-right"></i></button>
                        </div>
                    </section>

                    <!-- SECTION 2 -->
                    <h4>Membership</h4>
                    <section class="section-style">
                        <h5 class="card-title text-center">{{ __('Membershiip Plan') }}</h5>
                      <div class="container py-5">
                        <div class="errorTxt"></div>
                        <div class="row text-center align-items-end">
                          
                        @foreach($subs as $sub)
                          <!-- Pricing Table-->
                          <div class="col-lg-4 mb-5 mb-lg-0">
                            <div class="bg-white p-5 rounded-lg shadow">
                              <h1 class="h6 text-uppercase font-weight-bold mb-4">{{$sub->title}}</h1>

                              <div class="custom-separator my-4 mx-auto bg-primary"></div>

                              <p class="pb-2">{{$sub->desc}}</p>
                              <label for="pkg-{{$sub->id}}" class="btn btn-primary btn-block p-2 shadow rounded-pill">Subscribe <input type="checkbox" value="{{$sub->id}}" name="subscription[]" id="pkg-{{$sub->id}}" class="badgebox sbsc_check">
                                <span class="badge">&check;</span></label>
                            </div>
                          </div>
                          <!-- END -->
                          @endforeach


                        </div>
                      </div>
                      <div class="row">
                          <button type="submit" class="btn btn-primary">Register<i class="zmdi zmdi-long-arrow-right"></i>
                        </button>
                      </div>
                      
                    </section>

                </div>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection
