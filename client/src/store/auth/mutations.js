const mutations = {
    SET_TOKEN(state, token) {
        state.token = token;
    },
    SET_PASSWORD_UPDATE_EMAIL(state, email) {
        state.passwordUpdateEmail = email;
    },
};
export default mutations;
