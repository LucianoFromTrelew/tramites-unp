<template>
  <v-card>
    <v-card-text>
      <li>
        <template v-for="(documento, i) in documentos">
          <ul class="py-1">
            {{
              i + 1
            }}
            -
            {{
              documento.descripcion
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
  props: ["documentos", "items"]
};
</script>

<style scoped></style>
