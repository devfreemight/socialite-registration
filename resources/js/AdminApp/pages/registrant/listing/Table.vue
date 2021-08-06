<template>
    <div class="container mw-100 m-0 p-3">
        <h5 class="mb-4 fs-14">Search Results</h5>

        <div class="table-responsive">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">
                            <input type="checkbox" v-model="isCheckedAll" @click="selectAll">
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Birthday</th>
                        <th scope="col">Contact No.</th>
                        <th scope="col">Age</th>
                        <th scope="col">Street</th>
                        <th scope="col">Barangay</th>
                        <th scope="col">City</th>
                        <th scope="col">Landmark</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-show="data && data.length == 0">
                        <td colspan="12" class="text-center">
                            No data available.
                        </td>
                    </tr>

                    <tr v-show="data" :key="rowNum" v-for="(datum, rowNum) in data">
                        <td>
                            <input type="checkbox" v-model="selected" @click="toggleSelect" :value="datum.id">
                        </td>
                        <th scope="row">{{ rowNum | getTableNumber(currentPage, perPage) }}</th>
                        <td>{{ datum | getProperty('name', '') }} </td>
                        <td>{{ datum | getProperty('birthday', '') | format('date',{format:'MM/DD/YYYY'}) }}</td>
                        <td>{{ datum | getProperty('contact_no', '') }}</td>
                        <td>{{ datum | getProperty('age', '') }}</td>
                        <td>{{ datum | getProperty('street', '') }}</td>
                        <td>{{ datum | getProperty('barangay', '') }}</td>
                        <td>{{ datum | getProperty('city.name', '') }}</td>
                        <td>{{ datum | getProperty('landmark', '') }}</td>
                        <td>{{ datum | getProperty('export_status', '') | getExportStatus() }}</td>
                        <td>
                            <div class="form-check form-check-inline">
                                <router-link :to="{name: 'registrant:edit', params: { id: datum.id }}" class="btn btn-primary rounded-pill mr-1">Edit</router-link>
                                <button class="btn btn-danger rounded-pill" @click="deletePrompt(datum.id)">Delete</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div v-show="data" class="row py-5">
            <div class="col-sm-7">
                <ui-button :handler="exportPrompt" class="btn btn-primary rounded-pill px-4" :loading="exportLoading">Export</ui-button>
            </div>
            <div class="col-sm-5">
                <ui-pagination class="text-right" v-show="lastPage > 1" :total="lastPage" v-model="currentPage">
                    <span slot="prev-page-button">
                        <i class="fas fa-chevron-left"></i>
                    </span>
                    <span slot="next-page-button">
                        <i class="fas fa-chevron-right"></i>
                    </span>
                </ui-pagination >
                <span class="pl-5">Showing <b>{{ from || 0 }}~{{ to || 0 }}</b> of <b>{{ total || 0 }}</b> results</span>
            </div>
        </div>

        <modal v-if="exportModal">
            <h2 slot="header" class="font-weight-bold">Export</h2>
            <p slot="body">Please select at least one record?</p>
            <button slot="footer" class="btn btn-primary rounded-pill px-5" @click="exportModal = false">Close</button>
        </modal>

        <modal v-if="deleteModal">
            <h2 slot="header" class="font-weight-bold">Delete</h2>
            <p slot="body">Are you sure to delete this record?</p>
            <button slot="footer" class="btn btn-primary rounded-pill px-5" @click="deleteRecord">Proceed</button>
            <button slot="footer" class="btn btn-danger rounded-pill px-5" @click="deleteModal = false">Cancel</button>
        </modal>
    </div>
</template>

<script>
import Modal from '@admin/components/Modal';
import { mapState } from 'vuex';

export default {
    name: "RegistrantsListingPageTable",
    components: {
        Modal
    },
    data() {
        return {
            isCheckedAll: false,
            selected : [],
            exportLoading: false,
            exportModal: false,
            deleteModal: false,
            idToDelete: '',
        }
    },
    computed: {
        ...mapState('Registrants', ['registrants' , 'params']),
        data() {
            return this.registrants.data;
        },
        currentPage: {
            get(){
                return this.registrants.current_page
            },
            set(value){
                let params = Object.assign(this.params, {page: value});
                this.$store.dispatch('Registrants/index', params);
            }
        },
        perPage() {
            return this.registrants.per_page;
        },
        lastPage() {
            return this.registrants.last_page;
        },
        from() {
            return this.registrants.from;
        },
        to() {
            return this.registrants.to;
        },
        total() {
            return this.registrants.total;
        }
    },
    methods: {
        toggleSelect(datum) {
            this.allSelected = false;
        },
        selectAll() {
            this.selected = [];
            if (!this.isCheckedAll) {
                for (let i in this.data) {
                    this.selected.push(this.data[i].id);
                }
            }
        },
        exportPrompt() {
            if (this.selected.length == 0) {
                this.exportModal = true;
            } else {
                this.exportCSV();
            }
        },
        async exportCSV() {
            try {
                let response = await this.$api.registrants.exportCSV(this.selected, {responseType: 'blob'});
                const url = URL.createObjectURL(new Blob([response.data], {
                    type: 'application/vnd.ms-excel'
                }))
                const link = document.createElement('a')
                link.href = url
                link.setAttribute('download', 'registrants.xlsx')
                document.body.appendChild(link)
                link.click()

                this.isCheckedAll = true;
                this.selectAll();
            } catch(error) {
                console.log(error);
            } finally {
                this.exportLoading = false;
                this.isCheckedAll = false;
            }
        },
        deletePrompt(id) {
            this.deleteModal = true;
            this.idToDelete = id;
        },
        deleteRecord() {
            return new Promise( async (resolve,reject) => {
                try{
                    await this.$store.dispatch('Registrants/remove', this.idToDelete)
                }catch(error){ }
                this.deleteModal = false;
                resolve();
            })
        },
    },
};
</script>

<style lang=scss scoped>
.table {
    font-size: 14px;
}
</style>
