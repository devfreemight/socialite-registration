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

}

export default filters;
