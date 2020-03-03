<template v-slot:top>
  <v-dialog v-model="dialog" max-width="600px" @keydown.enter="save()">
    <template v-slot:activator="{ on }">
      <v-icon large v-on="on">add_circle</v-icon>
    </template>
    <v-card>
      <v-card-title>
        <span class="headline">{{ formTitle }}</span>
      </v-card-title>
      <v-card-text>
        <v-container>
          <v-form ref="form" v-model="valid" lazy-validation @submit.prevent>
            <v-row>
              <v-col cols="6">
                <v-autocomplete
                  :items="subcategorias"
                  item-text="nombre"
                  item-value="id"
                  label="Subcategoría"
                  v-model="selectedItem.subcategoria_id"
                  :rules="[v => !!v || 'Requerido']"
                ></v-autocomplete>
              </v-col>
              <v-col cols="6">
                <v-text-field 
                  v-model="selectedItem.nombre" 
                  label="Nombre"
                  :rules="[v => !!v || 'Requerido']">
                </v-text-field>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="6">
                <v-textarea 
                  v-model="selectedItem.descripcion" 
                  label="Descripción"
                  :rules="[v => !!v || 'Requerido']">
                </v-textarea>
              </v-col>
              <v-col cols="6">
                <v-text-field 
                  v-model="selectedItem.cod_producto" 
                  label="Código de producto"
                  :rules="[v => !!v || 'Requerido']">
                </v-text-field>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="6">
                <v-text-field 
                  v-model="selectedItem.precio_promotora"
                  type="number"
                  label="Precio/promotora"
                  :rules="[v => !!v || 'Requerido']">
                </v-text-field>
              </v-col>
              <v-col cols="6">
                <v-text-field 
                  v-model="selectedItem.precio_cliente"
                  type="number"
                  label="Precio/cliente"
                  :rules="[v => !!v || 'Requerido']">
                </v-text-field>
              </v-col>
            </v-row>
            <v-row>
              <v-col>
                <template>
                  <vue-clip 
                      :options="options" 
                      :on-complete="complete">
                      <template slot="clip-uploader-action">                        
                      <div class="dz-message v-btn v-btn--small theme--light success">Clic aqui para subir archivos</div>                        
                      </template>
                      <template slot="clip-uploader-body" slot-scope="props">                            
                      <div v-for="(file, index) in props.files" :key="index">
                          <v-icon color="success" v-if="file.status=='success'">check_circle</v-icon>
                          <span class="green--text" v-if="file.status=='success'"> correcto.</span>                            
                          <v-icon color="error" v-if="file.status=='error'">error</v-icon> 
                          <span class="red--text" v-if="file.status=='error'"> {{ file.errorMessage }}</span>
                      </div>
                      </template>                  
                  </vue-clip>
                </template>
                <v-text-field
                  v-model="valArchivo"
                  readonly filled
                  label="Fotos/Imagenes"
                  :rules="[v => !!v || 'Requerido']" 
                  persistent-hint
                ></v-text-field>
              </v-col>
            </v-row>
          </v-form>
        </v-container>
      </v-card-text>

      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="blue darken-1" text @click="close">Cancelar</v-btn>
        <v-btn color="blue darken-1" :disabled="!valid" text @click="save()">Guardar</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'

export default {
  props: ["item", "bus"],  
  data() {
    return {      
      valid: true,
      dialog: false,
      selectedIndex: -1,     
      selectedItem: {},
      error: '',
      subcategorias: [],
      options: {
        url: 'api/upload/file',
        headers: axios.defaults.headers.common,
        paramName: 'file',
        uploadMultiple: false,
        acceptedFiles: {
          extensions:  ['image/*'],
          message: 'Formato no permitido.'
        },
        maxFilesize: {
          limit: 5,
          message: 'El archivo es muy grande'
        },
        maxFiles: 5,
      },
      fileAdjunto: [],
      valArchivo: null,
    };
  },
  created() {},  
  mounted() {
    this.bus.$on("openDialog", item => {
      this.selectedItem = item;
      this.dialog = true;
      this.selectedIndex = item;
    });
    this.getSubcategorias()
  },
  computed: {
    formTitle() {
      return this.selectedIndex === -1 ? 'Nuevo ' : 'Editar '
    }    
  },
  methods: {
    close() {
      this.dialog = false;
      this.$refs.form.reset()
      this.bus.$emit("closeDialog");
      this.selectedIndex = -1;
      this.selectedItem = {}
    },
    async save() {
      try {
        if (this.$refs.form.validate()) {
          if (this.selectedIndex != -1) {
            await axios.put("api/producto/"+this.selectedItem.id, this.selectedItem)
          } else {
            this.selectedItem.fotos = JSON.stringify(this.fileAdjunto)
            await axios.post("api/producto", this.selectedItem)
          }
          this.$toast.success('Correcto.')
          this.close();
        }
      } catch(e) {
        console.log(e)
      }
    },
    async getSubcategorias(){
      try{
        let res = await axios.get('api/subcategoria')
        this.subcategorias = res.data
      }
      catch(e){
        console.log(e)
      }
    },
    complete (file, status, xhr) {
      this.fileAdjunto.push({ruta: xhr.response})
      this.valArchivo = "Cargado correctamente."
    },
  },  
};
</script>