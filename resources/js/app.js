import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import moment from "moment";

InertiaProgress.init();

createInertiaApp({
    title: (title) => `${title} - Inertia App`,
    resolve: (name) => require(`./Pages/${name}`),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(moment)
            .mixin({
                methods: {
                    route,
                    hasAnyPermission: function (permissions) {
                        var allPermissions = this.$page.props.auth.can;
                        var hasPermission = false;
                        permissions.forEach(function (item) {
                            if (allPermissions[item]) hasPermission = true;
                        });
                        return hasPermission;
                    },
                    moment: function (date) {
                        return moment(date).format("D-MM-YYYY HH:mm");
                    },
                },
            })
            .mount(el);
    },
});
