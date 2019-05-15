<template>
  <v-app id="inspire">
    <MyHeader />
    <v-content>
      <v-container fluid fill-height>
        <component :is="componentToDisplay" :size="100" />
      </v-container>
    </v-content>
    <MyFooter />
    <v-snackbar
      v-model="showSnackbar"
      :timeout="4000"
      :multi-line="true"
      :right="true"
      :top="true"
      v-bind="snackbarOptions"
      class="title"
    >
      {{ snackbarMessage }}
      <v-btn color="white" flat @click="showSnackbar = false">
        Cerrar
      </v-btn>
    </v-snackbar>
  </v-app>
</template>

<script charset="utf-8">
import MyHeader from "@/layout/MyHeader.vue";
import MyFooter from "@/layout/MyFooter.vue";
import Spinner from "@/components/Spinner.vue";
import { mapState } from "vuex";

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
  computed: {
    showSnackbar: {
      get() {
        return this.$store.state.snackbar.showSnackbar;
      },
      set(newValue) {
        this.$store.commit("SET_SNACKBAR_VISIBILITY", newValue);
      }
    },
    ...mapState({
      snackbarMessage: state => state.snackbar.snackbarMessage,
      snackbarOptions: state => state.snackbar.snackbarOptions
    })
  },
  async created() {
    try {
      await this.$store.dispatch("getCategorias");
      await this.$store.dispatch("getEtiquetas");
      await this.$store.dispatch("getDocumentos");
      await this.$store.dispatch("getMetodos");
      await this.$store.dispatch("getTramites");
      this.componentToDisplay = "router-view";
    } catch (e) {
      console.log({ e });
    }
  }
};
</script>

<style></style>
