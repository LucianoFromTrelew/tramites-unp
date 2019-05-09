<template>
  <v-stepper v-model="stepNumber">
    <v-stepper-header>
      <v-stepper-step
        v-for="(paso, i) in pasos"
        :complete="stepNumber > i + 1"
        :step="i + 1"
      />
    </v-stepper-header>

    <v-stepper-items>
      <v-stepper-content v-for="(paso, i) in pasos" :step="i + 1">
        <v-card class="mb-5 grey lighten-1">
          <v-card-text>
            {{ paso.descripcion }}
          </v-card-text>
        </v-card>
        <v-btn class="secondary" @click="onClickPreviousStep">Anterior</v-btn>
        <v-btn class="primary" @click="onClickNextStep">Siguiente</v-btn>
      </v-stepper-content>
    </v-stepper-items>
  </v-stepper>
</template>

<script>
export default {
  props: ["pasos"],
  data() {
    return {
      stepNumber: 1
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
    }
  }
};
</script>

<style scoped></style>
