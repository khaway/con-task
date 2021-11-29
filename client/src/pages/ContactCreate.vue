<template>
    <q-card tag="form" @submit.prevent="addNewContact" bordered flat>
        <q-card-section class="text-h6">
            Добавление контакта
        </q-card-section>
        <q-card-section class="q-pt-none">
            <q-input :model-value="newContactForm.name"
                     @update:model-value="newContactForm.name = $event"
                     label="ФИО"></q-input>
            <q-input :model-value="newContactForm.phone"
                     @update:model-value="newContactForm.phone = $event"
                     label="Номер телефона"></q-input>
        </q-card-section>
        <q-card-actions align="right">
            <q-btn @click.prevent="$router.back()" flat label="Отмена"></q-btn>
            <q-btn type="submit" unelevated color="primary" label="Добавить"></q-btn>
        </q-card-actions>
    </q-card>
</template>

<script>
import { defineComponent, reactive } from 'vue';
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';

export default defineComponent({
    name: 'ContactCreate',
    setup() {
        const $store = useStore();
        const $router = useRouter();
        const newContactForm = reactive({
            name: '',
            phone: '',
        });
        const addNewContact = () => {
            $store.dispatch('Contacts/createContact', newContactForm).then(() => {
                newContactForm.name = '';
                newContactForm.phone = '';
                $router.push({ name: 'contacts' });
            });
        };
        return { newContactForm, addNewContact };
    },
});
</script>
