<template>
  <v-flex xs12>
    <v-card color="blue lighten-1" dark>
      <v-card-title class="headline blue lighten-2">
        ¿Qué desea buscar?
      </v-card-title>
      <v-card-text>
        <span class="title">Buscar trámites, categorías, o etiquetas</span>
      </v-card-text>
      <v-card-text>
        <v-autocomplete
          v-model="model"
          :items="items"
          :loading="isLoading"
          color="white"
          hide-no-data
          hide-selected
          item-text="descripcion"
          placeholder="Escriba para buscar"
          prepend-icon="storage"
          return-object
        ></v-autocomplete>
      </v-card-text>
      <v-divider></v-divider>
      <div v-if="model">
        <v-expand-transition>
          <v-list class="blue">
            <v-list-tile v-for="(field, i) in fields" :key="i">
              <v-list-tile-content>
                <v-list-tile-title>{{
                  field.key | capitalize
                }}</v-list-tile-title>
                <v-list-tile-sub-title
                  v-text="field.value"
                ></v-list-tile-sub-title>
              </v-list-tile-content>
            </v-list-tile>
          </v-list>
        </v-expand-transition>
        <v-card-actions class="py-3">
          <v-btn color="grey darken-3" @click="model = null">
            Limpiar
            <v-icon right>close</v-icon>
          </v-btn>
          <v-spacer></v-spacer>
          <v-btn color="green" @click="onSelectClick">
            Seleccionar
          </v-btn>
        </v-card-actions>
      </div>
    </v-card>
  </v-flex>
</template>
<script>
export default {
  props: ["items"],
  data: () => ({
    isLoading: false,
    model: null
  }),
  computed: {
    fields() {
      if (!this.model) return [];

      return Object.keys(this.model).map(key => {
        return {
          key,
          value: this.model[key] || "n/a"
        };
      });
    }
  },
  methods: {
    onSelectClick() {
      this.$emit("model-selected", this.model);
    }
  },
  watch: {
    $route(to, from) {
      this.model = null;
    }
  }
};
</script>
<style scoped></style>
