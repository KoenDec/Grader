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
        <v-flex xs1 offset-xs4>
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
      <v-flex class="mt-5" offset-xs2 xs8>
        <v-data-table
          v-bind:headers="headers"
          :items="items"
          hide-actions
          class="elevation-1"
        >
          <template slot="items" scope="props">
            <td class="text-xs-left">{{ props.item.opleiding }}</td>
            <td class="text-xs-right">
              <v-btn color="error" class="ma-1 right" dark><v-icon dark>delete</v-icon></v-btn>
              <v-btn color="primary" class="ma-1 right" slot="activator" dark><v-icon dark>edit</v-icon></v-btn>
            </td>
          </template>
        </v-data-table>
      </v-flex>
    </v-layout>
  </main>
</template>

<script>
export default {
  name: 'Subjects',
  data () {
    return {
      headers: [
        { text: 'Opleiding', align: 'left', value: 'opleiding' },
        { text: 'Acties', value: 'actionbtns' }
      ],
      items: [
        {
          value: false,
          opleiding: 'Sletten',
          actionbtns: 1
        },
        {
          value: false,
          opleiding: 'Drank',
          actionbtns: 2
        },
        {
          value: false,
          opleiding: 'Kapper',
          actionbtns: 3
        }
      ]
    }
  }
}
</script>
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
