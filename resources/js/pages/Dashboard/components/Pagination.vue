<template>
    <div class="row mx-0 animate-box" data-animate-effect="fadeInUp">
        <div class="col-12 text-center pb-4 pt-4">
            <a href="#" class="btn_mange_pagging" @click="getDataByPagging(currentPagination - 1, $event)"><i class="fa fa-long-arrow-left"></i>&nbsp;&nbsp; Previous</a>
            <a href="#" :class="currentPagination == pageNumber ? 'btn_pagging btn_pagging-active' : 'btn_pagging'" 
                        v-for="pageNumber in numbers" :key="pageNumber" @click="getDataByPagging(pageNumber, $event)">{{ pageNumber }}</a>
            
            <a href="#" class="btn_pagging">...</a>
            <a href="#" class="btn_mange_pagging" @click="getDataByPagging(currentPagination + 1, $event)">Next <i class="fa fa-long-arrow-right"></i>&nbsp;&nbsp; </a>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        categorySlug: String
    },
    data() {
        return {
            'numbers': [
                1, 2, 3, 4, 5
            ],
            'currentPagination': 1
        }
    },
    methods: {
        getDataByPagging(pageNumber, e) {
            e.preventDefault();
            this.currentPagination = pageNumber;
            if (this.currentPagination > 0) {
                this.fetchPaginationAPI(this.currentPagination);
            } else
                this.currentPagination = 1;
        },
        fetchPaginationAPI(pageNumber) {
            this.$store.dispatch('retrieveArticlesByPageNumber', {
                slug: this.$props.categorySlug, 
                pageNumber: pageNumber
            });
        }
    }
}
</script>

<style>

</style>