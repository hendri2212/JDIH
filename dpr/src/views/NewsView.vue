<template>
    <main>
        <News />
        <RelatedNews />
    </main>
</template>
<script>
import News from '@/components/News.vue'
import RelatedNews from '@/components/RelatedNews.vue'
export default {
    name: "NewsView",
    components:{
        News,
        RelatedNews
    }
}
</script>