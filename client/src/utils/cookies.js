import { Cookies } from 'quasar';

const tokenKey = 'token';

export const getToken = () => Cookies.get(tokenKey);
export const setToken = (token) => Cookies.set(tokenKey, token);
export const removeToken = () => Cookies.remove(tokenKey);
