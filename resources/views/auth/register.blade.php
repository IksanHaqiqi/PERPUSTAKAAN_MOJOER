
@extends('layout.auth')

@section('title', 'Register')

@section('content')
<div class="row justify-content-center">
  <div class="col-xl-10">
    <div class="card border-0">
      <div class="card-body p-0">
        <div class="row no-gutters">


          <div class="col-lg-6 p-5">
            <h3 class="h4 font-weight-bold text-theme mb-5">Register</h3>
            @if($errors->any())
              <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif
            <form method="POST" action="{{ route('register.action') }}">
              @csrf
              <div class="form-group">
                <label for="name">Nama</label>
                <input type="text"
                       name="name"
                       id="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name') }}"
                       required>
              </div>
              <div class="form-group">
                <label for="email">Email address</label>
                <input type="email"
                       name="email"
                       id="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email') }}"
                       required>
              </div>
              <div class="form-group mb-5">
                <label for="password">Password</label>
                <input type="password"
                       name="password"
                       id="password"
                       class="form-control @error('password') is-invalid @enderror"
                       required>
              </div>~~`
              <button type="submit" class="btn btn-theme">Register</button>
              <a href="{{ route('login') }}" class="float-right text-primary">Login</a>
            </form>
          </div>


          <div class="col-lg-6 d-none d-lg-inline-block">
            <div class="account-block rounded-right">
              <div class="overlay rounded-right"></div>
              <div class="account-testimonial">
                <h4 class="mb-4 text-white">Join Our Community!</h4>
                <p class="lead text-white">"Mulai akses ribuan buku dan sumber belajar."</p>
                <p>- Perpustakaan</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <p class="text-muted text-center mt-3 mb-0">
      Already have an account?
      <a href="{{ route('login') }}" class="text-primary ml-1">Login</a>
    </p>
  </div>
</div>
@endsection
