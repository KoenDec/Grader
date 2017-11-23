<template>
  <main>
    <v-layout row-wrap>
        <v-flex xs12 offset-xs1 class="text-xs-left">
          <h1 class="display-3">Opleidingen</h1>
        </v-flex>
    </v-layout>
    <v-layout row-wrap>
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
          >
            <v-icon>add</v-icon>
          </v-btn>
          <v-btn
            fab
            dark
            small
            color="yellow"
            @click.stop="addSubjectFile = true"
          >
            <v-icon>file_upload</v-icon>
          </v-btn>
          <v-btn
            fab
            dark
            small
            color="red"
          >
            <v-icon>note_add</v-icon>
          </v-btn>
        </v-speed-dial>
    </v-layout>
    <v-layout row-wrap>
      <v-flex class="mt-5" offset-xs1 xs10>
        <v-data-table
          v-bind:headers="headers"
          :items="items"
          hide-actions
          class="elevation-1"
        >
          <template slot="items" slot-scope="props">
            <td class="text-xs-left">{{ props.item.name }}</td>
            <td class="text-xs-right">
              <v-btn color="error" class="ma-1 right" dark><v-icon dark>delete</v-icon></v-btn>
              <v-btn color="primary" class="ma-1 right" slot="activator" dark><v-icon dark>edit</v-icon></v-btn>
            </td>
          </template>
        </v-data-table>
      </v-flex>
      <v-dialog v-model="addSubjectFile">
        <v-card>
          <v-card-title><span class="headline">Opleidingen toevoegen</span></v-card-title>
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
              <v-btn color="primary" flat @click.stop="addSubjectFile=false">Close</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-layout>
  </main>
</template>

<script>
export default {
  name: 'Subjects',
  data () {
    return {
      filename: '',
      formData: [],
      addSubjectFile: false,
      headers: [
        { text: 'Opleiding', align: 'left', value: 'opleiding' },
        { text: '', value: 'actionbtns' }
      ],
      items: []
    }
  },
  methods: {
    uploadFiles () {
      const form = this.formData
      console.log(form)
    }
  },
  created () {
    var self = this
    this.$http.get('http://146.185.183.217/api/opleidingen')
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
