import auth from './auth';

export default function (Vue) {
    Vue.api = {
        auth,
    }

    Object.defineProperties(Vue.prototype,{
        $api:{
            get:() => {
                return Vue.api;
            }
        }
    })
}
