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
          requerimiento.descripcion
        }}
      </ul>
    </v-flex>
  </v-layout>
</template>

<script>
export default {
  props: ["requerimiento"],
  methods: {
    onDelete() {
      this.$emit("delete", this.requerimiento);
    }
  }
};
</script>

<style scoped></style>
