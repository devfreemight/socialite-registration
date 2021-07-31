<template>
    <div class="login container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-10 col-lg-6">
                <img src="/images/brandiology-banner.png" class="img-fluid my-4 my-md-5" alt="Brandiology PH | Brand ideas come to life" id="" title="Brandiology PH | Brand ideas come to life">
                <div class="card mb-lg-5">
                    <div class="card-body px-0 px-sm-5 px-md-5">
                        <h2 class="text-center font-weight-bold pt-sm-5 pt-md-5 pb-3">Log In</h2>
                        <login-form></login-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import LoginForm from '@common/components/LoginForm'

export default {
    components: {
        'login-form':LoginForm
    }
}
</script>
