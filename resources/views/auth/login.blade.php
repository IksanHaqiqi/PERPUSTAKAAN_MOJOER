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

                        <!-- Alert container for dynamic messages -->
                        <div id="alertContainer"></div>

                        <!-- Alert error (keep for fallback) -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Modified form for API login -->
                        <form id="loginForm" method="POST" action="{{ route('login') }}">
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
                            <button type="submit" id="loginButton" class="btn btn-theme mb-3 ">
                                <span id="buttonText">Login</span>
                                <span id="buttonSpinner" class="d-none">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    Logging in...
                                </span>
                            </button>
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

<script>
// Auth utility functions
function saveToken(token) {
    console.log('💾 Saving token to localStorage');
    try {
        localStorage.setItem('token', token);
        console.log('✅ Token saved successfully');
        return true;
    } catch (e) {
        console.error('❌ Error saving token:', e);
        return false;
    }
}

function getToken() {
    try {
        const token = localStorage.getItem('token');
        console.log('🔍 Getting token:', token ? '✅ Token found' : '❌ No token');
        return token;
    } catch (e) {
        console.error('❌ Error getting token:', e);
        return null;
    }
}

function clearToken() {
    try {
        localStorage.removeItem('token');
        console.log('🗑️ Token cleared');
        return true;
    } catch (e) {
        console.error('❌ Error clearing token:', e);
        return false;
    }
}

// Show alert function
function showAlert(message, type = 'danger') {
    const alertContainer = document.getElementById('alertContainer');
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
    alertDiv.innerHTML = `
        ${message}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    `;
    
    // Clear previous alerts
    alertContainer.innerHTML = '';
    alertContainer.appendChild(alertDiv);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (alertDiv.parentNode) {
            alertDiv.remove();
        }
    }, 5000);
}

// Handle form submission
document.getElementById('loginForm').addEventListener('submit', async function(e) {
    e.preventDefault(); // Prevent default form submission
    
    console.log('🚀 Starting API login process...');
    
    // Get form elements
    const form = e.target;
    const formData = new FormData(form);
    const submitButton = document.getElementById('loginButton');
    const buttonText = document.getElementById('buttonText');
    const buttonSpinner = document.getElementById('buttonSpinner');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    
    // Prepare login data
    const loginData = {
        email: formData.get('email'),
        password: formData.get('password')
    };
    
    console.log('📧 Login attempt for:', loginData.email);
    
    // Show loading state
    submitButton.disabled = true;
    buttonText.classList.add('d-none');
    buttonSpinner.classList.remove('d-none');
    emailInput.disabled = true;
    passwordInput.disabled = true;
    
    // Clear previous alerts
    document.getElementById('alertContainer').innerHTML = '';
    
    try {
        console.log('📡 Sending API login request...');
        
        const response = await fetch('{{ url("/api/login") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify(loginData)
        });
        
        console.log('📥 API Response status:', response.status);
        console.log('📥 Response headers:', Object.fromEntries([...response.headers.entries()]));
        
        // Check if response is JSON
        const contentType = response.headers.get('content-type');
        if (!contentType || !contentType.includes('application/json')) {
            const textResponse = await response.text();
            console.error('❌ Non-JSON response:', textResponse);
            throw new Error('Server returned non-JSON response. Please try again.');
        }
        
        const data = await response.json();
        console.log('📦 Full API response:', data);
        
        if (response.ok && data.status === true) {
            console.log('✅ API Login successful');
            
            if (data.access_token) {
                console.log('🔑 Token received:', data.access_token.substring(0, 20) + '...');
                
                // Save token to localStorage
                const tokenSaved = saveToken(data.access_token);
                
                if (tokenSaved) {
                    console.log('✅ Login process completed successfully');
                    
                    // Show success message
                    showAlert('Login berhasil! Redirecting...', 'success');
                    
                    // Redirect after short delay
                    setTimeout(() => {
                        // You can customize this redirect URL
                        window.location.href = '{{ route("crud.index") ?? "/" }}';
                    }, 1500);
                    
                } else {
                    throw new Error('Failed to save authentication token');
                }
            } else {
                console.error('❌ No access_token in response');
                throw new Error('Invalid server response: no authentication token received');
            }
            
        } else {
            // Handle API errors
            console.error('❌ API Login failed:', data);
            const errorMessage = data.message || 'Login failed. Please check your credentials.';
            showAlert(errorMessage, 'danger');
        }
        
    } catch (error) {
        console.error('❌ Login error:', error);
        
        // Show user-friendly error message
        let errorMessage = 'An error occurred during login. Please try again.';
        
        if (error.message.includes('fetch')) {
            errorMessage = 'Network error. Please check your internet connection.';
        } else if (error.message) {
            errorMessage = error.message;
        }
        
        showAlert(errorMessage, 'danger');
        
    } finally {
        // Restore form state
        submitButton.disabled = false;
        buttonText.classList.remove('d-none');
        buttonSpinner.classList.add('d-none');
        emailInput.disabled = false;
        passwordInput.disabled = false;
        
        console.log('🏁 Login process finished');
    }
});

// Check if user is already logged in on page load
document.addEventListener('DOMContentLoaded', function() {
    console.log('🔍 Checking existing authentication...');
    
    const existingToken = getToken();
    if (existingToken) {
        console.log('🔑 Existing token found, validating...');
        
        // Test token validity
        fetch('{{ url("/api/me") }}', {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${existingToken}`,
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (response.ok) {
                console.log('✅ Token is valid, redirecting...');
                showAlert('You are already logged in. Redirecting...', 'info');
                setTimeout(() => {
                    window.location.href = '{{ route("crud.index") ?? "/" }}';
                }, 1000);
            } else {
                console.log('❌ Token is invalid, clearing...');
                clearToken();
            }
        })
        .catch(e => {
            console.log('❌ Token validation failed:', e);
            clearToken();
        });
    }
});

// Debug functions (can be removed in production)
window.debugAuth = function() {
    console.log('=== AUTH DEBUG ===');
    console.log('Token:', getToken());
    console.log('LocalStorage:', {...localStorage});
    console.log('================');
};

// Expose functions globally for debugging (can be removed in production)
window.getToken = getToken;
window.clearToken = clearToken;
</script>
@endsection