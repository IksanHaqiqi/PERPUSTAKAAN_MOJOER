import { getToken } from './auth.js';

const API_BASE = '/api/lemari';

export async function getBuku() {
    const res = await fetch(API_BASE, {
        headers: { 'Authorization': `Bearer ${getToken()}` }
    });
    return await res.json();
}

export async function addBuku(buku) {
    const res = await fetch(API_BASE, {
        method: 'POST',
        headers: { 
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${getToken()}`
        },
        body: JSON.stringify(buku)
    });
    return await res.json();
}

export async function updateBuku(id, buku) {
    const res = await fetch(`${API_BASE}/${id}`, {
        method: 'PUT',
        headers: { 
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${getToken()}`
        },
        body: JSON.stringify(buku)
    });
    return await res.json();
}

export async function deleteBuku(id) {
    const res = await fetch(`${API_BASE}/${id}`, {
        method: 'DELETE',
        headers: { 'Authorization': `Bearer ${getToken()}` }
    });
    return await res.json();
}
