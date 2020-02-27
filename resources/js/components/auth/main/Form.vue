<template v-slot:top>
  <v-dialog v-model="dialog" fullscreen @keydown.enter="save()">
    <template v-slot:activator="{ on }">
      <span class="font-weight-bold linked" v-on="on" large>QUIERO VENDER</span>
    </template>
    <v-card>
      <v-card-title>
        <v-col cols="12" align="center">
          <v-img 
            src="/img/seytu.png"
            contain
            max-height="70px"
            max-width="150px">
          </v-img>
        </v-col>
      </v-card-title>
      <v-card-text>
        <v-container>
          <v-form ref="form" v-model="valid" lazy-validation @submit.prevent>
            <v-row>
              <v-col cols="6" xs="12" md="6">
                <v-row>
                  <v-col cols="4">
                    <v-text-field 
                      v-model="selectedItem.nombre" 
                      label="Nombre"
                      :rules="[v => !!v || 'Requerido']">
                    </v-text-field>
                  </v-col>
                  <v-col cols="4">
                    <v-text-field 
                      v-model="selectedItem.apellido_paterno" 
                      label="Apellido Paterno"
                      :rules="[v => !!v || 'Requerido']">
                    </v-text-field>
                  </v-col>
                  <v-col cols="4">
                    <v-text-field 
                      v-model="selectedItem.apellido_materno" 
                      label="Apellido Materno"
                      :rules="[v => !!v || 'Requerido']">
                    </v-text-field>
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="6">
                    <v-text-field 
                      v-model="selectedItem.email" 
                      label="Corréo Electrónico"
                      :rules="[v => !!v || 'Requerido']">
                    </v-text-field>
                  </v-col>
                  <v-col cols="6">
                    <v-text-field 
                      v-model="selectedItem.celular" 
                      label="Celular/Teléfono"
                      :rules="[v => !!v || 'Requerido']">
                    </v-text-field>
                  </v-col>
                </v-row>
                <v-row>
                  <v-col>
                    <v-text-field 
                      v-model="selectedItem.direccion" 
                      label="Dirección"
                      :rules="[v => !!v || 'Requerido']">
                    </v-text-field>
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="6">
                    <v-text-field 
                      v-model="selectedItem.ci" 
                      label="Carnet de identidad"
                      :rules="[v => !!v || 'Requerido']">
                    </v-text-field>
                  </v-col>
                  <v-col cols="6">
                    <v-select
                      v-model="selectedItem.departamento_id" 
                      :items="departamentos"
                      item-value="id"
                      item-text="nombre"
                      label="Ciudad de expedición"
                      :rules="[v => !!v || 'Requerido']">
                    </v-select>
                  </v-col>
                </v-row>
                <v-row>
                <v-col>
                  <template>
                    <vue-clip 
                        :options="options" 
                        :on-complete="complete"
                        :on-init="init">
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
              </v-col>
              <v-col cols="6" xs="12" md="6">
                <video width="100%" autoplay muted loop>
                  <source src="/img/video-form.mp4" type="video/mp4">
                  Su navegador no soporta el material multimedia
                </video>
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
      departamentos: [
        {
          id: 1,
          nombre: 'La Paz'
        },
        {
          id: 2,
          nombre: 'Cochabamba'
        },
        {
          id: 3,
          nombre: 'Santa Cruz'
        },
        {
          id: 4,
          nombre: 'Oruro'
        },
        {
          id: 5,
          nombre: 'Beni'
        },
        {
          id: 6,
          nombre: 'Pando'
        },
        {
          id: 7,
          nombre: 'Chuquisaca'
        },
        {
          id: 8,
          nombre: 'Tarija'
        },
        {
          id: 9,
          nombre: 'Potosí'
        },
      ],
      options: {
        url: 'api/upload/file',
        headers: axios.defaults.headers.common,
        paramName: 'file',
        uploadMultiple: false,
        acceptedFiles: {
          extensions:  ['application/pdf', 'image/*'],
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
      uploader: null
    };
  },
  created() {},  
  mounted() {
    this.bus.$on("openDialog", item => {
      this.selectedItem = item;
      this.dialog = true;
      this.selectedIndex = item;
    });
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
      this.bus.$emit("closeDialog")
      this.selectedIndex = -1
      this.selectedItem = {}
      this.uploader = null
    },
    async save() {
      try {
        if (this.$refs.form.validate()) {
          if (this.selectedIndex != -1) {
            await axios.put("api/promotora/"+this.selectedItem.id, this.selectedItem)
          } else {
            this.selectedItem.documentos_escaneados = JSON.stringify(this.fileAdjunto)
            await axios.post("api/promotora", this.selectedItem)
          }
          this.$toast.success('Correcto.')
          this.close();
        }
      } catch(e) {
        console.log(e)
      }
    },
    complete (file, status, xhr) {
      this.fileAdjunto.push({ruta: xhr.response})
      this.valArchivo = "Cargado correctamente."
    },
    init (uploader) {
      this.uploader = uploader
    },
  },  
};
</script>

<style>
    .linked{
        cursor: pointer
    }
</style>