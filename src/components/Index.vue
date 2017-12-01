<template>
  <v-app>
    <v-navigation-drawer persistent v-model="drawer" app>
    <v-toolbar flat center height="150vh">
        <img class="" src="../assets/CLW_Logo.png" height="100%">
    </v-toolbar>
     <v-divider></v-divider>
     <v-list dense>
       <v-list-tile v-for="item in navigation" :key="item" @click="route(item)">
         <v-list-tile-content>
           <v-list-tile-title>{{ item }}</v-list-tile-title>
         </v-list-tile-content>
       </v-list-tile>
     </v-list>
   </v-navigation-drawer>
   <v-toolbar color="indigo" dark fixed app>
        <v-icon large color="white" @click.stop="drawer = !drawer">{{ drawer? 'close':'menu' }}</v-icon>
     <v-toolbar-title>Rapportensysteem</v-toolbar-title>
     <v-spacer></v-spacer>
     <v-menu
      origin="center center"
      transition="scale-transition"
      auto
      >
        <v-toolbar-title slot="activator">
          <span>USERNAME</span>
          <v-icon dark>arrow_drop_down</v-icon>
        </v-toolbar-title>
        <v-list>
          <v-list-tile v-for="(item, i) in 2" :key="item" @click="">
            <v-list-tile-title v-text="item"></v-list-tile-title>
          </v-list-tile>
        </v-list>
      </v-menu>
      <v-toolbar-title flat>ADMIN</v-toolbar-title>
   </v-toolbar>
   <main>
     <v-content class="pt-1">
       <v-container grid-list-md fluid>
          <router-view/>
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
      'Afdrukken'
    ]
  }),
  methods: {
    route (path) {
      this.$router.push(path)
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->

<style scoped>
/* TODO custom css for the logo to fit the drawer */

</style>
