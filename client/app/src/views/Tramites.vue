<template>
  <v-layout row wrap>
    <v-flex xs12 class="pa-3">
      <h3 class="text-xs-center display-2">Tramites</h3>
    </v-flex>
    <v-flex xs12 lg6 xl4 v-for="tramite in tramites">
      <TramiteCard :tramite="tramite" @tramite-clicked="onTramiteClick" />
    </v-flex>
  </v-layout>
</template>

<script>
import TramiteCard from "@/components/TramiteCard";
export default {
  components: {
    TramiteCard
  },
  computed: {
    tramites() {
      return this.$store.getters.tramites;
    }
  },
  methods: {
    onTramiteClick(tramite) {
      this.$router.push(`/tramites/${tramite.id}`);
    }
  }
};
</script>

<style scoped></style>
