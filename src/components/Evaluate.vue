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
        <v-layout v-if="newEvalTable && moduleSelected" row wrap>
            <v-flex offset-xs1>
                <table>
                    <tr>
                        <th rowspan="2">
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
                    <v-flex v-for="cat in selectedModule.categorieen" :key="cat.id">
                        <tr><th rowspan="4">{{cat.name}}</th></tr>
                    </v-flex>
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
          newEvalTable: false
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
th, tr{
    border: 1px black solid
}
</style>
