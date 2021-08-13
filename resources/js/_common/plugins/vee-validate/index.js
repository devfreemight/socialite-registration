import VeeValidate, { Validator } from 'vee-validate';

const registration = {
    custom: {
        full_name: {
            required: 'The full name field is required.',
            regex: 'The full name field may only contain alphabetic characters as well as spaces and period.',
            max: 'The full name field may not be greater than 255 characters.',
        },
        gender: {
            included: 'Only female participants/registrants are allowed to get a free shampoo.'
        },
        birthday: {
            date_format: "The birthday must be in the format mm/dd/YYYY.",
            required: 'The birthday field is required.'
        },
        age: {
            between: "Only participants/registrants aged 18-30 years old are allowed, you must be born on year 1991 onwards but not later than year 2003."
        },
        contact_no: {
            required: 'The contact number/mobile number field is required.',
            digits: 'The contact number/mobile number field must be numeric and contains exactly 11 digits.'
        },
        address: {
            required: 'The house # and street field is required.',
            max: 'The house # and street field may not be greater than 255 characters.',
        },
        barangay: {
            required: 'The barangay field is required.',
            max: 'The barangay field may not be greater than 255 characters.'
        },
        landmark: {
            required: 'The landmark field is required.',
            max: 'The landmark field may not be greater than 255 characters.'
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

