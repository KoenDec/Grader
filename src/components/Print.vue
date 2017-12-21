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
    <datatableselects></datatableselects>
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
    this.$http.getStudentsWithEdu(function (data) {
      self.items = data
    })
    this.$http.getOpleidingen(function (data) {
      self.opleidingen = data
      self.receivedData = true
    })
  }
}
</script>
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
