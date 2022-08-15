<template>
    <page-header :breadcrumb='breadcrumb' :page_title="'Tambah Berita'"></page-header>
    <section class="main--content">
        <panel>
            <div class="records--header">
                <div class="title fa-shopping-bag">
                    <h3 class="h3">Berita <router-link :to="{ name:'ListNews' }" class="btn btn-sm btn-outline-info">Manage Berita</router-link></h3>
                    <!-- <p>Ditemukan Total 1,330 Berita</p> -->
                </div>

                <div class="actions">
                    <form action="#" class="search flex-wrap flex-md-nowrap">
                        <input type="text" class="form-control" placeholder="Judul berita..." required>
                        <button type="submit" class="btn btn-rounded"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
        </panel>
        <panel>
            <div class="records--body">
                <div class="title">
                    <h6 class="h6">Detail Berita</h6>

                    <!-- <a href="#" class="btn btn-rounded btn-danger">Hapus Berita</a> -->
                </div>
                <form @submit.prevent="createNews(1)">
                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label">Tag Berita: *</span>

                        <div class="col-md-9">
                            <tag :settings="tagSetting" :value="tagValue" :onChange="searchNewTag" :onChangeTag="onChangeTag"></tag>
                        </div>
                    </div>
                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label">Judul Berita: *</span>

                        <div class="col-md-9">
                            <input type="text" name="title" class="form-control" v-model="title" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label">Foto Berita: *</span>

                        <div class="col-md-9">
                            <file-upload ref="photo" @imageUploaded="imageUploaded"></file-upload>
                            <div class="row mt-3" v-if="imageUrl != null">
                                <div class="col-sm-8">
                                    <h3>Banner</h3>
                                    <div style="width:100%; aspect-ratio: auto 3/2;">
                                        <span v-if="loadingCropperBanner">Loading ...</span>
                                        <cropper-custom ref="cropperBanner" @ready="loadingCropperBanner = false" :stencil_props="{ aspectRatio: 3/2 }" :image="imageUrl"></cropper-custom>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <h3>Thumbnail</h3>
                                    <div style="width:100%; aspect-ratio: auto 1;">
                                        <span v-if="loadingCropperThumbnail">Loading ...</span>
                                        <cropper-custom ref="cropperThumbnail" @ready="loadingCropperThumbnail = false" :stencil_props="{ aspectRatio: 1 }" :image="imageUrl"></cropper-custom>
                                    </div>
                                </div>
                            </div>
                            <!-- <input ref="photo" type="file" name="photo" class="form-control" required> -->
                        </div>
                    </div>

                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label">Isi Berita:</span>

                        <div class="col-md-9">
                            <ckeditor required v-model="content" :editor="editor.editor" :config="editor.editorConfig"></ckeditor>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-9 offset-md-3">
                            <span @click="createNews(0)" class="px-3 text-primary" style="cursor: pointer;">Simpan Draft</span>
                            <input type="submit" value="Tambah Berita" class="btn btn-rounded btn-success">
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
import Tag from '../Helper/Tagify.vue'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import axios from 'axios'
import FileUpload from '../Helper/FileUpload.vue'
import CropperCustom from '../Helper/CropperCustom.vue';
axios.defaults.withCredentials = true;
export default {
    components: {
        PageHeader,
        Panel,
        Tag,
        FileUpload,
        CropperCustom,
    },
    setup() {
        const route = useRoute()
        const swal = inject('$swal')
        const breadcrumb = route.meta.breadcrumb

        const editor = ref({
            editor: ClassicEditor,
            editorConfig: {
                height:'400px'
            }
        })

        const title = ref('')
        const content = ref('')
        const photo = ref(null)
        const imageUrl = ref(null)
        const cropperBanner = ref(null);
        const cropperThumbnail = ref(null);
        const loadingCropperBanner = ref(false)
        const loadingCropperThumbnail = ref(false)
        const tagValue = ref([])
        const tagSetting = ref({
            whitelist: [],
            dropdown: {
                enabled: 0
            },
            callbacks: {
                add(e) {
                    // console.log("tag added:", e.detail);
                }
            }
        })

        const searchNewTag = async (query) => {
            const {data} = await axios.get(`${window.location.origin}/api/admin/tags?search=${query}`)
            return data.data.map(p => {
                return {
                    value:p.title
                }
            })
        }

        const onChangeTag = ({detail}) => {
            tagValue.value = detail.value != '' ? JSON.parse(detail.value) : []
        }

        const imageUploaded = (image) => {
            imageUrl.value = image
            loadingCropperBanner.value = true
            loadingCropperThumbnail.value = true
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

        const createNews = async (is_published = 1) => {
            let formData = new FormData()
            formData.append('title', title.value)
            formData.append('content', content.value)
            formData.append('photo', dataURLToBlob(imageUrl.value))
            let resultBanner = cropperBanner.value.getResult()
            let resultThumbnail = cropperThumbnail.value.getResult()
            formData.append('banner', dataURLToBlob(resultBanner.canvas.toDataURL()))
            formData.append('thumbnail', dataURLToBlob(resultThumbnail.canvas.toDataURL()))
            formData.append('bannerCoordinates', JSON.stringify(resultBanner.coordinates))
            formData.append('thumbnailCoordinates', JSON.stringify(resultThumbnail.coordinates))
            formData.append('is_published', is_published)
            formData.append('tags', JSON.stringify(tagValue.value))
            axios.post(window.location.origin + '/api/admin/news/create', formData).then(response => {
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

        return {
            breadcrumb,
            editor,
            title,
            content,
            photo,
            imageUrl,
            cropperBanner,
            cropperThumbnail,
            loadingCropperBanner,
            loadingCropperThumbnail,
            tagValue,
            tagSetting,
            searchNewTag,
            onChangeTag,
            imageUploaded,
            createNews,
        }
    },
}
</script>
<style>
    .ck-editor__editable {
        height: 400px !important;
    }
</style>