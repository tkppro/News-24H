<template>
    <div>
        <BigArticlesContainer />
        <SubArticlesContainer />
        <SmallArticlesContainer :data="getThoisu.articles" :sliderID="slider1" :title="'Thời sự'"/>
        <SmallArticlesContainer :data="getSuckhoe.articles" :sliderID="slider2" :title="'Sức khỏe'"/>
        <MixedContainer :data="getArticlesByCategory.articles" :title="'Kinh doanh'" :categorySlug="'kinh-doanh'" />
    </div>
</template>

<script>
import BigArticlesContainer from './components/BigArticlesContainer';
import SubArticlesContainer from './components/SubArticlesContainer';
import SmallArticlesContainer from './components/SmallArticlesContainer';
import MixedContainer from './components/MixedContainer';

export default {
    components: {
        BigArticlesContainer,
        SubArticlesContainer,
        SmallArticlesContainer,
        MixedContainer
    },
    data() {
        return {
            slider1: 'slider2',
            slider2: 'slider3',
        }
    },
    created() {
        this.$store.dispatch('retrieveArticles');
    },
    computed: {
        getThoisu() {
            return this.$store.getters.getThoisu;
        },
        getSuckhoe() {
            return this.$store.getters.getSuckhoe;
        },
        // getKinhdoanh() {
        //     return this.$store.getters.getKinhdoanh;
        // },
        getCategories() {
            return this.$store.getters.getCategories;
        },
        getArticlesByCategory() {
            return this.$store.getters.getArticlesByCategory;
        }
    }
}
</script>

<style>

</style>