<template>
    <nav id="navbar-bottom" 
        class="navbar navbar-expand navbar-bottom fixed-bottom d-block d-md-none navbar-dark bg-dark animated fadeInUp delay-0.5s">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item"
                v-for="link in sideBarLinks"
                :class="knowActiveSidebarClass(link.name)">
                <a class="nav-link" href="#" @click.prevent="changeActiveSidebar(link.name)"><i :class="link.iconClass"></i> {{link.title}}</a>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    data(){
        return{
            sideBarLinks: [],
            activeSideBarName: '',
        }
    },
    beforeMount(){
        this.subscribeToSideBarLinks();
    },
    mounted(){
        this.subscribeToSideBarLinks();
    },
    methods: {
        subscribeToSideBarLinks(){
            let instance = this;
            this.$hub.$on('subscribeToSideBarLinks', (activeSideBarName,links) => {
                instance.activeSideBarName = activeSideBarName;
                instance.sideBarLinks = links;
            })
        },
        knowActiveSidebarClass(linkName){
            return {
                'active' : this.activeSideBarName === linkName
            }
        },
        changeActiveSidebar(linkName){
            this.$hub.$emit('subscribeToChangeActiveSidebar', linkName);
        }
    }
}
</script>
