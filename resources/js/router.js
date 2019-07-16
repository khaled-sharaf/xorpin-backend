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


// products components
import Products from './views/products/Index'
import CreateProduct from './views/products/CreateProduct'
import EditProduct from './views/products/EditProduct'
import ProductProfile from './views/products/ProductProfile'


// products types components
import ProductsTypes from './views/products-types/Index'
import CreateProductsType from './views/products-types/CreateProductsType'
import EditProductsType from './views/products-types/EditProductsType'


// winners components
import Winners from './views/winners/Index'
import CreateWinner from './views/winners/CreateWinner'
import EditWinner from './views/winners/EditWinner'


// comments components
import Comments from './views/comments/Index'
import EditComment from './views/comments/EditComment'


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



                ////////////////// products routes ///////////////////
                {
                    path: 'products',
                    name: 'products',
                    component: Products,
                    meta: {
                        title: 'View all products'
                    }
                },
                {
                    path: 'product/create',
                    name: 'create-product',
                    component: CreateProduct,
                    meta: {
                        title: 'Create new product'
                    }
                },
                {
                    path: 'product/:id/edit',
                    name: 'edit-product',
                    component: EditProduct,
                    props: true,
                    meta: {
                        title: 'Edit product'
                    }
                },
                {
                    path: 'product/profile/:id',
                    name: 'product-profile',
                    component: ProductProfile,
                    props: true,
                },




                ////////////////// products  types routes ///////////////////
                {
                    path: 'products-types',
                    name: 'pro-types',
                    component: ProductsTypes,
                    meta: {
                        title: 'View all products types'
                    }
                },
                {
                    path: 'products-type/create',
                    name: 'create-pro-type',
                    component: CreateProductsType,
                    meta: {
                        title: 'Create new products type'
                    }
                },
                {
                    path: 'products-type/:id/edit',
                    name: 'edit-pro-type',
                    component: EditProductsType,
                    props: true,
                    meta: {
                        title: 'Edit products type'
                    }
                },


                ////////////////// winners routes ///////////////////
                {
                    path: 'winners',
                    name: 'winners',
                    component: Winners,
                    meta: {
                        title: 'View all winners'
                    }
                },
                {
                    path: 'winner/create',
                    name: 'create-winner',
                    component: CreateWinner,
                    meta: {
                        title: 'Create new winner'
                    }
                },
                {
                    path: 'winner/:id/edit',
                    name: 'edit-winner',
                    component: EditWinner,
                    props: true,
                    meta: {
                        title: 'Edit winner'
                    }
                },


                ////////////////// comments routes ///////////////////
                {
                    path: 'comments',
                    name: 'comments',
                    component: Comments,
                    meta: {
                        title: 'View all comments'
                    }
                },
                {
                    path: 'comment/:id/edit',
                    name: 'edit-comment',
                    component: EditComment,
                    props: true,
                    meta: {
                        title: 'Edit comment'
                    }
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
