<template>
 <v-flex xs12 sm6 class="ma-0">
    <v-select
                  v-bind:items="list"
                  :item-text="item.firstname"
                  :item-value="list.id"
                  v-model="selecteditem"
                  :label="`Zoek een ${labeltext}`"
                  no-data-text="Er werd niets gevonden"
                  autocomplete
                  @input="selectStudent()"
                ></v-select>
</v-flex>
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
  methods: {
    selectStudent: function () {
      // this.$emit('select-student', this.opleidingen)
    }
  },
  computed: {
    searchable_data: function () {
      var self = this
      var array = []
      self.list.forEach(function (item) {
        var string = ''
        self.concat_keys.forEach(function (key, i) {
          console.log('int' + i)
          string += item[key]
          if (i !== self.concat_keys.length - 1) {
            string += ' '
          }
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

menu__content--autocomplete{
  color:red
}

</style>
