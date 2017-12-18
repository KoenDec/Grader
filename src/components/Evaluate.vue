<template>
    <div>
        <v-layout row wrap>
            <v-flex xs12 offset-xs1 class="text-xs-left">
                <h1 class="display-3">Evaluatie</h1>
            </v-flex>
        </v-layout>
        <v-layout row-wrap>
            <v-flex xs12 offset-xs1 class="text-xs-left">
                <h2 class="headline">Evaluatiefiche voor: {{ student.firstname }} {{student.name}}</h2>
            </v-flex>
        </v-layout>
        <v-layout row-wrap>
            <v-flex xs4 class="text-xs-left">
                <v-breadcrumbs>
                    <v-breadcrumbs-item
                            v-for="breadcrumb in breadcrumbs" :key="breadcrumb.id" :disabled="breadcrumb.disabled"
                    >
                        {{ breadcrumb.text }}
                    </v-breadcrumbs-item>
                </v-breadcrumbs>
            </v-flex>
        </v-layout>
        <v-layout row-wrap>
            <v-flex xs12 sm4 offset-xs1>
                <v-select
                        label="Select"
                        v-bind:items="modulesDropdown"
                        v-model="selectedModuleName"
                        hint="Selecteer een module"
                        persistent-hint
                        @input="selectItem()"
                ></v-select>
            </v-flex>
        </v-layout>
        <v-layout v-if="moduleSelected" row wrap class="text-xs-left">
            <v-flex offset-xs1>
                <div>
                    <v-btn v-if="!newEvalTable" @click="newEval" color="primary"><v-icon class="mr-2">add</v-icon>Nieuwe Evaluatiefiche</v-btn>
                    <v-btn v-if="newEvalTable" @click="newEvalTable = false" color="primary"><v-icon class="mr-2">undo</v-icon>Back</v-btn>
                    <v-btn v-if="newEvalTable && !updateEval" @click="makeJSON" color="primary"><v-icon class="mr-2">save</v-icon>Evaluatie Opslaan</v-btn>
                    <p v-if="evalError" style="display: inline-block" class="red--text">{{evalError}}</p>
                </div>
            </v-flex>
        </v-layout>
        <v-flex xs10 offset-xs1>
            <v-list two-line v-if="moduleSelected && !newEvalTable && gotEvals">
                <v-subheader>{{'Evaluaties van ' + student.firstname + ' ' + student.name}}</v-subheader>
                <template v-for="evaluation in prevEvals[0].evaluaties.slice().reverse()">
                    <v-divider></v-divider>
                    <v-list-tile v-bind:key="evaluation.id" @click="getEvaluation(evaluation.id)">
                        <v-list-tile-content>
                            <v-list-tile-title>{{evaluation.date}} {{evaluation.name}}</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </template>
            </v-list>
        </v-flex>
        <template v-if="newEvalTable">
        <v-flex xs8 offset-xs2>
            <v-layout row-wrap>
                <v-flex>
                    <v-layout row-wrap>
                        <v-flex>
                            <v-card color="gray darken-3" class="black--text text-xs-left" height="100%">
                                <v-container fluid grid-list-lg>
                                    <v-flex>
                                        <v-text-field
                                                name="EvalFicheName"
                                                label="Naam evaluatiefiche"
                                                v-model="evalName"
                                        ></v-text-field>
                                    </v-flex>
                                </v-container>
                            </v-card>
                        </v-flex>
                        <v-flex>
                            <v-layout row-wrap>
                                <v-flex>
                                    <v-card color="gray darken-3" class="black--text text-xs-left" height="100%">
                                        <v-container fluid grid-list-lg>
                                            <v-layout row wrap>
                                                <v-flex>
                                                    <v-menu
                                                            lazy
                                                            :close-on-content-click="false"
                                                            v-model="menu"
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
                                                                v-model="dateFormatted"
                                                                prepend-icon="event"
                                                                @blur="date = parseDate(dateFormatted)"
                                                        ></v-text-field>
                                                        <v-date-picker v-model="date" @input="dateFormatted = formatDate($event)" no-title scrollable actions>
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
                                        </v-container>
                                    </v-card>
                                </v-flex>
                            </v-layout>
                            <v-layout row-wrap>
                                <v-flex>
                                    <v-card color="gray darken-3" class="black--text text-xs-left" height="100%">
                                        <v-container style="text-align: right;" fluid grid-list-lg>
                                            <p>Evaluatie leerkracht</p>
                                            <p><span>JA</span> | <span>NEE</span></p>
                                        </v-container>
                                    </v-card>
                                </v-flex>
                            </v-layout>
                        </v-flex>
                    </v-layout>
                </v-flex>
            </v-layout>
            <v-layout v-for="(cat, i) in selectedModule[0].categorieen" :key="i">
                <v-layout row-wrap class="mb-1">
                    <v-flex>
                        <v-layout row-wrap>
                            <v-flex>
                                <v-card class="black--text text-xs-center display-1" height="100%">
                                    <v-container>
                                        {{i+1}} {{cat.name}}
                                    </v-container>
                                </v-card>
                            </v-flex>
                        </v-layout>
                        <v-layout row-wrap>
                            <v-flex xs12>
                                <v-layout row-wrap v-for="(doel, j) in cat.doelstellingen" :key="j">
                                    <v-flex xs3>
                                        <v-card class="black--text text-xs-left" height="100%">
                                            <v-container fluid grid-list-lg>
                                                {{i+1}}.{{j+1}} {{doel.name}}
                                            </v-container>
                                        </v-card>
                                    </v-flex>
                                    <v-flex xs9>
                                        <v-layout row-wrap v-for="(crit, k) in doel.criteria" :key="k">
                                            <v-flex xs4>
                                                <v-card class="black--text text-xs-left" height="100%">
                                                    <v-container fluid grid-list-lg>
                                                        {{i+1}}.{{j+1}}.{{k+1}} {{crit.name}}
                                                    </v-container>
                                                </v-card>
                                            </v-flex>
                                            <v-flex xs8>
                                                <v-layout row-wrap v-for="(aspect, l) in crit.aspecten" :key="l">
                                                    <v-flex xs6>
                                                        <v-card color="gray darken-3" class="black--text text-xs-left" height="100%">
                                                            <v-container fluid grid-list-lg>
                                                                {{i+1}}.{{j+1}}.{{k+1}}.{{l+1}} {{aspect.name}}
                                                            </v-container>
                                                        </v-card>
                                                    </v-flex>
                                                    <v-flex xs2>
                                                        <v-btn
                                                                class="evalCard black--text text-xs-left"
                                                                style="height: 100%;margin: 0;"
                                                                v-if="activeBoxesCreated"
                                                                v-on:click="logYes(aspect.id)"
                                                                :class="{green: activeBoxes['yes' + aspect.id]}"
                                                        >
                                                            <p>JA</p>
                                                        </v-btn>
                                                    </v-flex>
                                                    <v-flex xs2>
                                                        <v-btn
                                                                class="evalCard black--text text-xs-left"
                                                                style="height: 100%; margin: 0"
                                                                v-if="activeBoxesCreated"
                                                                v-on:click="logNo(aspect.id)"
                                                                :class="{red: activeBoxes['no' + aspect.id]}"
                                                        >
                                                            <p>NEE</p>
                                                        </v-btn>
                                                    </v-flex>
                                                    <v-flex xs2>
                                                        <v-btn
                                                                class="evalCard black--text text-xs-left"
                                                                style="height: 100%; margin: 0"
                                                                v-if="activeBoxesCreated"
                                                                v-on:click="reset(aspect.id)"
                                                        >
                                                            <p>Reset</p>
                                                        </v-btn>
                                                    </v-flex>
                                                </v-layout>
                                            </v-flex>
                                        </v-layout>
                                    </v-flex>
                                </v-layout>
                            </v-flex>
                        </v-layout>
                    </v-flex>
                </v-layout>
            </v-layout>
        </v-flex>
       </template>
    </div>
