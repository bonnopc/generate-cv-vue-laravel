<template>
    <div class="container-fluid user-content">
        <alert-component></alert-component>
        <div class="row">
            <div class="col-md-2 d-none d-md-block bg-dark dashboard-sidebar sidebar h-100 animated fadeInLeft delay-0.5s">
                <div class="profile">
                    <!-- profile-sidebar -->
                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-userpic d-flex justify-content-center">
                        <img src="storage/uploads/user/user-medium.png" class="img-responsive float-center" alt="">
                    </div>
                    <!-- END SIDEBAR USERPIC -->
                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name">
                            Marcus Doe
                        </div>
                        <div class="profile-usertitle-job">
                            Developer
                        </div>
                    </div>
                    <!-- END SIDEBAR USER TITLE -->
                    <!-- SIDEBAR BUTTONS -->
                    <!-- <div class="profile-userbuttons">
                        <button type="button" class="btn btn-success btn-sm">Follow</button>
                        <button type="button" class="btn btn-danger btn-sm">Message</button>
                    </div> -->
                    <!-- END SIDEBAR BUTTONS -->
                    <!-- SIDEBAR MENU -->
                    <div class="row sidebar-nav">
                    <!-- <div class="profile-usermenu"> -->
                        <ul class="nav flex-column w-100">
                            <li class="nav-item" v-for="link in sideBarLinks">
                                <a href="#" class="nav-link" @click.prevent="changeComponent(link.name)" :class="{'active-sidebar': componentName === link.name}">
                                    <div class="nav-link-title">
                                        <i :class="link.iconClass"></i> <span style="padding: 5px;padding-left:10px;">{{link.title.toUpperCase()}}</span>
                                    </div>
                                    
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- END SIDEBAR -->
                </div> 
            </div>
            <div class="col-md-10 offset-md-2">
                <div class="content-wrapper">
                    <component class="animated bounceInDown delay-0.5s" 
                        v-show="selectedComponent" 
                        :is="selectedComponent"
                        :sideBarLinks="sideBarLinks"
                        :selectedSidebar="componentName"></component> 
                </div>
            </div>
        </div>
    </div>
</template>

<<script>
export default {
    data(){
        return{
            componentName: null,
            selectedComponent: null,
            sideBarLinks: [
                {name:'overview', title: 'Overview', component: 'overview-component', iconClass: 'fas fa-desktop'},
                {name:'themes', title: 'Themes', component: 'themes-component', iconClass: 'far fa-clone'},
                {name:'settings', title: 'Settings', component: 'settings-component', iconClass: 'fas fa-wrench'}
            ],
            // sideBarLinks: {
            //     [name:'update_info', title: 'Update Info', component: 'update-info-component'],
            //     [name:'themes', title: 'Themes', component: 'themes-component'],
            //     [name:'settings', title: 'Settings', component: 'settings-component']
            // }
        }
    },
    mounted(){
        this.initSelectedComponent();
        this.subscribeToChangeActiveSidebar();
        this.shareSideBarLinksAndInfo();
    },
    methods: {
        shareSideBarLinksAndInfo(){
            console.log("shareSideBarLinksAndInfo",this.componentName)
            this.$hub.$emit('subscribeToSideBarLinks', this.componentName, this.sideBarLinks);
        },
        subscribeToChangeActiveSidebar(){
            let instance = this;
            this.$hub.$on('subscribeToChangeActiveSidebar', name => {
                instance.changeComponent(name);
            })
        },
        initSelectedComponent(){
            let instance = this;
            instance.sideBarLinks.forEach(function(element) {
                if(!instance.selectedComponent || !instance.componentName){
                    instance.selectComponent(element.component,element.name)
                    
                }
            });
            this.$hub.$emit('subscribeToSideBarLinks', this.componentName, this.sideBarLinks);
        },
        changeComponent(name){
            let instance = this;
            instance.sideBarLinks.forEach(function(element) {
                if(instance.componentName !== element.name && name === element.name){
                    instance.selectComponent(element.component,element.name)
                }
            });
        },
        selectComponent(component,name){
            this.selectedComponent = component;
            this.componentName = name;
            this.$hub.$emit('subscribeToSideBarLinks', this.componentName, this.sideBarLinks);
            // console.log(this.selectedComponent, this.componentName, "change")
        }
    }
}
</script>