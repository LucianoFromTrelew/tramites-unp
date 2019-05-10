<template>
  <v-card>
    <v-card-text>
      <li>
        <template v-for="(requerimiento, i) in requerimientos">
          <RequerimientoItem
            :requerimiento="requerimiento"
            @delete="onDelete"
          />
          <v-divider></v-divider>
        </template>
        <v-layout v-if="$store.getters.isInEditMode">
          <v-flex xs6 md8 lg10>
            <v-text-field v-model="nuevoRequerimiento" />
          </v-flex>
          <v-flex xs4 md4 lg2>
            <v-btn :disabled="!nuevoRequerimiento" @click="onNew"
              >Agregar requerimiento</v-btn
            >
          </v-flex>
        </v-layout>
      </li>
    </v-card-text>
  </v-card>
</template>

<script>
import RequerimientoItem from "@/components/RequerimientoItem";
export default {
  components: {
    RequerimientoItem
  },
  props: ["requerimientos"],
  data() {
    return {
      nuevoRequerimiento: ""
    };
  },
  methods: {
    onDelete(requerimiento) {
      this.$emit("delete", requerimiento);
    },
    onNew() {
      this.$emit("new", this.nuevoRequerimiento);
    }
  }
};
</script>

<style scoped></style>
