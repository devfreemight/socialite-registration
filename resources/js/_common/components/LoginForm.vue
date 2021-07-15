<template>
<form @submit.prevent="submit" autocomplete="on">
    <slot v-bind:form="form">
        <div class="form-group mt-4">
            <label class="fs-16" for="email">Email</label>
            <input type="email" v-model="form.email" id="email" class="form-control">
        </div>
        <div class="form-group mb-40">
            <label class="fs-16" for="password">Password</label>
            <input type="password" v-model="form.password" id="password" class="form-control">
        </div>
        <div class="form-group">
            <ui-button class="px-5 float-right">Submit</ui-button>
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
            return closure();
        }
    }
}
</script>
