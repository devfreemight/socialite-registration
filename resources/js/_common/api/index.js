import auth from './auth';
import cities from './cities';

export default function (Vue) {
    Vue.api = {
        auth,
        cities,
    }

    Object.defineProperties(Vue.prototype,{
        $api:{
            get:() => {
                return Vue.api;
            }
        }
    })
}
