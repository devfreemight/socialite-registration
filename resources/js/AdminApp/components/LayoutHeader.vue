<template>
    <div class="layout-header">
        <nav class="navbar navbar-expand-lg navbar-light">
            <router-link class="navbar-brand" :to="{ name:'home' }">
                <img :src="$_assets('/images/brandiology-banner-red.png')" class="" alt="Brandiology PH" id="brandiology-logo" title="Brandiology PH">
            </router-link>
            <div class="navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"> <ui-button class="btn btn-primary rounded-pill logout-button" @click="prompt">Logout</ui-button></li>
                </ul>
            </div>
        </nav>

        <modal v-if="showModal">
            <h2 slot="header" class="font-weight-bold">Confirmation</h2>
            <p slot="body">Are you sure do you want to logout?</p>
            <button slot="footer" class="btn btn-primary rounded-pill px-5" @click="logout">Proceed</button>
            <button slot="footer" class="btn btn-danger rounded-pill px-5" @click="closeModal">Cancel</button>
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
    padding: 0px 120px;
    box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.03);
    background-color: #ffffff;
    z-index: 40;
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
    #brandiology-logo{
        height: auto;
        width: 228px;
    }
}
</style>
