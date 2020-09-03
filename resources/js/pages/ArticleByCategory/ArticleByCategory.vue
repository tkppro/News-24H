<template>
    <div>
        <MixedContainer :title="title" :data="getArticlesByCategory.articles" :categorySlug="this.$route.params.slug"/>
    </div>
</template>

<script>
import MixedContainer from '../Dashboard/components/MixedContainer';

export default {
    components: {
        MixedContainer
    },
    data() {
        return {
            'title': '',
        }
    },
    created() {
        this.$store.dispatch('retrieveArticlesByCategory', this.$route.params.slug);
    },
    computed: {
        getArticlesByCategory() {
            let data = this.$store.getters.getArticlesByCategory;
            this.title = data.name;

            return data;
        }
    }
}
</script>

<style>

</style>