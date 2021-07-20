<template>
    <div class="">
        <div class="d-flex position-relative mb-3">
            <h5 class="">{{ $route | getProperty('meta.title','') }} </h5>
        </div>

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
                            <option v-for="brgy in barangays" :key="brgy.brgy_id" :value="brgy.brgy_id" :selected="brgy.brgy_id == form.barangay_id">{{ brgy.name }}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="city" class="font-weight-bold">City</label>
                        <select class="form-control" name="city" id="city" v-model="form.city_id" @change="loadBarangays($event.target.value)">
                            <option value="" disabled>City</option>
                            <option v-for="city in cities" :key="city.city_id" :value="city.city_id">{{ city.name }}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="landmark" class="font-weight-bold">Landmark</label>
                        <input type="text" id="landmark" class="form-control" v-model="form.landmark">
                    </div>

                    <div class="form-group">
                        <ui-button class="btn btn-primary float-right px-5" :loading="searchLoading" @click="">Search</ui-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
    name : 'RegistrantEdit',
    props: {
        id: {
            required: true,
        },
    },
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
        original(){
            return this.$store.getters['Registrants/find'](this.id)
        },
    },
    methods: {
        loadCities() {
            this.$store.dispatch('Cities/index');
        },
        loadBarangays(city_id) {
            this.$store.dispatch('Barangays/index', { city_id: city_id });
        },
        async initialize(){
            this.form = Object.assign({}, this.original);
            try {
                let response = await this.$store.dispatch('Registrants/get', { id: this.id, })
                this.form = Object.assign({}, this.$_Arr.getProperty(response, 'data', this.form));
                this.loadBarangays(this.form.city_id);
            } catch(error) {
                console.log(error);
            }
        }
    },
    created() {
        this.initialize();
    },
    mounted() {
        this.loadCities();
    },
}
</script>

<style>

</style>
