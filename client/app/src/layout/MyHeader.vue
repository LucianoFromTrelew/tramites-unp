<template>
  <header>
    <v-navigation-drawer v-model="drawer" fixed app>
      <v-list dense>
        <SidebarLink
          v-for="(link, i) in sidebarLinks"
          :link="link"
          :key="i"
          @sidebar-link-clicked="onSidebarLinkClick"
        />
      </v-list>
    </v-navigation-drawer>
    <v-toolbar color="indigo" dark fixed app>
      <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
      <v-toolbar-title
        ><router-link to="/" class="white--text text-decoration-none"
          >Trámites UNP</router-link
        ></v-toolbar-title
      >
      <v-spacer />
      <v-toolbar-title
        v-if="$store.getters.isLoggedIn && $store.getters.isEditable"
        ><router-link
          :to="getEditPath()"
          class="white--text text-decoration-none"
          >Editar</router-link
        ></v-toolbar-title
      >
    </v-toolbar>
  </header>
</template>

<script>
import SidebarLink from "@/layout/SidebarLink";
export default {
  components: {
    SidebarLink
  },
  data() {
    return {
      drawer: false,
      sidebarLinks: [
        {
          route: "/",
          icon: "home",
          label: "Inicio"
        },
        {
          route: "/categorias",
          icon: "category",
          label: "Categorias"
        },
        {
          route: "/etiquetas",
          icon: "filter_1",
          label: "Etiquetas"
        },
        {
          route: "/admin",
          icon: "person",
          label: "Administración"
        }
      ]
    };
  },
  methods: {
    onSidebarLinkClick(route) {
      this.$router.push(route);
    },
    getEditPath() {
      if (this.$store.getters.isEditable) {
        return this.$route.fullPath.concat("/edit");
      }
    }
  }
};
</script>

<style scoped>
.text-decoration-none {
  text-decoration: none;
}
</style>
