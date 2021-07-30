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
                                <input id="name"
                                    v-validate="'required|max:255'"
                                    type="text"
                                    class="form-control form-control-lg"
                                    name="full name"
                                    v-model="form.name"
                                    placeholder="Juana Dela Cruz"
                                    autofocus
                                >
                                <p v-show="errors.has('full name')" class="is-danger">{{ errors.first('full name') }}</p>
                            </div>

                            <div class="form-group">
                                <label for="gender" class="font-weight-bold">Gender</label>
                                <select class="form-control form-control-lg"
                                    v-validate="'required|included:1'"
                                    name="gender"
                                    id="gender"
                                    v-model="form.gender"
                                >
                                    <option value="">Select Gender</option>
                                    <option value="0">Male</option>
                                    <option value="1">Female</option>
                                </select>
                                <i class="custom-fa-select fa fa-chevron-down"></i>
                                <p v-show="errors.has('gender')" class="is-danger">{{ errors.first('gender') }}</p>
                            </div>

                            <div class="form-group">
                                <label for="birthday" class="font-weight-bold">Birthday</label>
                                <input id="birthday"
                                    v-validate="'required|date_format:MM/dd/yyyy'"
                                    type="text"
                                    class="form-control form-control-lg"
                                    name="birthday"
                                    v-model="form.birthday"
                                    placeholder="mm/dd/YYYY"
                                >
                                <p v-show="errors.has('birthday')" class="is-danger">{{ errors.first('birthday') }}</p>
                            </div>

                            <div class="form-group">
                                <label for="contact_no" class="font-weight-bold">Contact No.</label>
                                <input id="contact_no"
                                    v-validate="'required|digits:11'"
                                    data-vv-as="contact no."
                                    type="text"
                                    class="form-control form-control-lg"
                                    name="contact_no"
                                    v-model="form.contact_no"
                                    placeholder="09123456789"
                                >
                                <p v-show="errors.has('contact_no')" class="is-danger">{{ errors.first('contact_no') }}</p>
                            </div>

                            <div class="form-group">
                                <label for="address" class="font-weight-bold">Address</label>
                                <input id="address"
                                    v-validate="'required|max:255'"
                                    data-vv-as="house # and street"
                                    type="text"
                                    class="form-control form-control-lg"
                                    name="address"
                                    v-model="form.street"
                                    placeholder="House #, Street"
                                >
                                <p v-show="errors.has('address')" class="is-danger">{{ errors.first('address') }}</p>
                            </div>

                            <div class="form-group">
                                <select class="form-control form-control-lg"
                                    v-validate="'required'"
                                    name="barangay"
                                    id="barangay"
                                    v-model="form.barangay_id"
                                >
                                    <option value="">Barangay</option>
                                    <option v-for="brgy in barangays" :key="brgy.brgy_id" :value="brgy.brgy_id">{{ brgy.name }}</option>
                                </select>
                                <i class="custom-fa-select fa fa-chevron-down"></i>
                                <p v-show="errors.has('barangay')" class="is-danger">{{ errors.first('barangay') }}</p>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control form-control-lg" v-model="city_name" disabled>
                            </div>

                            <div class="form-group">
                                <label for="landmark" class="font-weight-bold">Landmark</label>
                                <textarea id="landmark"
                                    v-validate="'required|max:255'"
                                    class="form-control form-control-lg"
                                    rows="6"
                                    v-model="form.landmark"
                                    name="landmark"
                                ></textarea>
                                <p v-show="errors.has('landmark')" class="is-danger">{{ errors.first('landmark') }}</p>
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
import moment from 'moment';

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

            this.$validator.validate().then(valid => {
                if (!valid) {
                    this.$toast.error('All details must be filled out correctly to continue and confirm the registration');
                    return;
                } else if (!this.validateAge()) {
                    this.$toast.error('Only participants aged 18-30 are allowed');
                    return;
                } else {
                    this.submitLoading = true;
                    this.submit(this.form);
                }
            });
        },
        validateAge() {
            let years = moment().diff(this.form.birthday, 'years', true);
            if (years >= 18 && years <= 30) {
                this.form.age = years.toFixed(2);
                return true;
            } else {
                return false;
            }
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
