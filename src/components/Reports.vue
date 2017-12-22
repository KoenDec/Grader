<template>
  <main>
  <v-dialog v-model="loadbarShow" persistent max-width="600">
    <v-flex xs12 pl-3 pr-3>
      <v-progress-linear
              height="20"
              v-model="loadbarValue"
              v-bind:active="loadbarShow"
      ></v-progress-linear>
    </v-flex>
  </v-dialog>
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
                      Startdatum:
                      <v-layout row-wrap>
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
                                          hint="inclusief"
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
                      Einddatum:
                      <v-layout row-wrap>
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
                                          hint="inclusief"
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
                  <v-btn color="green darken-1" flat @click.native="makeReports(true)">AANMAKEN</v-btn>
              </v-card-actions>
          </v-card>
      </v-dialog>
  </v-layout>
    <v-layout row-wrap>
        <v-flex xs12 offset-xs1 class="text-xs-left">
          <h1 class="display-3">Rapporten<span v-if="reportsGenerator"> aanmaken</span></h1>
        </v-flex>
    </v-layout>

    <v-layout row-wrap v-if="reportsGenerator">
        <v-flex xs1 offset-xs1>
            <v-btn @click="reportsGenerator = false" class="left" color="primary"><v-icon class="mr-2">undo</v-icon>Back</v-btn>
        </v-flex>
        <v-flex xs9>
            <v-btn class="right" color="warning" @click="makeReports(false)"><v-icon class="mr-2">save</v-icon>Alle Rapporten genereren</v-btn>
            <p>{{studentIdsFromSelect}}</p>
        </v-flex>
    </v-layout>
    <v-layout row-wrap v-if="reportsGenerator">
      <v-flex xs4 offset-xs1>
          <v-text-field
                  name="reportName"
                  v-model="reportName"
                  label="naam rapport"
                  id="reportName2"
                  type="text"
          >
          </v-text-field>
      </v-flex>
    </v-layout>
    <v-layout v-if="reportsGenerator">
        <v-flex xs6 offset-xs1>
            <v-layout row-wrap>
                <v-flex xs3>
                    <v-menu
                            lazy
                            :close-on-content-click="false"
                            v-model="menu3"
                            transition="scale-transition"
                            offset-y
                            full-width
                            :nudge-right="40"
                            max-width="290px"
                            min-width="290px"
                    >
                        <v-text-field
                                slot="activator"
                                label="Startdatum"
                                v-model="dateFormatted1"
                                prepend-icon="event"
                                hint="inclusief"
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
                <v-flex xs3>
                    <v-menu
                            lazy
                            :close-on-content-click="false"
                            v-model="menu4"
                            transition="scale-transition"
                            offset-y
                            full-width
                            :nudge-right="40"
                            max-width="290px"
                            min-width="290px"
                    >
                        <v-text-field
                                slot="activator"
                                label="Einddatum"
                                v-model="dateFormatted2"
                                prepend-icon="event"
                                hint="inclusief"
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
        </v-flex>
    </v-layout>

    <v-layout row-wrap v-if="!reportsGenerator">
      <v-flex v-if="currentreport === null" xs1 offset-xs1 mt-3 mr-5>
        <v-btn v-if="currentreport === null" @click="reportsGenerator = true; currentstudent = null" class="left" color="primary">Rapporten aanmaken</v-btn>
      </v-flex>
        <v-flex v-if="currentreport === null" xs1 mt-4>
            <p>OF</p>
        </v-flex>
      <v-flex xs2 offset-xs1 :class="{'ml-0': currentreport === null}" ref="results" @>
        <searchbar @select-item="applySelection" :list="items" :concat_keys="keys" :labeltext="zoeklabel" :item_concat_key="item_name" :item_value="item_value"></searchbar>
      </v-flex>
    </v-layout>
    <v-layout row-wrap>
        <v-flex v-if="currentreport" offset-xs1>
            <v-btn @click="currentreport = null; getCurrentStudentReports()" color="primary"><v-icon class="mr-2">undo</v-icon>Back</v-btn>
        </v-flex>
        <v-flex xs12 offset-xs1 class="text-xs-left">
          <h2 class="headline" v-if="currentstudent != null && !currentreport">{{ 'Overzicht rapporten' }}</h2>
          <v-flex>
            <div>
              <v-btn v-if="currentstudent != null && currentreport === null" @click="reportGen = true" class="left" color="primary">Rapport aanmaken voor {{currentstudent.student.firstname + ' ' + currentstudent.student.lastname}}</v-btn>
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
                      <v-list-tile-title><span style="border-right: solid 1px gray; padding-right: 5px">{{report.startdate}} - {{report.enddate}}</span> {{report.name}}</v-list-tile-title>
                    <!-- <v-list-tile-sub-title v-html="report.class"></v-list-tile-sub-title>-->
                  </v-list-tile-content>
                </v-list-tile>
              </template>
            </v-list>
            <!-- REPORT TEMPLATE -->
          <template v-if="currentreport != null && !reportsGenerator">
            <v-layout row-wrap>
              <v-flex xs12>
              <v-card color="blue-grey darken-4" class="white--text">
                 <v-container fluid grid-list-lg>
                   <v-layout row>
                     <v-flex xs7 height="100%">
                       <div>
                         <div height="100%" block class="display-3 text-xs-left">{{ currentreport.name }}</div>
                         <div block class="display-2 text-xs-left">{{currentstudent.student.firstname + ' ' + currentstudent.student.lastname}}</div>
                         <div block class="display-1 text-xs-left">{{dateFormatted1}} - {{dateFormatted2}}</div>
                       </div>
                     </v-flex>
                   </v-layout>
                 </v-container>
                 <v-flex>
                   <v-btn @click="" large color="primary"><v-icon>get_app</v-icon></v-btn>
                   <v-btn @click="print" large color="primary"><v-icon>print</v-icon></v-btn>
                   <v-btn v-if="!edit" @click="edit = true" large class="right" color="primary"><v-icon>edit</v-icon></v-btn>
                   <v-btn v-if="edit" @click="edit = false" large class="right" color="primary"><v-icon>save</v-icon></v-btn>
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
            <v-layout row-wrap v-for="categorie in module.doelstellingscategories" :key="categorie.id">
              <v-flex xs2>
              <v-card color="blue-grey darken-2" class="white--text text-xs-center" height="100%">
                 <v-container fluid grid-list-lg fill-height>
                   {{categorie.name}}
                 </v-container>
               </v-card>
              </v-flex>
              <v-flex xs10>
                <v-layout row-wrap v-for="doelstelling in categorie.doelstellingen" :key="doelstelling.id">
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
                                  v-if="edit"
                                  v-model="selectedScore[doelstelling.id]"
                                  :items="possibleScores"
                                  :item-text="doelstelling.score"
                                  :item-value="doelstelling.score"
                                  class="white--text pt-0"
                                  height="100%"
                                  dark
                                  required
                          ></v-select>
                          <p v-if="!edit">{{selectedScore[doelstelling.id]}}</p>
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
                    <v-chip label color="yellow" text-color="black" width="500px">
                      <v-icon left>label</v-icon>
                      <div style="display: block" class="mr-4">Algemene commentaar</div>
                      <div v-if="!edit">{{currentreport.commentaarAlgemeen}}</div>
                        <v-flex v-if="edit">
                            <v-text-field
                                name="Algemene commentaar"
                                v-model="currentreport.commentaarAlgemeen"
                                label="commentaar"
                                id="algemeneCommentaar"
                                type="text"
                            >
                            </v-text-field>
                        </v-flex>
                    </v-chip>
                    <v-chip label color="yellow" text-color="black">
                      <v-icon left>label</v-icon>
                      <div class="mr-4">Klassenraad commentaar</div>
                      <div v-if="!edit">{{currentreport.commentaarKlassenraad}}</div>
                        <v-flex v-if="edit">
                            <v-text-field
                                    name="Klassenraad commentaar"
                                    v-model="currentreport.commentaarKlassenraad"
                                    label="commentaar"
                                    id="klassenraadCommentaar"
                                    type="text"
                            >
                            </v-text-field>
                        </v-flex>
                    </v-chip>
                  </v-container>
                </v-card>
              </v-flex>
            </v-layout>
          </template>
        </v-flex>
    </v-layout>
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
      possibleScores: ['G', 'V', 'OV', 'RO', 'NVT'],
      reportGen: false,
      date1: null,
      dateFormatted1: '01/09/2017',
      date2: null,
      dateFormatted2: null,
      reportError: null,
      menu1: false,
      menu2: false,
      menu3: false,
      menu4: false,
      opleiding: null,
      reportName: null,
      edit: false,
      reportsGenerator: false,
      studentIdsFromSelect: [], // 7, 8, 9, 10
      studentIds: [],
      loopStudentIds: 0,
      loadbarValue: 0,
      loadbarShow: false,
      loadbarStep: 0
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
        self.currentreport = null
        self.getCurrentStudentReports()
      })
    },
    getCurrentStudentReports () {
      var self = this
      this.$http.getStudentReports(self.currentstudent.student.id, function (data) {
        self.current_student_reports = data.slice().reverse()
      })
    },
    getReport (rapportid) {
      var self = this
      this.$http.getStudentReport(rapportid, function (data) {
        self.currentreport = data
        self.dateFormatted1 = data.startdate
        self.dateFormatted2 = data.enddate
        for (var i = 0; i < data.modules.length; i++) {
          for (var j = 0; j < data.modules[i].doelstellingscategories.length; j++) {
            for (var k = 0; k < data.modules[i].doelstellingscategories[j].doelstellingen.length; k++) {
              var objId = data.modules[i].doelstellingscategories[j].doelstellingen[k].id
              var objScore = data.modules[i].doelstellingscategories[j].doelstellingen[k].score
              self.selectedScore[objId] = objScore
            }
          }
        }
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
    makeReports: function (singleReport) {
      var self = this
      self.currentreport = null
      self.studentIds = []
      if (singleReport) {
        self.studentIds.push(self.currentstudent.student.id)
      } else {
        self.studentIds = self.studentIdsFromSelect
      }
      if (self.loopStudentIds === 0) {
        self.loadbarStep = 100 / self.studentIds.length
        self.loadbarShow = true
      }
      var id = self.studentIds[self.loopStudentIds]
      console.log('next id=')
      console.log(id)
      if (id !== undefined) {
        self.loopStudentIds++
        self.generateReport(id, singleReport)
      } else {
        self.loopStudentIds = 0
      }
    },
    generateReport: function (id, singleReport) {
      var self = this
      self.reportGen = false
      var d1 = self.dateFormatted1.split('/')
      var d2 = self.dateFormatted2.split('/')
      var start = new Date(d1[2], parseInt(d1[1]) - 1, d1[0])
      var end = new Date(d2[2], parseInt(d2[1]) - 1, d2[0])
      if (self.dateFormatted1 !== null && self.dateFormatted2 !== null && self.reportName !== null && start < end) {
        self.reportError = null
        self.$http.getEvalForStudent(id, function (data) {
          self.opleiding = data
          self.currentreport = {}
          self.currentreport['commentaarAlgemeen'] = ''
          self.currentreport['commentaarKlassenraad'] = ''
          self.currentreport['klas'] = ''
          self.currentreport['name'] = self.reportName
          self.currentreport['startdate'] = self.dateFormatted1
          self.currentreport['enddate'] = self.dateFormatted2
          self.currentreport['studentId'] = id
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
          self.calculateScores(start, end, singleReport, id)
          self.currentreport['modules'] = modules
        })
      } else if (self.dateFormatted1 === null || self.dateFormatted2 === null) {
        self.reportError = 'Beide Datums moeten worden ingevuld'
      } else if (start >= end) {
        self.reportError = 'De startdatum kan niet na de einddatum komen'
      } else {
        self.reportError = 'Je moet een rapportnaam opgeven'
      }
    },
    calculateScores: function (start, end, singleReport, id) {
      var self = this
      var scores = {}
      self.$http.getAllEvalsByStudent(id, function (data) {
        for (var i = 0; i < self.currentreport.modules.length; i++) {
          for (var j = 0; j < self.currentreport.modules[i].doelstellingscategories.length; j++) {
            for (var k = 0; k < self.currentreport.modules[i].doelstellingscategories[j].doelstellingen.length; k++) {
              var doelstelling = self.currentreport.modules[i].doelstellingscategories[j].doelstellingen[k]
              var doelstellingId = doelstelling.id
              for (var l = 0; l < data.length; l++) {
                var c = data[l].date.split('/')
                var check = new Date(c[2], parseInt(c[1]) - 1, c[0])
                if (check >= start && check <= end) {
                  for (var m = 0; m < data[l].doelstellingscategories.length; m++) {
                    for (var n = 0; n < data[l].doelstellingscategories[m].doelstellingen.length; n++) {
                      var doel = data[l].doelstellingscategories[m].doelstellingen[n]
                      var doelId = doel.id
                      if (doelId === doelstellingId) {
                        scores[doelId] = []
                        for (var o = 0; o < doel.evaluatiecriteria.length; o++) {
                          for (var p = 0; p < doel.evaluatiecriteria[o].beoordelingsaspecten.length; p++) {
                            scores[doelId].push(doel.evaluatiecriteria[o].beoordelingsaspecten[p].score)
                          }
                        }
                      }
                    }
                  }
                }
              }
              doelstelling.score = self.getAvgScore(scores[doelstellingId])
              self.selectedScore[doelstellingId] = doelstelling.score
            }
          }
        }
        self.$http.getStudent(id, function (data) {
          self.currentreport['name'] = self.reportName + ' - ' + data.student.firstname + ' ' + data.student.lastname
          self.$http.saveReport(self.currentreport, function (data) {
            self.makeReports(singleReport)
            self.loadbarValue += self.loadbarStep
            if (self.loadbarValue === 100) {
              self.loadbarShow = false
              self.loadbarValue = 0
              self.loadbarStep = 0
            }
          })
        })
      })
    },
    getAvgScore: function (scores) {
      if (scores) {
        var l = scores.length
        var sum = 0
        for (var i = 0; i < l; i++) {
          sum += parseInt(scores[i])
        }
        if (sum / l >= 0.75) {
          return this.possibleScores[0]
        } else if (sum / l >= 0.50 && sum / l < 0.75) {
          return this.possibleScores[1]
        } else if (sum / l >= 0.25 && sum / l < 0.50) {
          return this.possibleScores[2]
        } else if (sum / l < 0.25) {
          return this.possibleScores[3]
        } else if (isNaN(sum / l)) {
          return this.possibleScores[4]
        }
      } else {
        return this.possibleScores[4]
      }
    }
  },
  created () {
    var self = this
    if (self.$route.query.id) {
      self.applySelection(self.$route.query.id)
    }
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
