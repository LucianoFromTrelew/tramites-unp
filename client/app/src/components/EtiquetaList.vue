<template>
  <v-layout row wrap>
    <template v-if="hasEtiquetas">
      <v-flex xs12 lg4 xl2 v-for="etiqueta in etiquetas" :key="etiqueta.id">
        <EtiquetaCard :etiqueta="etiqueta" @etiqueta-clicked="onClick" />
      </v-flex>
    </template>
    <v-flex v-else xs12>
      <h1>No hay etiquetas para mostrar</h1>
    </v-flex>
  </v-layout>
</template>

<script>
import EtiquetaCard from "@/components/EtiquetaCard";
export default {
  components: {
    EtiquetaCard
  },
  props: ["etiquetas"],
  computed: {
    hasEtiquetas() {
      return this.etiquetas.length > 0;
    }
  },
  methods: {
    onClick(etiqueta) {
      this.$emit("etiqueta-clicked", etiqueta);
    }
  }
};
</script>

<style scoped></style>
