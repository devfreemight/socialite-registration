<template>
    <div id="app">
        <router-view name="header"></router-view>
        <router-view></router-view>
        <router-view name="footer"></router-view>
    </div>
</template>

<script>
export default {
    name:'MainApp',
    // methods:{
    //     onLogin({ token }){
    //         this.$http.defaults.headers.common.Authorization =  'Bearer ' + token
    //         this.$router.push({ name:'home' });
    //     },
    //     onLogout(){
    //         this.$http.defaults.headers.common.Authorization =  null;
    //         this.$router.push({ name: 'login' });
    //     },
    // },
    // created(){
        // this.$bus.on('login',this.onLogin);
        // this.$bus.on('logout',this.onLogout);
    // },
}
</script>
