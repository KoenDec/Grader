<template>
  <main>
    <v-layout row-wrap>
        <v-flex xs12 offset-xs1 class="text-xs-left">
          <h1 class="display-3">Rapporten</h1>
        </v-flex>
    </v-layout>
    <v-layout row-wrap>
        <v-flex xs6 offset-xs1>
            <v-toolbar>
              <v-text-field  prepend-icon="search" hide-details single-line></v-text-field>
            </v-toolbar>
        </v-flex>
        <v-flex>
          <v-btn large color="primary"><v-icon>vertical_align_bottom</v-icon></v-btn>
          <v-btn large color="primary"><v-icon></v-icon></v-btn>
        </v-flex>
    </v-layout>
  </main>
</template>

<script>
export default {
  name: 'Reports',
  data () {
    return {

    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
