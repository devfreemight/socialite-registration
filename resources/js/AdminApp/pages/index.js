import LAYOUT_HEADER from '@admin/components/LayoutHeader'
import LAYOUT_BODY from '@admin/components/LayoutBody'
import LAYOUT_FOOTER from '@admin/components/LayoutFooter'

import LOGIN from './Login'

import AuthenticatedOnly from '@middlewares/AuthenticatedOnly';
import GuestOnly from '@middlewares/GuestOnly';
import Error404 from '@common/components/Error404';

import {
    PAGE_ERROR_404,
    PAGE_HOME,
} from '@common/pages'

export default [
    {
        path: '/login',
        name: 'login',
        components: {
            default: LOGIN,
        },
        meta: {
            middleware: GuestOnly(),
        }
    },
    {
        path: '/',
        components: {
            header: LAYOUT_HEADER,
            default: LAYOUT_BODY,
            footer: LAYOUT_FOOTER,
        },
        meta: {
            middleware: [AuthenticatedOnly('admin')],
        },
        children: [
            {
                path: '',
                name: PAGE_HOME,
                // redirect:{name: PAGE_COMPANY_LISTING }
            },
        ],
    },
    {
        path: '*',
        component: Error404,
        name: PAGE_ERROR_404,
    }
]
