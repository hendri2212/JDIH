<template>
    <main class="bg-white p-3 my-2">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" v-model="name">
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat" v-model="address">
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">Judul Aspirasi</label>
            <input type="text" class="form-control" id="title" v-model="title">
        </div>
        <div class="mb-3">
            <label for="information" class="form-label">Keterangan</label>
            <textarea class="form-control" id="information" rows="3" v-model="description"></textarea>
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Gambar</label>
            <input ref="photo" class="form-control" type="file" id="formFile">
        </div>
        
        <nav class="navbar px-3 bg-white fixed-bottom shadow-lg justify-content-end" style="max-width: 460px; margin: 0 auto">
            <span @click="saveReport" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
                    <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
                </svg>
                Kirim
            </span>
        </nav>
    </main>
</template>
<script>
    import axios from 'axios'
    export default {
        name: "Report",
        data(){
            return {
                name:"",
                address:"",
                title:"",
                description:""
            }
        },
        created(){
            axios.get(`${import.meta.env.VITE_URL_API}/sanctum/csrf-cookie`).then(response => {
                console.log(response)
            });
        },
        methods:{
            saveReport(){
                let formData = new FormData()
                formData.append('name', this.name)
                formData.append('address', this.address)
                formData.append('photo', this.$refs.photo.files[0])
                formData.append('title', this.title)
                formData.append('description', this.description)
                axios.post(`${import.meta.env.VITE_URL_API}/aspirations`, formData).then(response => {
                    this.$swal({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.data,
                    }).then(({isConfirmed}) => {
                        if(isConfirmed){
                            window.location.reload()
                        }
                    })
                }).catch(({response}) => {
                    swal({
                        icon: 'error',
                        title: 'Gagal!',
                        text: response.data,
                    }).then(({isConfirmed}) => {
                        if(isConfirmed){
                            window.location.reload()
                        }
                    })
                })
            }
        }
    }
</script>