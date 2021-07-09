export default (app,error) => {
    let response = error.response;

    if(response.status === 422) {
        let errors = app.$_Arr.getProperty(response,'data.errors',[]);
        let message = Object.values(errors).flat().reduce((errs,msg)=>{
            let hasExists = errs.findIndex((m)=>{ return m == msg }) >= 0;
            if(!hasExists && Boolean(msg)) errs.push(msg);
            return errs
        },[]).join("</br>");
        app.$toast.error([message].join(''));
    }
}

