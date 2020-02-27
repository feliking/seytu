import 'babel-polyfill'
import Vue from 'vue'

import router from '~/router/index'
import store from '~/store/index'
import App from '$comp/App'
import '~/plugins/index'
import vuetify from '~/plugins/vuetify'
import VueClip from 'vue-clip'


Vue.use(VueClip)

export const app = new Vue({
  router,
  store,
  vuetify,
  render: h => h(App)
}).$mount('#app')
