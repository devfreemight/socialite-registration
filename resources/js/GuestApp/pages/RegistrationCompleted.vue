<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-10 col-lg-6">

                <img :src="$_assets('/images/brandiology-banner.png')" class="img-fluid my-5" alt="Brandiology PH | Brand ideas come to life" id="" title="Brandiology PH | Brand ideas come to life">

                <div class="card mx-5">
                    <div class="card-body px-0 px-sm-5 px-md-5 text-center">
                        <div id="msg">
                            <i class="fas fa-check fa-2x text-center"></i>
                            <h2 class="font-weight-bold mb-5 mt-2 text-wrap">Registration Completed!</h2>
                        </div>
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
.card {
    height: 65vh;
}
#msg {
    top: 50%;
    left: 50%;
    position: absolute;
    transform: translate(-50%, -50%);
}
</style>
