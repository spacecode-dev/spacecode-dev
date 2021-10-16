Nova.booting((Vue, router, store) => {
    router.addRoutes([
        {
            name: 'settings',
            path: '/settings/:id?',
            component: require('./components/Settings').default,
        },
    ]);
});