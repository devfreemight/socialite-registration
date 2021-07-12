<template>
    <div class="container">
        <div class="row justify-content-end select-city">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center font-weight-bold mb-5 mt-3">Select City</h3>

                        <div class="mb-4 px-3">
                            <a v-for="city in cities" :key="city.id" class="btn btn-outline-primary btn-lg btn-block" v-bind:href="`/guest/register/${city.id}`" role="button">{{ city.name }}</a>
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
    data() {
        return {
            cities: [
                {
                    id: '072217',
                    name: 'Cebu City',
                }, {
                    id: '083738',
                    name: 'Ormoc City',
                }, {
                    id: '083747',
                    name: 'Tacloban City',
                }, {
                    id: '063022',
                    name: 'Ilo-ilo City',
                }
            ],
        }
    }
}
</script>

<style>

</style>
