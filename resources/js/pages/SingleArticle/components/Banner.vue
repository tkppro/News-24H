<template>
    <div id="fh5co-title-box" 
        :style="{
            backgroundImage: 'url(' + data.front_image + ')',
            backgroundPosition: '50%',
        }"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="page-title">
            <avatar :username="`${data.author}`" background-color="rgb(3, 169, 244)"></avatar>
            <span style="margin-top: 10px;">{{ data.publication_date }}</span>
            <h2>{{data.title}}</h2>
        </div>
    </div>
</template>

<script>
import Avatar from 'vue-avatar';

export default {
    props: {
        data: Object,
    },
    components: {
        Avatar
    },
    data() {
        return {
            
        }
    },
}
</script>

<style>

</style>