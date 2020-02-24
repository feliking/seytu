<template>
  <v-dialog persistent v-model="dialog" max-width="600px" @keydown.esc="close">
    <v-card>
      <v-card-text>
        <p class="pt-5 font-weight-bold">
            Al activar a la promotora podrá ingresar al sistema para hacer sus pedidos con: <br> 
            - Usuario: Corréo electrónico de la promotora <br>
            - Contraseña: El carnet de la promotora <br>
            <span class="error--text">Sí desea eliminar accesos de las promotoras puede ir al módulo de "Usuarios"</span>
        </p>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="error" small @click="close"><v-icon small>check</v-icon> Cancelar</v-btn>
        <v-btn color="success" small @click="activar"><v-icon small>close</v-icon> Activar promotora</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
import axios from 'axios'

export default {
  name: "RemoveItem",
  props: ["url", "bus"],
  data() {
    return {
      dialog: false,
      selectedItem: {}
    };
  },
  methods: {
    resetVariables() {
      this.path = '';
    },
    close() {
      this.selectedItem = {}
      this.dialog = false;
      this.bus.$emit("closeDialog");
    },
    async activar(){
        try{
            this.selectedItem.name = this.selectedItem.nombre
            this.selectedItem.password = this.selectedItem.ci
            await axios.post('api/user', this.selectedItem)
            await axios.put('api/promotora/'+this.selectedItem.id, {activo: true})
            this.close()
            this.$toast.success('Activado correctamente')
        }
        catch(e){
            console.log(e)
        }
    }
  },
  mounted() {
    this.bus.$on("openDialogQuestion", item => {
        this.dialog = true
        this.selectedItem = item
    });
  }
};
</script>