<template>
  <div>
    <v-layout row wrap>
        <v-flex xs12 offset-xs1 class="text-xs-left">
          <h1 class="display-3">Student {{pageUse[0]}}</h1>
        </v-flex>
    </v-layout>
    <v-layout row wrap>
      <v-flex xs10 offset-xs1>
        <v-stepper v-model="e1">
          <v-stepper-header>
            <v-stepper-step step="1" :complete="e1 > 1">Details</v-stepper-step>
            <v-divider></v-divider>
            <v-stepper-step step="2" :complete="e1 > 2">Modules toekennen</v-stepper-step>
            <v-divider></v-divider>
            <v-stepper-step step="3" :complete="e1 > 3">Voltooid</v-stepper-step>
          </v-stepper-header>
          <v-stepper-items>
            <v-stepper-content step="1">
              <v-form v-model="valid" ref="form" lazy-validation>
                <v-text-field
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
                ></v-text-field>
                <v-select
                  v-if="receivedData && studentOplSet"
                  label="Opleiding"
                  v-model="select"
                  :items="opleidingenDropdown"
                  item-text="select"
                  item-value="select"
                  :rules="[v => !!v || 'Een opleiding moet geselecteerd worden']"
                  required
                ></v-select>
                <v-btn color="primary" :disabled="!valid" @click="submit">Volgende</v-btn>
              </v-form>
            </v-stepper-content>
            <v-stepper-content step="2">
              <v-flex v-for="module in modules.modules" :key="module.id">
                <h3>Module: {{ module.name}}</h3>
                <v-divider></v-divider>
                  <v-expansion-panel popout expand>
                   <v-flex xs12 v-for="categorie in module.categorieen" :key="categorie.id">
                      <v-expansion-panel-content class="pt-0 pb-0">
                        <div slot="header">
                          <h5><v-icon class="mr-2">label_outline</v-icon>{{categorie.name}}</h5>
                        </div>
                        <v-card>
                          <v-card-text class="grey lighten-3">
                            <v-flex xs12 v-for="doelstelling in categorie.doelstellingen" :key="doelstelling.id">
                              <p>
                                <v-icon>navigate_next</v-icon>
                                {{doelstelling.name}}
                              </p>
                              <v-divider></v-divider>
                            </v-flex>
                          </v-card-text>
                        </v-card>
                      </v-expansion-panel-content>
                      <v-divider></v-divider>
                    </v-flex>
                  </v-expansion-panel>
              </v-flex>
              <v-btn color="primary" @click.native="e1 = 3">voltooien</v-btn>
              <v-btn flat  @click.native="e1 = 1">Vorige</v-btn>
            </v-stepper-content>
              <v-stepper-content step="3">
                <h5>Student {{firstname}} {{name}} {{pageUse[1]}}:</h5>
                <p>Naam: {{firstname}} {{name}}</p>
                <p>Email:{{email}}</p>
                <p>Opleiding: {{select}}</p>
                <router-link to="/studenten"><v-btn color="primary">Terug naar studenten</v-btn></router-link>
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
      select: '',
      pageUse: ['toevoegen', 'toegevoegd'],
      receivedData: false,
      studentOplSet: false,
      opleidingen: [],
      opleidingenDropdown: [],
      modules: []
    }
  },
  methods: {
    submit () {
      if (this.$refs.form.validate()) {
        var select = this.select
        console.log(select)
        var result = this.opleidingen.filter(function (obj) {
          return obj.name === select
        })
        this.callForModules(result[0].id)
        this.e1 = 2
      }
    },
    callForModules (id) {
      var self = this
      self.$http.get('http://146.185.183.217/api/fullOpleiding?opleiding=' + id)
        .then(function (response) {
          self.modules = response.data
          console.log(self.modules)
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
    if (this.$route.query.id) {
      self.pageUse = ['aanpassen', 'aangepast']
      var studentId = this.$route.query.id
      this.$http.get('http://146.185.183.217/api/student?id=' + studentId)
        .then(function (response) {
          console.log(response.data)
          self.firstname = response.data.student.firstname
          self.name = response.data.student.lastname
          self.email = response.data.student.email
          self.select = response.data.opleiding.name
          console.log(self.select)
          self.studentOplSet = true
        })
        .catch(function (error) {
          console.log(error)
        })
    } else {
      self.studentOplSet = true
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
