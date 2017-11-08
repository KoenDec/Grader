<template>
  <v-app>
    <v-navigation-drawer persistent v-model="drawer" app>
    <v-toolbar flat center height="150vh">
        <img align="middle" src="../assets/CLW_Logo.png" alt="Smiley face" height="100%">
    </v-toolbar>
     <v-divider></v-divider>
     <v-list dense>
       <v-list-tile v-for="item in navigation" @click="">
         <v-list-tile-content>
           <v-list-tile-title>{{ item }}</v-list-tile-title>
         </v-list-tile-content>
       </v-list-tile>
     </v-list>
   </v-navigation-drawer>
   <v-toolbar color="indigo" dark fixed app>
      <v-ripple>
        <v-icon large color="white" @click.stop="drawer = !drawer">{{ drawer? 'close':'menu' }}</v-icon>
      </v-ripple>
     <v-toolbar-title>Rapportensysteem</v-toolbar-title>
   </v-toolbar>
   <main>
     <v-content>
       <v-container fluid fill-height>
         <v-layout>
          <router-view/>
         </v-layout>
       </v-container>
     </v-content>
   </main>
  </v-app>
</template>

<script>
export default {
  name: 'Index',
  data: () => ({
    drawer: false,
    navigation: [
      'Rapporten',
      'Studenten',
      'Opleidingen',
      'Meldingen',
      'Afdrukken'
    ]
  })
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->

<style scoped>
/* TODO custom css for the logo to fit the drawer */

</style>
