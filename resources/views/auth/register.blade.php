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
                            @if ($errors->any())
                                <div class="alert alert-danger">{{ $errors->first() }}</div>
                            @endif
                            <form method="POST" action="{{ route('register.action') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" name="name" id="name"
                                        class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" name="email" id="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" required>
                                </div>
                                <div class="form-group ">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password"
                                        class="form-control @error('password') is-invalid @enderror" required>
                                </div>

                                <button type="submit" class="btn btn-theme mb-3">Register</button>

                                <p class="text-muted text-center mt-2 mb-0 ">
                                    Do you have an account?
                                    <a href="{{ route('login') }}" class="ml-1 text-primary ">Login</a>
                                </p>
                            </form>
                        </div>


                        <div class="col-lg-6 d-none d-lg-inline-block">
                            <div class="account-block rounded-right">
                                <img src="{{ asset('register.gif') }}" alt="Login Background"
                                    class="img-fluid rounded-right w-100 h-100" style="object-fit: cover;">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
