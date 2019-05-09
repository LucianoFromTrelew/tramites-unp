import { http } from "@/utils/http";

export default {
  state: {
    apiToken: localStorage.getItem("apiToken") || "",
    loggedIn: false
  },
  getters: {
    isLoggedIn: state => state.loggedIn
  },
  mutations: {
    SET_API_TOKEN(state, apiToken) {
      state.apiToken = apiToken;
      localStorage.setItem("apiToken", apiToken);
    },
    SET_LOGGED_IN(state, value) {
      state.loggedIn = value;
    }
  },
  actions: {
    async login({ commit }, { email, password }) {
      const { api_token } = (await http.post("login", {
        email,
        password
      })).data;
      commit("SET_API_TOKEN", api_token);
      commit("SET_LOGGED_IN", true);
    },
    async logout({ state, commit }) {
      try {
        await http.post("logout", null, {
          headers: { Authorization: `Bearer ${state.apiToken}` }
        });
        commit("SET_API_TOKEN", "");
        commit("SET_LOGGED_IN", false);
      } catch (e) {
        console.log("pinchose logout");
        /* handle error */
      }
    },
    async isLoggedIn({ state, commit }) {
      try {
        const res = (await http.get("user", {
          headers: {
            Authorization: `Bearer ${state.apiToken}`
          }
        })).data;
        commit("SET_LOGGED_IN", true);
      } catch (e) {
        /* handle error */
        commit("SET_LOGGED_IN", false);
      }
    }
  }
};
