// ========================================
// 2. FILE BARU: login-handler.js - HANDLE LOGIN FORM
// ========================================

import { saveToken, getToken, debugStorage } from './auth.js';

// Function untuk handle login form
export async function handleLogin(event) {
    event.preventDefault(); // Prevent form default submission
    
    console.log('🚀 Starting login process...');
    debugStorage(); // Check storage before login
    
    const form = event.target;
    const formData = new FormData(form);
    
    const loginData = {
        email: formData.get('email'),
        password: formData.get('password')
    };
    
    console.log('📧 Login attempt for:', loginData.email);
    
    // Show loading state
    const submitButton = form.querySelector('button[type="submit"]');
    const originalText = submitButton.textContent;
    submitButton.textContent = 'Logging in...';
    submitButton.disabled = true;
    
    try {
        console.log('📡 Sending login request...');
        
        const response = await fetch('/api/login', { // Relative URL
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify(loginData)
        });
        
        console.log('📥 Login response status:', response.status);
        console.log('📥 Response headers:', Object.fromEntries([...response.headers.entries()]));
        
        // Check if response is JSON
        const contentType = response.headers.get('content-type');
        if (!contentType || !contentType.includes('application/json')) {
            const textResponse = await response.text();
            console.error('❌ Non-JSON response:', textResponse);
            throw new Error('Server returned non-JSON response');
        }
        
        const data = await response.json();
        console.log('📦 Full login response:', data);
        
        if (response.ok && data.status === true) {
            console.log('✅ Login successful');
            
            if (data.access_token) {
                console.log('🔑 Token received:', data.access_token.substring(0, 20) + '...');
                
                // Save token
                const tokenSaved = saveToken(data.access_token);
                
                if (tokenSaved) {
                    console.log('✅ Login process completed successfully');
                    
                    // Show success message
                    showMessage('Login berhasil!', 'success');
                    
                    // Redirect after short delay
                    setTimeout(() => {
                        window.location.href = '/dashboard'; // Adjust URL as needed
                    }, 1000);
                    
                } else {
                    throw new Error('Failed to save token to localStorage');
                }
            } else {
                console.error('❌ No access_token in response');
                throw new Error('No access token received from server');
            }
            
        } else {
            console.error('❌ Login failed:', data);
            throw new Error(data.message || 'Login failed');
        }
        
    } catch (error) {
        console.error('❌ Login error:', error);
        showMessage('Login gagal: ' + error.message, 'error');
        
    } finally {
        // Restore button state
        submitButton.textContent = originalText;
        submitButton.disabled = false;
    }
}

// Function untuk handle logout
export async function handleLogout() {
    console.log('🚪 Starting logout process...');
    
    const token = getToken();
    if (!token) {
        console.log('ℹ️ No token found, redirecting to login');
        window.location.href = '/login';
        return;
    }
    
    try {
        const response = await fetch('/api/logout', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': `Bearer ${token}`,
                'X-Requested-With': 'XMLHttpRequest'
            }
        });
        
        console.log('📥 Logout response:', response.status);
        
        // Clear token regardless of response (in case server is down)
        clearToken();
        
        console.log('✅ Logout completed');
        showMessage('Logout berhasil!', 'success');
        
        // Redirect to login
        setTimeout(() => {
            window.location.href = '/login';
        }, 1000);
        
    } catch (error) {
        console.error('❌ Logout error:', error);
        // Still clear token and redirect
        clearToken();
        window.location.href = '/login';
    }
}

// Utility function untuk show messages
function showMessage(message, type = 'info') {
    console.log(`📢 ${type.toUpperCase()}: ${message}`);
    
    // Create toast/alert element (optional)
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type}`;
    alertDiv.textContent = message;
    alertDiv.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px;
        border-radius: 5px;
        z-index: 9999;
        color: white;
        background-color: ${type === 'success' ? '#28a745' : type === 'error' ? '#dc3545' : '#17a2b8'};
    `;
    
    document.body.appendChild(alertDiv);
    
    // Remove after 3 seconds
    setTimeout(() => {
        if (alertDiv.parentNode) {
            alertDiv.parentNode.removeChild(alertDiv);
        }
    }, 3000);
}
