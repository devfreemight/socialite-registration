<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <img src="/images/brandiology-banner.png" class="img-fluid my-5" alt="Brandiology PH | Brand ideas come to life" id="" title="Brandiology PH | Brand ideas come to life">

                <div class="card">

                    <div class="card-body px-0 px-md-5">
                        <h3 class="text-center font-weight-bold m-5">Sign Up Here</h3>

                        <form @submit.prevent="submitRegistration">
                            <div class="form-group">
                                <label for="name" class="font-weight-bold">Full Name</label>
                                <input id="name" type="text" class="form-control form-control-lg" name="name" v-model="form.name" autocomplete="name" required autofocus placeholder="Juan Dela Cruz">
                            </div>

                            <div class="form-group">
                                <label for="gender" class="font-weight-bold">Gender</label>
                                <select class="form-control form-control-lg" name="gender" id="gender" v-model="form.gender" required>
                                    <option value="">Select Gender</option>
                                    <option value="0">Male</option>
                                    <option value="1">Female</option>
                                </select>
                                <i class="custom-fa-select fa fa-chevron-down"></i>
                            </div>

                            <div class="form-group">
                                <label for="birthday" class="font-weight-bold">Birthday</label>
                                <input id="birthday" type="text" class="form-control form-control-lg" name="birthday" v-model="form.birthday" required placeholder="mm/dd/YYYY">
                            </div>

                            <div class="form-group">
                                <label for="contact_no" class="font-weight-bold">Contact No.</label>
                                <input id="contact_no" type="text" class="form-control form-control-lg" name="contact_no" v-model="form.contact_no" required placeholder="09123456789">
                            </div>

                            <div class="form-group">
                                <label for="age" class="font-weight-bold">Age</label>
                                <input id="age" type="text" class="form-control form-control-lg" name="age" v-model="form.age" required placeholder="18-30">
                            </div>

                            <div class="form-group">
                                <label for="address" class="font-weight-bold">Address</label>
                                <input id="address" type="text" class="form-control form-control-lg" name="street" v-model="form.street" required placeholder="Street">
                            </div>

                            <div class="form-group">
                                <select class="form-control form-control-lg" name="barangay" id="barangay" v-model="form.barangay_id" required>
                                    <option value="">Barangay</option>
                                    <option v-for="brgy in barangays" :key="brgy.brgy_id" :value="brgy.brgy_id">{{ brgy.name }}</option>
                                </select>
                                <i class="custom-fa-select fa fa-chevron-down"></i>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control form-control-lg" v-model="city_name" disabled>
                            </div>

                            <div class="form-group">
                                <label for="landmark" class="font-weight-bold">Landmark</label>
                                <textarea id="landmark" autofocus class="form-control form-control-lg" rows="6" v-model="form.landmark" name="landmark" required></textarea>
                            </div>

                            <div class="custom-control custom-checkbox mb-3">
                                <input class="custom-control-input" type="checkbox" value="1" v-model="term_and_cond" id="t&c">
                                <label for="t&c" class="custom-control-label">
                                    I agree to the
                                    <router-link class="red-link" :to="{ name: 'registration.termsofservice' }"><u>Terms of Service</u></router-link>
                                    and
                                    <router-link class="red-link" to=""><u>Privacy Policy</u></router-link>
                                </label>
                            </div>

                            <div class="form-group">
                                <ui-button class="btn btn-danger btn-lg px-5" :loading="submitLoading" :disabled="!term_and_cond">Submit</ui-button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { CITY_NAME, CITY_ID } from '@constants/address';

export default {
    name: 'RegisterForm',
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
                city_id: CITY_ID,
                landmark: '',
            },
            term_and_cond: false,
            submitLoading: false,
            city_name: CITY_NAME,
        }
    },
    computed: {
        barangays() {
            return this.$store.getters['Barangays/all'];
        },
    },
    methods: {
        getBarangays() {
            this.$store.dispatch('Barangays/index', { city_id: CITY_ID });
        },
        async submitRegistration() {
            if(!this.term_and_cond) {
                this.$toast.error('Please accept Terms of Service and Privacy Policy agreement.');
                return;
            }

            this.submitLoading = true;
            await this.submit(this.form);
        },
        submit() {
            return new Promise(async(resolve,reject) => {
                try {
                    await this.$store.dispatch('Guests/add', this.form);
                    this.$router.push({ name: 'registration.success' });
                } catch (error) {
                    reject(error);
                } finally {
                    this.submitLoading = false;
                    resolve();
                }
            });
        },
    },
    mounted() {
        this.getBarangays();
    }
}
</script>

<style scoped>

</style>
