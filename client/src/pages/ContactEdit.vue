<template>
    <q-card tag="form" @submit.prevent="updateContact" flat bordered>
        <q-card-section class="text-h6">
            Редактирование контакта
        </q-card-section>
        <q-card-section class="q-pt-none">
            <q-input :model-value="contactEdit.name"
                     @update:model-value="contactEdit.name = $event"
                     label="Новое Фио"
            ></q-input>
            <q-input :model-value="contactEdit.phone" @update:model-value="contactEdit.phone = $event"
                     label="Новый номер телефона"
            ></q-input>
        </q-card-section>
        <q-card-actions align="right">
            <q-btn @click="$router.back()" flat label="Отмена"></q-btn>
            <q-btn type="submit" unelevated color="primary" label="Обновить контакт"></q-btn>
        </q-card-actions>
    </q-card>
</template>

<script>
import {
    defineComponent, ref, watch, onMounted,
} from 'vue';
import { useStore } from 'vuex';
import { useRouter, useRoute } from 'vue-router';

export default defineComponent({
    name: 'ContactEdit',
    setup() {
        const $store = useStore();
        const $router = useRouter();
        const $route = useRoute();
        const contactEdit = ref({
            id: 0,
            name: '',
            phone: '',
        });
        onMounted(() => {
            if ($store.getters['Contacts/getContactById']($route.params.id)) {
                contactEdit.value = { ...$store.getters['Contacts/getContactById']($route.params.id) };
            }
        });

        watch(() => $store.state.Contacts.contacts, () => {
            contactEdit.value = { ...$store.getters['Contacts/getContactById']($route.params.id) };
        });

        const updateContact = () => {
            $store.dispatch('Contacts/updateContactById', contactEdit.value).then(() => {
                $router.push({ name: 'contacts' });
            });
        };
        return { contactEdit, updateContact };
    },
});
</script>
