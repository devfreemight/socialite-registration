<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-10 col-lg-6">

                <img :src="$_assets('/images/brandiology-banner.png')" class="img-fluid my-5" alt="Brandiology PH | Brand ideas come to life" id="" title="Brandiology PH | Brand ideas come to life">

                <div class="card mx-4 mx-md-5">
                    <div class="card-body px-0 px-sm-5 px-md-5">
                        <div class="text-center p-3">
                            <i class="fas fa-check fa-2x"></i>
                            <div class="d-flex justify-content-center">
                                <h2 class="font-weight-bold text-wrap">Registration Completed!</h2>
                            </div>
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

<style lang="scss" scoped>
@import "bootstrap/scss/vendor/_rfs.scss";

.svg-inline--fa, h2 {
    color: #ff5e75;
}
p {
    @include rfs(18px);
}
h2 {
    width: 10rem;
}
</style>
