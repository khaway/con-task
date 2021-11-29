import {
    getContacts, createContact, deleteContactById, updateContactById, toggleFavoritesById,
} from 'src/api/contacts';

const actions = {

    async getContacts({ commit }) {
        const { data } = await getContacts();
        commit('SET_CONTACTS', data.data);
    },
    async createContact({ commit }, contact) {
        const { name, phone } = contact;
        const { data } = await createContact({ name, phone });
        commit('PUSH_NEW_CONTACT_TO_CONTACTS', data.data);
    },
    async deleteContactById({ commit }, contactId) {
        await deleteContactById(contactId);
        commit('DELETE_CONTACT_BY_ID', contactId);
    },
    async updateContactById({ commit }, contact) {
        const { id, name, phone } = contact;
        const { data } = await updateContactById({ id, name, phone });
        commit('UPDATE_CONTACT_BY_ID', data.data);
    },
    async toggleFavoriteById({ commit }, contact) {
        await toggleFavoritesById(contact.id);
        commit('TOGGLE_FAVORITE_CONTACT_BY_ID', contact);
    },
};

export default actions;
