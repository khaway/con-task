const tokenKey = 'token';
const passwordResetEmail = 'password-reset-email';

export const getToken = () => localStorage.getItem(tokenKey);
export const setToken = (token) => localStorage.setItem(tokenKey, token);
export const removeToken = () => localStorage.removeItem(tokenKey);
export const getPasswordResetEmail = () => localStorage.getItem(passwordResetEmail);
export const setPasswordResetEmail = (email) => localStorage.setItem(passwordResetEmail, email);
export const removePasswordResetEmail = () => localStorage.removeItem(passwordResetEmail);
