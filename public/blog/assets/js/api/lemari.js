import { getToken, clearToken } from './auth.js';

export async function loadLemari() {
    console.log('🔄 Loading lemari data...');
    
    const token = getToken();
    if (!token) {
        console.error('❌ No token available');
        alert('Anda harus login terlebih dahulu');
        window.location.href = '/login';
        return;
    }
    
    console.log('🔑 Using token for API call');
    
    try {
        const response = await fetch('/api/lemari', { // Relative URL
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`,
                'X-Requested-With': 'XMLHttpRequest'
            }
        });
        
        console.log('📥 API Response status:', response.status);
        
        if (response.ok) {
            const data = await response.json();
            console.log('✅ Lemari data loaded:', data);
            return data;
            
        } else if (response.status === 401) {
            console.error('❌ Token expired or invalid');
            clearToken();
            alert('Session expired, please login again');
            window.location.href = '/login';
            
        } else if (response.status === 403) {
            console.error('❌ Access forbidden');
            alert('You do not have permission to access this resource');
            
        } else {
            const errorData = await response.json().catch(() => ({ message: 'Unknown error' }));
            console.error('❌ API Error:', errorData);
            alert(`Error: ${errorData.message}`);
        }
        
    } catch (error) {
        console.error('❌ Network error:', error);
        alert('Network error: ' + error.message);
    }
}

// Auto-load when script runs (if needed)
// loadLemari()