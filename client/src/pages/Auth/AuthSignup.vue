<template>
    <q-form @submit.prevent="signup">
        <q-card-section>
            <q-input autofocus type="email" :model-value="signupForm.email"
                     @update:model-value="signupForm.email = $event"
                     label="Почта"></q-input>
            <q-input type="password" :model-value="signupForm.password"
                     @update:model-value="signupForm.password = $event"
                     label="Пароль"></q-input>
            <q-input type="password" :model-value="signupForm.passwordConfirmation"
                     @update:model-value="signupForm.passwordConfirmation = $event"
                     label="Пароль"></q-input>
        </q-card-section>
        <q-card-actions align="right">
            <q-btn @click="$router.push({ name: 'auth' })" no-caps unelevated label="У меня есть аккаунт"></q-btn>
            <q-btn type="submit" no-caps color="primary" unelevated label="Зарегистрироваться"></q-btn>
        </q-card-actions>
    </q-form>
</template>

<script>
import { defineComponent, reactive } from 'vue';
import { useRouter } from 'vue-router';
import { useStore } from 'vuex';

export default defineComponent({
    name: 'AuthSignup',
    setup() {
        const $router = useRouter();
        const $store = useStore();
        const signupForm = reactive({
            email: '',
            password: '',
            passwordConfirmation: '',
        });
        const signup = () => {
            $store.dispatch('Auth/signup', signupForm)
                .then(() => $router.push({ name: 'contacts' }))
                .catch(() => {
                    //
                });
        };
        return { signupForm, signup };
    },
});
</script>
