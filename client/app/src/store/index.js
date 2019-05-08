import Vue from "vue";
import Vuex from "vuex";
import { http } from "@/utils/http";

Vue.use(Vuex);

const getIdAndDesc = ({ id, descripcion }) => ({ id, descripcion });
const getIdAndTitle = ({ id, titulo }) => ({ id, titulo });

export default new Vuex.Store({
  state: {
    categorias: [],
    etiquetas: [],
    tramites: []
  },
  getters: {
    categorias(state) {
      return state.categorias.map(getIdAndDesc);
    },
    etiquetas(state) {
      return state.etiquetas.map(getIdAndDesc);
    },
    tramites(state) {
      return state.tramites.map(getIdAndTitle);
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
    }
  }
});
