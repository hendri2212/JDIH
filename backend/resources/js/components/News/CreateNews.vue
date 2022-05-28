<template>
    <page-header :breadcrumb='breadcrumb' :page_title="'Tambah Berita'"></page-header>
    <section class="main--content">
        <panel>
            <div class="records--header">
                <div class="title fa-shopping-bag">
                    <h3 class="h3">Berita <a href="#" class="btn btn-sm btn-outline-info">Manage Berita</a></h3>
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
                        <span class="label-text col-md-3 col-form-label">Judul Berita: *</span>

                        <div class="col-md-9">
                            <input type="text" name="title" class="form-control" v-model="title" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label">Foto Berita: *</span>

                        <div class="col-md-9">
                            <input ref="photo" type="file" name="photo" class="form-control" required>
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
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
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

        const editor = ref({
            editor: ClassicEditor,
            editorConfig: {
                height:'400px'
            }
        })

        const title = ref('')
        const content = ref('')
        const photo = ref(null)

        const createNews = async (is_published = 1) => {
            let formData = new FormData()
            formData.append('title', title.value)
            formData.append('content', content.value)
            formData.append('photo', photo.value.files[0])
            formData.append('is_published', is_published)
            axios.post(window.location.origin + '/api/admin/news/create', formData).then(response => {
                swal({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response.data,
                })
            }).catch(() => {
                swal({
                    icon: 'error',
                    title: 'Gagal!',
                    text: response.data,
                })
            })
        }

        return {
            breadcrumb,
            editor,
            title,
            content,
            photo,
            createNews
        }
    },
}
</script>
<style>
    .ck-editor__editable {
        height: 400px !important;
    }
</style>