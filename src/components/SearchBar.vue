<template>
    <v-select
                  v-bind:items="searchable_data"
                  v-model="selecteditem"
                  v-bind:label="`${labeltext}`"
                  autocomplete
                ></v-select>

</template>

<script>
export default {
  name: 'SearchBar',
  props: ['list', 'concat_keys', 'labeltext'],
  data () {
    return {
      selecteditem: ''
    }
  },
  computed: {
    searchable_data: function () {
      var self = this
      var array = []
      self.list.forEach(function (item) {
        var string = ''
        self.concat_keys.forEach(function (key) {
          string += item[key] + ' '
        })
        array.push(string)
      })
      return array
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
