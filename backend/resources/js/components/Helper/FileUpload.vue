<template>
    <div>
        <div @click="sendEventImage()" class="card" style="border-style: dashed; cursor: pointer;">
            <div class="card-body d-flex justify-content-center align-items-center">
                <h4 class="text-primary m-0">
                    <span v-if="imageResizingLoading">Loading ...</span>
                    <span v-else>
                        <span v-if="imageUrl != null">Ganti Gambar</span>
                        <span v-else>Upload gambar</span>
                    </span>
                </h4>
            </div>
        </div>
        <input style="display:none" ref="EventfileInput" @change="onEventFilePicked" type="file" name="upload" accept="image/*" />
    </div>
</template>

<script>

import { ref } from 'vue'
export default {
    name: 'FileUpload',
    props:{
        imageProps:{
            type:String,
            default: null
        },
    },
    emits: ['imageUploaded'],
    setup (props, { emit }) {
        const imageResizingLoading = ref(false);
        const imageUrl = ref(props.imageProps);
        const EventfileInput = ref(null);
          
        const onEventFilePicked = (event) => {
            imageUrl.value = null
            imageResizingLoading.value = true
            const files = event.target.files
            const image = files[0]
            
            const filename = image.name
            if (filename.lastIndexOf('.') <= 0) {
              return alert('File tidak valid!')
            }
            const fileReader = new FileReader()
            fileReader.addEventListener('load', (event) => {
                var img = new Image();
                img.onload = function (imageEvent) {
                    var canvas = document.createElement('canvas'),
                    max_width = 630,
                    width = img.width,
                    height = img.height;

                    height *= max_width / width;
                    width = max_width;
                    canvas.width = width;
                    canvas.height = height;
                    canvas.getContext('2d').drawImage(img, 0, 0, width, height);
                    var dataUrl = canvas.toDataURL('image/png');
                    imageUrl.value = dataUrl
                    imageResizingLoading.value = false
                    emit('imageUploaded', imageUrl.value);
                }
                img.src = event.target.result;
            })
            fileReader.readAsDataURL(image)
        };
        const sendEventImage = () => {
            EventfileInput.value.click()
        };
        return {
            imageResizingLoading,
            imageUrl,
            EventfileInput,
            sendEventImage,
            onEventFilePicked,
        }
    }
}
</script>
<style scoped>
    .backdrop {
        position:absolute;
        top:0; 
        left:0;
        width:100%; 
        height:100%; 
        background-color: rgba(0, 0, 0, 0); 
        transition:.5s;
        display:flex;
        justify-content: center;
        align-items: center;
        cursor:pointer;
    }
    .backdrop span {
        transition:.4s;
        font-size:2em;
        opacity:0;
    }
    .backdrop:hover {
        background-color: rgba(0, 0, 0, .7); 
    }

    .backdrop:hover span {
        opacity:1;
    }
</style>