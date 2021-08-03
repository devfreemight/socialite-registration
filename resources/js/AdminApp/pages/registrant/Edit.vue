<template>
    <div class="">
        <div class="d-flex position-relative mb-3">
            <h2 class="font-weight-bold">{{ $route | getProperty('meta.title','') }} </h2>
        </div>

        <div id="container">
            <div class="container mw-100 m-0 p-3">
                <div class="accordion" id="editForm">
                    <div class="card">
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#editForm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="name" class="font-weight-bold">Full Name</label>
                                            <input id="name"
                                                v-validate="'max:255'"
                                                type="text"
                                                class="form-control"
                                                name="full name"
                                                v-model="form.name"
                                                placeholder="Juana Dela Cruz"
                                                autofocus
                                            >
                                            <p v-show="errors.has('full name')" class="is-danger">{{ errors.first('full name') }}</p>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-sm">
                                                <label for="gender" class="font-weight-bold">Gender</label>
                                                <select class="form-control"
                                                    v-validate="'included:1'"
                                                    name="gender"
                                                    id="gender"
                                                    v-model="form.gender"
                                                >
                                                    <option value="0">Male</option>
                                                    <option value="1">Female</option>
                                                </select>
                                                <i class="custom-fa-select fa fa-chevron-down"></i>
                                                <p v-show="errors.has('gender')" class="is-danger">{{ errors.first('gender') }}</p>
                                            </div>

                                            <div class="form-group col-sm">
                                                <label for="age" class="font-weight-bold">Age</label>
                                                <input id="age"
                                                    v-validate="'between:18,30'"
                                                    type="text"
                                                    class="form-control"
                                                    name="age"
                                                    v-model="form.age"
                                                    placeholder="18-30"
                                                >
                                                <p v-show="errors.has('age')" class="is-danger">{{ errors.first('age') }}</p>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="birthday" class="font-weight-bold">Birthday</label>
                                            <input id="birthday"
                                                v-validate="'date_format:MM/dd/yyyy'"
                                                type="text"
                                                class="form-control"
                                                name="birthday"
                                                v-model="form.birthday"
                                                placeholder="mm/dd/YYYY"
                                            >
                                            <p v-show="errors.has('birthday')" class="is-danger">{{ errors.first('birthday') }}</p>
                                        </div>
                                    </div>

                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="contact_no" class="font-weight-bold">Contact No.</label>
                                            <input id="contact_no"
                                                v-validate="'digits:11'"
                                                data-vv-as="contact no."
                                                type="text"
                                                class="form-control"
                                                name="contact_no"
                                                v-model="form.contact_no"
                                                placeholder="09123456789"
                                            >
                                            <p v-show="errors.has('contact_no')" class="is-danger">{{ errors.first('contact_no') }}</p>
                                        </div>

                                        <div class="form-group">
                                            <label for="address" class="font-weight-bold">Street Address</label>
                                            <input id="address"
                                                v-validate="'max:255'"
                                                data-vv-as="house # and street"
                                                type="text"
                                                class="form-control"
                                                name="street"
                                                v-model="form.street"
                                                placeholder="House #, Street"
                                            >
                                            <p v-show="errors.has('street')" class="is-danger">{{ errors.first('street') }}</p>
                                        </div>

                                        <div class="form-group">
                                            <label for="barangay" class="font-weight-bold">Barangay</label>
                                            <select class="form-control"
                                                v-validate="'required'"
                                                name="barangay"
                                                id="barangay"
                                                v-model="form.barangay_id"
                                            >
                                                <option value="" disabled>Barangay</option>
                                                <option v-for="brgy in barangays" :key="brgy.brgy_id" :value="brgy.brgy_id">{{ brgy.name }}</option>
                                            </select>
                                            <i class="custom-fa-select fa fa-chevron-down"></i>
                                            <p v-show="errors.has('barangay')" class="is-danger">{{ errors.first('barangay') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="landmark" class="font-weight-bold">Landmark</label>
                                            <textarea id="landmark"
                                                v-validate="'max:255'"
                                                class="form-control"
                                                rows="6"
                                                v-model="form.landmark"
                                                name="landmark"
                                            ></textarea>
                                            <p v-show="errors.has('landmark')" class="is-danger">{{ errors.first('landmark') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm">
                                        <div class="mb-3 text-center">
                                            <ui-button class="btn btn-danger btn-lg rounded-pill px-5" :loading="submitLoading" @click="validateForm">Update</ui-button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <modal v-if="showModal">
            <h2 slot="header" class="font-weight-bold">Update</h2>
            <p slot="body">Are you sure do you want to update this record?</p>
            <button slot="footer" class="btn btn-primary rounded-pill px-5" @click="update">Proceed</button>
            <button slot="footer" class="btn btn-danger rounded-pill px-5" @click="toggleModal(false)">Cancel</button>
        </modal>
    </div>
</template>

<script>
import { CITY_ID } from '@constants/address';
import { mapGetters } from 'vuex';
import moment from 'moment';
import Modal from '@admin/components/Modal';

export default {
    name : 'RegistrantEdit',
    components: {
        Modal
    },
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
                city_id: CITY_ID,
                landmark: '',
                id: this.id,
            },
            submitLoading: false,
            showModal: false,
        }
    },
    computed: {
        ...mapGetters({ barangays: 'Barangays/all' }),
        original(){
            return this.$store.getters['Registrants/find'](this.id)
        },
    },
    methods: {
        async initialize(){
            this.form = Object.assign({}, this.original);
            try {
                let response = await this.$store.dispatch('Registrants/get', { id: this.id, })
                this.form = Object.assign({}, this.$_Arr.getProperty(response.data, '', this.form));
                this.form.birthday = moment(this.form.birthday).format('MM/DD/Y');
            } catch(error) {}
        },
        toggleModal(value) {
            this.showModal = value;
            this.submitLoading = value;
        },
        validateForm() {
            this.$validator.validate().then(valid => {
                if (!valid) {
                    this.$toast.error('All details must be filled out correctly to continue.');
                    return;
                }  else {
                    this.toggleModal(true);
                }
            });
        },
        update() {
            return new Promise(async (resolve,reject)=>{
                try {
                    await this.$store.dispatch('Registrants/update', this.form);
                    this.$router.push({name: 'registrant:listing'});
                } catch (error) {
                    console.error(error);
                } finally {
                    this.toggleModal(false);
                    resolve();
                }
            });
        },
        getBarangays() {
            this.$store.dispatch('Barangays/index', { city_id: CITY_ID });
        },
    },
    created() {
        this.initialize();
        this.getBarangays();
    },
}
</script>

<style lang="scss" scoped>
#container {
    background-color: #fff;
    padding-bottom: 40px;;
}
h2 {
    font-size: 33px !important;
}
.card {
    border: solid 1px #ededed;
    .card-header {
        border-bottom-color: #ededed;
    }
    .card-body {
        background-color: rgba(0, 0, 0, 0.03);
    }
}
.form-group {
    margin-bottom: 1rem !important;
}
</style>
