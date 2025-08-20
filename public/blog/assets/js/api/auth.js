// ========================================
// 1. PERBAIKAN auth.js - DENGAN DEBUGGING LENGKAP
// ========================================

export function saveToken(token) {
    console.log('💾 Attempting to save token:', token);
    
    if (!token) {
        console.error('❌ Cannot save empty token');
        return false;
    }
    
    try {
        localStorage.setItem('token', token);
        console.log('✅ Token saved successfully');
        
        // Verify token was saved
        const savedToken = localStorage.getItem('token');
        if (savedToken === token) {
            console.log('✅ Token verification successful');
            return true;
        } else {
            console.error('❌ Token verification failed');
            return false;
        }
    } catch (e) {
        console.error('❌ Error saving token:', e);
        return false;
    }
}

export function getToken() {
    try {
        const token = localStorage.getItem('token');
        console.log('🔍 Getting token:', token ? '✅ Token found' : '❌ No token');
        return token;
    } catch (e) {
        console.error('❌ Error getting token:', e);
        return null;
    }
}

export function clearToken() {
    try {
        localStorage.removeItem('token');
        console.log('🗑️ Token cleared');
        return true;
    } catch (e) {
        console.error('❌ Error clearing token:', e);
        return false;
    }
}

// Debug function - check localStorage
export function debugStorage() {
    console.log('=== STORAGE DEBUG ===');
    console.log('localStorage available:', typeof(Storage) !== "undefined");
    console.log('All localStorage items:', {...localStorage});
    console.log('Token specifically:', localStorage.getItem('token'));
    console.log('==================');
}