<template>
    <q-card v-if="$route.name === 'contacts.id'" bordered flat>
        <q-card-section class="text-h6 flex no-wrap justify-between items-center">
            <q-btn @click.prevent="$router.back()" icon="chevron_left" round flat></q-btn>
            <div v-if="getContact">
                {{ getContact.name }}
            </div>
            <q-skeleton size="50%" v-else type="text"></q-skeleton>
            <q-btn @click="toggleFavorites" color="orange"
                   :icon="getContact !== undefined ? getContact.is_favorite ? 'star' : 'star_border': 'load'" round flat></q-btn>
        </q-card-section>
        <q-card-section class="q-pt-none text-center">
            <div v-if="getContact" class="text-body1">
                {{ getContact.phone }}
            </div>
            <q-skeleton size="50%" v-else type="text"></q-skeleton>
        </q-card-section>
    </q-card>
    <router-view v-else></router-view>
</template>

<script>
import { defineComponent, computed } from 'vue';
import { useStore } from 'vuex';
import { useRoute } from 'vue-router';

export default defineComponent({
    name: 'Contact',
    setup() {
        const $store = useStore();
        const $route = useRoute();
        const getContact = computed(() => $store.getters['Contacts/getContactById']($route.params.id));
        const toggleFavorites = () => {
            if (getContact.value) {
                $store.dispatch('Contacts/toggleFavoriteById', getContact.value);
            }
        };
        return { getContact, toggleFavorites };
    },
});
</script>
