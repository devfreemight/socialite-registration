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
                                            <input id="city" type="text" class="form-control" name="city" :value="this.city_name" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="landmark" class="font-weight-bold">Landmark</label>
                                            <input type="text" id="landmark" class="form-control" v-model="form.landmark">
                                        </div>

                                        <div class="form-group">
                                            <ui-button class="btn btn-primary float-right px-5" :loading="submitLoading" @click="showModal = true">Update</ui-button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- <div class="container mb-5">

        </div> -->

        <modal v-if="showModal">
            <h5 slot="header">Update</h5>
            <p slot="body" class="text-center">Are you sure do you want to update this record?</p>
            <button slot="footer" class="btn btn-primary" @click="update">Proceed</button>
            <button slot="footer" class="btn btn-secondary" @click="showModal = false">Cancel</button>
        </modal>
    </div>
</template>

<script>
import { CITY_NAME, CITY_ID } from '@constants/address';
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
            city_name: CITY_NAME,
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
                this.form = Object.assign({}, this.$_Arr.getProperty(response, 'data', this.form));
                this.form.birthday = moment(this.form.birthday).format('MM/DD/Y');
            } catch(error) {}
        },
        update(){
            return new Promise(async (resolve,reject)=>{
                try{
                    let response = await this.$store.dispatch('Registrants/update', this.form);
                    this.$router.push({name: 'registrant:listing'});
                } catch(error) {
                    console.error(error);
                }
                this.showModal = false;
                resolve();
            });
        },
    },
    created() {
        this.initialize();
    },
}
</script>

<style lang="scss" scoped>
#container {
    background-color: #fff;
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
</style>
