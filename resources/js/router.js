import Vue from 'vue'
import Router from 'vue-router'
import DefaultLayout from './layouts/DefaultLayout'
import Dashboard from './views/Dashboard'
// users components
import Users from './views/users/Index'
import CreateUser from './views/users/CreateUser'
import EditUser from './views/users/EditUser'

Vue.use(Router)

var pathRoute = ''

if (process.env.NODE_ENV === 'production') {
    pathRoute = '/admin'
} else {
    pathRoute = '/Belal/xorpin-backend/public/admin'
}

const vueRouter = new Router({
    mode: 'history',
    base: pathRoute,
    // base: process.env.BASE_URL,
    linkExactActiveClass: 'active',
    routes: [
        {
            path: '/',
            name: 'default-layout',
            component: DefaultLayout,
            children: [
                {
                    path: '/dashboard',
                    name: 'home',
                    component: Dashboard
                },
                {
                    path: 'users',
                    name: 'users',
                    component: Users
                },
                {
                    path: 'user/create',
                    name: 'create-user',
                    component: CreateUser
                },
                {
                    path: 'user/:id/edit',
                    name: 'edit-user',
                    component: EditUser
                },
                // {
                //     path: '/test',
                //     name: 'test',
                //     component: Test
                // },
            ]
        },
        {
            path: '*',
            redirect: { name: 'home' }
        }
    ]
})

export default vueRouter
