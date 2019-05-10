<template>
  <div>
    <v-dialog v-model="dialog" v-bind="$attrs" max-width="350">
      <v-card>
        <v-card-title class="headline"
          >¿Está seguro que desea eliminar la categoría? Eliminará también todos
          sus trámites</v-card-title
        >
        <v-card-actions>
          <v-spacer></v-spacer>

          <v-btn
            color="green darken-1"
            class="white--text"
            @click="dialog = false"
          >
            Cancelar
          </v-btn>

          <v-btn
            color="red darken-1"
            class="white--text"
            @click="$emit('confirm')"
          >
            Aceptar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-btn color="error" @click="dialog = true">Eliminar</v-btn>
  </div>
</template>

<script>
export default {
  data() {
    return {
      dialog: false
    };
  }
};
</script>

<style scoped></style>
