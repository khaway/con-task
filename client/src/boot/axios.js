import { boot } from 'quasar/wrappers';
import { Notify } from 'quasar';
import axios from 'axios';

// Be careful when using SSR for cross-request state pollution
// due to creating a Singleton instance here;
// If any client changes this (global) instance, it might be a
// good idea to move this instance creation inside of the
// "export default () => {}" function below (which runs individually
// for each client)
const api = axios.create({
    baseURL: 'http://127.0.0.1:8000/api/',
    headers: {
        'Access-Control-Allow-Origin': '*',
    },
});

export default boot(({ app, store }) => {
    api.interceptors.request.use(
        (config) => {
            config.headers.accept = 'application/json';

            config.headers['content-type'] = 'application/json';

            if (store.state.Auth.token) {
                config.headers.Authorization = `Bearer ${store.state.Auth.token}`;
            }

            return config;
        },
        (error) => {
            Promise.reject(error);
        },
    );

    api.interceptors.response.use((response) => {
        Notify.create({
            type: 'positive',
            message: response.data.message ? response.data.message : 'Успех',
            timeout: 2000,
            progress: true,
        });

        return response;
    }, (error) => {
        if (error.response.data.message !== undefined) {
            const errorMessage = error.response.data.message;
            Notify.create({
                type: 'negative',
                message: errorMessage,
                timeout: 2000,
                progress: true,
            });
        }

        return Promise.reject(error);
    });

    app.config.globalProperties.$axios = axios;
    // ^ ^ ^ this will allow you to use this.$axios (for Vue Options API form)
    //       so you won't necessarily have to import axios in each vue file

    app.config.globalProperties.$api = api;
    // ^ ^ ^ this will allow you to use this.$api (for Vue Options API form)
    //       so you can easily perform requests against your app's API
});

export { api };
