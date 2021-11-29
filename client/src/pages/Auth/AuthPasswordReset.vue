<template>
    <q-form @submit="passwordReset">
        <q-card-section class="text-h6">
            Восстановление пароля
        </q-card-section>
        <q-card-section class="q-pt-none">
            <q-input autofocus :model-value="email" label="Введите свою почту"
                     type="email"
                     @update:model-value="email = $event"
            ></q-input>
        </q-card-section>
        <q-card-actions align="right">
            <q-btn @click="$router.back()" no-caps unelevated label="Назад"></q-btn>
            <q-btn type="submit" no-caps color="primary" unelevated label="Сбросить пароль"></q-btn>
        </q-card-actions>
    </q-form>
</template>

<script>
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';
import { ref } from 'vue';

export default {
    name: 'AuthPasswordReset',
    setup() {
        const $store = useStore();
        const $router = useRouter();
        const email = ref('');
        const passwordReset = () => {
            $store.dispatch('Auth/passwordReset', email.value).then(() => {
                $router.push({ name: 'auth.password.update' });
            });
        };
        return { email, passwordReset };
    },
};
</script>
