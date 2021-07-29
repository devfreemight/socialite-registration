<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <img src="/images/brandiology-banner.png" class="img-fluid my-5" alt="Brandiology PH | Brand ideas come to life" id="" title="Brandiology PH | Brand ideas come to life">

                <div class="card mx-5">
                    <div class="card-body px-0 px-md-5 text-center">
                        <div id="msg">
                            <i class="fas fa-check fa-2x text-center"></i>
                            <h3 class="font-weight-bold mb-5 mt-2 text-wrap">Registration Completed!</h3>
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
h3 {
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
