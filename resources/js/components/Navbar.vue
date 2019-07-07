<style lang="scss">

</style>

<template>
    <div class="navbar-layout">
        <nav class="main-header navbar navbar-expand navbar-dark navbar-info">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                <router-link :to="{name: 'home'}" class="nav-link">Home</router-link>
                </li>
            </ul>

            <!-- SEARCH FORM -->
            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                    </button>
                </div>
                </div>
            </form>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"  href="/logout">
                    Logout <i class="fas fa-power-off"></i>
                    </a>

                    <form id="logout-form" action="/logout" method="POST" style="display: none;">
                        @csrf
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

        }
    },
    mounted() {

    }
}
</script>
