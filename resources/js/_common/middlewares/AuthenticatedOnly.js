import Arr from 'freedom-js-support/src/utilities/arr'
import CreateArray from '@helpers/CreateArray';

const defaultOnUnauthenticated = ({store,next,to,from}) => {
    return { name:'login'}
}

const isWithIn = (role,permissions)=>{
    let roles = CreateArray(permissions,'|')
    return roles.findIndex((value) => { return role.toLowerCase() === value.toLowerCase() }) >= 0;
}

export default function(_permissions,params={}){
    _permissions = _permissions.toLowerCase();
    let onUnauthenticated = Arr.getProperty(params,'onUnauthenticated',defaultOnUnauthenticated);

    return function({store,next,to,from}){
        let context = {store,next,to,from}
        let isAuthenticated = store.getters['Auth/isAuthenticated'];
        if(isAuthenticated){
            store.dispatch('Auth/check');
        }

        if(_permissions === 'authenticated' && isAuthenticated){
            return next();
        }

        if(!isAuthenticated){
            return typeof onUnauthenticated == 'function' ? onUnauthenticated(context) : onUnauthenticated;
        }

        // let role = store.getters['Auth/role'] || ''
        // if(!isWithIn(role, _permissions)){
        //     return typeof onUnauthenticated == 'function' ? onUnauthenticated(context) : onUnauthenticated;
        // }
        // return next();
    }
}
