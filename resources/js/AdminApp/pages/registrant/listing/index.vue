<template>
    <div class="registrants-listing-page">
        <div class="d-flex position-relative mb-3">
            <h5 class="">{{ $route | getProperty('meta.title','') }} </h5>
        </div>
        <search-form> </search-form>
        <hr>
        <listing-table></listing-table>
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

    }
}
</script>
<style lang="scss" scoped>
hr {
    margin-top: 2rem;
    margin-bottom: 2rem;
    border-top-color: #a8a8a8;
}
</style>
