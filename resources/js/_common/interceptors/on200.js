export default (app,response) => {
    if(!response){
        return;
    }
    let message = app.$_Arr.getProperty(response,'data.message',null);
    let skipOns = [
        'Form is valid'
    ]
    if(message && !skipOns.includes(message)){
        app.$toast.success(message);
    }
}