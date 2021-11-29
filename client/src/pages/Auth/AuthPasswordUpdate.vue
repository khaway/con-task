<template>
    <q-form @submit="passwordUpdate">
        <q-card-section class="text-h6">
            Восстановление пароля
        </q-card-section>
        <q-card-section class="q-pt-none">
            <q-input autofocus :model-value="passwordUpdateForm.resetToken" label="Введите полученный код"
                     @update:model-value="passwordUpdateForm.resetToken = $event"
            ></q-input>
            <q-input type="password" :model-value="passwordUpdateForm.newPassword" label="Введите новый пароль"
                     @update:model-value="passwordUpdateForm.newPassword = $event"
            ></q-input>
            <q-input type="password" :model-value="passwordUpdateForm.newPasswordConfirmation" label="Новый пароль ещё раз"
                     @update:model-value="passwordUpdateForm.newPasswordConfirmation = $event"
            ></q-input>
        </q-card-section>
        <q-card-actions align="right">
            <q-btn @click="$router.back()" no-caps unelevated label="Назад"></q-btn>
            <q-btn type="submit" no-caps color="primary" unelevated label="Сбросить пароль"></q-btn>
        </q-card-actions>
    </q-form>
</template>

<script>
import { defineComponent, reactive } from 'vue';
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';

export default defineComponent({
    name: 'AuthPasswordUpdate',
    setup() {
        const $store = useStore();
        const $router = useRouter();
        const passwordUpdateForm = reactive({
            resetToken: '',
            email: '',
            newPassword: '',
            newPasswordConfirmation: '',
        });
        const passwordUpdate = () => {
            passwordUpdateForm.email = $store.state.Auth.passwordUpdateEmail;
            $store.dispatch('Auth/passwordUpdate', passwordUpdateForm).then(() => $router.push({ name: 'auth' }));
        };
        return { passwordUpdateForm, passwordUpdate };
    },
});
</script>

<style scoped>

</style>
