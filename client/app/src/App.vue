<template>
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

<style></style>
