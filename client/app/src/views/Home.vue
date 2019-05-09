<template>
  <v-layout justify-center row wrap class="home">
    <AutocompleteInput
      :items="autocompleteItems"
      @model-selected="onModelSelected"
    />

    <!--acá va la lista de trámites, categorías, etiquetas-->
    <router-view />
  </v-layout>
</template>

<script>
import AutocompleteInput from "@/components/AutocompleteInput.vue";
import { mapGetters } from "vuex";

export default {
  name: "home",
  components: {
    AutocompleteInput
  },
  computed: {
    ...mapGetters(["autocompleteItems"])
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
