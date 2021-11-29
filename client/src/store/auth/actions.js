import {
    signin, signup, passwordReset, passwordUpdate,
} from 'src/api/auth';
import { setToken, removeToken } from 'src/utils/cookies';
import { setPasswordResetEmail, removePasswordResetEmail } from 'src/utils/storage';

const actions = {
    async signup({ commit }, user) {
        const { email, password, passwordConfirmation } = user;
        email.trim();
        const { data } = await signup({ email, password, passwordConfirmation });
        setToken(data.data.access_token);
        commit('SET_TOKEN', data.data.access_token);
    },

    async signin({ commit }, user) {
        const { email, password } = user;
        email.trim();
        const { data } = await signin({ email, password });
        setToken(data.data.access_token);
        commit('SET_TOKEN', data.data.access_token);
    },

    signout({ commit }) {
        removeToken();
        commit('SET_TOKEN', '');
    },

    async passwordReset({ commit }, email) {
        email.trim();
        await passwordReset({ email });
        setPasswordResetEmail(email);
        commit('SET_PASSWORD_UPDATE_EMAIL', email);
    },
    async passwordUpdate({ commit }, user) {
        const {
            resetToken, email, newPassword, newPasswordConfirmation,
        } = user;
        email.trim();
        await passwordUpdate({
            resetToken, email, newPassword, newPasswordConfirmation,
        });
        removePasswordResetEmail();
        commit('SET_PASSWORD_UPDATE_EMAIL', '');
    },
};
export default actions;
