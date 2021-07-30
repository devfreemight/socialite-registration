import VeeValidate, { Validator } from 'vee-validate';

const registration = {
    custom: {
        gender: {
            included: 'Only female participants are allowed'
        },
        birthday: {
            date_format: "The birthday must be in the format mm/dd/YYYY"
        }
    }
}

export default {
    install(Vue){
        Vue.use(VeeValidate, {
            events: 'blur|change'
        });
        Validator.localize('en', registration);
    }
}

