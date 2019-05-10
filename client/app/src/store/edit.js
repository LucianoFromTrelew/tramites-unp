export default {
  state: {
    isEditable: false,
    isInEditMode: false
  },
  getters: {
    isEditable: state => state.isEditable,
    isInEditMode: state => state.isInEditMode
  },
  mutations: {
    SET_EDITABLE(state, value) {
      state.isEditable = value;
    },
    SET_EDIT_MODE(state, value) {
      state.isInEditMode = value;
    }
  },
  actions: {
    isEditable({ commit }, value) {
      commit("SET_EDITABLE", value);
    },
    isInEditMode({ commit }, value) {
      commit("SET_EDIT_MODE", value);
    }
  }
};
