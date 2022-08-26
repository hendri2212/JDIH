<template>
    <main class="bg-white p-3 my-2">
        <h5 class="border-start border-5 border-warning px-2 text-dark">Program Kerja</h5>
        <ul v-if="!loading" class="list-group">
            <li v-for="data in work_plans" :key="'work_plan_'+data.id_work_plan" class="list-group-item border-0 border-bottom"># {{data.title}}</li>
        </ul>
        <ul v-else class="list-group placeholder-glow">
            <li class="list-group-item border-0 border-bottom">
                <span class="placeholder placeholder-lg col-12 bg-secondary"></span>
            </li>
            <li class="list-group-item border-0 border-bottom">
                <span class="placeholder placeholder-lg col-12 bg-secondary"></span>
            </li>
            <li class="list-group-item border-0 border-bottom">
                <span class="placeholder placeholder-lg col-12 bg-secondary"></span>
            </li>
            <li class="list-group-item border-0 border-bottom">
                <span class="placeholder placeholder-lg col-12 bg-secondary"></span>
            </li>
        </ul>
    </main>
</template>
<script>
    import axios from 'axios'
    export default {
        name: "Proker",
        data(){
            return {
                work_plans:[],
                loading:false
            }
        },
        created(){
            this.loading = true
            axios.get(`${import.meta.env.VITE_URL_API}/work-plans`).then(response => {
                this.work_plans = response.data
                this.loading = false
            })
        }
    }
</script>
<style scoped>
    .head-of-section{
        border-left: 6px solid rgb(54, 182, 182);
        padding-left:3px;
        border-top-left-radius: 3px;
    }
</style>