@extends('layouts.auth.app')
@section('title', 'Login')
@section('content')
<div class="row">
  <div class="col-2"></div>
    <div class="col-8">
      <div class="login-brand">
        <h1 style="color: #000000">CV. PANCA KARYA MANUNGGAL</h1>
      </div>

      <div class="card card-primary">
        <div class="row">
          <div class="col-sm-6">
             <img class="img-fluid" src="{{asset('images/login.jpg')}}" alt="Responsive image">
          </div>
          <div class="col-sm-6">
        <div class="card-header"><h4>Masuk</h4></div>
        <div class="card-body">
          <form method="POST" action="{{ route('login') }}" >
          @csrf

          <div class="form-group">
              <label for="email">Email</label>
              <input id="email" type="email" class="form-control" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
              @error('email')
              <span class="invalid-feedback d-block" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="form-group">
              <div class="d-block">
                  <label for="password" class="control-label">Kata Sandi</label>
              </div>
              <input id="password" type="password" class="form-control" @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

              @error('password')
              <span class="invalid-feedback d-block" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror

            </div>

            <div class="form-group">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" name="remember"  id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember-me">Ingat Saya</label>
              </div>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                Masuk
              </button>
            </div>
          </form>
          {{-- <div class="text-center mt-4 mb-3">
              Belum punya akun? <a href="{{route('register')}}">Register Sekarang!</a>
          </div> --}}
        </div>
        </div>
        </div>
      </div>
    </div>
  </div>
    <div class="col-2"></div>
@endsection
