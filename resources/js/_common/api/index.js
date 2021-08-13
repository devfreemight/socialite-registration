import auth from './auth';
import cities from './cities';
import registrants from './registrants';

export default function (Vue) {
    Vue.api = {
        auth,
        cities,
        registrants,
    }

    Object.defineProperties(Vue.prototype,{
        $api:{
            get:() => {
                return Vue.api;
            }
        }
    })
}
