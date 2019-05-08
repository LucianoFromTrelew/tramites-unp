<template>
  <v-hover>
    <v-card
      @click="onClick"
      slot-scope="{ hover }"
      :class="`elevation-${hover ? 12 : 2}`"
      class="ma-2"
    >
      <v-card-title>
        <div>
          <span class="headline">{{ tramite.id }} - {{ tramite.titulo }}</span>
          <div class="d-flex">
            <div class="ml-2 grey--text text--darken-2">
              <span>{{ tramite.descripcion }}</span>
            </div>
          </div>
        </div>
      </v-card-title>
    </v-card>
  </v-hover>
</template>

<script>
export default {
  props: ["tramite"],
  methods: {
    onClick() {
      this.$emit("tramite-clicked", this.tramite);
    }
  }
};
</script>

<style scoped></style>
