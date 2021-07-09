<template>
	<div class="login">
		<div class="card">
			<div class="text-center">
				<img src="" class="card-img-top sti-logo" alt="Brandiology PH">
			</div>
			<div class="card-body">
				<p class="card-title text-center font-weight-bolder fs-20">Log In</p>
				<login-form></login-form>
			</div>
		</div>
	</div>
</template>

<script>
import LoginForm from '@common/components/LoginForm'

export default {
	components:{
		'login-form':LoginForm
	}
}
</script>
