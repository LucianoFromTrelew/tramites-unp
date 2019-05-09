<template>
  <v-layout row wrap>
    <div v-if="hasTramites">
      <v-flex xs12 lg6 xl4 v-for="tramite in tramites" :key="tramite.id">
        <TramiteCard :tramite="tramite" @tramite-clicked="onClick" />
      </v-flex>
    </div>
    <v-flex v-else xs12>
      <h1>No hay trámites para mostrar</h1>
    </v-flex>
  </v-layout>
</template>

<script>
import TramiteCard from "@/components/TramiteCard";
export default {
  components: {
    TramiteCard
  },
  props: ["tramites"],
  computed: {
    hasTramites() {
      return this.tramites.length > 0;
    }
  },
  methods: {
    onClick(tramite) {
      this.$emit("tramite-clicked", tramite);
    }
  }
};
</script>

<style scoped></style>
