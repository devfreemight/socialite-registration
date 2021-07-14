<template>
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body px-5 text-center">
                        <div id="msg">
                            <i class="fas fa-check fa-2x"></i>
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
.card {
    height: 80vh;
}
#msg {
    top: 50%;
    left: 50%;
    position: absolute;
    transform: translate(-50%, -50%);
}
</style>
