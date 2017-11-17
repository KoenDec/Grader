<template>
  <div>
      <v-layout row wrap>
          <v-flex xs12 offset-xs1 class="text-xs-left">
            <h1 class="display-3">Studenten</h1>
          </v-flex>
      </v-layout>
      <v-layout row wrap>
          <v-flex xs4 offset-xs1>
              <v-toolbar>
                <v-text-field  prepend-icon="search" hide-details single-line></v-text-field>
              </v-toolbar>
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
              @click="logIt"
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
            <checkboxes :listobject="opleidingen"></checkboxes>
          </v-flex>
          <v-flex class="mt-4" xs8>
            <v-data-table
            v-bind:headers="headers"
            :items="items"
            hide-actions
            class="elevation-1"
            >
              <template slot="items" scope="props">
                <td class="text-xs-left">{{ props.item.firstname + ' ' + props.item.lastname  }}</td>
                <td class="text-xs-left">{{ props.item.opleiding }}</td>
                <td>
                  <v-btn color="error" class="ma-1 right" dark><v-icon dark>delete</v-icon></v-btn>
                  <v-btn color="primary" class="ma-1 right" slot="activator" dark><v-icon dark>edit</v-icon></v-btn>
                  <v-btn color="primary" class="ma-1 right" dark>rapport<v-icon dark right>import_contacts</v-icon></v-btn>
                </td>
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
      selected: [],
      headers: [
        { text: 'Student', align: 'left', value: 'student' },
        { text: 'Opleiding', align: 'left', value: 'opleiding' },
        { text: '', value: 'rapportid' }
      ],
<<<<<<< HEAD
      items: [],
      opleidingen: ['drank', 'sletten', 'kapper']
    }
  },
  methods: {
    uploadFiles () {
      const form = this.formData
      console.log(form)
    },
    logIt () {
      console.log(this)
=======
      items: [
        {
          value: false,
          student: 'MuslimParents Suicidebomber',
          opleiding: 'Drank',
          rapportid: 1
        },
        {
          value: false,
          student: 'Pleblord gayParentsFaggot',
          opleiding: 'sletten',
          rapportid: 2
        },
        {
          value: false,
          student: 'Dickbutt Quak',
          opleiding: 'Drank',
          rapportid: 3
        }
      ],
      opleidingen: ['drank', 'sletten', 'kapper'],
      methods: {
        uploadFiles () {
          const form = this.formData
          console.log(form)
        },
        route (path) {
          this.$router.push(path)
        }
      }
>>>>>>> 1c9f8ea455fdd945b76493456e0b1abf6298ecd5
    }
  },
  created () {
    var self = this
    this.$http.get('http://146.185.183.217/api/students')
      .then(function (response) {
        self.items = response.data
        console.log(self.items)
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
