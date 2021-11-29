import { boot } from 'quasar/wrappers';

export default boot(({ router, store }) => {
    router.beforeEach((to, from, next) => {
        if (to.matched.some((record) => record.meta.requiresAuth)) {
            if (!store.getters['Auth/isLoggedIn']) {
                next('/auth');
                return;
            }
        } else if (store.getters['Auth/isLoggedIn']) {
            next('/contacts');
            return;
        }
        next();
    });
});
