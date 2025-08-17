import { getToken } from './auth.js'; // pastiin token tersimpan pas login

async function loadLemari() {
    const token = getToken();
    if (!token) {
        alert('Token tidak ditemukan, silakan login ulang');
        return;
    }

    try {
        const res = await fetch("http://localhost:8000/api/lemari", {
            method: "GET",
            headers: {
                "Accept": "application/json",
                 "Content-Type": "application/json",
                "Authorization": "Bearer " + token
            }
        });

        if (res.ok) {
            const data = await res.json();
            console.log('Data lemari:', data);
            // render data di tabel / UI
        } else {
            const err = await res.json();
            console.error('Error fetching API:', err);
        }
    } catch (e) {
        console.error('Fetch error:', e);
    }
}

loadLemari();
