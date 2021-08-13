<template>
    <div class="container mw-100 m-0 p-3">
        <div class="accordion" id="searchForm">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <label class="font-weight-bold mb-0">Search</label>
                    <button id="chevyButton" @click="toggleChevron" class="btn float-right" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <span v-show="chevyDown"><i class="fa fa-chevron-down"></i></span>
                        <span v-show="chevyUp"><i class="fa fa-chevron-up"></i></span>
                    </button>
                </div>

                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#searchForm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-10 col-lg-6">
                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">Full Name</label>
                                    <input id="name"
                                        v-validate="'max:255'"
                                        type="text"
                                        class="form-control"
                                        name="full name"
                                        v-model="form.name"
                                        autofocus
                                        placeholder="Juana Dela Cruz"
                                    >
                                    <p v-show="errors.has('full name')" class="is-danger">{{ errors.first('full name') }}</p>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="age" class="font-weight-bold">Age</label>
                                            <input id="age"
                                                v-validate="'numeric|between:18,30'"
                                                type="text"
                                                class="form-control"
                                                name="age"
                                                v-model="form.age"
                                                placeholder="18-30"
                                            >
                                            <p v-show="errors.has('age')" class="is-danger">{{ errors.first('age') }}</p>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="export_status" class="font-weight-bold">Export Status</label>
                                            <select class="form-control" name="export_status" id="export_status" v-model="form.export_status">
                                                <option value="0">{{ EXPORT_VALUES[0] }}</option>
                                                <option value="1">{{ EXPORT_VALUES[1] }}</option>
                                            </select>
                                            <i class="custom-fa-select fa fa-chevron-down"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-10 col-lg-6">
                                <div class="form-group">
                                    <label for="contact_no" class="font-weight-bold">Contact No.</label>
                                    <input id="contact_no"
                                        v-validate="'numeric|max:11'"
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
                                    <label for="barangay" class="font-weight-bold">Barangay</label>
                                    <input id="barangay"
                                        v-validate="'max:255'"
                                        type="text"
                                        class="form-control"
                                        name="barangay"
                                        v-model="form.barangay"
                                        placeholder="Barangay"
                                    >
                                    <p v-show="errors.has('barangay')" class="is-danger">{{ errors.first('barangay') }}</p>
                                </div>

                                <div class="form-group">
                                    <label for="city" class="font-weight-bold">City</label>
                                    <select class="form-control" name="city" id="city" v-model="form.city_id">
                                        <option v-for="city in cities" :key="city.city_id" :value="city.city_id">{{ city.name }}</option>
                                    </select>
                                    <i class="custom-fa-select fa fa-chevron-down"></i>
                                </div>
                            </div>

                            <div class="col-lg">
                                <div class="form-group text-center">
                                    <ui-button class="btn btn-danger btn-lg px-5 rounded-pill" :loading="searchLoading" @click="searchHandler">Search</ui-button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import 'bootstrap/dist/js/bootstrap.min.js';
import { VALUES as EXPORT_VALUES, DEFAULT_STATUS } from '@constants/export';
import { CITY_ID } from '@constants/address';
import { mapState } from 'vuex';

export default {
    name: 'SearchForm',
    data() {
        return {
            form: {
                name: '',
                contact_no: '',
                age: '',
                barangay: '',
                city_id: CITY_ID,
                export_status: DEFAULT_STATUS,
            },
            searchLoading: false,
            chevyDown: true,
            chevyUp: false,
            EXPORT_VALUES
        }
    },
    computed: {
        ...mapState('Registrants', ['params']),
        cities() {
            return this.$store.getters['Cities/all'];
        },
    },
    methods: {
        async searchHandler() {
            this.$validator.validate().then(valid => {
                if (!valid) {
                    this.$toast.error('All details must be filled out correctly to continue.');
                    return;
                }  else {
                    this.searchLoading = true;
                    this.submit();
                }
            });
        },
        submit() {
            return new Promise(async(resolve,reject) => {
                try {
                    let params = Object.assign(this.params, this.form);
                    await this.$store.dispatch('Registrants/index', params);
                } catch (error) {
                    console.log(error);
                } finally {
                    this.searchLoading = false;
                    resolve();
                }
            });
        },
        toggleChevron() {
            this.chevyDown = !this.chevyDown;
            this.chevyUp = !this.chevyUp;
        },
    },
    mounted() {
        this.searchHandler();
    },
}
</script>

<style lang="scss" scoped>
#chevyButton {
    border-radius: 5px !important;
    background-color: rgb(202, 0, 17, 1);
    &.btn {
        padding: 0px 5px;
        height: 23px;
    }
    .svg-inline--fa {
        color: white;
    }
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
