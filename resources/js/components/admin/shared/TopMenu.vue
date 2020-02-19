<template>
	<v-app-bar color="primary" :clipped-left="$vuetify.breakpoint.mdAndUp" fixed app>
    <v-app-bar-nav-icon @click.stop="navToggle" class="white--text"></v-app-bar-nav-icon>

    <v-toolbar-title class="white--text">
      <v-img 
        src="/img/seytu.png"
        contain
        max-height="70px"
        max-width="150px">
      </v-img>
    </v-toolbar-title>
  </v-app-bar>
</template>

<script>
import { settings } from '~/config'

export default {
	data: () => ({
		siteName: settings.siteName
	}),

	methods: {
    navToggle() {
      this.$emit('nav-toggle')
    }
	}
}
</script>
