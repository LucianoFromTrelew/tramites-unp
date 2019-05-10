export default {
  computed: {
    isInEditMode() {
      return this.$route.fullPath.endsWith("edit");
    }
  },
  async mounted() {
    await this.$store.dispatch("isEditable", true);
  },
  async deactivated() {
    await this.$store.dispatch("isEditable", false);
  },
  async beforeDestroy() {
    await this.$store.dispatch("isEditable", false);
  },
  async destroyed() {
    await this.$store.dispatch("isEditable", false);
  }
};
