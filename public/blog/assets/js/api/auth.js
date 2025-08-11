const API_BASE = 'http://localhost:8000/api';
let token = localStorage.getItem('token') || null;

// Login
export async function login(email, password) {
    const res = await fetch(`${API_BASE}/login`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ email, password })
    });
    const data = await res.json();

    if (res.ok) {
        token = data.token;
        localStorage.setItem('token', token);
        alert('Login berhasil!');
    } else {
        alert(data.message || 'Login gagal');
    }
}

// Logout
export async function logout() {
    if (!token) return;
    await fetch(`${API_BASE}/logout`, {
        method: 'POST',
        headers: { 'Authorization': `Bearer ${token}` }
    });
    localStorage.removeItem('token');
    token = null;
    alert('Logout berhasil!');
}

// Ambil token untuk file lain
export function getToken() {
    return token;
}
