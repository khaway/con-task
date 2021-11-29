const mutations = {
    SET_CONTACTS(state, contacts) {
        state.contacts = contacts;
    },
    PUSH_NEW_CONTACT_TO_CONTACTS(state, newContact) {
        state.contacts.push(newContact);
    },
    DELETE_CONTACT_BY_ID(state, contactId) {
        state.contacts = state.contacts.filter((contact) => contact.id !== contactId);
    },
    UPDATE_CONTACT_BY_ID(state, updatedContact) {
        state.contacts = state.contacts.map((contact) => {
            if (contact.id === updatedContact.id) {
                contact = updatedContact;
            }
            return contact;
        });
    },
    TOGGLE_FAVORITE_CONTACT_BY_ID(state, updatedContact) {
        updatedContact.is_favorite = !updatedContact.is_favorite;
        state.contacts = state.contacts.map((contact) => {
            if (contact.id === updatedContact.id) {
                contact = updatedContact;
            }
            return contact;
        });
    },
};

export default mutations;
