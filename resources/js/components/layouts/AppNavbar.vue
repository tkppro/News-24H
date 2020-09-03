<template>
    <div class="container-fluid bg-faded fh5co_padd_mediya padding_786">
        <div class="padding_786">
            <nav class="navbar navbar-toggleable-md navbar-light ">
                <button class="navbar-toggler navbar-toggler-right mt-3" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                        aria-label="Toggle navigation"><span class="fa fa-bars"></span></button>
                <a class="navbar-brand" href="#"><img src="../../../assets/logo.png" alt="img" class="mobile_logo_width"/></a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <router-link tag="a" class="nav-link" to="/">Home <span class="sr-only">(current)</span></router-link>
                        </li>    
                        <li class="nav-item " v-for="category in getCategories" :key="category.id">
                            <router-link tag="a" :to="{
                                name: 'categories',
                                params: {
                                    slug: category.slug,
                                    
                                }
                            }" class="nav-link">
                                {{ category.name }} <span class="sr-only">(current)</span>
                            </router-link>
                        </li>
                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuButton2" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">World <span class="sr-only">(current)</span></a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink_1">
                                <a class="dropdown-item" href="#">Action in</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li> -->
                        <!-- <li class="nav-item ">
                            <a class="nav-link" href="Contact_us.html">Contact <span class="sr-only">(current)</span></a>
                        </li> -->
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</template>

<script>
export default {
    computed: {
        getCategories() {
            return this.$store.getters.getCategories;
        }
    }
}
</script>

<style>

</style>