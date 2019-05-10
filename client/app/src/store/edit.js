export default {
  state: {
    isEditable: false
  },
  getters: {
    isEditable: state => state.isEditable
  },
  mutations: {
    SET_EDITABLE(state, value) {
      state.isEditable = value;
    }
  },
  actions: {
    isEditable({ commit }, value) {
      commit("SET_EDITABLE", value);
    }
  }
};
