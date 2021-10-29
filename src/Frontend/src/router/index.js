import Vue from 'vue'
import Router from 'vue-router'


Vue.use(Router)

const routes = [
    {
        path: '/login', 
        name: 'login',
        meta: {title: '登录'},
        component: () => import('@/views/login')
    },
    {
        path: '/404',
        name: '404',
        meta:{title: '404'},
        component: () => import('@/views/404')
    },
    {
        path: '/home',
        name: 'home',
        meta: {title: 'home'},
        component: () => import('@/views/home')
    },
    {
        path: '/',
        redirect: '/home'
    },{
        path: '*',
        redirect: '/404'
    }
]

const router = new Router({
    routes
})

router.beforeEach((to, from, next) =>{
    if(to.name !== 'login' && !isTokenExists()) {
        next({name: 'login'})
    }else{
        next();
    }
})

const isTokenExists = () => {
    const token = localStorage.getItem("token");
    if(token && localStorage.getItem("token").length > 20) {
        return true;
    }else{
        return false;
    }
}

export default router;