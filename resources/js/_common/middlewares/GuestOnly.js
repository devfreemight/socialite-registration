import Arr from 'freedom-js-support/src/utilities/arr'
const defaultOnAuthenticated = ({store,next,to,from}) => {
    return { name:'home'}
}

export default function(params={}){

    let onAuthenticated =  Arr.getProperty(params,'onAuthenticated',defaultOnAuthenticated);

    return function ({store,next,to,from}){

        let context = {store,next,to,from}
        let isAuthenticated = store.getters['Auth/isAuthenticated']

        if(isAuthenticated){
            return typeof onAuthenticated == 'function' ? onAuthenticated(context) : onAuthenticated;
        }

        return next();
    }

}

