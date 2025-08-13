// Simpan token
export function setToken(token) {
    localStorage.setItem('api_token', token);
}

// Ambil token
export function getToken() {
    return localStorage.getItem('api_token');
}

// Hapus token (logout)
export function removeToken() {
    localStorage.removeItem('api_token');
}
