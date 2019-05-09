<template>
  <v-layout justify-center row wrap class="home">
    <AutocompleteInput :items="items" @model-selected="onModelSelected" />

    <!--acá va la lista de trámites, categorías, etiquetas-->
    <router-view />
  </v-layout>
</template>

<script>
import AutocompleteInput from "@/components/AutocompleteInput.vue";

export default {
  name: "home",
  components: {
    AutocompleteInput
  },
  computed: {
    items() {
      let items = [];
      this.$store.getters.categorias.forEach(categoria => {
        items.push({
          tipo: "categorias",
          id: categoria.id,
          descripcion: `Categoria: ${categoria.descripcion}`
        });
      });
      this.$store.getters.etiquetas.forEach(etiqueta => {
        items.push({
          tipo: "etiquetas",
          id: etiqueta.id,
          descripcion: `Etiqueta: ${etiqueta.descripcion}`
        });
      });
      this.$store.getters.tramites.forEach(tramite => {
        items.push({
          tipo: "tramites",
          id: tramite.id,
          descripcion: `Tramite: ${tramite.titulo}`
        });
      });
      return items;
    }
  },
  methods: {
    getDetailLink(model) {
      const { id, tipo } = model;
      return `/${tipo}/${id}`;
    },
    onModelSelected(model) {
      const route = this.getDetailLink(model);
      this.$router.push(route);
    }
  }
};
</script>
