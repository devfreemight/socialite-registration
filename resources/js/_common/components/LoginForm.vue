<template>
<form @submit.prevent="submit" autocomplete="on">
    <slot v-bind:form="form">
        <div class="form-group mt-4">
            <label class="fs-16 font-weight-bold" for="email">Email</label>
            <input type="email" v-validate="'required|email'" name="email" v-model="form.email" id="email" class="form-control form-control-lg">
            <p v-show="errors.has('email')" class="is-danger">{{ errors.first('email') }}</p>
        </div>
        <div class="form-group mb-40">
            <label class="fs-16 font-weight-bold" for="password">Password</label>
            <input type="password" v-validate="'required'" name="password" v-model="form.password" id="password" class="form-control form-control-lg">
            <p v-show="errors.has('password')" class="is-danger">{{ errors.first('password') }}</p>
        </div>
        <div class="form-group text-center">
            <ui-button class="btn btn-danger btn-lg rounded-pill px-5">Submit</ui-button>
        </div>
    </slot>
</form>
</template>
<script>
export default {
    name: 'LoginForm',
	data() {
		return {
			form: {
				email: '',
				password: ''
			}
		}
    },
    methods:{
        submit(){
            return this.login(this.form);
        },
        login(form) {
            this.validate(async ()=>{
                let res = await this.$store.dispatch('Auth/login', form)
            })
        },
        async validate(closure) {
            this.$validator.validate().then(valid => {
                if (!valid) {
                    this.$toast.error('All details must be filled out correctly to continue and confirm the login.');
                    return;
                } else {
                    return closure();
                }
            });
        }
    }
}
</script>
