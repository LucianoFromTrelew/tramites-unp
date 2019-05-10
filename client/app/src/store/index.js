import Vue from "vue";
import Vuex from "vuex";
import login from "@/store/auth";
import snackbar from "@/store/snackbar";
import { http } from "@/utils/http";

Vue.use(Vuex);

const getIdAndDesc = ({ id, descripcion }) => ({ id, descripcion });
const getIdAndDescAndTitle = ({ id, titulo, descripcion }) => ({
  id,
  titulo,
  descripcion
});

export default new Vuex.Store({
  modules: {
    login,
    snackbar
  },
  state: {
    categorias: [],
    etiquetas: [],
    documentos: [],
    tramites: [],
    tramiteActual: {},
    tramitesDeCategoria: [],
    tramitesDeEtiqueta: []
  },
  getters: {
    autocompleteItems(state, getters) {
      let items = [];
      getters.categorias.forEach(categoria => {
        items.push({
          tipo: "categorias",
          id: categoria.id,
          descripcion: `Categoria: ${categoria.descripcion}`
        });
      });
      getters.etiquetas.forEach(etiqueta => {
        items.push({
          tipo: "etiquetas",
          id: etiqueta.id,
          descripcion: `Etiqueta: ${etiqueta.descripcion}`
        });
      });
      getters.documentos.forEach(documento => {
        items.push({
          tipo: "documentos",
          id: documento.id,
          descripcion: `Documento: ${documento.descripcion}`
        });
      });
      getters.tramites.forEach(tramite => {
        items.push({
          tipo: "tramites",
          id: tramite.id,
          descripcion: `Tramite: ${tramite.titulo}`
        });
      });
      return items;
    },
    categorias(state) {
      return state.categorias.map(getIdAndDesc);
    },
    etiquetas(state) {
      return state.etiquetas.map(getIdAndDesc);
    },
    documentos(state) {
      return state.documentos.map(getIdAndDesc);
    },
    tramites(state) {
      return state.tramites.map(getIdAndDescAndTitle);
    },
    categoriaActual(state) {
      return categoriaId =>
        state.categorias.find(
          categoria => categoria.id === parseInt(categoriaId)
        );
    },
    etiquetaActual(state) {
      return etiquetaId =>
        state.etiquetas.find(etiqueta => etiqueta.id === parseInt(etiquetaId));
    }
  },
  mutations: {
    ADD_CATEGORIAS(state, categorias) {
      state.categorias = categorias;
    },
    ADD_ETIQUETAS(state, etiquetas) {
      state.etiquetas = etiquetas;
    },
    ADD_DOCUMENTOS(state, documentos) {
      state.documentos = documentos;
    },
    ADD_TRAMITES(state, tramites) {
      state.tramites = tramites;
    },
    ADD_NEW_TRAMITE(state, newTramite) {
      state.tramites.push(newTramite);
    },
    ADD_NEW_CATEGORIA(state, newCategoria) {
      state.categorias.push(newCategoria);
    },
    ADD_NEW_ETIQUETA(state, newEtiqueta) {
      state.etiquetas.push(newEtiqueta);
    },
    ADD_NEW_DOCUMENTO(state, newDocumento) {
      state.documentos.push(newDocumento);
    },
    SET_TRAMITE_ACTUAL(state, tramite) {
      state.tramiteActual = tramite;
    },
    SET_TRAMITES_DE_CATEGORIA(state, tramites) {
      state.tramitesDeCategoria = tramites;
    },
    SET_TRAMITES_DE_ETIQUETA(state, tramites) {
      state.tramitesDeEtiqueta = tramites;
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
    async getDocumentos({ commit }) {
      const response = await http.get("documentos");
      commit("ADD_DOCUMENTOS", response.data);
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
    },
    async getTramitesPerCategoria({ commit }, categoriaId) {
      const tramites = (await http.get(`categorias/${categoriaId}/tramites`))
        .data;
      commit("SET_TRAMITES_DE_CATEGORIA", tramites);
    },
    async getTramitesPerEtiqueta({ commit }, etiquetaId) {
      const tramites = (await http.get(`categorias/${etiquetaId}/tramites`))
        .data;
      commit("SET_TRAMITES_DE_ETIQUETA", tramites);
    },
    async newTramite({ commit, getters }, data) {
      const headers = {
        Authorization: `Bearer ${getters.apiToken}`
      };

      const newTramite = (await http.post("tramites", data, { headers })).data;
      commit("ADD_NEW_TRAMITE", newTramite);
    },
    async newCategoria({ commit, getters }, data) {
      const headers = {
        Authorization: `Bearer ${getters.apiToken}`
      };

      const newCategoria = (await http.post("categorias", data, { headers }))
        .data;
      commit("ADD_NEW_CATEGORIA", newCategoria);
    },
    async newEtiqueta({ commit, getters }, data) {
      const headers = {
        Authorization: `Bearer ${getters.apiToken}`
      };

      const newEtiqueta = (await http.post("etiquetas", data, { headers }))
        .data;
      commit("ADD_NEW_ETIQUETA", newEtiqueta);
    },
    async newDocumento({ commit, getters }, data) {
      const headers = {
        Authorization: `Bearer ${getters.apiToken}`
      };

      const newDocumento = (await http.post("documentos", data, { headers }))
        .data;
      commit("ADD_NEW_DOCUMENTO", newDocumento);
    }
  }
});
