<template>
  <div>
    <v-dialog v-model="dialog" v-bind="$attrs" max-width="350">
      <v-card>
        <v-card-title class="headline">
          <slot>¿Desea confirmar?</slot>
        </v-card-title>
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
            @click="
              $emit('confirm');
              dialog = false;
            "
          >
            Aceptar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-btn v-if="shouldDisplayBtn()" color="error" @click="dialog = true"
      >Eliminar</v-btn
    >
  </div>
</template>

<script>
export default {
  data() {
    return {
      dialog: false
    };
  },
  methods: {
    shouldDisplayBtn() {
      return !this.$attrs.hasOwnProperty("no-btn");
    },
    show(value = true) {
      this.dialog = value;
    }
  }
};
</script>

<style scoped></style>
