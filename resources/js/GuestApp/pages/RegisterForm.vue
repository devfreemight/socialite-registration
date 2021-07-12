<template>
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-md-6">
                <div class="card">

                    <div class="card-body px-5">

                        <h3 class="text-center font-weight-bold mb-5 mt-3">Sign Up Here</h3>

                        <div class="form-group">
                            <label for="name" class="font-weight-bold">Full Name</label>
                            <input id="name" type="text" class="form-control" name="name" value="" required autocomplete="name" autofocus placeholder="Juan Dela Cruz">
                        </div>

                        <div class="form-group">
                            <label for="gender" class="font-weight-bold">Gender</label>
                            <select class="form-control" name="gender" id="gender" v-model="form.gender" required>
                                <option value="">Select Gender</option>
                                <option value="0">Male</option>
                                <option value="1">Female</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="birthday" class="font-weight-bold">Birthday</label>
                            <input id="birthday" type="text" class="form-control" name="birthday" v-model="form.birthday" required placeholder="mm/dd/YYYY">
                        </div>

                        <div class="form-group">
                            <label for="contact_no" class="font-weight-bold">Contact No.</label>
                            <input id="contact_no" type="text" class="form-control" name="contact_no" v-model="form.contact_no" required placeholder="09123456789">
                        </div>

                        <div class="form-group">
                            <label for="age" class="font-weight-bold">Age</label>
                            <input id="age" type="text" class="form-control" name="age" v-model="form.age" required placeholder="18-30">
                        </div>

                        <div class="form-group">
                            <label for="address" class="font-weight-bold">Address</label>
                            <input id="address" type="text" class="form-control" name="street" v-model="form.street" required placeholder="Street">
                        </div>

                        <div class="form-group">
                            <select class="form-control" name="barangay" id="barangay" v-model="form.barangay" required>
                                <option value="">Barangay</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" name="city_name" v-model="form.city_name" disabled>
                        </div>

                        <div class="form-group">
                            <label for="landmark" class="font-weight-bold">Landmark</label>
                            <textarea id="landmark" autofocus class="form-control" rows="3" v-model="form.landmark" name="landmark" required></textarea>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="1" v-model="form.term_and_cond" id="t&c" name="t&c" required>
                            <label for="t&c" class="form-check-label">
                                I agree to the <ins>Terms of Service</ins> and <ins>Privacy Policy</ins>
                            </label>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary px-5">
                                Submit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
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
                barangay: '',
                city_name: '',
                landmark: '',
                term_and_cond: true
            },
        }
    },
}
</script>

<style>

</style>
