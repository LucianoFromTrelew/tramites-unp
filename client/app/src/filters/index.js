export default {
  install(Vue, options) {
    Vue.filter("capitalize", value => {
      if (!value) return "";
      value = value.toString().toLowerCase();
      if (value === "id") return "ID";
      return value.charAt(0).toUpperCase() + value.slice(1);
    });
  }
};
