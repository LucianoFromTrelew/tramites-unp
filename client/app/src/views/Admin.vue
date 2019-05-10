<template>
  <v-layout align-start row wrap>
    <v-flex xs12>
      <AutocompleteInput
        :items="autocompleteItems"
        @model-selected="onModelSelected"
      />
    </v-flex>
    <v-expansion-panel inset focusable class="ma-3">
      <v-flex
        xs12
        lg6
        mb-3
        mx-1
        v-for="(item, i) in items"
        :key="i"
        class="dark-border"
      >
        <v-expansion-panel-content>
          <template v-slot:header>
            <h3 class="display-1">{{ item.label }}</h3>
          </template>
          <NewItem
            v-bind="item.attrs"
            @new-item="onNewItem"
            @error="onError"
          ></NewItem>
        </v-expansion-panel-content>
      </v-flex>
    </v-expansion-panel>
  </v-layout>
</template>

<script>
import AutocompleteInput from "@/components/AutocompleteInput";
import NewItem from "@/components/NewItem";
import { mapGetters } from "vuex";

export default {
  components: {
    AutocompleteInput,
    NewItem
  },
  computed: {
    ...mapGetters(["autocompleteItems"])
  },
  data() {
    return {
      items: [
        {
          label: "Crear trámite",
          attrs: {
            action: "newTramite",
            extraFields: [
              "titulo",
              {
                field: "select_categoria",
                itemField: "categoria_id",
                items: this.$store.getters.categorias
              }
            ],
            errorMsg: "No se pudo crear el trámite"
          }
        },
        {
          label: "Crear categoría",
          attrs: {
            action: "newCategoria",
            errorMsg: "No se pudo crear la categoría"
          }
        },
        {
          label: "Crear etiqueta",
          attrs: {
            action: "newEtiqueta",
            errorMsg: "No se pudo crear la etiqueta"
          }
        },
        {
          label: "Crear documento",
          attrs: {
            action: "newDocumento",
            errorMsg: "No se pudo crear el documento"
          }
        }
      ]
    };
  },
  methods: {
    onModelSelected(model) {
      const { tipo, id } = model;
      const route = `${tipo}/${id}/edit`;
      this.$router.push(route);
    },
    onNewItem(successMsg) {
      this.$store.dispatch("snackbar", {
        msg: successMsg,
        color: "success"
      });
    },
    onError(errorMsg) {
      this.$store.dispatch("snackbar", errorMsg);
    }
  }
};
</script>

<style scoped>
.dark-border {
  border: 2px solid gray;
}
</style>
