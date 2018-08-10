<template>
    <nav id="navbar-top" 
        class="navbar navbar-expand navbar-top navbar-dark bg-dark sticky-top animated fadeInDown delay-0.5s"
        :class="showHideNav()">
        <div class="brand-icon col-sm-3">
            <a class="navbar-brand" href="/dashboard">{{app_name}}</a>.
            <!-- <i class="fas fa-bars sidebar-toggler"></i> -->
        </div>
        <!-- <div class="col-sm-3 sidebar-toggler">
            <i class="fas fa-align-justify"></i>
            <div class="sidebar-toggler">
                <span class="sidebar-toggler-icon"><i class="fas fa-chevron-left"></i></span>
            </div>
        </div> -->
        <!-- <div class="col-sm-5 col-md-5">
            <input v-if="user_name" class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
        </div> -->
        <div v-if="user_name" class="col-sm-9">
            <ul class="navbar-nav d-flex flex-row-reverse">
                <li class="nav-item text-nowrap">
                    <a class="nav-link" href="#" @click.prevent="submitLogout()">
                        <i class="fas fa-sign-out-alt"></i> Logout<!-- {{ __('Logout') }} -->
                    </a>
                    <form id="logout-form" action="/logout" method="POST" style="display: none;">
                        <input type="hidden" name="_token" :value="csrf">
                    </form>
                </li>
                <li class="nav-item text-nowrap">
                    <a class="nav-link" href="#" @click.prevent="">
                        <i class="far fa-file-pdf"></i> Genarate
                    </a>
                </li>
            </ul>
        </div>
        <div v-else class="col-sm-4 offset-sm-5 col-md-2 offset-md-4">
            <!-- <div class="row justify-content-end"> -->
                <ul class="navbar-nav d-flex flex-row-reverse">
                    <li class="nav-item active">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/register">Sign Up</a>
                    </li>
                </ul>
            <!-- </div> -->
        </div>
    </nav>
</template>

<script>
    export default {
        props: ['app_name', 'user_name', 'token'],
        data(){
            return{
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                prevScrollPosition: $(window).scrollTop()
            }
        },
        mounted() {
            // console.log(this.token, 'app_name')s
            // event.preventDefault();
            // document.getElementById('logout-form').submit();
            
            $(window).on('scroll',() => {
                this.showHideNav();
            })
        },
        methods: {
            submitLogout(){
                $('#logout-form').submit();
            },
            showHideNav(){
                let currentScrollPostion = $(window).scrollTop(),
                    navBar = $('#navbar-top'),
                    currentWidth = $(window).width();
                
                if(currentWidth >= 320 && currentWidth <= 768){
                    if(this.prevScrollPosition < currentScrollPostion){
                        // if(navBar.hasClass('show-navbar')) navBar.removeClass('show-navbar');
                        // navBar.addClass('hide-navbar')
                        if(navBar.hasClass('fadeInDown')) navBar.removeClass('fadeInDown');
                        navBar.addClass('fadeOutUp')
                    }
                    else {
                        if(navBar.hasClass('fadeOutUp')) navBar.removeClass('fadeOutUp');
                        navBar.addClass('fadeInDown');
                    }
                }
            }
        }
    }
</script>