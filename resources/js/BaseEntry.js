import API from '@api/index';
import Vue from 'vue';
import framework from 'freedom-vue-framework';
import CommonDependencies from './_common/dependencies'
import app_modules from '@common/store';
import interceptors from '@common/interceptors'

export default function(VueOptions,configurations={}){
    Vue.use(CommonDependencies);
    const dependencies = configurations['dependencies'];

    if(dependencies){
        Vue.use(dependencies);
    }

    let app = null;
    let apiIsLoading = false;

    const startProgress = () => {
        if(!apiIsLoading){
            app.$nprogress.start();
        }
        apiIsLoading = true;
    }

    const finishProgress = () => {
        if(apiIsLoading){
            app.$nprogress.done();
        }
        apiIsLoading = false;
    }

    configurations['vuex']['modules'] = Object.assign(app_modules,configurations['vuex']['modules'])
    configurations['resource'] = {
        interceptors:{
            request: [
                (request)=>{
                    startProgress()
                    return request;
                },(error)=>{
                    finishProgress()
                    return Promise.reject(error);
                }
            ],
            response : [
                success => {
                    finishProgress()
                    interceptors.onSuccess.forEach((intercept)=>{
                        intercept(app,success);
                    });
                    return success;
                },error=>{
                    finishProgress()
                    interceptors.onError.forEach((intercept)=>{
                        intercept(app,error)
                    })
                    return Promise.reject(error.response)
                }
            ]
        }
    }

    Vue.use(API)
    app = framework(VueOptions,configurations);

    app.$router.appendBeforeEach(startProgress);
    app.$router.appendAfterEach(finishProgress);

    const checkAuthenticity = () => {
        if(app.$store.getters['Auth/isAuthenticated']){
            app.$store.dispatch('Auth/check');
        }
    }

    var session_timer = null;
    const session_lifetime =  1000 * 60 * 60
    const renewSession = () => {
        clearTimeout(session_timer);
        session_timer = null;
        if(app.$store.getters['Auth/isAuthenticated']){
            session_timer = setTimeout(()=>{
                checkAuthenticity();
            },session_lifetime);
        }
    }

    app.$bus.on('login',renewSession);
    app.$bus.on('logout',renewSession);

    app.$router.appendAfterEach(renewSession);

    Vue.vuex = {
        store : () => {
            return app.$store;
        }
    }

    window.Vue = Vue;
    checkAuthenticity();

    Vue.http.defaults.headers.common['auth'] = { username: 'fmdev', password: 'brandiology' }

    return app;
}
