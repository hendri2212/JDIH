<template>    
    <layout>
        <page-header :breadcrumb='breadcrumb' :page_title="'Dashboard'"></page-header>
        <section class="main--content">
            <div class="row gutter-20">
            </div>
        </section>
    </layout>
</template>
<script>
import Layout from './Layout.vue'
import PageHeader from '../components/PageHeader.vue'
export default {
    components: {
        Layout,
        PageHeader
    },
    setup() {
        const breadcrumb = [
            {
                is_active:true,
                link: null,
                title: "Dashboard"
            }
        ]

        return {
            breadcrumb
        }
    },
}
</script>