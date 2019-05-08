<template>
  <v-layout justify-center align-center row wrap class="home">
    <!--<AutocompleteInput />-->
    <!--acá va la lista de trámites, categorías, etiquetas-->
    <router-view />
  </v-layout>
</template>

<script>
// @ is an alias to /src
import HelloWorld from "@/components/HelloWorld.vue";

export default {
  name: "home",
  components: {
    HelloWorld
  }
};
</script>
