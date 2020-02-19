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
        height="768"
        hide-delimiter-background
        show-arrows-on-hover
      >
        <v-carousel-item
          v-for="(slide, i) in slides"
          :key="i"
        >
          <v-sheet
            :color="colors[i]"
            height="100%"
          >
            <v-row
              class="fill-height"
              align="center"
              justify="center"
            >
              <div class="display-3">{{ slide }} Slide</div>
            </v-row>
          </v-sheet>
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
            src="https://i.ytimg.com/vi/y1AOmylwOvw/maxresdefault.jpg"
            contain
            max-height="540px">
          </v-img>
        </v-col>
        <v-col cols="6" class="pa-0">
          <v-img
            src="https://i.ytimg.com/vi/y1AOmylwOvw/maxresdefault.jpg"
            contain
            max-height="270px">
          </v-img>
          <v-img
            src="https://i.ytimg.com/vi/y1AOmylwOvw/maxresdefault.jpg"
            contain
            max-height="270px">
          </v-img>
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