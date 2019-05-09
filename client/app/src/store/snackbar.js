export default {
  state: {
    showSnackbar: false,
    snackbarMessage: ""
  },
  getters: {},
  mutations: {
    SET_SNACKBAR_MESSAGE(state, msg) {
      state.snackbarMessage = msg;
    },
    SET_SNACKBAR_VISIBILITY(state, value) {
      state.showSnackbar = value;
    }
  },
  actions: {
    snackbar({ commit }, msg) {
      commit("SET_SNACKBAR_MESSAGE", msg);
      commit("SET_SNACKBAR_VISIBILITY", true);
    }
  }
};
