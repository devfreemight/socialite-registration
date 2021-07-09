<template>
<form @submit.prevent="submit" autocomplete="on">
    <slot v-bind:form="form">
        <div class="form-group mt-4">
            <label class="fs-14" for="password">新しいパスワード</label>
            <input type="password" v-model="form.password" id="password" class="form-control">
        </div>
        <div class="form-group mb-40">
            <label class="fs-14" for="password_confirmation">新しいパスワード（確認）</label>
            <input type="password" v-model="form.password_confirmation" id="password_confirmation" class="form-control">
        </div>
        <button  type="submit" class="btn btn-primary btn-block">パスワード再設定</button>
    </slot>
</form>
</template>
<script>
import api from "@api/auth";

export default {
    name: 'PasswordResetForm',
	data() {
		return {
			form: {
				password: '',
				password_confirmation: ''
			}
		}
    },
    props: {
        token: {
            type: String,
            required: true
        },
        email: {
            type: String,
            required: true
        }
    },
    methods:{
        async submit(){
            await this.reset(Object.assign(this.form, {
                email: this.email,
                token: this.token
            }));
        },
        reset(form) {
            return new Promise(async(resolve,reject) => {
                try {
                    await api.change_password(form);
                    this.$router.push({ name: 'reset:complete' });
                } catch(error) {
                    // if token is not valid or modified
                    if (error.data.errors.status != undefined && error.data.errors.status[0] == 'このパスワードリセットトークンは無効です。') {
                        this.$router.push({ name: "login" });
                    }
                } finally {
                    resolve();
                }
            });
        },
    }
}
</script>
