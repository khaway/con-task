import { api } from 'boot/axios';

export const signin = (data) => api({
    url: 'auth/signin',
    method: 'post',
    data: {
        email: data.email,
        password: data.password,
    },
});
export const signup = (data) => api({
    url: 'auth/signup',
    method: 'post',
    data: {
        email: data.email,
        password: data.password,
        password_confirmation: data.passwordConfirmation,
    },
});
export const passwordReset = (data) => api({
    url: 'auth/password/reset',
    method: 'post',
    data: {
        email: data.email,
    },
});
export const passwordUpdate = (data) => api({
    url: 'auth/password/update',
    method: 'post',
    data: {
        email: data.email,
        new_password: data.newPassword,
        new_password_confirmation: data.newPasswordConfirmation,
        reset_token: data.resetToken,
    },
});
