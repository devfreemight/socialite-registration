import ROUTER_VIEW from '@common/components/RouterView';
import LISTING_PAGE from './listing'

import {
    PAGE_REGISTRANTS_LISTING,
    TITLE_REGISTRANTS_LISTING
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
                redirect: { name: PAGE_REGISTRANTS_LISTING },
            },
            {
                path: 'listing',
                name: PAGE_REGISTRANTS_LISTING,
                component: LISTING_PAGE,
                meta:{
                    title: TITLE_REGISTRANTS_LISTING,
                }
            },
            // {
            //     path:'edit/:id',
            //     name: PAGE_COMPANY_EDIT,
            //     component:EDITING_PAGE,
            //     props:true,
            //     meta:{
            //         title: TITLE_COMPANY_EDIT
            //     }
            // },
        ],
    },
];
