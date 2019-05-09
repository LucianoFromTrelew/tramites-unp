<template>
  <v-list-tile @click="onClick">
    <v-list-tile-action>
      <v-icon>{{ link.icon }}</v-icon>
    </v-list-tile-action>
    <v-list-tile-content>
      <v-list-tile-title>
        {{ link.label }}
      </v-list-tile-title>
    </v-list-tile-content>
  </v-list-tile>
</template>

<script>
export default {
  props: ["link"],
  methods: {
    onClick() {
      this.$emit("sidebar-link-clicked", this.link.route);
    }
  }
};
</script>

<style scoped></style>
