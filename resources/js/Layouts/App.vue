<script setup>
import {useI18n} from "vue-i18n";
import {usePage} from "@inertiajs/vue3";
import {onMounted} from "vue";

import Header from '@/Layouts/Partials/App/Header.vue';
import Footer from '@/Layouts/Partials/App/Footer.vue';

const {locale} = useI18n({useScope: 'global'});

locale.value = usePage().props?.locale ?? import.meta.env.VITE_APP_LOCALE

onMounted(() => {
    document.querySelector('html').setAttribute('lang', usePage().props?.locale)
})

</script>

<template>
    <Header />
    <main>
        <slot />
    </main>
    <Footer />
</template>

<style scoped>

</style>