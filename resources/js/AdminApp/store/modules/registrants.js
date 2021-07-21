import build from 'freedom-vue-framework/src/store-builder'
import Arr from 'freedom-js-support/src/utilities/arr'
import api from '@api/registrants';

const config = {
    api
}

export default build ({
    state: {

    },
    getters: {

    },
    mutations: {

    },
    actions: {
        update(context, payload) {
            let id = Arr.getProperty(payload,'id',null);
            let params = Arr.getProperty(payload,'params',null);
            if (params && payload.params) {
                delete payload.params;
            }
            return new Promise(async(resolve, reject) => {
                try{
                    let response = await api.update(id, payload, params)
                    context.commit("update", response.data.data);
                    resolve(response.data);
                }catch(response){
                    reject(response.data);
                }
            });
        }
    }
}, config)
