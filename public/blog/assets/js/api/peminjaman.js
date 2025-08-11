import { getToken } from './auth.js';

const API_BASE = 'http://localhost:8000/api/peminjaman';

export async function getPeminjaman() {
    const res = await fetch(API_BASE, {
        headers: { 'Authorization': `Bearer ${getToken()}` }
    });
    return await res.json();
}

export async function addPeminjaman(data) {
    const res = await fetch(API_BASE, {
        method: 'POST',
        headers: { 
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${getToken()}`
        },
        body: JSON.stringify(data)
    });
    return await res.json();
}
