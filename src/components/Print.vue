<template>

<main>
  <v-layout row-wrap>
      <v-flex xs12 offset-xs1 class="text-xs-left">
        <h1 class="display-3">Rapporten afdrukken</h1>
      </v-flex>
  </v-layout>
  <v-layout row-wrap class="mt-5">
  <v-flex xs2 offset-xs1>
    <checkboxes :listobject="opleidingen" v-if="receivedData"></checkboxes>
  </v-flex>
  <v-flex xs6>
    <v-data-table
      v-bind:headers="headers"
      v-bind:items="items"
      v-bind:search="search"
      v-model="selected"
      item-key="student"
      select-all
      class="elevation-1"
    >
      <template slot="headerCell" scope="props">
        <v-tooltip bottom>
          <span slot="activator">
            {{ props.header.text }}
          </span>
          <span>
            {{ props.header.text }}
          </span>
        </v-tooltip>
      </template>
      <template slot="items" scope="props">
        <td>
          <v-checkbox
            primary
            hide-details
            v-model="props.selected"
          ></v-checkbox>
        </td>
        <td class="text-xs-left">{{ props.item.firstname + ' ' + props.item.lastname  }}</td>
        <td class="text-xs-left">{{ props.item.opleidingName }}</td>
        <td><v-btn color="primary" class="ma-1 right" dark>rapport<v-icon dark right>import_contacts</v-icon></v-btn></td>
      </template>
    </v-data-table>
  </v-flex>
  <v-flex xs2>
    <v-btn color="primary" class="ma-1 left" dark><v-icon dark>print</v-icon></v-btn>
    <v-btn color="primary" class="ma-1 left" dark><v-icon dark>get_app</v-icon></v-btn>
  </v-flex>
    </v-layout>
</main>
</template>

<script>
export default {
  name: 'Print',
  data () {
    return {
      search: '',
      selected: [],
      headers: [
        { text: 'Student', align: 'left', value: 'student' },
        { text: 'Opleiding', align: 'left', value: 'opleiding' },
        { text: '', value: 'rapportid' }
      ],
      receivedData: false,
      items: [],
      opleidingen: []
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
  }
}
</script>
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
