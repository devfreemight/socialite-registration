const NOT_FOUND_MODEL = "No query results for model";
import {
    PAGE_ERROR_404
} from '@common/pages'
export default (app,error) => {
    let response = error.response;
    if(!response.status === 404) return;
    let message = app.$_Arr.getProperty(response,'data.message', NOT_FOUND_MODEL);
    if(message.indexOf( NOT_FOUND_MODEL ) >= 0) return app.$router.replace({ name: PAGE_ERROR_404 }); 
}

