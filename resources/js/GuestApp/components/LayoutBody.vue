<template>
<div class="layout-body position-relative">
    <router-view></router-view>
</div>
</template>

<script>

export default {
    name:'LayoutBody',
}
</script>

<style lang="scss">
.layout-body {
    margin: auto;
    width:100%;
    flex-grow: 1;
    max-width: 1200px;
    border-radius: 10px;
    box-shadow: 0 10px 10px 2px rgba(0, 0, 0, 0.03);
    background-color: #ffffff;
}
</style>
