<template v-once>
  <textarea v-if="mode === 'textarea'"/>
  <input v-else>
</template>

<script>
import Tagify from "@yaireo/tagify/dist/tagify.min.js";
import "@yaireo/tagify/dist/tagify.css";

export default {
  name: "Tags",
  props: {
    mode: String,
    settings: Object,
    value: Array,
    onChangeTag: Function,
    onChange: Function,
  },
  data(){
    return {
      tagify:null
    }
  },
  mounted() {
    this.tagify = new Tagify(this.$el, this.settings)
    // this.tagify.addTags(this.value)
    this.tagify.on('change', this.onChangeTag)
    this.tagify.on('input', this.onInput)
  },
  methods:{
    async onInput({detail}){
      let value = detail.value
      this.tagify.loading(true).dropdown.hide()
      let new_whitelist = await this.onChange(value)
      this.tagify.whitelist = new_whitelist // update whitelist Array in-place
      this.tagify.loading(false).dropdown.show(value)
    },
    async addTags(data){
      this.tagify.addTags(data)
    }
  }
};
</script>