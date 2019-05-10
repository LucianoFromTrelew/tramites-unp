<template>
  <v-card>
    <v-card-text>
      <li>
        <template v-for="(requerimiento, i) in requerimientos">
          <ul class="py-1">
            {{
              i + 1
            }}
            -
            {{
              requerimiento.descripcion
            }}
          </ul>
          <v-divider></v-divider>
        </template>
      </li>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  props: ["requerimientos"]
};
</script>

<style scoped></style>
