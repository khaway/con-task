<template>
    <q-layout class="bg-grey-2">
        <q-page-container>
            <q-page class="flex flex-center">
                <div class="layout-page">
                    <q-card bordered flat v-if="$route.name === 'contacts'">
                        <q-card-section class="text-h6">
                            <div>Список контактов</div>
                        </q-card-section>
                        <q-list v-if="$store.state.Contacts.contacts.length !== 0" separator>
                            <contact-list-item v-for="contact in $store.state.Contacts.contacts"
                                               @on-contact-click="$router.push({ name: 'contacts.id', params: { id: contact.id } })"
                                               @on-favorites-toggle="toggleFavorites"
                                               @on-contact-edit="editContact"
                                               @on-contact-delete="deleteContact"
                                               :key="contact.id"
                                               :contact="contact"/>
                        </q-list>
                        <div v-else class="flex flex-center q-py-md">
                            <q-spinner size="24px"></q-spinner>
                        </div>
                        <q-card-actions class="q-mt-auto" align="right">
                            <q-btn color="primary"
                                   class="full-width"
                                   @click="$router.push({ name: 'contacts.create' })"
                                   icon="add"
                                   outline label="Добавить контакт"></q-btn>
                        </q-card-actions>
                    </q-card>
                    <router-view v-else></router-view>
                </div>
                <q-page-sticky position="bottom-right" :offset="[16, 16]">
                    <q-btn @click="$store.dispatch('Auth/signout').then(() => $router.push('auth'))"
                           color="accent" label="Выйти"/>
                </q-page-sticky>
            </q-page>
        </q-page-container>
    </q-layout>
</template>

<script>
import ContactListItem from 'components/ContactListItem';
import { onBeforeMount } from 'vue';
import { useQuasar } from 'quasar';
import { useRouter } from 'vue-router';
import { useStore } from 'vuex';

export default {
    name: 'Contacts',
    components: { ContactListItem },
    setup() {
        const $q = useQuasar();
        const $router = useRouter();
        const $store = useStore();
        onBeforeMount(() => {
            $store.dispatch('Contacts/getContacts');
        });
        const deleteContact = (contactId) => {
            $q.dialog({
                title: $store.state.Contacts.contacts.filter((contact) => contact.id === contactId)[0].name,
                message: 'Вы действительно хотите удалить этот контакт?',
                cancel: {
                    outline: true,
                    label: 'Отмена',
                },
                ok: {
                    color: 'negative',
                    label: 'Удалить',
                },
            }).onOk(() => {
                $store.dispatch('Contacts/deleteContactById', contactId);
            });
        };
        const editContact = (contactId) => {
            $router.push({ name: 'contacts.id.edit', params: { id: contactId } });
        };
        const toggleFavorites = (contact) => {
            $store.dispatch('Contacts/toggleFavoriteById', contact);
        };

        return { deleteContact, editContact, toggleFavorites };
    },
};
</script>
<style>
.layout-page {
    width: 500px;
    height: 700px;
    max-height: 700px;
}
</style>
