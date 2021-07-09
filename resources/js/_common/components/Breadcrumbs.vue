<template>
<nav class="ui-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item" :class="{active: $route.name === match.name}" v-for="(match,index) in breadcrumbs" :key="index">
         <router-link :to="getLink(match)" v-if="$route.name !== match.name">
                {{ match | getProperty('meta.title','')}} 
         </router-link>
         <a href="#" v-else> {{ match | getProperty('meta.title','')}} </a>
        </li>
    </ol>
</nav>
</template>
<script>
import CreateArray from 'freedom-js-support/src/helpers/CreateArray'
export default {
    name:'ui-breadcrumbs',
    computed:{
        hasBreadcrumbsMeta(){
            return Boolean(this.metaBreadcrumbs)
        },
        metaBreadcrumbs(){
            let breadcrumbs = this.$_Arr.getProperty(this.$route,'meta.breadcrumbs',null)
            return breadcrumbs ? CreateArray(breadcrumbs) : null;
        },
        breadcrumbs(){
            return this.getRoutes().reverse().reduce(( breadcrumbs,route )=>{
                let breadcrumbAlreadyExists = breadcrumbs.findIndex((t)=>{ return this.isRouteTheSame(route,t) }) >= 0
                if(!breadcrumbAlreadyExists) breadcrumbs.unshift(route);
                return breadcrumbs;
            },[])
        },
    },
    methods:{
        isRouteTheSame(routeA,routeB){
            return this.getRouteTitle(routeA) == this.getRouteTitle(routeB);
        },
        getRouteTitle(route){
            return this.$_Arr.getProperty(route,'meta.title',null)
        },
        getRoutes(){
            return this.hasBreadcrumbsMeta ? this.getBreadcrumbRoutes() : this.getMatchingRoutes()
        },
        getBreadcrumbRoutes(){
            return this.metaBreadcrumbs.map((route)=>{
                if(typeof route === 'string') route = { name: route }
                return this.$_Arr.getProperty(this.$router.resolve(route),'route',route);
            }).concat([this.$route]);
        },
        getMatchingRoutes(){
             return this.$route.matched.filter((route)=>{
                return Boolean(this.$_Arr.getProperty(route,'meta.title',''));
            });
        },
        getLink(route){
            return { path: this.getPath(route) };
        },
        getPath(route){
            let path = this.$_Arr.getProperty(route,'path');
            let hasParam =  path.indexOf(':') >= 0 ;
            if(hasParam){
                Object.keys(this.$route.params).forEach((key)=>{
                    path = path.replace(`:${key}`,this.$route.params[key]);
                });
            }
            return path;
        }
    },
}
</script>
<style lang="scss">
.ui-breadcrumb{
    .breadcrumb {
        background-color: transparent;
    }
    .breadcrumb-item{
        a{
            margin: 0 11px 0 0;
            font-family: NotoSansJP;
            font-size: 14px;
            font-weight: normal;
            font-stretch: normal;
            font-style: normal;
            letter-spacing: normal;
            color: #333333;
        }
        &.active{
            a{
                font-weight: bold;
                color: #0f3073;
            }
        }
    }
    .breadcrumb-item + .breadcrumb-item::before {
        font-family: "FontAwesome";
        content: "\f105";
        display: inline-block;
        padding-right: 0.5rem;
        color: #6c757d;
        font-size:13px;
    }

}
</style>
