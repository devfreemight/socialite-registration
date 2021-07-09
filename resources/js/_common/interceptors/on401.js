export default (app,error) => {
    let response = error.response;
    if(response.status === 401){
        app.$store.dispatch('Auth/logout')
    }
}
