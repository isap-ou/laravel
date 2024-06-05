import { createInertiaApp } from '@inertiajs/vue3'
import createServer from '@inertiajs/vue3/server'
import { renderToString } from '@vue/server-renderer'
import { createSSRApp, h } from 'vue'
import InertiaTitle from 'inertia-title/vue3'
import i18n from "@/i18n.js";
import store from "@/store.js";

createServer(page =>
    createInertiaApp({
        page,
        render: renderToString,
        resolve: name => {
            const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
            return pages[`./Pages/${name}.vue`]
        },
        setup({ App, props, plugin }) {
            store.commit('setSettings', props.initialPage.props.global);
            return createSSRApp({
                render: () => h(App, props),
            }).use(plugin)
            .use(InertiaTitle)
            .use(i18n)
            .use(store)
        },
    }),
)