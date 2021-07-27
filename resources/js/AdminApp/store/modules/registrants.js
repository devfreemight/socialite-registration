import build from 'freedom-vue-framework/src/store-builder'
import helper from 'freedom-vue-framework/src/store-builder/helper'
import Arr from 'freedom-js-support/src/utilities/arr'
import api from '@api/registrants';

const config = {
    api
}

export default build ({
    state: {
        registrants: {},
        params: {
            page: ''
        }
    },
    getters: {

    },
    mutations: {
        setRegistrants(state, payload) {
            state.registrants = payload;
        },
        setPaginationCurrentPage(state, payload) {
            state.registrants.current_page = payload;
        },
        setParams(state,value){
            Object.keys(value).forEach((field)=>{
                Vue.set(state.params,field,value[field])
            });
        },
        remove(state, id) {
            if (id) {
                var o_id = id.id ? id.id : id;
                var ids = Array.isArray(o_id) ? o_id : [o_id];

                helper.remove(state.registrants.data, ids);
            }
        },
    },
    actions: {
        index(context, params) {
            let join = Arr.getProperty(params,'join',false)
            if (params && params.join) {
                delete params.join;
            }
            return new Promise(async (resolve, reject) => {
                try{
                    let response = await api.index(params)
                    context.commit('setRegistrants', response.data);
                    context.commit('setParams', params);
                    resolve(response.data);
                }catch(response){
                    reject(response);
                }
            });
        },
        setPaginationCurrentPage(context, datum) {
            context.commit('setPaginationCurrentPage', datum);
        },
    }
}, config)
