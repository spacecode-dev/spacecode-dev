import filemanager from './components/Tool';

Nova.booting((Vue, router) => {
    router.addRoutes([
        {
            name: 'filemanager',
            path: '/filemanager',
            component: filemanager,
        },
    ]);
});