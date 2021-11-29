import { api } from 'boot/axios';

export const getContacts = () => api({
    url: 'contacts',
    method: 'get',
});

export const createContact = (contact) => api({
    url: 'contacts',
    method: 'post',
    data: {
        name: contact.name,
        phone: contact.phone,
    },
});

export const deleteContactById = (contactId) => api({
    url: `contacts/${contactId}`,
    method: 'delete',
});

export const updateContactById = (contact) => api({
    url: `contacts/${contact.id}`,
    method: 'put',
    data: {
        name: contact.name,
        phone: contact.phone,
    },
});

export const toggleFavoritesById = (contactId) => api({
    url: `contacts/${contactId}/toggle_favorite`,
    method: 'post',
});
