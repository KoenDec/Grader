<template>
  <div>
      <v-layout row wrap>
          <v-flex xs12 offset-xs1 class="text-xs-left">
            <h1 class="display-3">Studenten</h1>
          </v-flex>
      </v-layout>
      <v-layout row wrap>
          <v-flex xs4 offset-xs1 ref="results" @>
            <searchbar @select-student="applySelection" :list="items" :concat_keys="keys" :labeltext="zoeklabel" :item_concat_key="item_name" :item_value="item_value"></searchbar>
          </v-flex>
          <v-flex xs1 offset-xs4 class="mr-5">
          </v-flex>
          <v-speed-dial
            hover
            direction="left"
          >
            <v-btn
              slot="activator"
              color="blue darken-2"
              dark
              fab
              hover
              class="left"
            >
              <v-icon>add</v-icon>
            </v-btn>
            <v-btn
              fab
              dark
              small
              color="yellow"
              @click.stop="addStudentsFile = true"
            >
              <v-icon>file_upload</v-icon>
            </v-btn>
            <router-link to="AddStudent" style="text-decoration: none">
              <v-btn
                fab
                dark
                small
                color="red"
              >
                 <v-icon>person_add</v-icon>
              </v-btn>
            </router-link>
          </v-speed-dial>
      </v-layout>
      <v-layout row wrap>
          <v-flex class="mt-4" offset-xs1 xs2>
            <checkboxes :listobject="opleidingen" v-if="receivedData" @update-filters="applyFilters"></checkboxes>
          </v-flex>
          <v-flex class="mt-4" xs8>
            <v-data-table
            v-bind:headers="headers"
            :items="items"
            hide-actions
            class="elevation-1"
            >
              <template slot="items" slot-scope="props">
                <tr v-if="!filters.includes(props.item.opleidingName) && selectedid === props.item.id || selectedid === ''">
                <td class="text-xs-left">{{ props.item.firstname + ' ' + props.item.lastname  }}</td>
                <td class="text-xs-left">{{ props.item.opleidingName }}</td>
                <td>
                  <v-btn color="error" class="ma-1 right" dark><v-icon dark>delete</v-icon></v-btn>
                  <router-link :to="{ path: 'Addstudent', query: { id: props.item.id }}"><v-btn color="primary" class="ma-1 right" dark><v-icon dark>edit</v-icon></v-btn></router-link>
                  <v-btn color="primary" class="ma-1 right" dark>rapport<v-icon dark right>import_contacts</v-icon></v-btn>
                  <router-link :to="{ path: 'Evaluate', query: { id: props.item.id }}"><v-btn color="primary" class="ma-1 right" dark>Evaluatie<v-icon dark right>assignment</v-icon></v-btn></router-link>
                </td>
              </tr>
              </template>
            </v-data-table>
          </v-flex>
          <v-dialog v-model="addStudentsFile">
            <v-card>
              <v-card-title><span class="headline">Studenten toevoegen</span></v-card-title>
              <v-card-text>
                <v-container grid-list-md>
                  <v-layout wrap>
                    <v-flex xs12>
                      <fileInput v-model="filename" @formData="formData"></fileInput>
                    </v-flex>
                  </v-layout>
                </v-container>
              </v-card-text>
              <v-card-actions>
                  <v-btn color="primary" flat @click.stop="addStudentsFile=false">Close</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
      </v-layout>
  </div>
</template>

<script>
export default {
  name: 'Studenten',
  data () {
    return {
      filename: '',
      formData: [],
      addStudentsFile: false,
      search: '',
      receivedData: false,
      selectedid: '',
      filters: [],
      keys: ['firstname', 'lastname'],
      item_name: 'fullname',
      item_value: 'id',
      zoeklabel: 'student',
      headers: [
        { text: 'Student', align: 'left', value: 'student' },
        { text: 'Opleiding', align: 'left', value: 'opleiding' },
        { text: '', value: 'rapportid' }
      ],
      items: [],
      opleidingen: []
    }
  },
  methods: {
    uploadFiles () {
      const form = this.formData
      console.log(form)
    },
    applyFilters (payload) {
      var self = this
      payload.forEach(function (filter) {
        if (self.filters.includes(filter.opleiding)) {
          if (filter.value === true) {
            const index = self.filters.indexOf(filter.opleiding)
            self.filters.splice(index, 1)
          }
        } else if (filter.value === false) {
          self.filters.push(filter.opleiding)
        }
      })
    },
    applySelection (payload) {
      this.selectedid = payload
    }
  },
  created () {
    var self = this
    this.$http.get('http://146.185.183.217/api/studentenMetOpleiding')
      .then(function (response) {
        self.items = response.data
        console.log(self.items)
      })
      .catch(function (error) {
        console.log(error)
      })
    this.$http.get('http://146.185.183.217/api/opleidingen')
        .then(function (response) {
          self.opleidingen = response.data
          console.log(self.opleidingen)
          self.receivedData = true
        })
        .catch(function (error) {
          console.log(error)
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
