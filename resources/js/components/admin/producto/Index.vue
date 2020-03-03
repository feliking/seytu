<template>
  <v-container fluid>
    <v-toolbar>
        <v-toolbar-title>Productos</v-toolbar-title>
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
      :single-expand="singleExpand"
      :expanded.sync="expanded"
      item-key="id"
      show-expand
    >
      <template v-slot:expanded-item="{ headers, item }">
        <td :colspan="headers.length">
          <v-card>
            <v-simple-table>
              <template v-slot:default>
                <tbody>
                  <tr>
                    <td><strong>Descripción: </strong></td>
                    <td>{{ item.descripcion }}</td>
                  </tr>
                  <tr>
                    <td><strong>Imagenes: </strong></td>
                    <td>
                      <a 
                        v-for="image of item.fotos"
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
        text: '', 
        value: 'data-table-expand' 
      },
      {
        text: "subcategoria",
        value: "subcategoria.nombre",
        align: "center"
      },
      {
        text: "Nombre",
        value: "nombre",
        align: "center"
      },
      {
        text: "Código",
        value: "cod_producto",
        align: "center"
      },
      {
        text: "Precio/promotora",
        value: "precio_promotora",
        align: "center"
      },
      {
        text: "Precio/cliente",
        value: "precio_cliente",
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
    loading: true,
    expanded: [],
    singleExpand: false,
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
        let res = await axios.get("api/producto")
        this.table = res.data;
        this.table.forEach(ele => ele.fotos = JSON.parse(ele.fotos))
        this.loading = false
      } catch (e) {
        console.log(e);
      }
    },
    editItem(item) {
      this.bus.$emit("openDialog", item);
    },
    async removeItem(item) {
      this.bus.$emit("openDialogRemove", `api/producto/${item.id}`);      
    },
  }
};
</script>
