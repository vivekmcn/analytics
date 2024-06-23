@extends('layouts.login')
@section('content')
<div class="card">
    <div class="card-body login-card-body">
       <div class="logo" style="text-align:center"> 
      <img src="{{ asset('theme/mab/dist/img/MAB_Logo_Lotus Only.png') }}" alt="logo" />
      </div>
      <h2 class="login-box-msg" style="font-family: 'Lato', sans-serif;font-weight: 800;letter-spacing: -1px;font-size: 38px;color: #000 !important">MAB ANALYTICS</h2>
      <p>Login to access your interactive campaign metrics.</p>
        
      <form method="POST" action="{{ route('login') }}">
          @if (session('message'))
             <div class="alert" role="alert" style="color: green">
                {{ session('message') }}
            </div>
        @endif
        @csrf
        <div class="input-group mb-3">
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>          
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
           @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="input-group mb-3">
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-12">
            <div class="icheck-primary">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-md-12 col-sm-12 col-12">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="{{ route('forgot.password') }}">I forgot my password</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
@endsection
