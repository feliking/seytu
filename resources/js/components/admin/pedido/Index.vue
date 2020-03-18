<template>
  <v-container fluid :loading="loading">
    <v-row>
        <v-col cols="4">
            <v-text-field
                label="Buscar un producto"
            >
            </v-text-field>
        </v-col>
        <v-col cols="4">
            <v-autocomplete
                :items="categorias"
                item-text="nombre"
                item-value="id"
                label="Seleccione una categoría"
                v-model="id_categoria"
                @change="getCategoria()"
            >
            </v-autocomplete>
        </v-col>
        <v-col cols="4">
            <v-select
                v-if="categoria != null"
                :items="categoria.subcategorias"
                item-text="nombre"
                item-value="id"
                label="Seleccione una subcategoría"
            >
            </v-select>
        </v-col>
    </v-row>
  </v-container>
</template>
<script type="text/javascript">
import Vue from "vue";
import axios from 'axios'
import Form from "./Form";

export default {
  components: {
    Form
  },
  data: () => ({
    bus: new Vue(),
    loading: true,
    categorias: [],
    categoria: null,
    id_categoria: null
  }),
  computed: {},
  mounted() {
    this.getCategorias()
  },
  methods: {
    async getCategorias() {
      try {
        let res = await axios.get("api/categoria")
        this.categorias = res.data;
        this.loading = false
      } catch (e) {
        console.log(e);
      }
    },
    async getCategoria(){
        try{
            let res = await axios.get("api/categoria/"+this.id_categoria)
            this.categoria = res.data
            console.log(this.categoria)
        }catch(e){
            console.log(e)
        }
    },
    editItem(item) {
      this.bus.$emit("openDialog", item);
    },
    async removeItem(item) {
      this.bus.$emit("openDialogRemove", `api/lugar/${item.id}`);      
    },
  }
};
</script>
