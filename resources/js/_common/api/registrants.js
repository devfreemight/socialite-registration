import build from 'freedom-vue-framework/src/api-builder'
const config = {
    resource: 'registrants'
}
export default build ({
    exportCSV(payload, headers){
        return this.getHttp().post(this.makeUrl('export-csv'), payload, headers);
    },
    update(id, payload, headers) {
        return this.getHttp().put('/api/registrants/' + id, payload, headers);
    },
    destroy(id, params="", config={}){
        return this.getHttp().delete('/api/registrants/' + id, config);
    },
}, config)
