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
        <template v-if="newEvalTable">
        <v-layout row-wrap>
            <v-flex xs10 offset-xs1>
                <v-layout row-wrap>
                    <v-flex xs6>
                        <v-card color="cyan darken-3" class="white--text text-xs-left" height="100%">
                            <v-container fluid grid-list-lg>
                                <v-flex>
                                    <v-text-field
                                            name="EvalFicheName"
                                            label="Naam evaluatiefiche"
                                    ></v-text-field>
                                </v-flex>
                            </v-container>
                        </v-card>
                    </v-flex>
                    <v-flex xs6>
                        <v-layout row-wrap>
                            <v-flex xs12>
                                <v-card color="cyan darken-3" class="white--text text-xs-left" height="100%">
                                    <v-container fluid grid-list-lg>
                                        datum:<input type="date" name="EvalDate" id="EvalDate" />
                                    </v-container>
                                </v-card>
                            </v-flex>
                        </v-layout>
                        <v-layout row-wrap>
                            <v-flex xs6>
                                <v-card color="cyan darken-3" class="white--text text-xs-left" height="100%">
                                    <v-container fluid grid-list-lg>
                                        <p>Evaluatie leerkracht</p>
                                        <p><span class="ml-5">JA</span><span class="right mr-5">NEE</span></p>
                                    </v-container>
                                </v-card>
                            </v-flex>
                            <v-flex xs6>
                                <v-card color="cyan darken-3" class="white--text text-xs-left" height="100%">
                                    <v-container fluid grid-list-lg>
                                        <p>Eindevaluatie leerkracht</p>
                                        <p>RO/O/V/G</p>
                                    </v-container>
                                </v-card>
                            </v-flex>
                        </v-layout>
                    </v-flex>
                </v-layout>
            </v-flex>
        </v-layout>
        <v-layout v-for="(cat, i) in selectedModule[0].categorieen" :key="i">
            <v-layout row-wrap xs10>
                <v-flex offset-xs1>
                    <v-layout row-wrap>
                        <v-flex xs11>
                            <v-card color="cyan darken-1" class="white--text text-xs-center display-1" height="100%">
                                <v-container>
                                    {{i+1}} {{cat.name}}
                                </v-container>
                            </v-card>
                        </v-flex>
                    </v-layout>
                    <v-layout row-wrap>
                        <v-flex xs11>
                            <v-layout row-wrap v-for="(doel, j) in cat.doelstellingen" :key="j">
                                <v-flex xs2>
                                    <v-card color="cyan darken-3" class="white--text text-xs-left" height="100%">
                                        <v-container fluid grid-list-lg>
                                            {{i+1}}.{{j+1}} {{doel.name}}
                                        </v-container>
                                    </v-card>
                                </v-flex>
                                <v-flex xs10>
                                    <v-layout row-wrap v-for="(crit, k) in doel.criteria" :key="k">
                                        <v-flex xs2>
                                            <v-card color="cyan darken-3" class="white--text text-xs-left" height="100%">
                                                <v-container fluid grid-list-lg>
                                                    {{i+1}}.{{j+1}}.{{k+1}} {{crit.name}}
                                                </v-container>
                                            </v-card>
                                        </v-flex>
                                        <v-flex xs7>
                                            <v-layout row-wrap v-for="(aspect, l) in crit.aspecten" :key="l">
                                                <v-flex xs5>
                                                    <v-card color="cyan darken-3" class="white--text text-xs-left" height="100%">
                                                        <v-container fluid grid-list-lg>
                                                            {{i+1}}.{{j+1}}.{{k+1}}.{{l+1}} {{aspect.name}}
                                                        </v-container>
                                                    </v-card>
                                                </v-flex>
                                                <v-flex xs2>
                                                    <v-card color="cyan darken-3" class="evalCard white--text text-xs-left" height="100%">
                                                        <v-container fluid grid-list-lg>
                                                            <div class="evalCel">
                                                                <input type="radio" value="yes" :name="'eval' + i + j + k + l">
                                                            </div>
                                                        </v-container>
                                                    </v-card>
                                                </v-flex>
                                                <v-flex xs1></v-flex>
                                                <v-flex xs2>
                                                    <v-card color="cyan darken-3" class="evalCard white--text text-xs-left" height="100%">
                                                        <v-container fluid grid-list-lg>
                                                            <div class="evalCel">
                                                                <input type="radio" value="no" :name="'eval' + i + j + k + l">
                                                            </div>
                                                        </v-container>
                                                    </v-card>
                                                </v-flex>
                                            </v-layout>
                                        </v-flex>
                                        <v-flex xs4>
                                            <v-card color="cyan darken-3" class="mr-4 white--text text-xs-left" height="100%">
                                                <v-container fluid grid-list-lg>

                                                </v-container>
                                            </v-card>
                                        </v-flex>
                                    </v-layout>
                                </v-flex>
                            </v-layout>
                        </v-flex>
                    </v-layout>
                </v-flex>
            </v-layout>
        </v-layout>
       </template>
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
        },
        selectEvalCel: function () {
          console.log('clicked')
        }
      },
      created () {
        var self = this
        var studentId = this.$route.query.id
        this.$http.getStudent(studentId, function (data) {
          self.student.firstname = data.student.firstname
          self.student.name = data.student.lastname
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
th, tr, td{
    border: 1px black solid
}
.evalCel{
    width: 50px;
    height:50px;
    margin:auto;
    position:relative;
}

.evalCard{
    width: 150px;
    margin-left: 50px;
}

input[type="radio"]{
    display:inline-block;
    position: absolute;
    left: 33%;
    top: 50%;
    transform: translateY(-50%) scale(3);
}
</style>
