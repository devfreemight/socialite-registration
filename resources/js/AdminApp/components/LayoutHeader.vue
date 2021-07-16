<template>
    <div class="layout-header">
        <nav class="navbar navbar-expand-lg navbar-light">
            <router-link class="navbar-brand" :to="{ name:'home' }">
                <img src="" class="card-img-top" alt="Brandiology PH" id="">
            </router-link>
            <div class="navbar-collapse" id="navbarNav">
                <ul class="navbar-nav m-auto page-menu">
                    <li class="nav-item" :class="{ 'active': activeTab == 'registrants' }"> <router-link class="nav-link" :to="{name:'registrants'}"> Registrants </router-link> </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mr-10 d-flex justify-content-center flex-column align-center"> <span class="user-name" >{{ user.name }}</span> </li>
                    <li class="nav-item"> <ui-button class="logout-button" @click="prompt">Logout</ui-button></li>
                </ul>
            </div>
        </nav>

        <modal v-if="showModal">
            <p slot="body" class="text-center">Are you sure do you want to logout?</p>
            <button slot="footer" class="btn btn-primary" @click="logout">Proceed</button>
            <button slot="footer" class="btn btn-secondary" @click="closeModal">Cancel</button>
        </modal>
    </div>
</template>

<script>
import Modal from './Modal';

export default {
    name:'layout-header',
    components: {
        Modal
    },
    data() {
        return {
            showModal: false,
        }
    },
    computed:{
        user() {
            return this.$store.getters['Auth/profile'];
        },
        activeTab() {
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
        prompt() {
            this.showModal = true;
        },
        closeModal() {
            this.showModal = false;
        },
        logout() {
            return this.$store.dispatch('Auth/logout');
        },
    },
}
</script>


<style lang="scss">
.layout-header{
    flex-grow: 1;
    max-height: 94px;
    width: 100%;
    padding: 20px 60px;
    box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.03);
    background-color: #ffffff;
    nav.navbar{
        max-width: 1440px;
        margin: 0 auto;
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
            font-weight: normal;
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
