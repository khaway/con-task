<template>
    <q-item clickable
            :active="contact.id.toString() === $route.params.id"
             @click="onContactClick">
        <q-item-section avatar>
            <q-btn @click.stop="onFavoritesToggle" color="orange" round flat>
                <q-icon :name="contact.is_favorite ? 'star' : 'star_border'"></q-icon>
            </q-btn>
        </q-item-section>
        <q-item-section>
            <q-item-label class="ellipsis">{{ contact.name }}</q-item-label>
            <q-item-label class="ellipsis" caption>{{ contact.phone }}</q-item-label>
        </q-item-section>
        <q-item-section side>
            <div class="row no-wrap">
                <q-btn @click.stop="onContactEdit"
                    round unelevated flat color="primary" icon="edit"/>
                <q-btn @click.stop="onContactDelete"
                    round unelevated flat color="negative" icon="delete"/>
            </div>
        </q-item-section>
    </q-item>
</template>

<script>
import { defineComponent } from 'vue';
import { useRouter } from 'vue-router';

export default defineComponent({
    name: 'ContactListItem',
    emits: ['onContactDelete', 'onContactEdit', 'onFavoritesToggle', 'onContactClick'],
    props: {
        contact: {
            type: Object,
            required: true,
        },
    },
    setup(props, { emit }) {
        const $router = useRouter();
        function onContactDelete() {
            emit('onContactDelete', props.contact.id);
        }
        function onContactEdit() {
            emit('onContactEdit', props.contact.id);
        }
        function onFavoritesToggle() {
            emit('onFavoritesToggle', props.contact);
        }
        function onContactClick() {
            $router.push({ name: 'contacts.id', params: { id: props.contact.id } });
            emit('onContactClick', props.contact.id);
        }

        return {
            onContactDelete, onContactEdit, onFavoritesToggle, onContactClick,
        };
    },
});
</script>
