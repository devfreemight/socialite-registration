<template>
    <div class="container">
        <div class="row justify-content-end select-city">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center font-weight-bold mb-5 mt-3">Select City</h3>

                        <div class="mb-4 px-3">
                            <a v-for="city in cities" :key="city.city_id" class="btn btn-outline-primary btn-lg btn-block" v-bind:href="`/register/${city.city_id}/${city.name}`" role="button">{{ city.name }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'SelectCity',
    computed: {
        cities() {
            return this.$store.getters['Cities/all'];
        },
    },
    methods: {
        getCities() {
            this.$store.dispatch('Cities/index');
        },
    },
    mounted() {
        this.getCities();
    },
}
</script>

<style>

</style>
