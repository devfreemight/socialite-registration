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
    margin: auto auto 10rem auto;
    width:100%;
    flex-grow: 1;
    max-width: 1200px;
    background-color: inherit;
}

@media (max-width: 575.98px) {
    .layout-body {
        margin: auto auto 1rem auto;
    }
    .card {
        background-color: transparent;
        border: none;
    }
}

</style>
