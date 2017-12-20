<template>
  <main>
  <v-layout row justify-center>
      <v-dialog v-model="reportGen" persistent max-width="290">
          <v-card>
              <v-card-title class="headline">Rapport aanmaken</v-card-title>
                  <v-card-text>
                      <v-text-field
                              name="reportName"
                              v-model="reportName"
                              label="naam rapport"
                              id="reportName"
                              type="text"
                      >
                      </v-text-field>
                      <br/>
                      Start datum:
                      <v-layout row wrap>
                          <v-flex>
                              <v-menu
                                      lazy
                                      :close-on-content-click="false"
                                      v-model="menu1"
                                      transition="scale-transition"
                                      offset-y
                                      full-width
                                      :nudge-right="40"
                                      max-width="290px"
                                      min-width="290px"
                              >
                                  <v-text-field
                                          slot="activator"
                                          label="Datum"
                                          v-model="dateFormatted1"
                                          prepend-icon="event"
                                          @blur="date1 = parseDate(dateFormatted1)"
                                  ></v-text-field>
                                  <v-date-picker v-model="date1" @input="dateFormatted1 = formatDate($event)" no-title scrollable actions>
                                      <template slot-scope="{ save, cancel }">
                                          <v-card-actions>
                                              <v-spacer></v-spacer>
                                              <v-btn flat color="primary" @click="cancel">Cancel</v-btn>
                                              <v-btn flat color="primary" @click="save">OK</v-btn>
                                          </v-card-actions>
                                      </template>
                                  </v-date-picker>
                              </v-menu>
                          </v-flex>
                      </v-layout>
                      <br/>
                      Eind datum:
                      <v-layout row wrap>
                          <v-flex>
                              <v-menu
                                      lazy
                                      :close-on-content-click="false"
                                      v-model="menu2"
                                      transition="scale-transition"
                                      offset-y
                                      full-width
                                      :nudge-right="40"
                                      max-width="290px"
                                      min-width="290px"
                              >
                                  <v-text-field
                                          slot="activator"
                                          label="Datum"
                                          v-model="dateFormatted2"
                                          prepend-icon="event"
                                          @blur="date2 = parseDate(dateFormatted2)"
                                  ></v-text-field>
                                  <v-date-picker v-model="date2" @input="dateFormatted2 = formatDate($event)" no-title scrollable actions>
                                      <template slot-scope="{ save, cancel }">
                                          <v-card-actions>
                                              <v-spacer></v-spacer>
                                              <v-btn flat color="primary" @click="cancel">Cancel</v-btn>
                                              <v-btn flat color="primary" @click="save">OK</v-btn>
                                          </v-card-actions>
                                      </template>
                                  </v-date-picker>
                              </v-menu>
                          </v-flex>
                      </v-layout>
                  </v-card-text>
              <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn color="green darken-1" flat @click.native="reportGen = false">TERUG</v-btn>
                  <v-btn color="green darken-1" flat @click.native="generateReport()">AANMAKEN</v-btn>
              </v-card-actions>
          </v-card>
      </v-dialog>
  </v-layout>
    <v-layout row-wrap>
        <v-flex xs12 offset-xs1 class="text-xs-left">
          <h1 class="display-3">Rapporten</h1>
        </v-flex>
    </v-layout>
    <v-layout row-wrap>
      <v-flex xs4 offset-xs1 ref="results" @>
        <searchbar @select-item="applySelection" :list="items" :concat_keys="keys" :labeltext="zoeklabel" :item_concat_key="item_name" :item_value="item_value"></searchbar>
      </v-flex>
    </v-layout>
    <v-layout row-wrap>
        <v-flex xs12 offset-xs1 class="text-xs-left">
          <h2 class="headline" v-if="currentstudent != null && !currentreport">{{ 'Overzicht rapporten' }}</h2>
          <v-flex>
            <div>
              <v-btn v-if="currentstudent != null && currentreport === null" @click="reportGen = true" class="left" color="primary">Rapport aanmaken</v-btn>
              <p v-if="reportError" style="display: inline-block" class="red--text pt-3">{{reportError}}</p>
            </div>
          </v-flex>
        </v-flex>
    </v-layout>
    <v-layout row-wrap>
        <v-flex xs10 offset-xs1>
            <v-list two-line v-if="currentstudent != null && currentreport === null">
              <v-subheader>{{'Rapporten van ' + currentstudent.student.firstname + ' ' + currentstudent.student.lastname}}</v-subheader>
              <template v-for="report in current_student_reports">
                <v-divider></v-divider>
                <v-list-tile v-bind:key="report.id" @click="getReport(report.id)">
                  <v-list-tile-content>
                    <v-list-tile-title v-html="report.name"></v-list-tile-title>
                    <!-- <v-list-tile-sub-title v-html="report.class"></v-list-tile-sub-title>-->
                  </v-list-tile-content>
                </v-list-tile>
              </template>
            </v-list>
            <!-- REPORT TEMPLATE -->
            <template v-if="currentreport != null">
            <v-layout row-wrap>
              <v-flex xs12>
              <v-card color="blue-grey darken-4" class="white--text">
                 <v-container fluid grid-list-lg>
                   <v-layout row>
                     <v-flex xs7 height="100%">
                       <div>
                         <div height="100%" block class="display-3 text-xs-left">{{ currentreport.name }}</div>
                         <div block class="display-2 text-xs-left">{{currentstudent.student.firstname + ' ' + currentstudent.student.lastname}}</div>
                       </div>
                     </v-flex>
                   </v-layout>
                 </v-container>
                 <v-flex>
                   <v-btn @click="" large color="primary"><v-icon>get_app</v-icon></v-btn>
                   <v-btn @click="print" large color="primary"><v-icon>print</v-icon></v-btn>
                 </v-flex>
               </v-card>
             </v-flex>
            </v-layout>
            <!-- REPORT MODULES -->
            <template v-for="module in currentreport.modules">
            <v-layout row-wrap>
              <v-flex xs12>
                <v-card color="blue-grey darken-3" class="display-2 white--text text-xs-left">
                  <v-container fluid grid-list-lg>
                    {{module.naam}}
                  </v-container>
                </v-card>
              </v-flex>
            </v-layout>
            <v-layout row-wrap v-for="categorie in module.doelstellingscategories">
              <v-flex xs2>
              <v-card color="blue-grey darken-2" class="white--text text-xs-center" height="100%">
                 <v-container fluid grid-list-lg fill-height>
                   {{categorie.name}}
                 </v-container>
               </v-card>
              </v-flex>
              <v-flex xs10>
                <v-layout row-wrap v-for="doelstelling in categorie.doelstellingen">
                  <v-flex xs10>
                    <v-card color="blue-grey" class="white--text text-xs-left" height="100%">
                      <v-container fluid grid-list-lg fill-height>
                        {{doelstelling.name}}
                      </v-container>
                    </v-card>
                  </v-flex>
                  <v-flex xs2>
                    <v-card color="teal" class="white--text" fill-height height="100%">
                      <v-container fluid grid-list-lg pb-0>
                          <v-select
                                  v-model="selectedScore[doelstelling.id]"
                                  :items="possibleScores"
                                  :item-text="doelstelling.score"
                                  :item-value="doelstelling.score"
                                  class="white--text pt-0"
                                  height="100%"
                                  dark
                                  required
                          ></v-select>
                      </v-container>
                    </v-card>
                  </v-flex>
                </v-layout>
              </v-flex>
            </v-layout>
            </template>
            <!-- REPORT COMMENTS AND NOTES -->
            <v-layout row-wrap>
              <v-flex xs12>
                <v-card color="blue-grey darken-4" class="white--text text-xs-left">
                  <v-container fluid grid-list-lg>
                    <v-chip label color="yellow" text-color="black" width="100%">
                      <v-icon left>label</v-icon>
                      <div class="mr-4">Algemene commentaar</div>
                      <div>{{currentreport.commentaarAlgemeen}}</div>
                    </v-chip>
                    <v-chip label color="yellow" text-color="black">
                      <v-icon left>label</v-icon>
                      <div class="mr-4">Klassenraad commentaar</div>
                      <div>{{currentreport.commentaarKlassenraad}}</div>
                    </v-chip>
                  </v-container>
                </v-card>
              </v-flex>
            </v-layout>
          </template>
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
      items: [],
      keys: ['firstname', 'lastname'],
      selectedScore: {},
      item_name: 'fullname',
      item_value: 'id',
      zoeklabel: 'student',
      currentstudent: null,
      currentreport: null,
      current_student_reports: null,
      usercredentials: {
        username: 'thomas.de.nil@student.howest.be',
        password: 'Student'
      },
      headers: {
        'Content-Type': 'text/plain'
      },
      possibleScores: ['ZG', 'G', 'V', 'OV'],
      reportGen: false,
      date1: null,
      dateFormatted1: null,
      date2: null,
      dateFormatted2: null,
      reportError: null,
      menu1: false,
      menu2: false,
      opleiding: null,
      reportName: null
    }
  },
  methods: {
    print () {
      this.$printer.print(this.currentstudent, this.currentreport)
    },
    applySelection (payload) {
      var self = this
      this.$http.getStudent(payload, function (data) {
        self.currentstudent = data
        console.log(self)
        self.getCurrentStudentReports()
      })
    },
    getCurrentStudentReports () {
      console.log(this.currentstudent)
      var self = this
      this.$http.getStudentReports(self.currentstudent.student.id, function (data) {
        self.current_student_reports = data
      })
    },
    getReport (rapportid) {
      var self = this
      this.$http.getStudentReport(rapportid, function (data) {
        self.currentreport = data
        console.log(data)
        for (var i = 0; i < data.modules.length; i++) {
          for (var j = 0; j < data.modules[i].doelstellingscategories.length; j++) {
            for (var k = 0; k < data.modules[i].doelstellingscategories[j].doelstellingen.length; k++) {
              var objId = data.modules[i].doelstellingscategories[j].doelstellingen[k].id
              var objScore = data.modules[i].doelstellingscategories[j].doelstellingen[k].score
              self.selectedScore[objId] = objScore
            }
          }
        }
        console.log(self.selectedScore)
      })
    },
    formatDate (date) {
      if (!date) {
        return null
      }
      const [year, month, day] = date.split('-')
      return `${day}/${month}/${year}`
    },
    parseDate (date) {
      if (!date) {
        return null
      }
      const [month, day, year] = date.split('/')
      return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`
    },
    generateReport: function () {
      var self = this
      self.reportGen = false
      console.log(self.reportName)
      if (self.dateFormatted1 !== null && self.dateFormatted2 !== null && self.reportName !== null) {
        self.reportError = null
        self.$http.getEvalForStudent(self.currentstudent.student.id, function (data) {
          console.log(data)
          self.opleiding = data
          self.currentreport = {}
          self.currentreport['commentaarAlgemeen'] = ''
          self.currentreport['commentaarKlassenraad'] = ''
          self.currentreport['klas'] = ''
          self.currentreport['name'] = self.reportName
          var modules = []
          for (var i = 0; i < self.opleiding.modules.length; i++) {
            var module = self.opleiding.modules[i]
            modules[i] = {naam: module.name, id: module.id, doelstellingscategories: [], commentaar: null}
            for (var j = 0; j < self.opleiding.modules[i].categorieen.length; j++) {
              var doelstellingscategorie = self.opleiding.modules[i].categorieen[j]
              modules[i]['doelstellingscategories'][j] = {name: doelstellingscategorie.name, id: doelstellingscategorie.id, doelstellingen: []}
              for (var k = 0; k < self.opleiding.modules[i].categorieen[j].doelstellingen.length; k++) {
                var doelstelling = self.opleiding.modules[i].categorieen[j].doelstellingen[k]
                modules[i]['doelstellingscategories'][j]['doelstellingen'][k] = {name: doelstelling.name, id: doelstelling.id, opmerking: null, score: null}
              }
            }
          }
          self.currentreport['modules'] = modules.slice().reverse()
        })
      } else if (self.dateFormatted1 === null || self.dateFormatted2 === null) {
        self.reportError = 'Beide Datums moeten worden ingevuld'
      } else {
        self.reportError = 'Je moet een rapportnaam opgeven'
      }
    }
  },
  computed: {
    Opleidingen () {

    }
  },
  created () {
    var self = this
    var d = new Date()
    var month = d.getMonth() + 1
    self.dateFormatted2 = d.getDate() + '/' + month + '/' + d.getFullYear()
    this.$http.getStudentsWithEdu(function (data) {
      self.items = data
    })
  },
  mounted () {
    var sheet = document.createElement('style')
    sheet.innerHTML = 'div.menu__content--autocomplete {top:165px !important;}'
    document.body.appendChild(sheet)
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
