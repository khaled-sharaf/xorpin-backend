import Vue from 'vue'
import Router from 'vue-router'
import Gate from './Gate'
const gate = new Gate()

// default layout and dashboard
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


// settings components
import Settings from './views/settings/Index'
import CreateSetting from './views/settings/CreateSetting'
import EditSetting from './views/settings/EditSetting'


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
                        authCompany: true,
                        title: 'Dashboard'
                    }
                },

                ////////////////// user routes ///////////////////
                {
                    path: 'users',
                    name: 'users',
                    component: Users,
                    meta: {
                        title: 'Users'
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
                        authCompany: true,
                        title: 'Edit user'
                    }
                },


                ////////////////// company routes ///////////////////
                {
                    path: 'companies',
                    name: 'companies',
                    component: Companies,
                    meta: {
                        title: 'Companies'
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
                        authCompany: true,
                        title: 'Edit company'
                    }
                },
                {
                    path: 'company/profile/:id',
                    name: 'company-profile',
                    component: CompanyProfile,
                    props: true,
                    meta: {
                        authCompany: true,
                        title: 'Company profile'
                    }
                },



                ////////////////// products routes ///////////////////
                {
                    path: 'products',
                    name: 'products',
                    component: Products,
                    meta: {
                        authCompany: true,
                        title: 'Products'
                    }
                },
                {
                    path: 'product/create',
                    name: 'create-product',
                    component: CreateProduct,
                    meta: {
                        authCompany: true,
                        title: 'Create new product'
                    }
                },
                {
                    path: 'product/:id/edit',
                    name: 'edit-product',
                    component: EditProduct,
                    props: true,
                    meta: {
                        authCompany: true,
                        title: 'Edit product'
                    }
                },
                {
                    path: 'product/profile/:id',
                    name: 'product-profile',
                    component: ProductProfile,
                    props: true,
                    meta: {
                        authCompany: true,
                        title: 'Product profile'
                    }
                },




                ////////////////// products  types routes ///////////////////
                {
                    path: 'products-types',
                    name: 'pro-types',
                    component: ProductsTypes,
                    meta: {
                        authCompany: true,
                        title: 'Products types'
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
                        authCompany: true,
                        title: 'Winners'
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
                        title: 'Comments'
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




                ////////////////// settings routes ///////////////////
                {
                    path: 'settings',
                    name: 'settings',
                    component: Settings,
                    meta: {
                        title: 'Settings'
                    }
                },
                {
                    path: 'setting/create',
                    name: 'create-setting',
                    component: CreateSetting,
                    meta: {
                        title: 'Create new setting'
                    }
                },
                {
                    path: 'setting/:id/edit',
                    name: 'edit-setting',
                    component: EditSetting,
                    props: true,
                    meta: {
                        title: 'Edit setting'
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

  if (!to.meta.authCompany) {
      if (gate.isAdminCompany()) {
          setTimeout(() => {
            next({name: 'home'})
          }, 100)
      }
  }
  next();
});


export default vueRouter
