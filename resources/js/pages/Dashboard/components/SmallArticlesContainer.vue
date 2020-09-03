<template>
    <div class="container-fluid pb-4 pt-5">
        <div class="container animate-box">
            <div>
                <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">{{title}}</div>
            </div>
            <div class="owl-carousel owl-theme carousel-3" :id="sliderID">
                <div class="item px-2" v-for="item in data" :key="item.id">
                    <div class="fh5co_hover_news_img">
                        <div class="fh5co_news_img"><img :src="item.front_image" :alt="item.slug"/></div>
                        <div>
                            <router-link tag="a" :to="{
                                name: 'single-article',
                                params: {
                                    slug: item.slug
                                }}" class="d-block fh5co_small_post_heading">
                                <span class="">{{item.title}}</span>
                            </router-link>
                            <div class="c_g"><i class="fa fa-clock-o"></i> {{ convertDateString(item.publication_date)}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        sliderID: String,
        title: String,
        data: Array,
    },
    created() {
        // $('#' + this.$props.sliderID).carousel();
    },
    data() {
        return {
            "loaded": false,
        }
    },
    methods: {
        
    }
}
</script>

<style>

</style>