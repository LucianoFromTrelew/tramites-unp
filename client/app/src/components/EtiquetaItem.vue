<template>
  <v-chip class="my-2 font-weight-medium">
    {{ etiqueta.descripcion }}
    <v-icon v-if="$store.getters.isInEditMode" right @click="onClickClose"
      >close</v-icon
    >
  </v-chip>
</template>

<script>
export default {
  props: ["etiqueta"],
  methods: {
    onClickClose() {
      this.$emit("delete", this.etiqueta);
    }
  }
};
</script>

<style scoped></style>
