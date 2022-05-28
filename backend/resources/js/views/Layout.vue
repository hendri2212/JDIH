<template>
    <div class="wrapper">
        <navbar></navbar>
        <sidebar></sidebar>
        <main class="main--container">
            <slot></slot>
            <main-footer></main-footer>
        </main>
    </div>
</template>
<script>
import Navbar from '../components/Navbar.vue'
import Sidebar from '../components/Sidebar.vue'
import PageHeader from '../components/PageHeader.vue'
import MainFooter from '../components/MainFooter.vue'
export default ({
    components:{
        Navbar,
        Sidebar,
        PageHeader,
        MainFooter
    },
    setup() {
        
    },
})
</script>
