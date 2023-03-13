@extends('layouts/login')
@section('title')
    Login
@endsection
@section('main-content')
<section class="vh-100 bg-surface-secondary">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="{{ asset('image/login.png') }}" alt="login form" style="border-radius: 1rem 0 0 1rem; height: 700px; width: 100%; object-fit: cover;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                <x-auth-session-status class="mb-4" :status="session('status')" />
                <form method="POST" action="{{ route('login') }}">
                  @csrf

                  <div class="d-flex align-items-center mb-3 pb-1">
                    <img class="img-fluid" src="{{ asset('image/logo.png') }}" alt="">
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Use your <span class="classic"><b>Finestauction</b></span> Account</h5>

                  @if (session('error'))
                    <div class="alert alert-danger mb-3 pb-3">
                        {{ session('error') }}
                    </div>
                  @endif

                  <div class="form-outline mb-4">
                    <label class="form-label" for="email" :value="__('Email')">
                      <p class="form-label">Email</p>
                    <input type="email" class="form-control" id="email" name="email" :value="old('email')" required autofocus autocomplete="username">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </label>
                  </div>

                  <div class="form-outline mb-4">
                    <label class="form-label-wrapper" for="password" :value="__('Password')">
                      <p class="form-label">Password</p>
                    <input type="password" class="form-control" id="password" name="password" required autocomplete="current-password">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </label>
                  </div>

                  <!-- Remember Me -->
                  <div class="block my-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                        <span class="form-label">{{ __('Remember me') }}</span>
                    </label>
                  </div>

                  <div class="pt-1 mb-4">
                    <button class="btn btn-lg blue-800">{{ __('Log in') }}</button>
                  </div>

                  @if (Route::has('password.request'))
                  <a class="small" href="{{ route('password.request') }}">Forgot password?</a>
                  @endif
                  <p class="mb-5 pb-lg-2 text-muted" style="color:#3468d6;">Don't have an account? <a href="{{ route('register') }}"
                      style="color: #3468d6;">Register here</a></p>
                  <a href="#!" class="small text-muted">Terms of use.</a>
                  <a href="#!" class="small text-muted">Privacy policy</a>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section> 
@endsection
