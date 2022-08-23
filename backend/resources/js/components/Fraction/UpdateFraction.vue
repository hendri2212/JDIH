<template>
    <page-header :breadcrumb='breadcrumb' :page_title="'Tambah Fraksi'"></page-header>
    <section class="main--content">
        <panel>
            <div class="records--header">
                <div class="title fa-shopping-bag">
                    <h3 class="h3">Fraksi <router-link :to="{name:'ListFraction'}" class="btn btn-sm btn-outline-info">Manage Fraksi</router-link></h3>
                    <!-- <p>Ditemukan Total 1,330 Fraksi</p> -->
                </div>

                <div class="actions">
                    <form action="#" class="search flex-wrap flex-md-nowrap">
                        <input type="text" class="form-control" placeholder="Fraksi..." required>
                        <!-- <select name="select" class="form-control">
                            <option value="" selected>Product Category</option>
                        </select> -->
                        <button type="submit" class="btn btn-rounded"><i class="fa fa-search"></i></button>
                    </form>

                    <router-link to="/fraction/create" class="addRelatedLink btn btn-lg btn-rounded btn-warning">Tambah Fraksi</router-link>
                </div>
            </div>
        </panel>
        <panel>
            <div class="records--body">
                <div class="title">
                    <h6 class="h6">Detail Fraksi</h6>
                    <span @click="showModalDelete(route.params.id)" class="btn btn-rounded btn-danger">Hapus Fraksi</span>
                </div>
                <form @submit.prevent="updateFraksi">
                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label">Nama Fraksi: *</span>

                        <div class="col-md-9">
                            <input type="text" name="title" class="form-control" v-model="name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label">Lambang Fraksi: *</span>

                        <div class="col-md-9">
                            <file-upload ref="photo" @imageUploaded="imageUploaded"></file-upload>
                            <div class="row mt-3" v-if="imageUrl != null">
                                <div class="col-sm-12">
                                    <div style="width:100%; aspect-ratio: auto 1/1;">
                                        <span v-if="loadingCropper">Loading ...</span>
                                        <cropper-custom ref="cropper" @ready="loadingCropper = false" :stencil_props="{ aspectRatio: 1/1 }" :default_position="default_position" :default_size="default_size" :image="imageUrl"></cropper-custom>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-9 offset-md-3">
                            <!-- <span class="px-3 text-primary" style="cursor: pointer;">Simpan Draft</span> -->
                            <input type="submit" value="Update Fraksi" class="btn btn-rounded btn-success">
                        </div>
                    </div>
                </form>
            </div>
        </panel>
    </section>
</template>

<script>
import { ref, inject } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import PageHeader from '../PageHeader'
import Panel from '../Panel'
import axios from 'axios'
axios.defaults.withCredentials = true;
import FileUpload from '../Helper/FileUpload.vue'
import CropperCustom from '../Helper/CropperCustom.vue';
export default {
    components: {
        PageHeader,
        Panel,
        FileUpload,
        CropperCustom
    },
    setup() {
        const route = useRoute()
        const router = useRouter()
        const swal = inject('$swal')
        const breadcrumb = route.meta.breadcrumb

        const loading = ref(false)
        const name = ref('')
        const photo = ref(null)
        const imageUrl = ref(null)
        const cropper = ref(null)
        const loadingCropper = ref(false)
        const default_position = ref(null)
        const default_size = ref(null)

        const imageUploaded = (image) => {
            imageUrl.value = image
            loadingCropper.value = true
        }

        const dataURLToBlob = (dataURL) => {
            var BASE64_MARKER = ';base64,';
            if (dataURL.indexOf(BASE64_MARKER) == -1) {
                var parts = dataURL.split(',');
                var contentType = parts[0].split(':')[1];
                var raw = parts[1];

                return new Blob([raw], {type: contentType});
            }

            var parts = dataURL.split(BASE64_MARKER);
            var contentType = parts[0].split(':')[1];
            var raw = window.atob(parts[1]);
            var rawLength = raw.length;

            var uInt8Array = new Uint8Array(rawLength);

            for (var i = 0; i < rawLength; ++i) {
                uInt8Array[i] = raw.charCodeAt(i);
            }

            return new Blob([uInt8Array], {type: contentType});
        }

        function getBase64Image(url) {
            return new Promise((resolve, reject) => {
                var canvas = document.createElement("canvas");
                var ctx = canvas.getContext('2d');
                var img = new Image;
                img.onload = function(){
                    canvas.width = img.width
                    canvas.height = img.height
                    ctx.drawImage(img,0,0);
                    resolve(canvas.toDataURL())
                };
                img.src = url;
            })
        }

        const getFraction = async () => {
            await axios.get(window.location.origin + '/api/admin/fraction/'+ route.params.id).then(response => {
                getBase64Image(`${window.location.origin}/storage/${response.data.photo}`).then(image => {
                    loading.value = false
                    name.value = response.data.name
                    imageUrl.value = image
                    let coordinates = JSON.parse(response.data.coordinates)
                    default_position.value = {
                        top : coordinates.top,
                        left : coordinates.left,
                    }
                    default_size.value = {
                        width : coordinates.width,
                        height : coordinates.height,
                    }
                })
            })
        }
        const updateFraksi = async () => {
            let formData =  new FormData()
            formData.append('name', name.value)
            let result = cropper.value.getResult()
            formData.append('photo', dataURLToBlob(result.canvas.toDataURL()))
            formData.append('coordinates', JSON.stringify(result.coordinates))
            axios.post(window.location.origin + '/api/admin/fraction/'+ route.params.id, formData).then(response => {
                swal({
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

        const showModalDelete = async (id) => {
            await swal({
                title: 'Apa anda yakin?',
                text: 'Data ini akan dihapus secara permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "Yakin!",
                cancelButtonText: "Batal",
            }).then(({isConfirmed}) => {
                if (isConfirmed) {
                    axios.delete(window.location.origin + `/api/admin/fraction/${id}`).then(response => {
                        router.push({
                            name:"ListFraction"
                        })
                    }).catch(({response}) => {
                        swal({
                            icon: 'error',
                            title: 'Gagal!',
                            text: response.data,
                        })
                    })
                }
            });
        }

        getFraction()
        // onMounted(getFraction)

        return {
            route,
            breadcrumb,
            loading,
            name,
            photo,
            imageUrl,
            imageUploaded,
            cropper,
            loadingCropper,
            default_position,
            default_size,
            updateFraksi,
            showModalDelete
        }
    },
}
</script>
<style>
    .ck-editor__editable {
        height: 400px !important;
    }
</style>