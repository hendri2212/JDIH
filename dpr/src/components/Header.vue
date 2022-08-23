<template>
    <div class="bg-white p-3">
        <div class="d-flex justify-content-between align-items-center">
            <router-link to="/" class="text-decoration-none">
                <h4 class="mb-0 text-success">DPRD Kotabaru</h4>
            </router-link>
            <a :href="URL_ADMIN" class="text-decoration-none btn btn-sm btn-outline-success">Login</a>
        </div>
    </div>
</template>
<script>
    export default {
        name:"Header",
        data(){
            return {
                URL_ADMIN: import.meta.env.VITE_URL_ADMIN
            }
        }
    }
</script>