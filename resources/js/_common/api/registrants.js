import build from 'freedom-vue-framework/src/api-builder'
const config = {
    resource: 'admin/listing'
}
export default build ({
    exportCSV(payload, headers) {
        return this.getHttp().post(this.makeUrl('export-csv'), payload, headers);
    },
    update(id, payload, headers) {
        return this.getHttp().put(config.resource + id, payload, headers);
    },
    destroy(id, params="", config={}) {
        return this.getHttp().delete(config.resource + id, config);
    },
    show(id, params="", config={}) {
        return this.getHttp().get(config.resource + id, config);
    },
}, config)
