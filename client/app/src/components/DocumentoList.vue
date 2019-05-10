<template>
  <v-card>
    <v-card-text>
      <li>
        <template v-for="(documento, i) in documentos">
          <DocumentoItem :documento="documento" @delete="onDelete" />
          <v-divider></v-divider>
        </template>
        <v-layout v-if="$store.getters.isInEditMode">
          <v-flex xs3 md8 lg10>
            <v-select
              v-model="nuevoDocumento"
              :items="filterItems()"
              item-text="descripcion"
              label="Nuevo documento"
              return-object
            />
          </v-flex>
          <v-flex xs3 md4 lg2>
            <v-btn :disabled="!nuevoDocumento" @click="onNew"
              >Agregar documento</v-btn
            >
          </v-flex>
        </v-layout>
      </li>
    </v-card-text>
  </v-card>
</template>

<script>
import DocumentoItem from "@/components/DocumentoItem";
export default {
  components: {
    DocumentoItem
  },
  props: ["documentos", "items"],
  data() {
    return {
      nuevoDocumento: null
    };
  },
  methods: {
    onDelete(documento) {
      this.$emit("delete", documento);
    },
    onNew() {
      this.$emit("new", this.nuevoDocumento);
      this.nuevoDocumento = null;
    },
    isInTramite(documento) {
      return this.documentos.findIndex(et => et.id === documento.id) !== -1;
    },
    filterItems() {
      return this.items.filter(et => !this.isInTramite(et));
    }
  }
};
</script>

<style scoped></style>
