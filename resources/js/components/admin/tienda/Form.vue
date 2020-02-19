<template v-slot:top>
  <v-dialog v-model="dialog" max-width="900px" @keydown.enter="save()">
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
              <v-col class="d-flex" cols="12" sm="6">
                <v-select
                  :items="departamentos"
                  item-text="nombre"
                  item-value="id"
                  label="Departamento"
                  v-model="selectedItem.departamento_id"
                  :rules="[v => !!v || 'Requerido']"
                ></v-select>
              </v-col>
              <v-col class="d-flex" cols="12" sm="6">
                <v-text-field 
                  v-model="selectedItem.nombre" 
                  label="Nombre"
                  :rules="[v => !!v || 'Requerido', v => (v && v.length <= 50) || 'No mayor a 50 caracteres']">
                </v-text-field>
              </v-col>
              <v-col class="d-flex" cols="12" sm="6">
                <v-text-field 
                  v-model="selectedItem.direccion" 
                  label="Dirección"
                  :rules="[v => !!v || 'Requerido']">
                </v-text-field>
              </v-col>
              <v-col class="d-flex" cols="12" sm="6">
                <v-text-field 
                  v-model="selectedItem.telefono" 
                  label="Teléfono"
                  :rules="[v => !!v || 'Requerido',]">
                </v-text-field>
              </v-col>
              <v-col class="d-flex" cols="12" sm="6">
                <v-text-field 
                  v-model="selectedItem.fax" 
                  label="Fax"
                  :rules="[v => !!v || 'Requerido',]">
                </v-text-field>
              </v-col>
              <v-col class="d-flex" cols="12" sm="6">
                <v-text-field 
                  v-model="selectedItem.email" 
                  label="Corréo Electrónico"
                  :rules="[v => !!v || 'Requerido',]">
                </v-text-field>
              </v-col>
            </v-row>
          </v-form>
        </v-container>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
        <v-btn color="blue darken-1" :disabled="!valid" text @click="save()">Save</v-btn>
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
      departamentos: []
    };
  },
  created() {},  
  mounted() {
    this.bus.$on("openDialog", item => {
      this.selectedItem = item;
      this.dialog = true;
      this.selectedIndex = item;
    });
    this.getDepartamentos()
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
            console.log(this.selectedItem)
            await axios.put("api/tienda/"+this.selectedItem.id, this.selectedItem)
            
          } else {
            await axios.post("api/tienda", this.selectedItem)
          }
          this.$toast.success('Correcto.')
          this.close();
        }
      } catch(e) {
        console.log(e)
      }
    },
    async getDepartamentos(){
      try{
        let res = await axios.get('api/departamento')
        this.departamentos = res.data
      }
      catch(e){
        console.log(e)
      }
    }
  },  
};
</script>