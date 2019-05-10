<template>
  <v-layout row wrap>
    <Spinner v-if="loading" />
    <div v-else>
      <h1 class="display-1 py-4 font-weight-bold text-capitalize">
        {{ etiquetaActual.descripcion }}
      </h1>
      <TramiteList
        :tramites="tramitesDeEtiqueta"
        @tramite-clicked="onTramiteClick"
      />
    </div>
  </v-layout>
</template>

<script>
import { mapState } from "vuex";
import Spinner from "@/components/Spinner";
import TramiteList from "@/components/TramiteList";
import Editable from "@/mixins/editable";
export default {
  mixins: [Editable],
  components: {
    Spinner,
    TramiteList
  },
  data() {
    return {
      loading: false
    };
  },
  computed: {
    ...mapState(["tramitesDeEtiqueta"]),
    etiquetaActual() {
      return this.$store.getters.etiquetaActual(this.$route.params.id);
    }
  },
  methods: {
    async fetchData() {
      try {
        this.loading = true;
        const etiquetaId = this.$route.params.id;
        await this.$store.dispatch("getTramitesPerEtiqueta", etiquetaId);
      } catch (e) {
        /* handle error */
      } finally {
        this.loading = false;
      }
    },
    onTramiteClick(tramite) {
      this.$router.push(`/tramites/${tramite.id}`);
    }
  },
  created() {
    this.fetchData();
  },
  watch: {
    $route(to, from) {
      this.fetchData();
    }
  }
};
</script>

<style scoped></style>
