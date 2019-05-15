<template>
  <v-stepper v-model="stepNumber">
    <v-stepper-header>
      <v-stepper-step
        v-for="(paso, i) in pasos"
        :complete="stepNumber > i + 1"
        :step="i + 1"
        :key="i"
      />
    </v-stepper-header>

    <v-stepper-items>
      <v-stepper-content v-for="(paso, i) in pasos" :step="i + 1" :key="i">
        <PasoItem :paso="paso" @delete="onDelete"></PasoItem>
      </v-stepper-content>
      <v-layout xs4 row wrap>
        <v-btn class="secondary" @click="onClickPreviousStep">Anterior</v-btn>
        <v-btn class="primary" @click="onClickNextStep">Siguiente</v-btn>
        <v-layout v-if="$store.getters.isInEditMode" justify-end xs4>
          <v-text-field v-model="nuevoPaso" label="Agregar paso"></v-text-field>
          <v-btn class="primary" @click="onNew" :disabled="!nuevoPaso"
            >Agregar paso</v-btn
          >
        </v-layout>
      </v-layout>
    </v-stepper-items>
  </v-stepper>
</template>

<script>
import PasoItem from "@/components/PasoItem";
export default {
  components: {
    PasoItem
  },
  props: ["pasos", "metodo"],
  data() {
    return {
      stepNumber: 1,
      nuevoPaso: ""
    };
  },
  computed: {
    maxStep() {
      return this.pasos.length;
    }
  },
  methods: {
    onClickNextStep() {
      if (this.stepNumber >= this.maxStep) {
        this.stepNumber = 1;
        return;
      }
      this.stepNumber++;
    },
    onClickPreviousStep() {
      if (this.stepNumber == 1) {
        this.stepNumber = this.maxStep;
        return;
      }
      this.stepNumber--;
    },
    onDelete(paso) {
      const { metodo } = this;
      this.$emit("delete", { paso, metodo });
    },
    onNew() {
      const { nuevoPaso, metodo } = this;
      this.$emit("new", { paso: nuevoPaso, metodo });
      this.nuevoPaso = "";
    }
  }
};
</script>

<style scoped></style>
