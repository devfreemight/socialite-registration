<template>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col"></th>
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
            <tr v-show="!data">
                <td colspan="11" class="text-center">
                    No data available.
                </td>
            </tr>

            <tr v-show="data" :key="rowNum" v-for="(datum, rowNum) in data">
                <td>
                    checkbox
                </td>
                <th scope="row">{{ rowNum + 1}}</th>
                <td>{{ datum | getProperty('name', '') }} </td>
                <td>{{ datum | getProperty('gender', '') | getProperGender() }} </td>
                <td>{{ datum | getProperty('birthday', '') | format('date',{format:'MM/DD/YYYY'}) }}</td>
                <td>{{ datum | getProperty('contact_no') }}</td>
                <td>{{ datum | getProperty('age') }}</td>
                <td>{{ datum | getProperty('street') }}</td>
                <td>{{ datum | getProperty('barangay.name') }}</td>
                <td>{{ datum | getProperty('city.name') }}</td>
                <td>{{ datum | getProperty('landmark') }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'edit', params: { id: datum.id }}" class="btn btn-primary">Edit</router-link>
                        <button class="btn btn-danger" @click="deleteBook(datum.id)">Delete</button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    name: "RegistrantsListingPageTable",
    computed: {
        data(){
            return this.$store.getters['Registrants/all'];
        },
    },
    methods: {
        loadList() {
            this.$store.dispatch('Registrants/index');
        },
        checkboxClick(datum) {
            console.log(datum);
        },
    },
    mounted() {
        this.loadList();
    }
};
</script>

<style lang=scss scoped>
.table {
    font-size: 14px;
}
</style>
