<template>
  <div id="nav">
    <appnave/>
  </div>
  <router-view/>
</template>
<script>
import Appnave from './components/global/appnave.vue'
export default {
  name: 'nav',
  components: {
    Appnave
  }
}
</script>
<style lang="scss">
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

#nav {
  padding: 30px;

  a {
    font-weight: bold;
    color: #2c3e50;
    text-decoration: none;

    &.router-link-exact-active {
      color: #42b983;
    }
  }
}
</style>
