<template>
    <div class="registrants-listing-page">
        <div class="d-flex position-relative mb-3">
            <h2 class="font-weight-bold">{{ $route | getProperty('meta.title','') }} </h2>
        </div>

        <div id="container">
            <search-form></search-form>
            <listing-table></listing-table>
        </div>
    </div>
</template>
<script>
import TABLE from './Table';
import SEARCH_FORM from './Search';

export default {
    name : 'RegistrantListingPageIndex',
    components:{
        'listing-table': TABLE,
        'search-form': SEARCH_FORM,
    },
    methods:{
        getCities() {
            this.$store.dispatch('Cities/index');
        },
    },
    mounted() {
        this.getCities();
    },
}
</script>
<style lang="scss" scoped>
#container {
    background-color: #fff;
}
h2 {
    font-size: 33px !important;
}
</style>
