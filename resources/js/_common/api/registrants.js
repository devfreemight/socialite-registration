import build from 'freedom-vue-framework/src/api-builder'
const config = {
    resource: 'admin/listing'
}
export default build ({
    exportCSV(payload, headers) {
        return this.getHttp().post(this.makeUrl('export-csv'), payload, headers);
    },
    update(id, payload, headers) {
        return this.getHttp().put(this.makeUrl(`/${id}`), payload, headers);
    },
    destroy(id, params="", config={}) {
        return this.getHttp().delete(this.makeUrl(`/${id}`), config);
    },
    show(id, params="", config={}) {
        return this.getHttp().get(this.makeUrl(`/${id}`), config);
    },
}, config)
