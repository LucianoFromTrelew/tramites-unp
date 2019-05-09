<template>
  <v-hover>
    <v-card
      @click="onClick"
      slot-scope="{ hover }"
      :class="`elevation-${hover ? 12 : 2}`"
      color="blue lighten-4"
      class="ma-2"
    >
      <v-card-title>
        <div>
          <span class="headline"
            >{{ categoria.id }} - {{ categoria.descripcion }}</span
          >
        </div>
      </v-card-title>
    </v-card>
  </v-hover>
</template>

<script>
export default {
  props: ["categoria"],
  methods: {
    onClick() {
      this.$emit("categoria-clicked", this.categoria);
    }
  }
};
</script>

<style scoped></style>
