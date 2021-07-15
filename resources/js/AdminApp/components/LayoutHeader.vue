<template>
    <div class="layout-header">
        <nav class="navbar navbar-expand-lg navbar-light">
            <router-link class="navbar-brand" :to="{ name:'home' }">
                <img src="" class="card-img-top" alt="..." id="">
            </router-link>
            <div class="navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mr-10 d-flex justify-content-center flex-column align-center"> <span class="user-name" :to="{name:'home'}" >{{ user.last_name }} {{ user.first_name }} </span> </li>
                    <li class="nav-item"> <ui-button class="logout-button" @click="prompt">Logout</ui-button></li>
                </ul>
            </div>
        </nav>
    </div>
</template>

<script>
export default {
    name:'layout-header',
    computed:{
        user(){
            return this.$store.getters['Auth/profile'];
        },
        activeTab(){
            let match;
            this.$route.matched.forEach((route)=>{
                if (route.meta.hasOwnProperty('tab')) {
                    match = route.meta.tab;
                }
            });
            return match;
        }
    },
    methods:{
        prompt(){
            this.$dialog.open({
                content: 'Are you sure do you want to logout?',
                buttons:[ { text: 'Proceed', click:this.logout}, ]
            });
        },
        logout(){
            return this.$store.dispatch('Auth/logout');
        },
    },
}
</script>


<style lang="scss">
.layout-header{
    flex-grow: 1;
    max-height:94px;
    width: 100%;
    padding: 20px 120px;
    box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.03);
    background-color: #ffffff;
    nav.navbar{
        max-width:1440px;
        margin:0 auto;
        padding: 0rem 1rem;
    }
    .navbar-brand{
        width: 80px;
        height: 54px;
        margin: 0 410px 0 0;
        align-self:left;
        padding-top: 0rem !important;
    }
    .logout-button{
        width: 120px;
        height: 40px;
        white-space: nowrap;
    }
    .navbar-nav{
        .nav-item{
            font-size: 16px;
            font-weight:normal;
            font-stretch: normal;
            font-style: normal;
            line-height: normal;
            text-align: right;
            color: #333333;
            &.active {
                font-weight: bold;
                border-bottom: solid 2px #0f3073;
                a{
                    color: #0f3073;
                }
            }
        }
    }
    .user-name{
        font-weight: 500;
        color: #9c9c9c;
    }
    #sti-logo{
        height: 54px;
        width: auto;
    }
}
</style>
