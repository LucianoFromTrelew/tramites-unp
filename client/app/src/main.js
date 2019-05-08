import Vue from "vue";
import Vuetify from "vuetify";
import "vuetify/dist/vuetify.min.css";
import "material-design-icons-iconfont";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import myFilters from "./filters";

Vue.config.productionTip = false;
Vue.use(Vuetify);
Vue.use(myFilters);

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount("#app");
