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
      let options = {};
      if (typeof payload === "object") {
        msg = payload.msg;
        delete payload.msg;
        options = payload;
      } else {
        msg = payload;
      }
      commit("SET_SNACKBAR_MESSAGE", msg);
      commit("SET_SNACKBAR_OPTIONS", options);
      commit("SET_SNACKBAR_VISIBILITY", true);
    }
  }
};
