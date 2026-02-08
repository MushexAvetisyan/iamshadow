@extends('layouts.app')

@section('content')
    <div class="RegistrationForm">
        <div class="ring">
            <i style="--clr:#00ff0a;"></i>
            <i style="--clr:#ff0057;"></i>
            <i style="--clr:#fffd44;"></i>
            <div class="loginFormContainer">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <h2>Login</h2>
                    <div class="inputBx">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                               name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Username">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                        @enderror
                    </div>
                    <div class="inputBx">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                               placeholder="Password" name="password" required autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                        @enderror
                    </div>
                    <div class="inputBx">
                        <button class="btn btn-primary" type="submit">Sign in</button>
                    </div>
                    <div class="links">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">Forget Password</a>
                        @endif
                        <a href="{{route('register')}}" >Signup</a>
                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
