<template>
    <div :class="this.$route.name == 'single-article' ? 'single' : ''">
        <AppHeader />
        <AppNavbar />
        <transition name="component-fade" mode="out-in">
            <router-view :key="$route.fullPath"></router-view>
        </transition>
        <!-- <SingleArticle /> -->
        <AppFooter />
        <GoToTop />
    </div>
</template>

<script>
import AppHeader from '../js/components/layouts/AppHeader';
import AppNavbar from '../js/components/layouts/AppNavbar';
import AppFooter from '../js/components/layouts/AppFooter';
import GoToTop from '../js/components/ui/GoToTop';


export default {
    components: {
        AppHeader,
        AppNavbar,
        AppFooter,
        GoToTop,
    }
}
</script>

<style>
.component-fade-enter-active, .component-fade-leave-active {
  transition: opacity .3s ease;
}

.component-fade-enter, .component-fade-leave-to
/* .component-fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>