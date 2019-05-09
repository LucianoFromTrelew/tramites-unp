<template>
  <v-layout xs12>
    <Spinner v-if="loading" />
    <v-flex v-else>
      <h1 class="display-1 py-4 font-weight-bold">
        {{ tramiteActual.tramite.titulo }}
      </h1>
      <h3 class="headline pb-2">{{ tramiteActual.categoria.descripcion }}</h3>
      <hr />
      <h3 class="subheading py-2">{{ tramiteActual.tramite.descripcion }}</h3>
      <v-divider />
      <v-layout row wrap>
        <v-flex xs12>
          <v-chip
            class="my-2 font-weight-medium"
            v-for="etiqueta in tramiteActual.etiquetas"
          >
            {{ etiqueta.descripcion }}
          </v-chip>
        </v-flex>
      </v-layout>

      <v-expansion-panel focusable>
        <!--Requerimientos-->
        <v-expansion-panel-content>
          <template v-slot:header>
            <div>Requerimientos</div>
          </template>
          <v-card>
            <v-card-text>
              <li>
                <template
                  v-for="(requerimiento, i) in tramiteActual.requerimientos"
                >
                  <ul class="py-1">
                    {{
                      i + 1
                    }}
                    -
                    {{
                      requerimiento.descripcion
                    }}
                  </ul>
                  <v-divider></v-divider>
                </template>
              </li>
            </v-card-text>
          </v-card>
        </v-expansion-panel-content>
        <!--Documentos-->
        <v-expansion-panel-content>
          <template v-slot:header>
            <div>Documentos</div>
          </template>
          <v-card>
            <v-card-text>
              <li>
                <template v-for="(documento, i) in tramiteActual.documentos">
                  <ul class="py-1">
                    {{
                      i + 1
                    }}
                    -
                    {{
                      documento.descripcion
                    }}
                  </ul>
                  <v-divider></v-divider>
                </template>
              </li>
            </v-card-text>
          </v-card>
        </v-expansion-panel-content>
        <!--Metodos-->
        <v-expansion-panel-content>
          <template v-slot:header>
            <div>Metodos</div>
          </template>
          <v-expansion-panel>
            <v-expansion-panel-content v-for="metodo in tramiteActual.metodos">
              <template v-slot:header>
                <div class="pl-5">{{ metodo.descripcion }}</div>
              </template>
              <PasosTramite :pasos="getPasosPorMetodo(metodo)" />
            </v-expansion-panel-content>
          </v-expansion-panel>
        </v-expansion-panel-content>
      </v-expansion-panel>
    </v-flex>
  </v-layout>
</template>

<script>
import Spinner from "@/components/Spinner";
import PasosTramite from "@/components/PasosTramite";
import { mapState } from "vuex";

export default {
  components: {
    Spinner,
    PasosTramite
  },
  computed: {
    ...mapState(["tramiteActual"])
  },
  data() {
    return {
      loading: false
    };
  },
  methods: {
    getPasosPorMetodo({ id }) {
      const pasosPorMetodo = this.tramiteActual.pasosPorMetodo[id];
      if (!pasosPorMetodo || !pasosPorMetodo.length) return [];
      return pasosPorMetodo;
    },
    async fetchData() {
      try {
        this.loading = true;
        await this.$store.dispatch("getTramite", this.$route.params.id);
      } catch (e) {
        /* handle error - display snackbar*/
      } finally {
        this.loading = false;
      }
    }
  },
  created() {
    this.fetchData();
  },
  watch: {
    $route(to, from) {
      this.fetchData();
    }
  }
};
</script>

<style scoped></style>
