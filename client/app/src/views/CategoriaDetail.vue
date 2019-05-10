<template>
  <v-layout row wrap xs12>
    <Spinner v-if="loading" />
    <template v-else>
      <v-flex xs12>
        <h1 class="display-1 py-4 font-weight-bold">
          {{ categoriaActual.descripcion }}
        </h1>
      </v-flex>
      <v-flex xs12>
        <TramiteList
          :tramites="tramitesDeCategoria"
          @tramite-clicked="onTramiteClick"
        />
      </v-flex>
      <v-layout justify-end v-if="isInEditMode">
        <ConfirmDialog @confirm="onConfirmDelete">
          ¿Está seguro que desea eliminar la categoría? Eliminará también todos
          sus trámites
        </ConfirmDialog>
      </v-layout>
    </template>
  </v-layout>
</template>

<script>
import { mapState } from "vuex";
import Spinner from "@/components/Spinner";
import TramiteList from "@/components/TramiteList";
import ConfirmDialog from "@/components/ConfirmDialog";
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
    ...mapState(["tramitesDeCategoria"]),
    categoriaActual() {
      return this.$store.getters.categoriaActual(this.$route.params.id);
    }
  },
  methods: {
    async fetchData() {
      try {
        this.loading = true;
        const categoriaId = this.$route.params.id;
        await this.$store.dispatch("getTramitesPerCategoria", categoriaId);
      } catch (e) {
        console.log("No se pudo recuperar datos");
        /* handle error */
      } finally {
        this.loading = false;
      }
    },
    onTramiteClick(tramite) {
      this.$router.push(`/tramites/${tramite.id}`);
    },
    async onConfirmDelete() {
      try {
        await this.$store.dispatch("deleteCategoria", this.$route.params.id);
        this.$store.dispatch("snackbar", {
          msg: "Categoría eliminada correctamente",
          color: "green"
        });
        this.$router.push("/");
      } catch (e) {
        console.log({ e });
        this.$store.dispatch("snackbar", "No se pudo eliminar la categoría");
      }
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
