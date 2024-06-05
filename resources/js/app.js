import {createSSRApp, h} from 'vue'
import {initFlowbite} from 'flowbite'
import {createInertiaApp, router} from '@inertiajs/vue3'
import InertiaTitle from 'inertia-title/vue3'
import store from "./store.js";
import i18n from "@/i18n.js";

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', {eager: true})
        return pages[`./Pages/${name}.vue`]
    },
    setup({el, App, props, plugin}) {
        store.commit('setSettings', props.initialPage.props.global)
        createSSRApp({render: () => h(App, props)})
        .use(plugin)
        .use(i18n)
        .use(InertiaTitle)
        .use(store)
        .mount(el)
    },
}).then(() => {
    document.getElementById('app').removeAttribute('data-page');
    router.on('navigate', () => initFlowbite())
})