<template>
    <div class="registrants-listing-page">
        <div class="d-flex position-relative">
            <h4 class="">{{ $route | getProperty('meta.title','') }} </h4>
        </div>
        <!-- <search-form> </search-form> -->
        <listing-table></listing-table>
    </div>
</template>
<script>
import TABLE from './Table';
{/* import SEARCH_FORM from './Search'; */}
export default {
    name : 'RegistrantListingPageIndex',
    components:{
        'listing-table': TABLE,
        // 'search-form': SEARCH_FORM,
    },
    // methods:{


    // }
}
</script>
<style lang="scss">
// .company-listing-page{
//     .registration-button{
//         width: 201px;
//         height: 60px;
//     }
// }
</style>
