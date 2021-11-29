<template>
    <q-form @submit.prevent="signIn">
        <q-card-section>
            <q-input autofocus type="email" :model-value="signinForm.email"
                     @update:model-value="signinForm.email = $event"
                     label="Почта"></q-input>
            <q-input type="password" :model-value="signinForm.password"
                     @update:model-value="signinForm.password = $event"
                     label="Пароль"></q-input>
        </q-card-section>
        <q-card-actions align="right">
            <q-btn @click="$router.push({ name: 'auth.password.reset' })" no-caps unelevated label="Восстановление пароля"></q-btn>
            <q-btn type="submit" no-caps color="primary" unelevated label="Войти"></q-btn>
        </q-card-actions>
    </q-form>
</template>

<script>
import { defineComponent, reactive } from 'vue';
import { useRouter } from 'vue-router';
import { useStore } from 'vuex';

export default defineComponent({
    name: 'AuthSignin',
    setup() {
        const $router = useRouter();
        const $store = useStore();
        const signinForm = reactive({
            email: '',
            password: '',
        });
        const signIn = () => {
            $store.dispatch('Auth/signin', signinForm)
                .then(() => $router.push({ name: 'contacts' }))
                .catch(() => {
                    //
                });
        };
        return { signinForm, signIn };
    },
});
</script>
