<template>
  <v-container>
    <v-card>
      <v-form v-model="valid" class="pa-4">
        <v-layout row wrap>
          <v-flex xs12>
            <v-text-field
              v-model="user.email"
              :rules="[rules.required, rules.email]"
              label="Email"
              required
            ></v-text-field>
          </v-flex>

          <v-flex xs12>
            <v-text-field
              v-model="user.password"
              label="Contraseña"
              :rules="[rules.required]"
              :append-icon="showPassword ? 'visibility' : 'visibility_off'"
              :type="showPassword ? 'text' : 'password'"
              required
              @click:append="showPassword = !showPassword"
            ></v-text-field>
          </v-flex>
          <v-layout justify-end>
            <v-btn
              color="blue-grey"
              class="white--text"
              :disabled="!valid"
              :loading="loading"
              @click="onSendClick"
            >
              Enviar
              <v-icon right dark>send</v-icon>
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
    user: {
      email: "",
      password: ""
    },
    showPassword: false,
    valid: false,
    rules: {
      required: v => !!v || "Campo requerido",
      email: v =>
        /.+@.+/.test(v) || "Debe ingresar una dirección de email válida"
    },
    loading: false
  }),
  methods: {
    async onSendClick() {
      try {
        this.loading = true;
        await this.$store.dispatch("login", this.user);
        this.$router.push("/admin");
      } catch (e) {
        alert("EE TODO mal");
        console.log({ e });
        /* handle error */
      } finally {
        this.loading = false;
      }
    }
  }
};
</script>

<style scoped></style>
