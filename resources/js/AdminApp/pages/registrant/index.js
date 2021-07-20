import ROUTER_VIEW from '@common/components/RouterView';
import LISTING_PAGE from './listing'
import EDIT_PAGE from './Edit'

import {
    PAGE_REGISTRANT_LISTING,
    PAGE_REGISTRANT_EDITING,
    TITLE_REGISTRANT_LISTING,
    TITLE_REGISTRANT_EDIT
} from '@common/pages'

export default [
    {
        path: '/registrants',
        component: ROUTER_VIEW,
        meta: {
            tab: 'registrants',
        },
        children:[
            {
                path: '/',
                redirect: { name: PAGE_REGISTRANT_LISTING },
            },
            {
                path: 'listing',
                name: PAGE_REGISTRANT_LISTING,
                component: LISTING_PAGE,
                meta:{
                    title: TITLE_REGISTRANT_LISTING,
                }
            },
            {
                path:'edit/:id',
                name: PAGE_REGISTRANT_EDITING,
                component: EDIT_PAGE,
                props:true,
                meta:{
                    title: TITLE_REGISTRANT_EDIT
                }
            },
        ],
    },
];
