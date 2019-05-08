<template>
  <v-layout justify-center align-center class="text-xs-center">
    <v-progress-circular :size="size" :color="color" indeterminate />
  </v-layout>
</template>

<script>
export default {
  props: {
    size: {
      default: 50
    },
    color: {
      default: "primary"
    }
  }
};
</script>

<style scoped></style>
