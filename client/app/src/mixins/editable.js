export default {
  computed: {
    isInEditMode() {
      return this.$route.fullPath.endsWith("edit");
    }
  },
  async mounted() {
    await this.$store.dispatch("isEditable", true);
  },
  async activated() {
    await this.$store.dispatch("isEditable", true);
  },
  async deactivated() {
    await this.$store.dispatch("isEditable", false);
    await this.$store.dispatch("isInEditMode", false);
  },
  async beforeDestroy() {
    await this.$store.dispatch("isEditable", false);
    await this.$store.dispatch("isInEditMode", false);
  },
  async destroyed() {
    await this.$store.dispatch("isEditable", false);
    await this.$store.dispatch("isInEditMode", false);
  },
  watch: {
    async $route(to, from) {
      await this.$store.dispatch("isInEditMode", this.isInEditMode);
    }
  }
};
