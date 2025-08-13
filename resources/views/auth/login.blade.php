@extends('layout.auth')

@section('title', 'Login')

@section('content')
<div class="row justify-content-center align-items-center d-flex min-vh-100">
    <div class="col-xl-10">
        <div class="card border-0">
            <div class="card-body p-0">
                <div class="row no-gutters ">
                    <div class="col-lg-6 p-5 ">
                        <h3 class="h4 font-weight-bold text-theme mb-4 ">Login</h3>

                        <!-- Alert error dari AJAX -->
                        <div id="alertError" class="alert alert-danger d-none"></div>

                        <form id="loginForm">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" name="email" id="email"
                                    class="form-control" value="{{ old('email') }}" required autofocus>
                            </div>
                            <div class="form-group ">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password"
                                    class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-theme mb-3 ">Login</button>
                            <p class="text-muted text-center mt-3 mb-0">
                                Don't have an account?
                                <a href="{{ route('register') }}" class="ml-1 text-primary ">Register</a>
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

<script type="module">
import { setToken } from './auth.js';

document.getElementById('loginForm').addEventListener('submit', async function(e){
    e.preventDefault();

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const alertEl = document.getElementById('alertError');

    alertEl.classList.add('d-none');
    alertEl.textContent = '';

    try {
        const res = await fetch('{{ route("login") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            credentials: 'same-origin',
            body: JSON.stringify({ email, password })
        });

        // <-- LETAK KODE INI -->
        if(res.ok){
            const data = await res.json();
            setToken(data.access_token); // simpan token
            window.location.href = '/lemari'; // redirect ke dashboard
        } else {
            const data = await res.json().catch(()=>({ message: 'Login gagal' }));
            alertEl.textContent = data.message || 'Login gagal';
            alertEl.classList.remove('d-none');
        }
    } catch (err) {
        alertEl.textContent = 'Terjadi kesalahan. Silakan coba lagi.';
        alertEl.classList.remove('d-none');
    }
});
</script>
@endsection
