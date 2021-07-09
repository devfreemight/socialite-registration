import plugins from './plugins';
import Field from 'aj-vue-ui/src/components/field/index'
import Button from 'aj-vue-ui/src/components/button/index'
import Pagination from 'aj-vue-ui/src/components/pagination/index'
import DatePicker from 'aj-vue-ui/src/components/datepicker'
import Table from 'aj-vue-ui/src/components/table/index'
import Checkbox from 'aj-vue-ui/src/components/checkbox/index'
import Input from 'aj-vue-ui/src/components/input/index'
import Block from 'aj-vue-ui/src/components/block/index'
import Dialog from 'aj-vue-ui/src/components/dialog/index'
import Dropdown from 'aj-vue-ui/src/components/dropdown/index'
import Autocomplete from 'aj-vue-ui/src/components/autocomplete/index'
import Select from 'aj-vue-ui/src/components/select/index'
import Radio from 'aj-vue-ui/src/components/radio/index'
import VueToast from "vue-toast-notification";
import "vue-toast-notification/dist/theme-default.css";
import NProgress from "nprogress";
import "nprogress/nprogress.css";

const dependencies = {
    Field,
    Button,
    Pagination,
    Table,
    Select,
    Checkbox,
    Dropdown,
    Autocomplete,
    Input,
    Block,
    NProgress,
}

dependencies.install = (Vue) => {
    for(let name in dependencies){
        var dependency = dependencies[name]
        if (dependency && name !== 'install') {
            Vue.use(dependency)
        }
    }
    Vue.use(VueToast, { position: "bottom" });
    Vue.use(plugins)
    Vue.prototype.$nprogress = NProgress;
}

if(typeof window != 'undefined' && window.Vue){
    window.Vue.use(dependencies);
}

export default dependencies
