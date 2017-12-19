<template>
  <main>
    <v-layout row-wrap>
        <v-flex xs12 offset-xs1 class="text-xs-left">
          <h1 class="display-3">Opleidingen</h1>
        </v-flex>
    </v-layout>
    <template v-if="!editMode">
    <v-layout row-wrap>
        <v-flex xs4 offset-xs1>
          <searchbar @select-item="applySelection" :list="items" :concat_keys="keys" :labeltext="zoeklabel" :item_concat_key="item_name" :item_value="item_value"></searchbar>
        </v-flex>
        <v-flex xs1 offset-xs4 class="mr-5">
          <v-btn class="primary" @click="editMode=true">+ Nieuwe Opleiding</v-btn>
        </v-flex>
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
            <tr v-if="checkSelected(props.item.id)">
            <td class="text-xs-left">{{ props.item.name }}</td>
            <td class="text-xs-right">
              <v-btn color="error" class="ma-1 right" dark><v-icon dark>delete</v-icon></v-btn>
              <v-btn color="primary" class="ma-1 right" slot="activator" dark><v-icon dark>edit</v-icon></v-btn>
            </td>
            </tr>
          </template>
        </v-data-table>
      </v-flex>
    </v-layout>
  </template>
  <v-container>
    <subjecteditor v-if="editMode"></subjecteditor>
  </v-container>
  </main>
</template>

<script>
export default {
  name: 'Subjects',
  data () {
    return {
      filename: '',
      formData: [],
      editMode: false,
      addSubjectFile: false,
      headers: [
        { text: 'Opleiding', align: 'left', value: 'opleiding' },
        { text: '', value: 'actionbtns' }
      ],
      items: [],
      filters: [],
      selectedid: null,
      keys: ['name'],
      zoeklabel: 'Opleiding',
      item_name: 'name',
      item_value: 'id'
    }
  },
  methods: {
    applySelection (payload) {
      this.selectedid = payload
    },
    uploadFiles () {
      const form = this.formData
      console.log(form)
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
    this.$http.getOpleidingen(function (data) {
      self.items = data
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
