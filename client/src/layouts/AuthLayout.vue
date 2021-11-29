<template>
    <q-layout>
        <q-page-container>
            <q-page class="flex flex-center">
                <div class="layout-page">
                    <q-card flat bordered>
                        <q-tabs v-if="$route.name.split('.')[1] !== 'password'" no-caps active-color="primary" indicator-color="primary">
                            <q-route-tab label="Войти" name="sign_in"
                                         :to="{ name: 'auth.signin' }"></q-route-tab>
                            <q-route-tab label="Регистрация" name="sign_up"
                                         :to="{ name: 'auth.signup' }"></q-route-tab>
                        </q-tabs>
                        <router-view></router-view>
                    </q-card>
                </div>
            </q-page>
        </q-page-container>
    </q-layout>

</template>

<script>
import { defineComponent } from 'vue';

export default defineComponent({
    name: 'AuthLayout',
    setup() {

    },
});
</script>
