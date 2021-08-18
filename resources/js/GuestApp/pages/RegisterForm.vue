<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-10 col-lg-6">
                <img :src="$_assets('/images/brandiology-banner-red.png')" class="img-fluid my-4 my-md-5" alt="Brandiology PH | Brand ideas come to life" id="" title="Brandiology PH | Brand ideas come to life">

                <div class="card">
                    <div class="card-body px-0 px-sm-5 px-md-5">
                        <h2 class="text-center font-weight-bold pt-sm-5 pt-md-5 pb-3">Sign up for your FREE shampoo!</h2>
                        <form @submit.prevent="submitRegistration">
                            <div class="form-group">
                                <label for="name" class="font-weight-bold">Full Name</label>
                                <input id="name"
                                    v-validate="{ required:true, regex:/^(?![\s.]+$)[a-zA-Z\s.]*$/, max:255 }"
                                    data-vv-as="full name"
                                    type="text"
                                    class="form-control form-control-lg"
                                    name="full_name"
                                    v-model="form.name"
                                    placeholder="Maymay Entrata"
                                    autofocus
                                    ref="full_name"
                                >
                                <p v-show="errors.has('full_name')" class="is-danger">{{ errors.first('full_name') }}</p>
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Gender</label>
                                <input type="text" class="form-control form-control-lg" name="gender" v-model="female_text" readonly>
                                <p class="">Only female participants/registrants are allowed to get a free shampoo.</p>
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
                                    ref="birthday"
                                >
                                <p v-show="errors.has('birthday')" class="is-danger">{{ errors.first('birthday') }}</p>
                                <p class="">Only participants/registrants aged 18-30 years old are allowed to redeem the free shampoo, you must be born on year 1991 onwards but not later than year 2003.</p>
                            </div>

                            <div class="form-group">
                                <label for="contact_no" class="font-weight-bold">Contact Number/Mobile Number</label>
                                <input id="contact_no"
                                    v-validate="'required|digits:11'"
                                    data-vv-as="contact number/mobile number"
                                    type="text"
                                    class="form-control form-control-lg"
                                    name="contact_no"
                                    v-model="form.contact_no"
                                    ref="contact_no"
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
                                    ref="address"
                                >
                                <p v-show="errors.has('address')" class="is-danger">{{ errors.first('address') }}</p>
                            </div>

                            <div class="form-group">
                                <input
                                    v-validate="'required|max:255'"
                                    type="text"
                                    class="form-control form-control-lg"
                                    name="barangay"
                                    v-model="form.barangay"
                                    placeholder="Barangay"
                                    ref="barangay"
                                >
                                <p v-show="errors.has('barangay')" class="is-danger">{{ errors.first('barangay') }}</p>
                            </div>

                            <div class="form-group">
                                <select class="form-control form-control-lg"
                                    v-validate="'required'"
                                    name="city"
                                    id="city"
                                    v-model="form.city_id"
                                >
                                    <option v-for="city in cities" :key="city.city_id" :value="city.city_id">{{ city.name }}</option>
                                </select>
                                <i class="custom-fa-select fa fa-chevron-down"></i>
                                <p v-show="errors.has('city')" class="is-danger">{{ errors.first('city') }}</p>
                            </div>

                            <div class="form-group">
                                <label for="landmark" class="font-weight-bold">Landmark</label>
                                <textarea id="landmark"
                                    v-validate="'required|max:255'"
                                    class="form-control form-control-lg"
                                    rows="6"
                                    v-model="form.landmark"
                                    name="landmark"
                                    ref="landmark"
                                ></textarea>
                                <p v-show="errors.has('landmark')" class="is-danger">{{ errors.first('landmark') }}</p>
                            </div>

                            <div class="custom-control custom-checkbox mb-4 mb-md-3 text-center text-sm-left text-md-left">
                                <input class="custom-control-input" type="checkbox" value="1" v-model="term_and_cond" id="t&c">
                                <label for="t&c" class="custom-control-label">
                                    I agree to the
                                    <router-link class="red-link" :to="{ name: 'registration.termsofservice' }"><u>Terms of Service</u></router-link>
                                    and
                                    <router-link class="red-link" to=""><u>Privacy Policy</u></router-link>
                                </label>
                            </div>

                            <div class="form-group text-center text-sm-left text-md-left">
                                <ui-button class="btn btn-danger btn-lg rounded-pill px-5" :loading="submitLoading" :disabled="!term_and_cond">Submit</ui-button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { DEFAULT_GENDER_TEXT } from '@constants/gender';
import { PAGE_GUEST_REGISTRATION_SUCCESS } from '@common/pages'
import { CITY_ID } from '@constants/address';
import moment from 'moment';

export default {
    name: 'RegisterForm',
    data() {
        return {
            form: {
                name: '',
                birthday: '',
                contact_no: '',
                age: '',
                street: '',
                barangay: '',
                city_id: CITY_ID,
                landmark: '',
            },
            term_and_cond: false,
            submitLoading: false,
            female_text: DEFAULT_GENDER_TEXT
        }
    },
    computed: {
        cities() {
            return this.$store.getters['Cities/all'];
        },
    },
    methods: {
        getCities() {
            this.$store.dispatch('Cities/index');
        },
        async submitRegistration() {
            if(!this.term_and_cond) {
                this.$toast.error('Please accept Terms of Service and Privacy Policy agreement.');
                return;
            }

            this.$validator.validate().then(valid => {
                if (!valid) {
                    this.$refs[this.errors.items[0].field].focus(),
                    this.$toast.error('All details must be filled out correctly to continue and confirm the registration.');
                    return;
                } else if (!this.validateAge()) {
                    this.$toast.error('Only participants/registrants aged 18-30 years old are allowed, you must be born on year 1991 onwards but not later than year 2003.');
                    return;
                } else {
                    this.submitLoading = true;
                    this.submit();
                }
            });
        },
        validateAge() {
            this.form.age = moment().diff(this.form.birthday, 'years');
            return (this.form.age >= 18 && this.form.age <= 30);
        },
        submit() {
            return new Promise(async(resolve,reject) => {
                try {
                    let response = await this.$store.dispatch('Guests/add', this.form);
                    this.$router.push({
                        name: PAGE_GUEST_REGISTRATION_SUCCESS,
                        params: { token: response.data.registration_token }
                    });
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
        this.getCities();
    }
}
</script>

<style lang="scss" scoped>
@media (max-width: 575.98px) {
    .custom-control-label {
        font-size: 11px;
        padding-top: 3px;
    }
}
p {
    font-size: 13px;
}
</style>
