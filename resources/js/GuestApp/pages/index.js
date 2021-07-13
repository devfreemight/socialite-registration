import LAYOUT_HEADER from '@guest/components/LayoutHeader'
import LAYOUT_BODY from '@guest/components/LayoutBody'
import LAYOUT_FOOTER from '@guest/components/LayoutFooter'

import SELECT_CITY from './SelectCity';
import REGISTER_FORM from './RegisterForm';

import GuestOnly from '@middlewares/GuestOnly';
import Error404 from '@common/components/Error404';

import {
	PAGE_ERROR_404,
	PAGE_HOME,
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
                redirect: { name: 'select:city'}
            },
            {
                path: '/select-city',
                name: 'select:city',
                component: SELECT_CITY
            },
            {
                path: 'register/:city_id/:name',
                name: 'guest.register',
                props: true,
                component: REGISTER_FORM
            },
        ]
    },
	{
		path:'*',
		component:Error404,
		name: PAGE_ERROR_404,
	}
]
