<template>
    <router-view/>
</template>
<script>
import { defineComponent, onBeforeMount } from 'vue';
import { useRouter } from 'vue-router';
import { api } from 'boot/axios';
import { useStore } from 'vuex';

export default defineComponent({
    name: 'App',
    setup() {
        const $router = useRouter();
        const $store = useStore();
        onBeforeMount(() => {
            api.interceptors.response.use(undefined, (err) => new Promise(() => {
                // eslint-disable-next-line no-underscore-dangle
                if (err.response !== undefined && err.response.status === 401 && err.response.config && !err.response.config.__isRetryRequest !== undefined) {
                    $store.dispatch('Auth/logout').then(() => {
                        if ($router.currentRoute.value.path !== '/auth') {
                            $router.push('/auth');
                        }
                    });
                }
                throw err;
            }));
        });
    },
});
</script>
