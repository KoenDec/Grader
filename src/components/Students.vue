<template>
  <div>
      <v-layout row wrap>
          <v-flex xs12 offset-xs1 class="text-xs-left">
            <h1 class="display-3">Studenten</h1>
          </v-flex>
      </v-layout>
      <v-layout row wrap>
          <v-flex xs4 offset-xs1 ref="results" @>
            <searchbar @select-item="applySelection" :list="items" :concat_keys="keys" :labeltext="zoeklabel" :item_concat_key="item_name" :item_value="item_value"></searchbar>
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
                <tr v-if="!filters.includes(props.item.opleidingName) && checkSelected(props.item.id)">
                <td class="text-xs-left">{{ props.item.firstname + ' ' + props.item.lastname  }}</td>
                <td class="text-xs-left">{{ props.item.opleidingName }}</td>
                <td>
                  <v-btn color="error" class="ma-1 right" dark><v-icon dark>delete</v-icon></v-btn>
                  <router-link :to="{ path: 'Addstudent', query: { id: props.item.id }}"><v-btn color="primary" class="ma-1 right" dark><v-icon dark>edit</v-icon></v-btn></router-link>
                    <router-link :to="{ path: 'rapporten', query: { id: props.item.id, name: props.item.firstname + ' ' + props.item.lastname }}"><v-btn color="primary" class="ma-1 right" dark>rapport<v-icon dark right>import_contacts</v-icon></v-btn></router-link>
                    <a :href="'#/Evaluate?id=' + props.item.id" target="_blank"><v-btn color="primary" class="ma-1 right" dark>Evaluatie<v-icon dark right>assignment</v-icon></v-btn></a>
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
  name: 'Students',
  data () {
    return {
      filename: '',
      formData: [],
      addStudentsFile: false,
      search: '',
      receivedData: false,
      selectedid: null,
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
    },
    checkSelected (id) {
      if (this.selectedid === null) {
        return true
      } else if (this.selectedid === id) {
        return true
      } else {
        return false
      }
    }
  },
  created () {
    var self = this
    this.$http.getStudentsWithEdu(function (data) {
      self.items = data
    })
    this.$http.getOpleidingen(function (data) {
      self.opleidingen = data
      self.receivedData = true
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
