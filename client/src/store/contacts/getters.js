const getters = {
    // eslint-disable-next-line no-unused-vars,eqeqeq
    getContactById: (state) => (contactId) => state.contacts.find((contact) => contact.id == contactId),
};

export default getters;
