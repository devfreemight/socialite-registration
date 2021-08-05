import VeeValidate, { Validator } from 'vee-validate';

const registration = {
    custom: {
        full_name: {
            regex: 'The full name field may only contain alphabetic characters as well as spaces and period.'
        },
        gender: {
            included: 'Only female participants are allowed.'
        },
        birthday: {
            date_format: "The birthday must be in the format mm/dd/YYYY."
        },
        age: {
            between: "Only participants/registrants aged 18-30 years old are allowed."
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

