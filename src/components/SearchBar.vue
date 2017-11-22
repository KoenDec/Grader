<template>
 <v-flex xs12 sm6 class="ma-0">
    <v-select
                  :items="searchable_data"
                  :item-text="`${item_concat_key}`"
                  :item-value="`${item_value}`"
                  v-model="selecteditem"
                  :label="`Zoek een ${labeltext}`"
                  no-data-text="Er werd niets gevonden"
                  autocomplete
                  @input="selectItem()"
                  @update:searchInput="checkSelected"
                ></v-select>
</v-flex>
</template>

<script>
export default {
  name: 'SearchBar',
  props: ['list', 'concat_keys', 'labeltext', 'item_concat_key', 'item_value'],
  data () {
    return {
      selecteditem: ''
    }
  },
  methods: {
    selectItem: function () {
      this.$emit('select-student', this.selecteditem)
    },
    checkSelected: function (payload) {
      this.selecteditem = ''
    }
  },
  computed: {
    searchable_data: function () {
      var self = this
      var array = []
      self.list.forEach(function (item) {
        var object = {}
        object[self.item_concat_key] = 'vuile slet'
        var string = ''
        self.concat_keys.forEach(function (key, i) {
          console.log('int' + i)
          string += item[key]
          if (i !== self.concat_keys.length - 1) {
            string += ' '
          }
        })
        object[self.item_concat_key] = string
        object[self.item_value] = item.id
        array.push(object)
      })
      return array
    }
  },
  created () {
    console.log(this.list)
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

menu__content--autocomplete{
  color:red
}

</style>
