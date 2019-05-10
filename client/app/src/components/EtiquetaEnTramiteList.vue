<template>
  <v-flex>
    <EtiquetaItem
      v-for="(etiqueta, i) in etiquetas"
      :etiqueta="etiqueta"
      :key="i"
      @delete="onDelete"
    ></EtiquetaItem>
  </v-flex>
</template>

<script>
import EtiquetaItem from "@/components/EtiquetaItem";
export default {
  components: {
    EtiquetaItem
  },
  props: ["etiquetas", "items"],
  methods: {
    onDelete(etiqueta) {
      this.$emit("delete", etiqueta);
    }
  }
};
</script>

<style scoped></style>
