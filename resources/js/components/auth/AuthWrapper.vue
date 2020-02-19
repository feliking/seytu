<template>
  <v-content>
    <v-container fluid fill-height justify-center align-center pa-0>
      <transition name="fade" mode="out-in">
        <router-view></router-view>
      </transition>
    </v-container>
  </v-content>
</template>

<script>
export default {}
</script>
