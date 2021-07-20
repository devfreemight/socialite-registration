import build from 'freedom-vue-framework/src/api-builder'
const config = {
    resource: 'registrants'
}
export default build ({
    exportCSV(payload, headers){
        return this.getHttp().post(this.makeUrl('export-csv'), payload, headers);
    },
}, config)
