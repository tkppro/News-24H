<template>
    <div>  
        <Banner :data="getSingleArticle"/>
        <Content :data="getSingleArticle"/>
        <Trending  :data="getTrendingArticles"/>
    </div>
</template>

<script>
import Banner from '../SingleArticle/components/Banner';
import Content from '../SingleArticle/components/Content';
import Trending from '../SingleArticle/components/Trending';

export default {
    data() {
        return {
            slug: this.$route.params.slug,
        }
        
    },
    components: {
        Banner,
        Content, 
        Trending
    },
    computed: {
        getSingleArticle() {
            return this.$store.getters.getSingleArticle;
        },
        getTrendingArticles() {
            return this.$store.getters.getTrendingArticles;
        }
    },
    mounted() {
        this.$store.dispatch('retrieveSingleArticle', this.slug);
    }
}
</script>

<style>

</style>