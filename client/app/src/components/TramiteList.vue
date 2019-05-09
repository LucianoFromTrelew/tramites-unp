<template>
  <v-layout row wrap>
    <v-flex xs12 lg6 xl4 v-for="tramite in tramites" :key="tramite.id">
      <TramiteCard :tramite="tramite" @tramite-clicked="onClick" />
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
  methods: {
    onClick(tramite) {
      this.$emit("tramite-clicked", tramite);
    }
  }
};
</script>

<style scoped></style>
