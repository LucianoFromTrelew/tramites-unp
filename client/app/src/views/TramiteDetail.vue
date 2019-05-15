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
        <!--Etiquetas-->
        <EtiquetaEnTramiteList
          :items="$store.getters.etiquetas"
          :etiquetas="tramiteActual.etiquetas"
          @delete="onDeleteEtiqueta"
          @new="onNewEtiqueta"
        />
      </v-layout>

      <v-expansion-panel focusable>
        <!--Requerimientos-->
        <v-expansion-panel-content>
          <template v-slot:header>
            <div>Requerimientos</div>
          </template>
          <RequerimientoList
            :requerimientos="tramiteActual.requerimientos"
            @delete="onDeleteRequerimiento"
            @new="onNewRequerimiento"
          />
        </v-expansion-panel-content>
        <!--Documentos-->
        <v-expansion-panel-content>
          <template v-slot:header>
            <div>Documentos</div>
          </template>
          <DocumentoList
            :items="$store.getters.documentos"
            :documentos="tramiteActual.documentos"
            @delete="onDeleteDocumento"
            @new="onNewDocumento"
          />
        </v-expansion-panel-content>
        <!--Metodos-->
        <v-expansion-panel-content>
          <template v-slot:header>
            <div>Metodos</div>
          </template>
          <v-expansion-panel>
            <v-expansion-panel-content
              v-for="(metodo, i) in $store.getters.metodos"
              :key="i"
            >
              <template v-slot:header>
                <div class="pl-5">{{ metodo.descripcion }}</div>
              </template>
              <PasosTramite
                :pasos="getPasosPorMetodo(metodo)"
                :metodo="metodo"
                @delete="onDeletePaso"
                @new="onNewPaso"
              />
            </v-expansion-panel-content>
          </v-expansion-panel>
        </v-expansion-panel-content>
      </v-expansion-panel>
    </v-flex>
    <ConfirmDialog no-btn @confirm="onConfirm" ref="dialog">{{
      this.confirmMsg
    }}</ConfirmDialog>
  </v-layout>
</template>

<script>
import Spinner from "@/components/Spinner";
import EtiquetaEnTramiteList from "@/components/EtiquetaEnTramiteList";
import RequerimientoList from "@/components/RequerimientoList";
import DocumentoList from "@/components/DocumentoList";
import PasosTramite from "@/components/PasosTramite";
import ConfirmDialog from "@/components/ConfirmDialog";
import { mapState } from "vuex";
import Editable from "@/mixins/editable";

export default {
  mixins: [Editable],
  components: {
    Spinner,
    EtiquetaEnTramiteList,
    RequerimientoList,
    DocumentoList,
    PasosTramite,
    ConfirmDialog
  },
  computed: {
    ...mapState(["tramiteActual"])
  },
  data() {
    return {
      loading: false,
      confirmMsg: "",
      afterConfirmPayload: {},
      afterConfirmAction: ""
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
    },
    onDeleteEtiqueta(etiqueta) {
      this.confirmMsg = `¿Desea eliminar la etiqueta [${
        etiqueta.descripcion
      }]?`;
      this.afterConfirmPayload = {
        tramite_id: this.tramiteActual.tramite.id,
        etiqueta_id: etiqueta.id
      };
      this.afterConfirmAction = "deleteEtiquetaTramite";
      this.afterConfirmSuccessMsg = "Etiqueta removida con éxito";
      this.afterConfirmErrorMsg = "No se pudo remover la etiqueta";
      this.$refs.dialog.show();
    },
    async onNewEtiqueta(etiqueta) {
      try {
        const payload = {
          tramite_id: this.tramiteActual.tramite.id,
          etiqueta
        };
        await this.$store.dispatch("newEtiquetaTramite", payload);
        this.$store.dispatch("snackbar", {
          msg: "Etiqueta agregada con éxito",
          color: "green"
        });
      } catch (e) {
        console.log({ e });
        this.$store.dispatch("snackbar", "No se pudo agregar la etiqueta");
      }
    },
    onDeleteRequerimiento(requerimiento) {
      this.confirmMsg = `¿Desea eliminar el requerimiento [${
        requerimiento.descripcion
      }]?`;
      this.afterConfirmPayload = {
        tramite_id: this.tramiteActual.tramite.id,
        requerimiento_id: requerimiento.id
      };
      this.afterConfirmAction = "deleteRequerimiento";
      this.afterConfirmSuccessMsg = "Requerimiento eliminado con éxito";
      this.afterConfirmErrorMsg = "No se pudo eliminar el requerimiento";
      this.$refs.dialog.show();
    },
    async onNewRequerimiento(requerimiento) {
      try {
        const payload = {
          tramite_id: this.tramiteActual.tramite.id,
          requerimiento
        };
        await this.$store.dispatch("newRequerimiento", payload);
        this.$store.dispatch("snackbar", {
          msg: "Requerimiento agregado con éxito",
          color: "green"
        });
      } catch (e) {
        console.log({ e });
        this.$store.dispatch("snackbar", "No se pudo agregar el requerimiento");
      }
    },
    onDeleteDocumento(documento) {
      this.confirmMsg = `¿Desea eliminar el documento [${
        documento.descripcion
      }]?`;
      this.afterConfirmPayload = {
        tramite_id: this.tramiteActual.tramite.id,
        documento_id: documento.id
      };
      this.afterConfirmAction = "deleteDocumento";
      this.afterConfirmSuccessMsg = "Documento eliminado con éxito";
      this.afterConfirmErrorMsg = "No se pudo eliminar el documento";
      this.$refs.dialog.show();
    },
    async onNewDocumento(documento) {
      try {
        const payload = {
          tramite_id: this.tramiteActual.tramite.id,
          documento
        };
        await this.$store.dispatch("newDocumentoTramite", payload);
        this.$store.dispatch("snackbar", {
          msg: "Documento agregado con éxito",
          color: "green"
        });
      } catch (e) {
        console.log({ e });
        this.$store.dispatch("snackbar", "No se pudo agregar el documento");
      }
    },
    onDeletePaso(payload) {
      const { paso, metodo } = payload;
      this.confirmMsg = `¿Desea eliminar el paso [${
        paso.descripcion
      }] del método [${metodo.descripcion}]?`;
      this.afterConfirmPayload = {
        tramite_id: this.tramiteActual.tramite.id,
        metodo_id: metodo.id,
        paso_id: paso.id
      };
      this.afterConfirmAction = "deletePaso";
      this.afterConfirmSuccessMsg = "Paso eliminado con éxito";
      this.afterConfirmErrorMsg = "No se pudo eliminar el paso";
      this.$refs.dialog.show();
    },
    async onNewPaso(payload) {
      const { paso, metodo } = payload;
      try {
        const data = {
          tramite_id: this.tramiteActual.tramite.id,
          metodo,
          paso
        };
        await this.$store.dispatch("newPaso", data);
        this.$store.dispatch("snackbar", {
          msg: "Paso agregado con éxito",
          color: "green"
        });
      } catch (e) {
        console.log({ e });
        this.$store.dispatch("snackbar", "No se pudo agregar el paso");
      }
    },
    async onConfirm() {
      try {
        const {
          afterConfirmAction,
          afterConfirmPayload,
          afterConfirmSuccessMsg
        } = this;
        await this.$store.dispatch(afterConfirmAction, afterConfirmPayload);
        this.$store.dispatch("snackbar", {
          msg: afterConfirmSuccessMsg,
          color: "green"
        });
      } catch (e) {
        console.log({ e });
        const { afterConfirmErrorMsg } = this;
        this.$store.dispatch("snackbar", afterConfirmErrorMsg);
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
