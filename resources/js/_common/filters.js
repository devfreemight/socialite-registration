import { VALUES as EXPORT_VALUES } from '@constants/export';

const filters = {

}

filters.install = ( Vue ) => {
    Vue.filter('getTableNumber', (index,currentPage=1,perPage=15)=> {
        return ( perPage * ( currentPage - 1 ) ) + index + 1;
    })

    Vue.filter('getProperty',(data,property,defaultValue='') =>{
        return Vue._Arr.getProperty(data,property,defaultValue);
    });

    Vue.filter('getProperGender',(value) =>{
        return value == 0 ? 'Male' : 'Female';
    });

    Vue.filter('getExportStatus',(value) =>{
        return EXPORT_VALUES[Number(value)];
    });
}

export default filters;
