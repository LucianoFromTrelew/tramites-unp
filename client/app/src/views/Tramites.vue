<template>
  <v-layout row wrap>
    <v-flex xs12 class="pa-3">
      <h3 class="text-xs-center display-2">Tramites</h3>
    </v-flex>
    <TramiteList :tramites="tramites" @tramite-clicked="onTramiteClick" />
  </v-layout>
</template>

<script>
import TramiteList from "@/components/TramiteList";
import { mapGetters } from "vuex";
export default {
  components: {
    TramiteList
  },
  computed: {
    ...mapGetters(["tramites"])
  },
  methods: {
    onTramiteClick(tramite) {
      this.$router.push(`/tramites/${tramite.id}`);
    }
  }
};
</script>

<style scoped></style>
