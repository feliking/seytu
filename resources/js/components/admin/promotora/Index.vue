<template>
  <v-container fluid>
    <Question :bus="bus" />
    <v-toolbar>
        <v-toolbar-title>Promotoras</v-toolbar-title>
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
              label="Carnet de identidad"
              single-line
              hide-details
              width="20px"
            ></v-text-field>
        </v-toolbar-title>
    </v-toolbar>
    <v-data-table
      :headers="headers"
      :items="table"
      :search="search"
      class="elevation-1"
      :loading="loading" 
      loading-text="Cargando... Espere por favor"
      :single-expand="singleExpand"
      :expanded.sync="expanded"
      item-key="id"
      show-expand
    >
    <template v-slot:item.activate="{ item }">
      <v-btn 
        v-if="!item.activo" 
        class="ma-2" 
        tile 
        color="error"
        @click.prevent="activar(item)">
        <v-icon left>clear</v-icon> Activar
      </v-btn>
      <v-btn v-else class="ma-2" tile color="success">
        <v-icon left>done</v-icon> Activado
      </v-btn>
    </template>
    <template v-slot:expanded-item="{ headers, item }">
        <td :colspan="headers.length">
          <v-card>
            <v-simple-table>
              <template v-slot:default>
                <tbody>
                  <tr>
                    <td><strong>Corréo Electrónico: </strong></td>
                    <td>{{ item.email }}</td>
                  </tr>
                  <tr>
                    <td><strong>Telefono/Celular: </strong></td>
                    <td>{{ item.celular }}</td>
                  </tr>
                  <tr>
                    <td><strong>Dirección: </strong></td>
                    <td>{{ item.direccion }}</td>
                  </tr>
                  <tr>
                    <td><strong>Imagenes subidas: </strong></td>
                    <td>
                      <a 
                        v-for="image of item.documentos_escaneados"
                        :href="image.ruta"
                        :key="image.ruta"
                        target="_blank">
                        <v-img
                          :src="image.ruta"
                          max-width="400px">
                        </v-img>
                      </a>
                    </td>
                  </tr>
                </tbody>
              </template>
            </v-simple-table>
          </v-card>
        </td>
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
import Question from "./Question";

export default {
  components: {
    RemoveItem,
    Question,
  },
  data: () => ({
    bus: new Vue(),
    headers: [
      { 
        text: '', 
        value: 'data-table-expand' 
      },
      {
        text: "Nombre",
        value: "nombre",
        align: "center"
      },
      {
        text: "Apellido paterno",
        value: "apellido_paterno",
        align: "center"
      },
      {
        text: "Apellido materno",
        value: "apellido_materno",
        align: "center"
      },
      {
        text: "Carnet de identidad",
        value: "ci",
        align: "center"
      },
      {
        text: "Activar",
        value: "activate",
        align: "center"
      }
    ],
    table: [],
    search: "",
    loading: true,
    expanded: [],
    singleExpand: false,
    archivos: []
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
        let res = await axios.get("api/promotora")
        this.table = res.data;
        this.table.forEach(ele => ele.documentos_escaneados = JSON.parse(ele.documentos_escaneados))
        this.loading = false
      } catch (e) {
        console.log(e);
      }
    },
    editItem(item) {
      this.bus.$emit("openDialog", item);
    },
    async removeItem(item) {
      this.bus.$emit("openDialogRemove", `api/promotora/${item.id}`);      
    },
    async activar(item){
      this.bus.$emit('openDialogQuestion', item)
    }
  }
};
</script>
