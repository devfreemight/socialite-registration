import build from 'freedom-vue-framework/src/api-builder'
const config = {
    resource: 'guest'
}
export default build ({
    check_registration_token(token) {
        return this.getHttp().get(this.makeUrl(`check-registration-token/${token}`));
    },
}, config)
