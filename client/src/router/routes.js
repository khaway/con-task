const routes = [
    {
        path: '/',
        redirect: { name: 'contacts' },
        component: () => import('layouts/GlobalLayout.vue'),
        children: [
            {
                path: 'auth',
                name: 'auth',
                redirect: { name: 'auth.signin' },
                component: () => import('layouts/AuthLayout.vue'),
                meta: {
                    requiresAuth: false,
                },
                children: [
                    {
                        path: 'signin',
                        name: 'auth.signin',
                        component: () => import('pages/Auth/AuthSignin.vue'),
                    },
                    {
                        path: 'signup',
                        name: 'auth.signup',
                        component: () => import('pages/Auth/AuthSignup.vue'),
                    },
                    {
                        path: 'password/reset',
                        name: 'auth.password.reset',
                        component: () => import('pages/Auth/AuthPasswordReset.vue'),
                    },
                    {
                        path: 'password/update',
                        name: 'auth.password.update',
                        component: () => import('pages/Auth/AuthPasswordUpdate.vue'),
                    },
                ],

            },
            {
                path: 'contacts',
                name: 'contacts',
                component: () => import('pages/Contacts.vue'),
                meta: {
                    requiresAuth: true,
                },
                children: [
                    {
                        path: ':id',
                        name: 'contacts.id',
                        component: () => import('pages/Contact.vue'),
                        children: [
                            {
                                path: 'edit',
                                name: 'contacts.id.edit',
                                component: () => import('pages/ContactEdit.vue'),
                            },
                        ],
                    },
                    {
                        path: 'create',
                        name: 'contacts.create',
                        component: () => import('pages/ContactCreate.vue'),
                    },
                ],
            },
        ],
    },

    // Always leave this as last one,
    // but you can also remove it
    {
        path: '/:catchAll(.*)*',
        component: () => import('pages/Error404.vue'),
    },
];

export default routes;
