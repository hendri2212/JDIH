<script setup>
import { RouterLink, RouterView } from 'vue-router'
import Header from '@/components/Header.vue'
import HeaderBack from '@/components/HeaderBack.vue'

import "https://owlcarousel2.github.io/OwlCarousel2/assets/vendors/jquery.min.js"
import "https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/owl.carousel.js"
</script>

<template>
    <main>
        <Header v-if="$route.name!='report'" />
        <HeaderBack v-else />
        <RouterView />
    </main>
</template>
<style>
@import '@/assets/base.css';
@import url('https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/assets/owl.carousel.min.css');
@import url('https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/assets/owl.theme.default.min.css');

#app {
    max-width: 460px;
    margin: 0 auto;
}
</style>
