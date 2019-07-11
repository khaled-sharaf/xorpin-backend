import Vue from 'vue'
import Router from 'vue-router'
import DefaultLayout from './layouts/DefaultLayout'
import Dashboard from './views/Dashboard'

// users components
import Users from './views/users/Index'
import CreateUser from './views/users/CreateUser'
import EditUser from './views/users/EditUser'



// companies components
import Companies from './views/companies/Index'
import CreateCompany from './views/companies/CreateCompany'
import EditCompany from './views/companies/EditCompany'
import CompanyProfile from './views/companies/CompanyProfile'



Vue.use(Router)

var pathRoute = ''

if (process.env.NODE_ENV === 'production') {
    pathRoute = '/' + window.cp_prefix
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
                    component: Dashboard,
                    meta: {
                        title: 'Dashboard'
                    }
                },

                ////////////////// user routes ///////////////////
                {
                    path: 'users',
                    name: 'users',
                    component: Users,
                    meta: {
                        title: 'View all users'
                    }
                },
                {
                    path: 'user/create',
                    name: 'create-user',
                    component: CreateUser,
                    meta: {
                        title: 'Create new user'
                    }
                },
                {
                    path: 'user/:id/edit',
                    name: 'edit-user',
                    component: EditUser,
                    props: true,
                    meta: {
                        title: 'Edit user'
                    }
                },


                ////////////////// company routes ///////////////////
                {
                    path: 'companies',
                    name: 'companies',
                    component: Companies,
                    meta: {
                        title: 'View all companies'
                    }
                },
                {
                    path: 'company/create',
                    name: 'create-company',
                    component: CreateCompany,
                    meta: {
                        title: 'Create new company'
                    }
                },
                {
                    path: 'company/:id/edit',
                    name: 'edit-company',
                    component: EditCompany,
                    props: true,
                    meta: {
                        title: 'Edit company'
                    }
                },
                {
                    path: 'company/profile/:id',
                    name: 'company-profile',
                    component: CompanyProfile,
                    props: true,
                },

            ]
        },
        {
            path: '*',
            redirect: { name: 'home' }
        }
    ]
})

vueRouter.beforeEach((to, from, next) => {
  const nearestWithTitle = to.matched.slice().reverse().find(r => r.meta && r.meta.title);

  // If a route with a title was found, set the document (page) title to that value.
  if(nearestWithTitle) document.title = nearestWithTitle.meta.title;

  next();
});


export default vueRouter
