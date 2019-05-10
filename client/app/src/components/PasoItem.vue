<template>
  <v-card class="mb-5 grey lighten-1">
    <v-layout row wrap>
      <v-flex xs7 md10>
        <v-card-text>
          {{ paso.descripcion }}
        </v-card-text>
      </v-flex>
      <v-flex v-if="$store.getters.isInEditMode" xs3 md2>
        <v-btn @click="onClick">
          <v-icon>close</v-icon>
        </v-btn>
      </v-flex>
    </v-layout>
  </v-card>
</template>

<script>
export default {
  props: ["paso"],
  methods: {
    onClick() {
      this.$emit("delete", this.paso);
    }
  }
};
</script>

<style scoped></style>
