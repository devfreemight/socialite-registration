import LAYOUT_HEADER from '@guest/components/LayoutHeader'
import LAYOUT_BODY from '@guest/components/LayoutBody'
import LAYOUT_FOOTER from '@guest/components/LayoutFooter'

import SELECT_CITY from './SelectCity';
import REGISTER_FORM from './RegisterForm';
import REGISTRATION_COMPLETED from './RegistrationCompleted'
import TERM_OF_SERVICE from './TermsOfService'

import GuestOnly from '@middlewares/GuestOnly';
import Error404 from '@common/components/Error404';

import {
	PAGE_ERROR_404,
	PAGE_HOME,
    PAGE_GUEST_REGISTRATION,
    PAGE_GUEST_REGISTRATION_SUCCESS,
    PAGE_GUEST_TOS
} from '@common/pages'

export default [
    {
        path: '/',
        components: {
			default: LAYOUT_BODY,
            header: LAYOUT_HEADER
		},
        meta: {
			middleware: GuestOnly(),
		},
        children: [
            {
                path: '/',
                name: PAGE_HOME,
                redirect: { name: PAGE_GUEST_REGISTRATION }
            },
            {
                path: 'sign-up',
                name: PAGE_GUEST_REGISTRATION,
                component: REGISTER_FORM,
            },
            {
                path: 'registration',
                name: PAGE_GUEST_REGISTRATION_SUCCESS,
                component: REGISTRATION_COMPLETED
            },
            {
                path: 'terms-of-service',
                name: PAGE_GUEST_TOS,
                component: TERM_OF_SERVICE,
            }
        ]
    },
	{
		path:'*',
		component:Error404,
		name: PAGE_ERROR_404,
	}
]
