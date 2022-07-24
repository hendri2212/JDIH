<template>
    <page-header :breadcrumb='breadcrumb' :page_title="'Tambah User'"></page-header>
    <section class="main--content">
        <panel>
            <div class="records--header">
                <div class="title fa-shopping-bag">
                     <h3 class="h3">User <router-link :to="{ name:'ListUser' }" class="btn btn-sm btn-outline-info">Manage User</router-link></h3>
                    <!-- <p>Ditemukan Total 1,330 User</p> -->
                </div>

                <!-- <div class="actions">
                    <form action="#" class="search flex-wrap flex-md-nowrap">
                        <input type="text" class="form-control" placeholder="User..." required>
                        <button type="submit" class="btn btn-rounded"><i class="fa fa-search"></i></button>
                    </form>
                </div> -->
            </div>
        </panel>
        <panel>
            <div class="records--body">
                <div class="title">
                    <h6 class="h6">Detail User</h6>

                    <!-- <a href="#" class="btn btn-rounded btn-danger">Hapus User</a> -->
                </div>
                <form @submit.prevent="updateUser">
                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label">Nama: *</span>

                        <div class="col-md-9">
                            <input type="text" name="name" id="name" v-model="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label">Username: *</span>

                        <div class="col-md-9">
                            <input type="text" name="title" class="form-control" v-model="username" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label">Password: *</span>

                        <div class="col-md-9">
                            <input type="password" name="password" class="form-control" v-model="password" required>
                            <small>*Biarkan kosong jika tidak ingin merubah password</small>
                            <small>*Min 8 Karakter</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label">Jenis: *</span>

                        <div class="col-md-9">
                            <input type="radio" v-model="type" name="type" value="admin"> Admin
                            <input type="radio" v-model="type" name="type" value="dpr"> DPR
                        </div>
                    </div>
                    <div class="form-group row" v-if="type == 'dpr'">
                        <span class="label-text col-md-3 col-form-label">Fraksi: *</span>

                        <div class="col-md-9">
                            <select name="id_fraction" v-model="id_fraction" class="form-control">
                                <option v-for="data in fraction" :value="data.id_fraction">{{ data.name }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label">Foto: *</span>

                        <div class="col-md-9">
                            <input ref="photo" type="file" name="photo" class="form-control">
                            <small>*Anggota Dewan wajib mengisi foto untuk di tampilkan di halaman utama</small>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-9 offset-md-3">
                            <!-- <span class="px-3 text-primary" style="cursor: pointer;">Simpan Draft</span> -->
                            <input type="submit" value="Tambah User" class="btn btn-rounded btn-success">
                        </div>
                    </div>
                </form>
            </div>
        </panel>
    </section>
</template>

<script>
import { ref, inject } from 'vue'
import { useRoute } from 'vue-router'
import PageHeader from '../PageHeader'
import Panel from '../Panel'
import axios from 'axios'
axios.defaults.withCredentials = true;
export default {
    components: {
        PageHeader,
        Panel
    },
    setup() {
        const route = useRoute()
        const swal = inject('$swal')
        const breadcrumb = route.meta.breadcrumb
        const name = ref('')
        const username = ref('')
        const password = ref('')
        const type = ref('admin')
        const photo = ref(null)
        const fraction = ref([])
        const id_fraction = ref(null)
        const getFraction = async () => {
            await axios.get(window.location.origin + '/api/fractions').then(response => {
                fraction.value = response.data
            })
        }
        const getUser = async () => {
            await axios.get(window.location.origin + `/api/admin/user/${route.params.id}`).then(response => {
                name.value = response.data.data.name
                username.value = response.data.data.username
                type.value = response.data.data.type
                id_fraction.value = response.data.data.fraction ? response.data.data.fraction.id : null
            })
        }
        const updateUser = async () => {
            let formData = new FormData
            formData.append('name', name.value)
            formData.append('username', username.value)
            formData.append('password', password.value)
            formData.append('type', type.value)
            if(photo.value.files){
                formData.append('photo', photo.value.files[0])
            }
            if(type.value == 'dpr'){
                formData.append('id_fraction', id_fraction.value)
            }
            axios.post(window.location.origin + '/api/admin/user/update', formData).then(response => {
                swal({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response.data,
                })
            }).catch((response) => {
                swal({
                    icon: 'error',
                    title: 'Gagal!',
                    text: response.data,
                })
            })
        }

        getFraction()
        getUser()
        return {
            breadcrumb,
            name,
            username,
            password,
            type,
            photo,
            fraction,
            id_fraction,
            updateUser,
        }
    },
}
</script>