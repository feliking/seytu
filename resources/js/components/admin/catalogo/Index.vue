<template>
  <v-container fluid>
    <v-toolbar>
        <v-toolbar-title>Catálogos</v-toolbar-title>
        <v-spacer></v-spacer>        
        <v-divider
          class="mx-2"
          inset
          vertical
        ></v-divider>
        <v-toolbar-title>
          <v-text-field
              v-model="search"
              append-icon="search"
              label="Buscar"
              single-line
              hide-details
              width="20px"
            ></v-text-field>
        </v-toolbar-title>
        <v-divider
          class="mx-2"
          inset
          vertical
        ></v-divider>
        <Form :bus="bus"/>
        <RemoveItem :bus="bus"/>
    </v-toolbar>
    <v-data-table
      :headers="headers"
      :items="table"
      :search="search"
      class="elevation-1"
      :loading="loading" 
      loading-text="Cargando... Espere por favor"
    >
      <template v-slot:item.archivo="{ item }">
        <a :href="item.archivo" target="_blank">
          <v-icon
            color="error"
            title="Abrir archivo pdf">
            picture_as_pdf
          </v-icon>
        </a>
      </template>
      <template v-slot:item.estado="{ item }">
        <v-icon
          v-if="item.estado == true"
          color="success"
          @click="inactivar(item)">
          check
        </v-icon>
        <v-icon
          v-if="item.estado == false"
          color="error"
          @click="activar(item)">
          close
        </v-icon>
      </template>
      <template v-slot:item.action="{ item }">
        <v-icon
          color="warning"
          class="mr-2"
          title="editar"
          @click="editItem(item)"
        >
          edit
        </v-icon>
        <v-icon
        color="error"
          title="eliminar"
          @click="removeItem(item)"
        >
          delete
        </v-icon>
      </template>
      <v-alert slot="no-results" :value="true" color="error" icon="fa fa-times">
        Tu Busqueda de "{{ search }}" no encontró resultados.
      </v-alert>
      <template slot="no-data">
        <v-alert slot="no-results" :value="true" color="primary" icon="fa fa-times" class="white--text">
          Sin resultados.
        </v-alert>
      </template>
    </v-data-table>
  </v-container>
</template>
<script type="text/javascript">
import Vue from "vue";
import axios from 'axios'
import RemoveItem from "../RemoveItem";
import Form from "./Form";

export default {
  components: {
    RemoveItem,
    Form,
  },
  data: () => ({
    bus: new Vue(),
    headers: [
      {
        text: "Nombre",
        value: "nombre",
        align: "center"
      },
      {
        text: "Gestión",
        value: "gestion",
        align: "center"
      },
      {
        text: "Archivo",
        value: "archivo",
        align: "center"
      },
      {
        text: "Estado",
        value: "estado",
        align: "center"
      },
      {
        text: "Opciones",
        align: "center",
        sortable: false,
        value: "action"
      }
    ],
    table: [],
    search: "",
    loading: true
  }),
  computed: {},
  mounted() {
    this.getTable();
    this.bus.$on("closeDialog", () => {
      this.getTable();
    });
  },
  methods: {
    async getTable() {
      try {
        let res = await axios.get("api/catalogo")
        this.table = res.data;
        this.loading = false
      } catch (e) {
        console.log(e);
      }
    },
    editItem(item) {
      this.bus.$emit("openDialog", item);
    },
    async removeItem(item) {
      this.bus.$emit("openDialogRemove", `api/catalogo/${item.id}`);      
    },
    async activar(item){
      try{
        let res = await axios.put('api/catalogo/'+item.id, { estado: true })
        this.getTable()
        this.$toast.success('Activado correctamente')
      }
      catch(e){
        console.log(e)
      }
    },
    async inactivar(item){
      try{
        let res = await axios.put('api/catalogo/'+item.id, { estado: false })
        this.getTable()
        this.$toast.warning('Desactivado correctamente')
      }
      catch(e){
        console.log(e)
      }
    }
  }
};
</script>
