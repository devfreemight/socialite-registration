<template>
<div class="layout-body position-relative">
    <ui-breadcrumbs class="position-absolute" style="top:-50px;left:0px"></ui-breadcrumbs>
    <router-view></router-view>
</div>
</template>

<script>

import Breadcrumbs from '@common/components/Breadcrumbs';
export default {
    name:'LayoutBody',
    components:{
        'ui-breadcrumbs' : Breadcrumbs,
    }
}
</script>

<style lang="scss">
.layout-body {
margin: 81px auto 80px auto;
width:100%;
flex-grow: 1;
max-width: 1200px;
border-radius: 10px;
box-shadow: 0 10px 10px 2px rgba(0, 0, 0, 0.03);
background-color: #ffffff;
}
</style>