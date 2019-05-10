<template>
  <v-container>
    <v-card>
      <v-form v-model="valid" class="pa-4">
        <v-layout row wrap>
          <v-flex xs12 v-for="(field, i) in fields" :key="i">
            <v-text-field
              v-if="!isSelect(field)"
              v-model="item[field]"
              :rules="[rules.required]"
              :label="field | capitalize"
              required
            ></v-text-field>
            <v-select
              v-else
              v-model="item[getItemFieldName(field)]"
              :label="getFieldName(field) | capitalize"
              :items="getSelectItems(field)"
              item-text="descripcion"
              item-value="id"
              required
            ></v-select>
          </v-flex>

          <v-layout justify-end>
            <v-btn
              color="primary"
              class="white--text"
              :disabled="!valid"
              :loading="loading"
              @click="onSendClick"
            >
              Crear
              <v-icon right dark>add_circle</v-icon>
            </v-btn>
          </v-layout>
        </v-layout>
      </v-form>
    </v-card>
  </v-container>
</template>

<script>
export default {
  data: () => ({
    fields: ["descripcion"],
    item: {},
    valid: false,
    rules: {
      required: v => !!v || "Campo requerido"
    },
    errorMsg: "No se pudo realizar la operación",
    successMsg: "¡Operación realizada con éxito!",
    loading: false
  }),
  methods: {
    async onSendClick() {
      this.loading = true;
      try {
        await this.$store.dispatch(this.action, this.item);
        this.$emit("new-item", this.successMsg);
        this.reset();
      } catch (e) {
        console.log({ e });
        this.$emit("error", this.errorMsg);
      } finally {
        this.loading = false;
      }
    },
    isSelect(field) {
      return field.startsWith("select_");
    },
    getItemFieldName(field) {
      const ef = this.$attrs.extraFields.find(f => f.field === field);
      return ef.itemField;
    },
    getFieldName(field) {
      return field.replace("select_", "");
    },
    getSelectItems(field) {
      const ef = this.$attrs.extraFields.find(f => f.field === field);
      return ef.items;
    },
    reset() {
      for (const prop in this.item) {
        this.item[prop] = "";
      }
    }
  },
  created() {
    if (this.$attrs.hasOwnProperty("extraFields")) {
      this.$attrs.extraFields.forEach(extraField => {
        this.fields.unshift(extraField.field || extraField);
        this.item[extraField.itemField || extraField] = "";
      });
    }
    if (this.$attrs.hasOwnProperty("action")) {
      this.action = this.$attrs.action;
    }
    if (this.$attrs.hasOwnProperty("errorMsg")) {
      this.errorMsg = this.$attrs.errorMsg;
    }
  }
};
</script>

<style scoped></style>
