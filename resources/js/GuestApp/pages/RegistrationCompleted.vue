<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-10 col-lg-6">

                <img :src="$_assets('/images/brandiology-banner.png')" class="img-fluid my-5" alt="Brandiology PH | Brand ideas come to life" id="" title="Brandiology PH | Brand ideas come to life">

                <div class="card mx-5">
                    <div class="card-body px-0 px-sm-5 px-md-5">
                        <div class="text-center p-4 p-sm-4 p-md-5">
                            <i class="fas fa-check fa-2x"></i>
                            <h2 class="font-weight-bold text-wrap">Registration Completed!</h2>
                        </div>

                        <p>We received your request. Our team will get in touch with you for the delivery of your FREE shampoo.</p>
                        <p>In return, we would like to request for you to post a review about the shampoo on your social media pages and get the chance to virtually meet its brand ambassador. Thank you!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'RegistrationCompleted',
}
</script>

<style scoped>
.svg-inline--fa, h2 {
    color: #ff5e75;
}
</style>
