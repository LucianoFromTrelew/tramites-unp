<template>
  <v-layout row wrap>
    <v-flex xs12 class="pa-3">
      <h3 class="text-xs-center display-2">Categorias</h3>
    </v-flex>
    <CategoriaList
      :categorias="categorias"
      @categoria-clicked="onCategoriaClick"
    />
  </v-layout>
</template>

<script>
import CategoriaList from "@/components/CategoriaList";
import { mapGetters } from "vuex";
export default {
  components: {
    CategoriaList
  },
  computed: {
    ...mapGetters(["categorias"])
  },
  methods: {
    onCategoriaClick(categoria) {
      this.$router.push(`/categorias/${categoria.id}`);
    }
  }
};
</script>

<style scoped></style>
