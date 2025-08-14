import { getToken } from './auth.js'; // file auth.js sama seperti sebelumnya

async function loadLemari() {
    const token = getToken();
    if (!token) {
        alert('Token tidak ditemukan, silakan login ulang');
        return;
    }

    const res = await fetch('/api/lemari', {
        headers: {
            'Authorization': `Bearer ${token}`,
            'Accept': 'application/json'
        }
    });

    if(res.ok){
        const data = await res.json();
        console.log('Data lemari:', data);
        // render data di tabel / UI
    } else {
        console.log('Error fetching API', await res.json());
    }
}

loadLemari();
