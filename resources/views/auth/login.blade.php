@extends('layouts.app', ['class' => 'bg-default','bg'=>'bgWhite'])

@section('content')
    @include('layouts.headers.guest')

    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7 bgWhite">
                <div class="card bg-secondary shadow border-0 bgWhite">
                    <div class="card-header bg-transparent noBorder bgWhite">
                        {{-- <div class="text-muted text-center mt-2 mb-3"><small>{{ __('Sign in with') }}</small></div> --}}
                        <div class="text-muted text-center mt-2 mb-3">
                            <small>
                                <img src="{{ asset('argon') }}/img/brand/white.png" height="80"/>
                            </small>
                        </div>
                        {{-- <div class="btn-wrapper text-center">
                            <a href="#" class="btn btn-neutral btn-icon">
                                <span class="btn-inner--icon"><img src="{{ asset('argon') }}/img/icons/common/github.svg"></span>
                                <span class="btn-inner--text">{{ __('Github') }}</span>
                            </a>
                            <a href="#" class="btn btn-neutral btn-icon">
                                <span class="btn-inner--icon"><img src="{{ asset('argon') }}/img/icons/common/google.svg"></span>
                                <span class="btn-inner--text">{{ __('Google') }}</span>
                            </a>
                        </div> --}}
                    </div>
                    <div class="card-body px-lg-5 py-lg-5 bgWhite">
                        {{-- <div class="text-center text-muted mb-4">
                            <small>
                                    Create new account OR Sign in with these credentials:
                                    <br>
                                    Username <strong>admin@argon.com</strong> Password: <strong>secret</strong>
                            </small>
                        </div> --}}
                        <form role="form" method="POST" action="{{ route('login') }}">
                            @csrf
                            <h3 class="b"> LOGIN</h3>
                            <p > Login to access your account</h3>
                            <div class="borderBottomBlue form-group{{ $errors->has('email') ? ' has-danger' : '' }} mb-3">
                                <div class="input-group input-group-alternative noBorderShadow">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text noBg"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class=" inputField form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" type="email" name="email" value="{{ old('email') }}" value="admin@argon.com" required autofocus>
                                </div>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="borderBottomBlue form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative noBorderShadow">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text noBg"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>

    <input class="inputField  form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Password') }}" type="password" value="secret" required>
                                </div>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="custom-control custom-control-alternative custom-checkbox">
                                <input class="custom-control-input" name="remember" id="customCheckLogin" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="customCheckLogin">
                                    <span class="text-muted">{{ __('Remember me') }}</span>
                                </label>

                                @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="blueC ml25">
                                    <small>{{ __('Forgot password?') }}</small>
                                </a>
                            @endif

                            </div>
                            <div class="text-left">
                                <button type="submit" class="btn btn-primary my-4 pl-5 pr-5 purpleBg purpleBorder">{{ __('LOGIN') }}</button>
                            </div>

                            {{-- <p class="text-center"> Don't have an Account? <a href="{{ route('register') }}">Register Here</a></h3> --}}
                        </form>
                    </div>
                </div>
                {{-- <div class="row mt-3">
                    <div class="col-6">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-light">
                                <small>{{ __('Forgot password?') }}</small>
                            </a>
                        @endif
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('register') }}" class="text-light">
                            <small>{{ __('Create new account') }}</small>
                        </a>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
