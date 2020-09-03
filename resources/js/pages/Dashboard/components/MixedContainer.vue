<template>
    <div class="container-fluid pb-4 pt-4 paddding">
        <div class="container paddding">
            <div class="row mx-0">
                <!-- vertical-articles-container -->
                <div class="col-md-8 animate-box" data-animate-effect="fadeInLeft">
                    <div>
                        <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">{{ title }}</div>
                    </div>
                    <p v-if="typeof(data) === 'undefined' ">There are no articles!</p>   
                    <transition-group name="component-fade" mode="out-in" v-else>    
                        <div  class="row pb-4" v-for="item in data" :key="item.id">
                            <div class="col-md-5">
                                <div class="fh5co_hover_news_img">
                                    <div class="fh5co_news_img"><img :src="item.front_image" alt=""/></div>
                                    <div></div>
                                </div>
                            </div>
                            <div class="col-md-7 animate-box">
                                <router-link  tag="a" :to="{
                                    name: 'single-article',
                                    params: {
                                        slug:item.slug
                                    }}" class="fh5co_magna py-2"> 
                                    {{item.title}} 
                                </router-link> 
                                <router-link tag="a" :to="{
                                    name: 'single-article',
                                    params: {
                                        slug: item.slug
                                    }}" class="fh5co_mini_time py-3"> 
                                    {{item.author}} - {{ convertDateString(item.publication_date)}} 
                                </router-link>
                                <div class="fh5co_consectetur" v-html="item.description"></div>
                            </div>
                        </div>
                    </transition-group>
                </div>

                <!-- tag-container -->
                <div class="col-md-3 animate-box" data-animate-effect="fadeInRight">
                    <div>
                        <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">Danh mục</div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="fh5co_tags_all">
                        <a href="#" class="fh5co_tagg" v-for="category in getCategories" :key="category.id">{{category.name}}</a>
                    </div>
                    <div>
                        <div class="fh5co_heading fh5co_heading_border_bottom pt-3 py-2 mb-4">Most Popular</div>
                    </div>
                    <div class="row pb-3">
                        <div class="col-5 align-self-center">
                            <img src="https://i1-vnexpress.vnecdn.net/2020/08/26/Copy-of-518317-01-02-159832790-2436-2730-1598410580.jpg?w=680&h=0&q=100&dpr=1&fit=crop&s=xtSsnRIXY_mvcOpzPIU-ew" alt="img" class="fh5co_most_trading"/>
                        </div>
                        <div class="col-7 paddding">
                            <div class="most_fh5co_treding_font"> Magna aliqua ut enim ad minim veniam quis nostrud.</div>
                            <div class="most_fh5co_treding_font_123"> April 18, 2016</div>
                        </div>
                    </div>
                    <div class="row pb-3">
                        <div class="col-5 align-self-center">
                            <img src="images/allef-vinicius-108153.jpg" alt="img" class="fh5co_most_trading"/>
                        </div>
                        <div class="col-7 paddding">
                            <div class="most_fh5co_treding_font"> Enim ad minim veniam nostrud xercitation ullamco.</div>
                            <div class="most_fh5co_treding_font_123"> April 18, 2016</div>
                        </div>
                    </div>
                    <div class="row pb-3">
                        <div class="col-5 align-self-center">
                            <img src="images/download (2).jpg" alt="img" class="fh5co_most_trading"/>
                        </div>
                        <div class="col-7 paddding">
                            <div class="most_fh5co_treding_font"> Magna aliqua ut enim ad minim veniam quis nostrud.</div>
                            <div class="most_fh5co_treding_font_123"> April 18, 2016</div>
                        </div>
                    </div>
                    <div class="row pb-3">
                        <div class="col-5 align-self-center"><img src="images/seth-doyle-133175.jpg" alt="img"
                                                                class="fh5co_most_trading"/></div>
                        <div class="col-7 paddding">
                            <div class="most_fh5co_treding_font"> Magna aliqua ut enim ad minim veniam quis nostrud.</div>
                            <div class="most_fh5co_treding_font_123"> April 18, 2016</div>
                        </div>
                    </div>
                </div>
            </div>
            <Pagination :categorySlug="categorySlug"/>
        </div>
    </div>
</template>

<script>
import Pagination from './Pagination';

export default {
    components: {
        Pagination
    },
    props: {
        data: Array,
        title: String,
        categorySlug: String,
    },
    computed: {
        getCategories() {
            return this.$store.getters.getCategories;
        }
    },
    methods: {
        
    }
}
</script>

<style>

</style>