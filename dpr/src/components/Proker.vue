<template>
    <main class="bg-white p-3 my-2">
        <h5 class="border-start border-5 border-warning px-2">Program Kerja</h5>
        <ul class="list-group">
            <li v-for="data in work_plans" :key="'work_plan_'+data.id_work_plan" class="list-group-item border-0 border-bottom"># {{data.title}}</li>
        </ul>
    </main>
</template>
<script>
    import axios from 'axios'
    export default {
        name: "Proker",
        data(){
            return {
                work_plans:[]
            }
        },
        created(){
            axios.get("http://127.0.0.1:8000/api/work-plans").then(response => {
                this.work_plans = response.data
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