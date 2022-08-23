<template>
	<div class="w-100 h-100">
		<cropper
		ref="cropper"
		class="upload-example-cropper"
		:src="image"
		:stencil-props="stencil_props"
		:default-position="default_position"
		:default-size="default_size"
		@ready="ready"
		/>
	</div>
</template>
<script>
	import { Cropper } from 'vue-advanced-cropper'
	import 'vue-advanced-cropper/dist/style.css';
	// // This function is used to detect the actual image type, 
	// function getMimeType(file, fallback = null) {
	// 	const byteArray = (new Uint8Array(file)).subarray(0, 4);
	// 	let header = '';
	// 	for (let i = 0; i < byteArray.length; i++) {
	// 	header += byteArray[i].toString(16);
	// 	}
	// 	switch (header) {
	// 		case "89504e47":
	// 			return "image/png";
	// 		case "47494638":
	// 			return "image/gif";
	// 		case "ffd8ffe0":
	// 		case "ffd8ffe1":
	// 		case "ffd8ffe2":
	// 		case "ffd8ffe3":
	// 		case "ffd8ffe8":
	// 			return "image/jpeg";
	// 		default:
	// 			return fallback;
	// 	}
	// }

	export default {
		components: {
			Cropper,
		},
		props:{
			image: String,
			stencil_props: {
				type: Object,
				default: {
					aspectRatio: 1,
				}
			},
			default_position:{
				type:Object,
				default:null
			},
			default_size:{
				type:Object,
				default:null
			}
		},
		methods: {
			getResult() {
				let {canvas, coordinates} = this.$refs.cropper.getResult()
				return {
					canvas, coordinates
				}
			},
			reset() {
				// this.image = {
				// 	src: null,
				// 	type: null
				// }
			},
			ready() {
				this.$emit('ready')
			}
		},
		destroyed() {
			// Revoke the object URL, to allow the garbage collector to destroy the uploaded before file
			if (this.image.src) {
				URL.revokeObjectURL(this.image.src)
			}
		}
	};
</script>