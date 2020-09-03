import Vue from 'vue'
import Vuex from 'vuex'
import Axios from 'axios';

Vue.use(Vuex)

export const store = new Vuex.Store({
    state: {
        tinmoinhat: [],
        thegioi: [],
        thoisu: [],
        suckhoe: [],
        // kinhdoanh: [],
        categories: [],
        singleArticle: {},
        trendingArticles: [],
        articlesByCategory: [],
    },
    getters: {
        getTinmoinhat(state) {
            return state.tinmoinhat;
        },
        getThegioi(state) {
            return state.thegioi;
        },
        getThoisu(state) {
            return state.thoisu;
        },
        getSuckhoe(state) {
            return state.suckhoe;
        },
        // getKinhdoanh(state) {
        //     return state.kinhdoanh;
        // },
        getCategories(state) {
            return state.categories;
        },
        getSingleArticle(state) {
            return state.singleArticle;
        },
        getTrendingArticles(state) {
            return state.trendingArticles;
        },
        getArticlesByCategory(state) {
            return state.articlesByCategory;
        }

    },
    mutations: {
        retrieveArticles(state, data) {
            state.tinmoinhat = data.tinmoinhatArticles;
            state.thegioi = data.thegioiArticles;
            state.thoisu = data.thoisuArticles;
            state.suckhoe = data.suckhoeArticles;
            // state.kinhdoanh = data.kinhdoanhArticles;
            state.categories = data.categories;
            state.articlesByCategory = data.kinhdoanhArticles;
        },
        retrieveSingleArticle(state, data) {
            state.singleArticle = data.article;
            state.trendingArticles = data.trendingArticles;
        },
        retrieveArticlesByCategory(state, data) {
            state.articlesByCategory = data;
        },
        retrieveArticlesByPageNumber(state, data) {
            state.articlesByCategory = data;
        }
    },
    actions: {
        retrieveArticles(context) {
            var vm = this;

            axios.get('/articles')
            .then((response) => {
                
                context.commit('retrieveArticles', response.data)
                vm.videos_p = response.data;
                Vue.nextTick(function(){
                    $('.carousel-3').owlCarousel({
                        loop: false,
                        margin: 10,
                        dots: false,
                        nav: true,
                        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
                        responsive: {
                            0: {
                                items: 1
                            },
                            600: {
                                items: 2
                            },
                            1000: {
                                items: 3
                            }
                        }
                    });

                    $('.carousel-4').owlCarousel({
                        loop: false,
                        margin: 10,
                        dots: false,
                        nav: true,
                        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
                        responsive: {
                            0: {
                                items: 1
                            },
                            600: {
                                items: 3
                            },
                            1000: {
                                items: 4
                            }
                        }
                    });
                }.bind(vm));
                
            })
            .catch((error) => {
                console.log(error);
            })
        },
        retrieveSingleArticle(context, slug) {
            var vm = this;

            axios.get('/' + slug)
            .then( response => {
                context.commit('retrieveSingleArticle', response.data);
                vm.videos_p = response.data;
                Vue.nextTick(function(){
                    $('#slider-trending').owlCarousel({
                        loop: false,
                        margin: 10,
                        dots: false,
                        nav: true,
                        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
                        responsive: {
                            0: {
                                items: 1
                            },
                            600: {
                                items: 2
                            },
                            1000: {
                                items: 3
                            }
                        }
                    });
                }.bind(vm));
            })
            .catch( error => {
                console.log(error);
            })
        },
        retrieveArticlesByCategory(context, slug) {
            axios.get('/categories/' + slug)
            .then(response => {
                context.commit('retrieveArticlesByCategory', response.data);
            })
            .catch(error => {
                console.log(error);
            })
        },
        retrieveArticlesByPageNumber(context, payload) {
            axios.get('/categories/' + payload.slug + '/' + payload.pageNumber)
            .then(response => {
                context.commit('retrieveArticlesByPageNumber', response.data);
            })
            .catch(error => {
                console.log(error);
            })
        }
    }
});