<template>
    <div class="index-container">
        <!-- <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="/img/bg/bg1" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="/img/bg/bg2" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="/img/bg/bg3" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div> -->
        <div v-if="loginButton" @click="showLoginDiv" class="float-right">
            <button class="login-button btn btn-lg btn-success">
                Login
            </button>
        </div>
        <!-- <div class="row justify-content-center"> -->
            <!-- <div class="col-md-8 col-sm-8 col-lg-8"> -->
                <div class="index-intro">
                    <div id="loginDiv" v-if="loginDiv" class="card card-default card-rounded align-middle">
                        <div class="col-12">
                            <div class="float-right">
                                <a href="#" @click.prevent="showLoginButton">X</a>
                            </div>
                            <form>
                                <div class="form-group">
                                    <label class="sr-only" for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="exampleInputPassword1">Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                </div>
                                <center><button type="submit" class="btn btn-transparent">Submit</button></center>
                            </form>
                            
                        </div>
                    </div>
                </div>
            <!-- </div> -->
        <!-- </div> -->
    </div>
</template>

<script>
    export default {
        data(){
            return {
                loginDiv: false,
                loginButton: true
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            showLoginDiv: function(){
                this.loginDiv = true;
                this.loginButton = false;
                $('#loginDiv').addClass('animated bounceOutLeft');
                // return !showLogin;
                return false;
            },
            showLoginButton: function(){
                this.loginDiv = false;
                this.loginButton = true;
                $('#loginDiv').removeClass('animated bounceOutLeft');
                
                return false;
            }
        }
    }
</script>