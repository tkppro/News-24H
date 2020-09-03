<template>
    <div class="container-fluid pt-3">
        <div class="container animate-box" data-animate-effect="fadeIn">
            <div>
                <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">Thế giới</div>
            </div>
            <div class="owl-carousel owl-theme js carousel-4" id="slider1">
                <div class="item px-2" v-for="item in getThegioi" :key="item.id">
                    <div class="fh5co_latest_trading_img_position_relative">
                        <div class="fh5co_latest_trading_img"><img :src="item.front_image" :alt="item.slug"
                                                            class="fh5co_img_special_relative"/></div>
                        <div class="fh5co_latest_trading_img_position_absolute"></div>
                        <div class="fh5co_latest_trading_img_position_absolute_1">
                            <router-link tag="a" :to="{
                                name: 'single-article',
                                params: {
                                    slug: item.slug
                                }}" class="text-white"> 
                                {{item.title}} 
                            </router-link>
                            <div class="fh5co_latest_trading_date_and_name_color"> {{item.author}} - {{ convertDateString(item.publication_date)}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    computed: {
        getThegioi() {
            return this.$store.getters.getThegioi.articles;
        },
    },
    methods: {
       
    }
}
</script>

<style>

</style>