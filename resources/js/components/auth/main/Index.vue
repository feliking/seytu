<template>
  <v-row class="pa-0">
    <v-col cols="12" align="center">
      <v-img 
        src="/img/seytu.png"
        contain
        max-height="70px"
        max-width="150px">
      </v-img>
    </v-col>
    <v-col cols="12" align-center>
      <p class="text-center">Maquillaje       Perfumes      Tratamiento Facial</p>
    </v-col>
    <v-col cols="12" class="pa-0">
      <v-carousel
        cycle
        height="600"
        hide-delimiter-background
        show-arrows-on-hover
      >
        <v-carousel-item>
          <v-img src="/img/BannerDesktopHomeLB-C05-BIO.jpg"></v-img>
        </v-carousel-item>
        <v-carousel-item>
          <v-img src="/img/BannerDesktopHomeLB-C05-BIO.jpg"></v-img>
        </v-carousel-item>
      </v-carousel>
    </v-col>
    <v-col cols="12" class="pa-0">
      <div class="blue-grey darken-4 text-center display-3 pa-2 font-italic">
        <span class="white--text">Nuestras Categorías</span>
      </div>
    </v-col>
    <v-col cols="12" class="pa-0">
      <v-row class="pa-0">
        <v-col cols="6" class="pa-0">
          <v-img
            src="/img/category-banner-1-c03-2020-FR-MON.jpg"
            max-height="540px"
            aspect-ratio="0.1">
          </v-img>
        </v-col>
        <v-col cols="6" class="pa-0">
          <v-img
            src="/img/CAT-2.jpg"
            max-height="270px">
          </v-img>
          <v-img
            src="/img/CAT-3.jpg"
            max-height="270px">
          </v-img>
        </v-col>
        <v-col cols="12">
          <v-img
            src="/img/banner-catalogo.jpg"
            max-height="600px">
          </v-img>
        </v-col>
        <hr>
        <v-col class="pink lighten-5">
          <v-row>
            <v-col cols="2">

            </v-col>
            <v-col cols="2">
              <p class="font-weight-bold caption">NUESTRAS MARCAS</p>
              <p class="caption">MARCA 1</p>
              <p class="caption">MARCA 2</p>
              <p class="caption">MARCA 3</p>
            </v-col>
            <v-col cols="2">
              <p class="font-weight-bold caption">CATALOGOS</p>
              <p class="caption">CATALOGO 2</p>
              <p class="caption">CATALOGO 3</p>
              <p class="caption">CATALOGO 1</p>
            </v-col>
            <v-col cols="2">
              <p class="font-weight-bold caption">LEGAL</p>
              <p class="caption">TÉRMINOS Y CONDICIONES</p>
              <p class="caption">CONDICIONES DE USO</p>
              <p class="caption">POLÍTICA DE PRIVACIDAD</p>
              <p class="caption">DERECHOS ARCO</p>
              <p class="caption">VIGENCIA DE CAMPAÑAS</p>
            </v-col>
            <v-col cols="2">
              <p class="font-weight-bold caption">CONTÁCTANOS</p>
              <p class="caption">PREGUNTAS FRECUENTES</p>
              <p class="caption">QUIERO VENDER</p>
              <p class="caption">ESCRÍBENOS</p>
            </v-col>
            <v-col cols="2">

            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-col>
  </v-row>
</template>

<script>
export default {
  data () {
    return {
      colors: [
        'indigo',
        'warning',
        'pink darken-2',
        'red lighten-1',
        'deep-purple accent-4',
      ],
      slides: [
        'First',
        'Second',
        'Third',
        'Fourth',
        'Fifth',
      ],
    }
  },
}
</script>

<style>

</style>