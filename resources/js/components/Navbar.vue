<style lang="scss">

</style>

<template>
    <div class="navbar-layout">
        <nav class="main-header navbar navbar-expand navbar-dark" :class="{'navbar-info': $gate.isAdmin(), 'navbar-primary': $gate.isAdminCompany()}">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <router-link :to="{name: 'home'}" class="nav-link link-home">{{ $t('global.home') }}</router-link>
                </li>
            </ul>

            <!-- SEARCH FORM -->
            <!-- <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                    </button>
                </div>
                </div>
            </!-->

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto nav-links-right">
                <li class="nav-item">
                    <div class="btn-group langs-btns-group" role="group">
                        <button type="button" class="btn btn-sm btn-dark" @click="setLocale('en')" :class="$i18n.locale == 'en' ? 'disabled' : ''">EN</button>
                        <button type="button" class="btn btn-sm btn-dark" @click="setLocale('ar')" :class="$i18n.locale == 'ar' ? 'disabled' : ''">AR</button>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" :href="$domain_admin + '/logout'">
                        {{ $t('global.logout') }}
                        <i class="fas fa-power-off"></i>
                    </a>

                    <form id="logout-form" :action="$domain_admin + '/logout'" method="POST" style="display: none;">
                        <input type="hidden" name="_token" :value="csrf_token">
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</template>


<script>
export default {
    name: 'navbar',
    data() {
        return {
            csrf_token: window.csrf_token
        }
    },
    methods: {
        setLocale(locale) {
            const msgs = require(`./../lang/${locale}.json`)
            this.$i18n.setLocaleMessage(locale, msgs)
            this.$i18n.locale = locale
            let myMainRtlCss = locale == 'ar' ? '/admin/css/main-rtl.css' : '/admin/css/main.css'
            let styleMyMain = document.getElementById('style-my-main')
            styleMyMain.setAttribute('href', this.$domain + myMainRtlCss)
            localStorage.setItem('locale', locale)
            axios.defaults.headers.common['locale'] = locale
        }
    },
    mounted() {
        if (localStorage.getItem('locale') != null) {
            this.setLocale(localStorage.getItem('locale'))
        } else {
            localStorage.setItem('locale', this.$i18n.locale)
        }
    },
}
</script>
