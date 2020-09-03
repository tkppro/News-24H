<template>
    <div class="row">
        <div class="col-md-6 col-6 paddding animate-box" data-animate-effect="fadeIn" v-for="item in data" :key="item.id">
            <div class="fh5co_suceefh5co_height_2"><img :src="item.front_image" alt="img"/>
                <div class="fh5co_suceefh5co_height_position_absolute"></div>
                <div class="fh5co_suceefh5co_height_position_absolute_font_2">
                    <div class="">
                        <router-link tag="a" :to="{
                            name: 'single-article',
                            params: {
                                slug: item.slug
                            }}" class="color_fff"> 
                            <i class="fa fa-clock-o"></i>
                            &nbsp;&nbsp;{{ convertDateString(item.publication_date) }} 
                        </router-link></div>
                    <div class="">
                        <router-link tag="a" :to="{
                            name: 'single-article',
                            params: {
                                slug: item.slug
                            }}" class="fh5co_good_font_2"> {{item.title}} 
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</template>

<script>
export default {
    props: {
        data: Array
    }
}
</script>

<style>

</style>