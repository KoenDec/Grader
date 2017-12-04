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
                    <v-btn color="primary"><v-icon>repeat</v-icon>Vorige Evaluatiefiches</v-btn>
                    <v-btn @click="newEval" color="primary"><v-icon>add</v-icon>Nieuwe Evaluatiefiche</v-btn>
                </div>
            </v-flex>
        </v-layout>
        <v-layout v-if="newEvalTable" row wrap v-for="(cat, i) in selectedModule[0].categorieen">
            <v-flex offset-xs1>
                <v-layout row-wrap>
                    <v-flex xs12>
                        <v-card color="cyan darken-1" class="white--text text-xs-center display-1" height="100%">
                            <v-container>
                                {{i+1}} {{cat.name}}
                            </v-container>
                        </v-card>
                    </v-flex>
                </v-layout>
                    <v-flex xs10>
                        <v-layout row-wrap v-for="(doel, j) in cat.doelstellingen">
                            <v-flex xs2>
                                <v-card color="cyan darken-3" class="white--text text-xs-left" height="100%">
                                    <v-container fluid grid-list-lg>
                                        {{i+1}}.{{j+1}} {{doel.name}}
                                    </v-container>
                                </v-card>
                            </v-flex>
                            <v-flex xs10>
                                <v-layout row-wrap v-for="(crit, k) in doel.criteria">
                                    <v-flex xs2>
                                        <v-card color="cyan darken-3" class="white--text text-xs-left" height="100%">
                                            <v-container fluid grid-list-lg>
                                                {{i+1}}.{{j+1}}.{{k+1}} {{crit.name}}
                                            </v-container>
                                        </v-card>
                                    </v-flex>
                                    <v-flex xs10>
                                        <v-layout row-wrap v-for="(aspect, l) in crit.aspecten">
                                            <v-flex xs4>
                                                <v-card color="cyan darken-3" class="white--text text-xs-left">
                                                    <v-container fluid grid-list-lg>
                                                        {{i+1}}.{{j+1}}.{{k+1}}.{{l+1}} {{aspect.name}}
                                                    </v-container>
                                                </v-card>
                                            </v-flex>
                                        </v-layout>
                                    </v-flex>
                                </v-layout>
                            </v-flex>
                        </v-layout>
                    </v-flex>
                <table>
                    <tr>
                        <th rowspan="2" colspan="3">
                            <v-flex>
                                <v-text-field
                                        name="EvalFicheName"
                                        label="Naam evaluatiefiche"
                                ></v-text-field>
                            </v-flex>
                        </th>
                        <th colspan="3">datum:<input type="date" name="EvalDate" id="EvalDate" /></th>
                    </tr>
                    <tr>
                        <th colspan="2">Evaluatie (JA | NEE)</th><th>Eind Evaluatie</th>
                    </tr>
                    <template v-for="cat in selectedModule[0].categorieen">
                        <tr><th>{{cat.name}}</th><td colspan="5"></td></tr>
                        <template v-for="doel in cat.doelstellingen">
                            <tr>
                                <td :rowspan="1">{{doel.name}}</td>
                            </tr>
                            <template v-for="crit in doel.criteria">
                                <tr>
                                    <td :rowspan="crit.aspecten.length">{{crit.name}}</td>
                                </tr>
                                <template v-for="aspect in crit.aspecten">
                                    <tr>
                                        <td>{{aspect.name}}</td><td class="empty-cel"></td><td class="empty-cel"></td><td class="empty-cel"></td>
                                    </tr>
                                </template>
                            </template>
                        </template>
                    </template>
                </table>
            </v-flex>
        </v-layout>
    </div>
</template>

<script>
    export default {
      name: 'Evaluatie',
      data () {
        return {
          student: {name: '', firstname: ''},
          breadcrumbs: [
            {id: 0, text: 'test', disabled: false},
            {id: 1, text: '', disabled: false}
          ],
          modulesDropdown: [],
          modules: [],
          selectedModuleName: [],
          selectedModule: {},
          evalFiches: [],
          moduleSelected: false,
          newEvalTable: false,
          doelRowSpan: 0
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
        },
        newEval: function () {
          this.newEvalTable = true
        }
      },
      created () {
        var self = this
        var studentId = this.$route.query.id
        this.$http.get('http://146.185.183.217/api/student?id=' + studentId)
          .then(function (response) {
            console.log(response.data)
            self.student.firstname = response.data.student.firstname
            self.student.name = response.data.student.lastname
            self.breadcrumbs[0].text = response.data.opleiding.name
          })
          .catch(function (error) {
            console.log(error)
          })

        this.$http.get('http://146.185.183.217/api/evaluatieVoorStudent?id=' + studentId)
          .then(function (response) {
            console.log(response.data)
            self.modules = response.data.modules
            console.log(self.modules)
            for (var i = 0; i < self.modules.length; i++) {
              self.modulesDropdown.push(self.modules[i].name)
            }
          })
          .catch(function (error) {
            console.log(error)
          })
      }
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
th, tr, td{
    border: 1px black solid
}
.empty-cel{
    width: 50px;
    height:50px;
}
</style>
