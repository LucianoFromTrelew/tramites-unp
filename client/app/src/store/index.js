import Vue from "vue";
import Vuex from "vuex";
import { http } from "@/utils/http";

Vue.use(Vuex);

const getIdAndDesc = ({ id, descripcion }) => ({ id, descripcion });
const getIdAndDescAndTitle = ({ id, titulo, descripcion }) => ({
  id,
  titulo,
  descripcion
});

export default new Vuex.Store({
  state: {
    categorias: [],
    etiquetas: [],
    tramites: [],
    tramiteActual: {}
  },
  getters: {
    categorias(state) {
      return state.categorias.map(getIdAndDesc);
    },
    etiquetas(state) {
      return state.etiquetas.map(getIdAndDesc);
    },
    tramites(state) {
      return state.tramites.map(getIdAndDescAndTitle);
    }
  },
  mutations: {
    ADD_CATEGORIAS(state, categorias) {
      state.categorias = categorias;
    },
    ADD_ETIQUETAS(state, etiquetas) {
      state.etiquetas = etiquetas;
    },
    ADD_TRAMITES(state, tramites) {
      state.tramites = tramites;
    },
    SET_TRAMITE_ACTUAL(state, tramite) {
      state.tramiteActual = tramite;
    }
  },
  actions: {
    async getCategorias({ commit }) {
      const response = await http.get("categorias");
      commit("ADD_CATEGORIAS", response.data);
    },
    async getEtiquetas({ commit }) {
      const response = await http.get("etiquetas");
      commit("ADD_ETIQUETAS", response.data);
    },
    async getTramites({ commit }) {
      const response = await http.get("tramites");
      commit("ADD_TRAMITES", response.data);
    },
    async getTramite({ state, commit }, tramiteId) {
      const tramite = state.tramites.find(
        tramite => tramite.id === parseInt(tramiteId)
      );

      const categoria = (await http.get(`tramites/${tramiteId}/categoria`))
        .data;

      const etiquetas = (await http.get(`tramites/${tramiteId}/etiquetas`))
        .data;

      const documentos = (await http.get(`tramites/${tramiteId}/documentos`))
        .data;

      const requerimientos = (await http.get(
        `tramites/${tramiteId}/requerimientos`
      )).data;

      const metodos = (await http.get(`tramites/${tramiteId}/metodos`)).data;

      let pasosPorMetodo = {};
      for (const { id } of metodos) {
        const res = await http.get(`tramites/${tramiteId}/pasos/${id}`);
        pasosPorMetodo[id] = res.data;
      }
      const tramiteActual = {
        tramite,
        categoria,
        etiquetas,
        documentos,
        requerimientos,
        metodos,
        pasosPorMetodo
      };
      commit("SET_TRAMITE_ACTUAL", tramiteActual);
    }
  }
});
