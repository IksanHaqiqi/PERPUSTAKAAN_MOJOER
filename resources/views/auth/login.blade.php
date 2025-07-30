@extends('layout.auth')

@section('title', 'Login')
 
@section('content')
<div class="row justify-content-center">
  <div class="col-xl-10">
    <div class="card border-0">
      <div class="card-body p-0">
        <div class="row no-gutters">

          
          <div class="col-lg-6 p-5">
            <h3 class="h4 font-weight-bold text-theme mb-5">Login</h3>
            @if($errors->any())
              <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif
            <form method="POST" action="{{ route('login') }}">
              @csrf
              <div class="form-group">
                <label for="email">Email address</label>
                <input type="email"
                       name="email"
                       id="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email') }}"
                       required autofocus>
              </div>
              <div class="form-group mb-5">
                <label for="password">Password</label>
                <input type="password"
                       name="password"
                       id="password"
                       class="form-control @error('password') is-invalid @enderror"
                       required>
              </div>
              <button type="submit" class="btn btn-theme">Login</button>
              <a href="{{ route('register') }}" class="float-right text-primary">Register</a>
            </form>
          </div>


          <div class="col-lg-6 d-none d-lg-inline-block">
            <div class="account-block rounded-right">
              <div class="overlay rounded-right"></div>
              <div class="account-testimonial">
                <h4 class="mb-4 text-white">Welcome to Perpustakaan!</h4>
                <p class="lead text-white">"Akses mudah ke seluruh koleksi buku Anda."</p>
                <p>- Admin</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <p class="text-muted text-center mt-3 mb-0">
      Don't have an account?
      <a href="{{ route('register') }}" class="text-primary ml-1">Register</a>
    </p>
  </div>
</div>
@endsection
