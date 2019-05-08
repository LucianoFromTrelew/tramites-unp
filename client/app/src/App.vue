<template>
  <!--<div id="app">-->
  <!--<div id="nav">-->
  <!--<router-link to="/">Home </router-link> |-->
  <!--<router-link to="/about">About</router-link>-->
  <!--</div>-->
  <!--<router-view />-->
  <!--</div>-->
  <v-app id="inspire">
    <MyHeader />
    <v-content>
      <v-container fluid fill-height>
        <component :is="componentToDisplay" :size="100" />
      </v-container>
    </v-content>
    <MyFooter />
  </v-app>
</template>

<script charset="utf-8">
import MyHeader from "@/layout/MyHeader.vue";
import MyFooter from "@/layout/MyFooter.vue";
import Spinner from "@/components/Spinner.vue";

export default {
  components: {
    MyHeader,
    MyFooter,
    Spinner
  },
  data() {
    return {
      componentToDisplay: "Spinner"
    };
  },
  async created() {
    try {
      await this.$store.dispatch("getCategorias");
      await this.$store.dispatch("getEtiquetas");
      await this.$store.dispatch("getTramites");
      this.componentToDisplay = "router-view";
    } catch (e) {
      console.log({ e });
    }
  }
};
</script>

<style>
#app {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
#nav {
  padding: 30px;
}

#nav a {
  font-weight: bold;
  color: #2c3e50;
}

#nav a.router-link-exact-active {
  color: #42b983;
}

.main {
  min-height: 100vh;
}
</style>
