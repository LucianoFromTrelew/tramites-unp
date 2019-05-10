<template>
  <v-layout>
    <v-flex xs2 md1 v-if="$store.getters.isInEditMode">
      <v-chip @click="onDelete">
        <v-icon>close</v-icon>
      </v-chip>
    </v-flex>
    <v-flex xs10 md11>
      <ul class="py-1">
        {{
          documento.descripcion
        }}
      </ul>
    </v-flex>
  </v-layout>
</template>

<script>
export default {
  props: ["documento"],
  methods: {
    onDelete() {
      this.$emit("delete", this.documento);
    }
  }
};
</script>

<style scoped></style>
