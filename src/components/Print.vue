<template>

<main>
  <v-layout row-wrap>
      <v-flex xs12 offset-xs1 class="text-xs-left">
        <h1 class="display-3">Rapporten afdrukken</h1>
      </v-flex>
  </v-layout>
  <v-layout row-wrap class="mt-5">
  <v-flex xs2 offset-xs1>
    <checkboxes :listobject="opleidingen"></checkboxes>
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
        <td class="text-xs-left">{{ props.item.student }}</td>
        <td class="text-xs-left">{{ props.item.opleiding }}</td>
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
      opleidingen: ['drank', 'sletten', 'kapper']
    }
  }
}
</script>
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
