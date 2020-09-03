<template>
    <div class="container-fluid paddding mb-5">
        <div class="row mx-0">
            <div class="col-md-6 col-12 paddding animate-box" data-animate-effect="fadeIn">
                <div class="fh5co_suceefh5co_height">
                    <img :src="getTinmoinhat[0].front_image" alt="img"/>
                    <div class="fh5co_suceefh5co_height_position_absolute"></div>
                    <div class="fh5co_suceefh5co_height_position_absolute_font">
                        <div class="">
                            <router-link tag="a" :to="{
                                name: 'single-article',
                                params: {
                                    slug: getTinmoinhat[0].slug
                                }}" class="color_fff"> 
                                <i class="fa fa-clock-o"></i>
                                &nbsp;&nbsp;{{ convertDateString(getTinmoinhat[0].publication_date) }}
                            </router-link>
                        </div>
                        <div class="">
                            <router-link tag="a" :to="{
                                name: 'single-article',
                                params: {
                                    slug: getTinmoinhat[0].slug
                                }}" class="fh5co_good_font"> 
                                {{ getTinmoinhat[0].title }}
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <ListArticles :data="getTinmoinhat.slice(1)" />
            </div>
        </div>
    </div>
</template>

<script>
import ListArticles from './ListArticles';

export default {
    components: {
        ListArticles
    },
    props: {
       
    },
    data() {
        return {
            
        }
    },
    created() {
       
    },
    computed: {
        getTinmoinhat() {
            return this.$store.getters.getTinmoinhat.articles;
        },
    },
    methods: {
        
    }
}
</script>

<style>

</style>