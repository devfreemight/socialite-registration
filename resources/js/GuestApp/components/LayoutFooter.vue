<template>
    <div class="layout-footer">

    </div>
</template>

<script>

export default {
  name:'LayoutFooter',
  computed:{
    currentYear(){
      return new Date().getFullYear()
    }
  }
}
</script>

<style lang="scss">
.layout-footer{
    max-height:139.8px;
    flex-grow:1;
    padding: 40px;
    font-family: NotoSansJP;
    font-size: 14px;
    font-weight: 500;
    font-stretch: normal;
    font-style: normal;
    line-height: normal;
    letter-spacing: 0.5px;
    text-align: center;
    color: #333333;
}
</style>
