<template>
  <v-flex>
    <EtiquetaItem
      v-for="(etiqueta, i) in etiquetas"
      :etiqueta="etiqueta"
      :key="i"
      @delete="onDelete"
    ></EtiquetaItem>
    <v-layout v-if="$store.getters.isInEditMode">
      <v-flex xs5 md8 lg10>
        <v-select
          v-model="nuevaEtiqueta"
          :items="filterItems()"
          item-text="descripcion"
          label="Nueva etiqueta"
          return-object
        />
      </v-flex>
      <v-flex xs4 md4 lg2>
        <v-btn :disabled="!nuevaEtiqueta" @click="onNew"
          >Agregar etiqueta</v-btn
        >
      </v-flex>
    </v-layout>
  </v-flex>
</template>

<script>
import EtiquetaItem from "@/components/EtiquetaItem";
export default {
  components: {
    EtiquetaItem
  },
  props: ["etiquetas", "items"],
  data() {
    return {
      nuevaEtiqueta: null
    };
  },
  methods: {
    onDelete(etiqueta) {
      this.$emit("delete", etiqueta);
    },
    onNew() {
      this.$emit("new", this.nuevaEtiqueta);
      this.nuevaEtiqueta = null;
    },
    isInTramite(etiqueta) {
      return this.etiquetas.findIndex(et => et.id === etiqueta.id) !== -1;
    },
    filterItems() {
      return this.items.filter(et => !this.isInTramite(et));
    }
  }
};
</script>

<style scoped></style>
