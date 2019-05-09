<template>
  <v-layout row wrap>
    <template v-if="hasCategorias">
      <v-flex xs12 lg6 xl4 v-for="categoria in categorias" :key="categoria.id">
        <CategoriaCard :categoria="categoria" @categoria-clicked="onClick" />
      </v-flex>
    </template>
    <v-flex v-else xs12>
      <h1>No hay categorías para mostrar</h1>
    </v-flex>
  </v-layout>
</template>

<script>
import CategoriaCard from "@/components/CategoriaCard";
export default {
  components: {
    CategoriaCard
  },
  props: ["categorias"],
  computed: {
    hasCategorias() {
      return this.categorias.length > 0;
    }
  },
  methods: {
    onClick(categoria) {
      this.$emit("categoria-clicked", categoria);
    }
  }
};
</script>

<style scoped></style>
