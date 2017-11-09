<template>
  <div>
      <v-layout row wrap>
          <v-flex xs12 offset-xs1 class="text-xs-left">
            <h1 class="display-3">Studenten</h1>
          </v-flex>
      </v-layout>
      <v-layout row wrap>
          <v-flex xs6 offset-xs1>
              <v-toolbar>
                <v-text-field  prepend-icon="search" hide-details single-line></v-text-field>
              </v-toolbar>
          </v-flex>
      </v-layout>
      <v-layout row wrap>
          <v-flex xs6 offset-xs1>
            <checkboxes :listobject="opleidingen"></checkboxes>
          </v-flex>
      </v-layout>
  </div>
</template>

<script>
export default {
  name: 'Studenten',
  data () {
    return {
      opleidingen: ['Kapper', 'sletten', 'drank']
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
