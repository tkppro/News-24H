import Vue from 'vue'
import VueRouter from 'vue-router'
import Dashboard from '../pages/Dashboard/Dashboard.vue'
import SingleArticle from '../pages/SingleArticle/SingleArticle.vue'
import ArticleByCategory from "../pages/ArticleByCategory/ArticleByCategory.vue"
// import Login from '../components/auth/Login'
// import Logout from '../components/auth/Logout'
// import Register from '../components/auth/Register'
// import { store } from '../store/store'
Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        name: 'dashboard',
        component: Dashboard,
    },
    {
        path: '/:slug',
        name: 'single-article',
        component: SingleArticle, 
    },
    {
        path: '/categories/:slug',
        name: 'categories',
        component: ArticleByCategory,
        props: true
    }
   
    // {
    //     path: '/login',
    //     name: 'login',
    //     component: Login,
    //     props: true,
    //     meta: {
    //         requiresVisitor: true
    //     }
    // },
    // {
    //     path: '/logout',
    //     name: 'logout',
    //     component: Logout
    // },
    // {
    //     path: '/register',
    //     name: 'register',
    //     component: Register,
    //     meta: {
    //         requiresVisitor: true
    //     }
    // },
]

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes,
    scrollBehavior (to, from, savedPosition) {
        return { x: 0, y: 0 }
    }
})

// router.beforeEach((to, from, next) => {
//     if (to.matched.some(record => record.meta.requiresAuth)) {
//         if (!store.getters.loggedIn) {
//             next({
//                 name: 'login',
//             })
//         } else {
//             next()
//         }
//     } else if (to.matched.some(record => record.meta.requiresVisitor)) {
//         if (store.getters.loggedIn) {
//             next({
//                 name: 'dashboard',
//             }, { name: 'project' }, { name: 'team' })
//         } else {
//             next()
//         }
//     } else {
//         next()
//     }
// })

export default router