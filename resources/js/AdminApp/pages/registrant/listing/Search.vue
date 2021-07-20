<template>
    <div class="container mb-5">
        <div class="row">

            <div class="col-sm">
                <div class="form-group">
                    <label for="name" class="font-weight-bold">Full Name</label>
                    <input id="name" type="text" class="form-control" name="name" v-model="form.name" autocomplete="name" autofocus placeholder="Juan Dela Cruz">
                </div>

                <div class="form-group">
                    <label for="gender" class="font-weight-bold">Gender</label>
                    <select class="form-control" name="gender" id="gender" v-model="form.gender">
                        <option value="">Select Gender</option>
                        <option value="0">Male</option>
                        <option value="1">Female</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="birthday" class="font-weight-bold">Birthday</label>
                    <input id="birthday" type="text" class="form-control" name="birthday" v-model="form.birthday" placeholder="mm/dd/YYYY">
                </div>

                <div class="form-group">
                    <label for="contact_no" class="font-weight-bold">Contact No.</label>
                    <input id="contact_no" type="text" class="form-control" name="contact_no" v-model="form.contact_no" placeholder="09123456789">
                </div>
            </div>

            <div class="col-sm">
                <div class="form-group">
                    <label for="age" class="font-weight-bold">Age</label>
                    <input id="age" type="text" class="form-control" name="age" v-model="form.age" placeholder="18-30">
                </div>

                <div class="form-group">
                    <label for="address" class="font-weight-bold">Street Address</label>
                    <input id="address" type="text" class="form-control" name="street" v-model="form.street" placeholder="Street">
                </div>

                <div class="form-group">
                    <label for="barangay" class="font-weight-bold">Barangay</label>
                    <select class="form-control" name="barangay" id="barangay" v-model="form.barangay_id">
                        <option value="" disabled>Barangay</option>
                        <option v-for="brgy in barangays" :key="brgy.brgy_id" :value="brgy.brgy_id">{{ brgy.name }}</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="city" class="font-weight-bold">City</label>
                    <select class="form-control" name="city" id="city" v-model="form.city_id" @change="getBarangays($event)">
                        <option value="" disabled>City</option>
                        <option v-for="city in cities" :key="city.city_id" :value="city.city_id">{{ city.name }}</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="landmark" class="font-weight-bold">Landmark</label>
                    <input type="text" id="landmark" class="form-control" v-model="form.landmark">
                </div>

                <div class="form-group">
                    <ui-button class="btn btn-primary float-right px-5" :loading="searchLoading" @click="searchHandler">Search</ui-button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
    name: 'SearchForm',
    data() {
        return {
            form: {
                name: '',
                gender: '',
                birthday: '',
                contact_no: '',
                age: '',
                street: '',
                barangay_id: '',
                city_id: '',
                landmark: '',
            },
            searchLoading: false,
        }
    },
    computed: {
        ...mapGetters({
            cities: 'Cities/all',
            barangays: 'Barangays/all',
        }),
    },
    methods: {
        getCities() {
            this.$store.dispatch('Cities/index');
        },
        getBarangays(event) {
            this.$store.dispatch('Barangays/index', { city_id: event.target.value });
        },
        searchHandler() {
            return this.$store.dispatch('Registrants/index', this.form);
        },
    },
    mounted() {
        this.getCities();
        this.searchHandler();
    },
}
</script>

<style>

</style>
