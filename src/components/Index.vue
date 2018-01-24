<template>
  <v-app>
    <v-navigation-drawer persistent v-model="drawer" app v-if="['login'].indexOf($route.name)">
    <v-toolbar flat center height="150vh">
        <img class="" src="../assets/CLW_Logo.png" height="100%">
    </v-toolbar>
     <v-divider></v-divider>
     <v-list dense>
       <v-list-tile v-for="item in navigation" :key="item" @click="route(item); drawer = false">
         <v-list-tile-content>
           <v-list-tile-title>{{ item }}</v-list-tile-title>
         </v-list-tile-content>
       </v-list-tile>
     </v-list>
   </v-navigation-drawer>
   <v-toolbar color="indigo" dark fixed app v-if="['login'].indexOf($route.name)">
        <v-icon large color="white" @click.stop="drawer = !drawer">{{ drawer? 'close':'menu' }}</v-icon>
     <v-toolbar-title>Rapportensysteem</v-toolbar-title>
     <v-spacer></v-spacer>
     <v-menu
       :close-on-content-click="false"
       v-model="menu"
     >
      <v-btn color="white" flat slot="activator">Account</v-btn><v-card>
        <v-list>
          <v-list-tile avatar>
            <v-list-tile-content v-if="isLoaded">
              <v-list-tile-title class="amber--text">{{ currentUser.role }}</v-list-tile-title>
              <div>{{ currentUser.name }}</div>
              <!--<v-list-tile-sub-title>Lector fysica & Chemie</v-list-tile-sub-title>-->
            </v-list-tile-content>
          </v-list-tile>
        </v-list>
        <v-divider></v-divider>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn flat @click="menu = false">Cancel</v-btn>
          <v-btn color="primary" flat @click="logout">Afmelden</v-btn>
        </v-card-actions>
      </v-card>

     </v-menu>
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
    ],
    fav: true,
    menu: false,
    message: false,
    hints: true,
    currentUser: {
      id: '',
      name: '',
      role: ''
    },
    isLoaded: false
  }),
  methods: {
    route (path) {
      this.$router.push(path)
    },
    logout: function () {
      var self = this
      self.menu = false
      self.$http.logout(function (data) {
        self.$router.push('/login')
      })
    }
  },
  created: function () {
    var self = this
    self.$http.getCurrentUser(function (data) {
      self.currentUser.id = data.id
      self.currentUser.name = data.name
      self.currentUser.role = data.role
      self.isLoaded = true
    })
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->

<style scoped>
/* TODO custom css for the logo to fit the drawer */

</style>
