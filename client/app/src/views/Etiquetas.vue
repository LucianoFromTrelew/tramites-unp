<template>
  <v-layout row wrap>
    <v-flex xs12 class="pa-3">
      <h3 class="text-xs-center display-2">Etiquetas</h3>
    </v-flex>
    <EtiquetaList :etiquetas="etiquetas" @etiqueta-clicked="onEtiquetaClick" />
  </v-layout>
</template>

<script>
import EtiquetaList from "@/components/EtiquetaList";
import { mapGetters } from "vuex";
export default {
  components: {
    EtiquetaList
  },
  computed: {
    ...mapGetters(["etiquetas"])
  },
  methods: {
    onEtiquetaClick(etiqueta) {
      this.$router.push(`/etiquetas/${etiqueta.id}`);
    }
  }
};
</script>

<style scoped></style>
