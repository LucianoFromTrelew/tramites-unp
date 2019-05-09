<template>
  <v-hover>
    <v-card
      @click="onClick"
      slot-scope="{ hover }"
      :class="`elevation-${hover ? 12 : 2}`"
      color="grey lighten-2"
      class="ma-2"
    >
      <v-card-title>
        <div>
          <span class="headline"
            >{{ etiqueta.id }} - {{ etiqueta.descripcion }}</span
          >
        </div>
      </v-card-title>
    </v-card>
  </v-hover>
</template>

<script>
export default {
  props: ["etiqueta"],
  methods: {
    onClick() {
      this.$emit("etiqueta-clicked", this.etiqueta);
    }
  }
};
</script>

<style scoped></style>
