<template>
  <v-layout row wrap xs12>
    <Spinner v-if="loading" />
    <template v-else>
      <v-flex xs12>
        <h1 class="display-1 py-4 font-weight-bold text-capitalize">
          {{ etiquetaActual.descripcion }}
        </h1>
      </v-flex>
      <v-flex xs12>
        <TramiteList
          :tramites="tramitesDeEtiqueta"
          @tramite-clicked="onTramiteClick"
        />
      </v-flex>
      <v-layout justify-end v-if="isInEditMode">
        <ConfirmDialog @confirm="onConfirmDelete"
          >¿Está seguro que desea eliminar la etiqueta?</ConfirmDialog
        >
      </v-layout>
    </template>
  </v-layout>
</template>

<script>
import { mapState } from "vuex";
import Spinner from "@/components/Spinner";
import ConfirmDialog from "@/components/ConfirmDialog";
import TramiteList from "@/components/TramiteList";
import Editable from "@/mixins/editable";
export default {
  mixins: [Editable],
  components: {
    Spinner,
    ConfirmDialog,
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
    async onConfirmDelete() {
      try {
        await this.$store.dispatch("deleteEtiqueta", this.$route.params.id);
        this.$store.dispatch("snackbar", {
          msg: "Etiqueta eliminada correctamente",
          color: "green"
        });
        this.$router.push("/");
      } catch (e) {
        console.log({ e });
        this.$store.dispatch("snackbar", "No se pudo eliminar la etiqueta");
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
