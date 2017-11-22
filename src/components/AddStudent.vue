<template>
  <div>
    <v-layout row wrap>
        <v-flex xs12 offset-xs1 class="text-xs-left">
          <h1 class="display-3">Studenten</h1>
        </v-flex>
    </v-layout>
    <v-layout row wrap>
      <v-flex xs10 offset-xs1>
        <v-stepper v-model="e1">
          <v-stepper-header>
            <v-stepper-step step="1" :complete="e1 > 1">Details</v-stepper-step>
            <v-divider></v-divider>
            <v-stepper-step step="2" :complete="e1 > 2">Modules toekennen</v-stepper-step>
          </v-stepper-header>
          <v-stepper-items>
            <v-stepper-content step="1">
              <v-form v-model="valid" ref="form" lazy-validation>
                <!--<v-text-field
                  label="Naam"
                  v-model="name"
                  :rules="nameRules"
                  required
                ></v-text-field>
                <v-text-field
                  label="Voornaam"
                  v-model="firstname"
                  :rules="firstnameRules"
                  required
                ></v-text-field>
                <v-text-field
                  label="E-mail"
                  v-model="email"
                  :rules="emailRules"
                  required
                ></v-text-field>-->
                <v-select
                  v-if="receivedData"
                  label="Opleiding"
                  v-model="select"
                  :items="opleidingenDropdown"
                  :rules="[v => !!v || 'Een opleiding moet geselecteerd worden']"
                  required
                ></v-select>
                <v-btn color="primary" :disabled="!valid" @click="submit">Volgende</v-btn>
              </v-form>
            </v-stepper-content>
            <v-stepper-content step="2">
              <v-flex v-if="receivedModules" v-for="module in modules">
                <h3>Modules in de opleiding {{ module.name }}</h3>
                <!-- <v-divider></v-divider>
                  <v-expansion-panel popout expand>
                    <v-flex xs12 v-for="">
                      <v-expansion-panel-content>
                        <div slot="header">
                          <v-checkbox v-bind:label="mod" light></v-checkbox>
                        </div>
                        <v-card>
                          <v-card-text class="grey lighten-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</v-card-text>
                        </v-card>
                      </v-expansion-panel-content>
                      <v-divider></v-divider>
                    </v-flex>
                  </v-expansion-panel> -->
              </v-flex>
              <v-btn color="primary" @click.native="e1 = 3">voltooien</v-btn>
              <v-btn flat  @click.native="e1 = 1">Vorige</v-btn>
            </v-stepper-content>
          </v-stepper-items>
        </v-stepper>
      </v-flex>
    </v-layout>
  </div>
</template>

<script>
export default {
  name: 'Home',
  data () {
    return {
      e1: 0,
      valid: true,
      name: '',
      nameRules: [
        (v) => !!v || 'Naam moet ingevuld worden'
      ],
      firstname: '',
      firstnameRules: [
        (v) => !!v || 'Voornaam moet ingevuld worden'
      ],
      email: '',
      emailRules: [
        (v) => !!v || 'E-mail moet ingevuld worden',
        (v) => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail moet geldig zijn'
      ],
      select: null,
      receivedData: false,
      opleidingen: [],
      opleidingenDropdown: [],
      receivedModules: false,
      modules: []
    }
  },
  methods: {
    submit () {
      if (this.$refs.form.validate()) {
        var select = this.select
        var result = this.opleidingen.filter(function (obj) {
          return obj.name === select
        })
        this.callForModules(result[0].id)
        this.e1 = 2
      }
    },
    callForModules (id) {
      this.$http.get('http://146.185.183.217/api/modulesVoorOpleiding?opleiding=1')
        .then(function (response) {
          self.modules = response.data
          console.log(self.modules)
          self.receivedModules = true
        })
        .catch(function (error) {
          console.log(error)
        })
    }
  },
  created () {
    var self = this
    this.$http.get('http://146.185.183.217/api/opleidingen')
      .then(function (response) {
        self.opleidingen = response.data
        console.log(self.opleidingen)
        for (var i = 0; i < self.opleidingen.length; i++) {
          self.opleidingenDropdown.push(self.opleidingen[i].name)
        }
        console.log('dropdown: ' + self.opleidingenDropdown)
        self.receivedData = true
      })
        .catch(function (error) {
          console.log(error)
        })
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
