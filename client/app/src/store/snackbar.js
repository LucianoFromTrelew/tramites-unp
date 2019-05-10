export default {
  state: {
    showSnackbar: false,
    snackbarMessage: "",
    snackbarOptions: {}
  },
  getters: {},
  mutations: {
    SET_SNACKBAR_MESSAGE(state, msg) {
      state.snackbarMessage = msg;
    },
    SET_SNACKBAR_VISIBILITY(state, value) {
      state.showSnackbar = value;
    },
    SET_SNACKBAR_OPTIONS(state, options) {
      state.snackbarOptions = options;
    }
  },
  actions: {
    snackbar({ commit }, payload) {
      let msg;
      if (typeof payload === "object") {
        msg = payload.msg;
        delete payload.msg;
        commit("SET_SNACKBAR_OPTIONS", payload);
      }
      commit("SET_SNACKBAR_MESSAGE", msg);
      commit("SET_SNACKBAR_VISIBILITY", true);
    }
  }
};
