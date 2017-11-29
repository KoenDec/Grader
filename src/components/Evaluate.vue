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
                        v-model="selectedModule"
                        hint="Selecteer een module"
                        persistent-hint
                        @input="selectItem()"
                ></v-select>
            </v-flex>
        </v-layout>
        <v-layout row wrap class="text-xs-left">
            <v-flex offset-xs1>
                <div>
                    <v-btn color="primary"><v-icon>add</v-icon>Nieuwe Evaluatiefiche</v-btn>
                </div>
            </v-flex>
        </v-layout>
        <v-layout row wrap>
            <table>
                <tr>
                    <th></th>
                </tr>
            </table>
        </v-layout>
    </div>
</template>

<script>
    export default {
      name: 'Studenten',
      data () {
        return {
          student: {name: '', firstname: ''},
          breadcrumbs: [
              {id: 0, text: 'test', disabled: false},
              {id: 1, text: '', disabled: false}
          ],
          modulesDropdown: [],
          modules: [],
          selectedModule: []
        }
      },
      methods: {
        selectItem: function () {
          this.breadcrumbs[1].text = this.selectedModule
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

</style>