</template>

<script>
    export default {
      name: 'Evaluatie',
      data () {
        return {
          student: {name: '', firstname: '', id: null},
          breadcrumbs: [
            {id: 0, text: 'test', disabled: false},
            {id: 1, text: '', disabled: false}
          ],
          modulesDropdown: [],
          modules: [],
          selectedModuleName: [],
          selectedModule: {},
          evalFiches: [],
          prevEvals: [],
          moduleSelected: false,
          newEvalTable: false,
          gotEvals: false,
          updateEval: false,
          doelRowSpan: 0,
          activeBoxes: {},
          activeBoxesCreated: false,
          saveEval: {},
          evalName: '',
          evalError: null,
          date: null,
          dateFormatted: null,
          menu: false
        }
      },
      methods: {
        selectItem: function () {
          var self = this
          this.breadcrumbs[1].text = this.selectedModuleName
          var result = this.modules.filter(function (obj) {
            return obj.name === self.selectedModuleName
          })
          this.selectedModule = result
          console.log(this.selectedModule)
          this.moduleSelected = true
          this.newEvalTable = false
          self.createActiveBoxes(this.selectedModule)
          self.prevEvals = []
          this.$http.getEvalsByStudent(this.selectedModule[0].id, this.student.id, function (data) {
            self.prevEvals.push(data)
            console.log(self.prevEvals)
            self.gotEvals = true
          })
        },
        newEval: function () {
          var self = this
          self.newEvalTable = true
          var d = new Date()
          var month = d.getMonth() + 1
          self.dateFormatted = d.getDate() + '/' + month + '/' + d.getFullYear()
          self.evalName = null
          self.createActiveBoxes(this.selectedModule)
          self.updateEval = false
          console.log(self.activeBoxes)
        },
        createActiveBoxes: function (module) {
          this.activeBoxes = {}
          console.log(module)
          for (var i = 0; i < module.length; i++) {
            for (var j = 0; j < module[i].categorieen.length; j++) {
              for (var k = 0; k < module[i].categorieen[j].doelstellingen.length; k++) {
                for (var l = 0; l < module[i].categorieen[j].doelstellingen[k].criteria.length; l++) {
                  for (var m = 0; m < module[i].categorieen[j].doelstellingen[k].criteria[l].aspecten.length; m++) {
                    var objectid = module[i].categorieen[j].doelstellingen[k].criteria[l].aspecten[m].id
                    var objectName = 'yes' + objectid
                    this.activeBoxes[objectName] = null
                    objectName = 'no' + objectid
                    this.activeBoxes[objectName] = null
                  }
                }
              }
            }
          }
          console.log(this.activeBoxes)
          this.activeBoxesCreated = true
        },
        logYes: function (id) {
          this.$set(this.activeBoxes, 'yes' + id, true)
          this.$set(this.activeBoxes, 'no' + id, false)
          this.$forceUpdate()
        },
        logNo: function (id) {
          this.$set(this.activeBoxes, 'yes' + id, false)
          this.$set(this.activeBoxes, 'no' + id, true)
          this.$forceUpdate()
        },
        reset: function (id) {
          this.$set(this.activeBoxes, 'yes' + id, null)
          this.$set(this.activeBoxes, 'no' + id, null)
          this.$forceUpdate()
        },
        makeJSON: function () {
          if (this.evalName !== '') {
            this.evalError = null
            var objKeys = Object.keys(this.activeBoxes)
            var objLength = Object.keys(this.activeBoxes).length
            this.saveEval['name'] = this.evalName
            this.saveEval['studentId'] = this.student.id
            this.saveEval['moduleId'] = this.selectedModule[0].id
            this.saveEval['aspecten'] = []
            this.saveEval['date'] = this.dateFormatted
            for (var i = 0; i < objLength; i = i + 2) {
              var obj = {aspectId: objKeys[i].substr(3), beoordeling: this.activeBoxes[objKeys[i]]}
              this.saveEval['aspecten'].push(obj)
            }
            this.$http.createEval(this.saveEval, function (data) { console.log(data) })
            console.log(this.saveEval)
            this.newEvalTable = false
          } else {
            this.evalError = 'geef een naam op voor de Evaluatiefiche'
          }
        },
        getEvaluation: function (id) {
          var self = this
          self.newEvalTable = true
          var obj = self.prevEvals[0].evaluaties.filter(function (elem) {
            if (elem.id === id) return elem
          })
          console.log(obj)
          self.evalName = obj[0].name
          self.dateFormatted = obj[0].date
          self.createActiveBoxes(this.selectedModule)
          obj[0].aspecten.forEach(function (item) {
            if (item.aspectBeoordeling === '1') {
              self.$set(self.activeBoxes, 'yes' + item.aspectId, true)
              self.$set(self.activeBoxes, 'no' + item.aspectId, false)
            } else if (item.aspectBeoordeling === '0') {
              self.$set(self.activeBoxes, 'yes' + item.aspectId, false)
              self.$set(self.activeBoxes, 'no' + item.aspectId, true)
            }
          })
          this.$forceUpdate()
          self.updateEval = true
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
        }
      },
      created () {
        var self = this
        var studentId = this.$route.query.id
        this.$http.getStudent(studentId, function (data) {
          self.student.firstname = data.student.firstname
          self.student.name = data.student.lastname
          self.student.id = data.student.id
          self.breadcrumbs[0].text = data.opleiding.name
        })
        this.$http.getEvalForStudent(studentId, function (data) {
          self.modules = data.modules
          for (var i = 0; i < self.modules.length; i++) {
            self.modulesDropdown.push(self.modules[i].name)
          }
        })
      }
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
p{
    margin-bottom: 0;
}
input[type="radio"]{
    display:inline-block;
    position: absolute;
    left: 33%;
    top: 50%;
    transform: translateY(-50%) scale(3);
}
</style>
