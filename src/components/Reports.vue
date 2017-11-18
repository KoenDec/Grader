<template>
  <main>
    <v-layout row-wrap>
        <v-flex xs12 offset-xs1 class="text-xs-left">
          <h1 class="display-3">Rapporten</h1>
        </v-flex>
    </v-layout>
    <v-layout row-wrap>
        <v-flex xs6 offset-xs1>
            <v-toolbar>
              <v-text-field  prepend-icon="search" hide-details single-line></v-text-field>
            </v-toolbar>
        </v-flex>
        <v-flex>
          <v-btn @click="getSomething" large color="primary"><v-icon>get_app</v-icon></v-btn>
          <v-btn @click="logSomething" large color="primary"><v-icon>print</v-icon></v-btn>
        </v-flex>
    </v-layout>
    <v-layout row-wrap>
        <v-flex xs12 offset-xs1 class="text-xs-left">
          <h2 class="headline">Studiemodules van: {{ currentstudent.name }}</h2>
        </v-flex>
    </v-layout>
    <v-layout row-wrap>
        <v-flex xs10 offset-xs1>
        <v-expansion-panel popout expand>
          <v-expansion-panel-content v-for="(item,i) in 5" :key="i">
            <div slot="header">Item</div>
            <v-card>
              <v-card-text class="grey lighten-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</v-card-text>
            </v-card>
          </v-expansion-panel-content>
        </v-expansion-panel>
      </v-flex>
    </v-layout>
    {{Opleidingen}}
  </main>
</template>

<script>
export default {
  name: 'Reports',
  data () {
    return {
      currentstudent: { // TODO DUMMY OBJECT - will be converted by watched property
        'name': 'Faisal Nizami'
      },
      currentreport: {

      },
      usercredentials: {
        username: 'thomas.de.nil@student.howest.be',
        password: 'Student'
      },
      headers: {
        'Content-Type': 'text/plain'
      }
    }
  },
  methods: {
    logSomething () {
      this.$http.post('http://146.185.183.217/api/auth', this.usercredentials)
      .then(function (response) {
        console.log(response.data)
        var d = new Date()
        document.cookie = 'GID=' + response.data.GID + '; expires=' + d.getTime() * 60 * 60 * 24 * 7
        document.cookie = 'GID_=' + response.data.GID_ + '; expires=' + d.getTime() * 60 * 60 * 24 * 3
      })
      .catch(function (error) {
        console.log(error)
      })
    },
    getSomething () {
      this.$http.get('http://146.185.183.217/api/students')
      .then(function (response) {
        console.log(response)
      })
      .catch(function (error) {
        console.log(error)
      })
    }
  },
  computed: {
    Opleidingen () {

    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
