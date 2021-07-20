<template>
    <div class="d-flex flex-column">
        <h5>
            Search Results
            <ui-button :handler="prompt" class="btn btn-primary float-right" :loading="exportLoading">Export (CSV)</ui-button>
        </h5>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">
                        <input type="checkbox" v-model="isCheckedAll" @click="selectAll">
                    </th>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Birthday</th>
                    <th scope="col">Contact No.</th>
                    <th scope="col">Age</th>
                    <th scope="col">Street</th>
                    <th scope="col">Barangay</th>
                    <th scope="col">City</th>
                    <th scope="col">Landmark</th>
                    <th scope="col" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-show="data.length == 0">
                    <td colspan="12" class="text-center">
                        No data available.
                    </td>
                </tr>

                <tr v-show="data" :key="rowNum" v-for="(datum, rowNum) in data">
                    <td>
                        <input type="checkbox" v-model="selected" @click="toggleSelect" :value="datum.id">
                    </td>
                    <th scope="row">{{ rowNum + 1}}</th>
                    <td>{{ datum | getProperty('name', '') }} </td>
                    <td>{{ datum | getProperty('gender', '') | getProperGender() }} </td>
                    <td>{{ datum | getProperty('birthday', '') | format('date',{format:'MM/DD/YYYY'}) }}</td>
                    <td>{{ datum | getProperty('contact_no') }}</td>
                    <td>{{ datum | getProperty('age') }}</td>
                    <td>{{ datum | getProperty('street') }}</td>
                    <td>{{ datum | getProperty('barangay_name') }}</td>
                    <td>{{ datum | getProperty('city_name') }}</td>
                    <td>{{ datum | getProperty('landmark', '') }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <router-link :to="{name: 'registrant:edit', params: { id: datum.id }}" class="btn btn-primary">Edit</router-link>
                            <button class="btn btn-danger" @click="">Delete</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <modal v-if="showModal">
            <h5 slot="header">CSV Exporting</h5>
            <p slot="body" class="text-center">Please select at least one record?</p>
            <button slot="footer" class="btn btn-secondary" @click="showModal = false">Close</button>
        </modal>
    </div>
</template>

<script>
import Modal from '@admin/components/Modal';

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
            showModal: false,
        }
    },
    computed: {
        data() {
            return this.$store.getters['Registrants/all'];
        },
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
        prompt() {
            if (this.selected.length == 0) {
                this.showModal = true;
            } else {
                this.exportCSV();
            }
        },
        async exportCSV() {
            try {
                let response = await this.$api.registrants.exportCSV(this.selected, {responseType: 'blob'});
                const url = URL.createObjectURL(new Blob([response.data], {
                    type: 'text/csv'
                }))
                const link = document.createElement('a')
                link.href = url
                link.setAttribute('download', 'registrants.csv')
                document.body.appendChild(link)
                link.click()
            } catch(error) {
                console.log(error);
            } finally {
                this.exportLoading = false;
            }
        },
    },
    mounted() {

    }
};
</script>

<style lang=scss scoped>
.table {
    font-size: 14px;
}
</style>
