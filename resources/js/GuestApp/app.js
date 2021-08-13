import BaseEntry from '../BaseEntry'
import Vue from 'vue';
import routes from './pages'
import App from './MainApp';
import { modules, persistLocal, persistSession } from './store'

import dependencies from './dependencies';
import config from './config';
Vue.use(dependencies);

const base_url = "/";

const app = BaseEntry({
    el:'#app',
    render: h => h(App),
}, {
    dependencies,
    config,
    vuex: { modules, persistLocal, persistSession },
    router: {
        routes,
        base: base_url,
    },
})

export default app;

