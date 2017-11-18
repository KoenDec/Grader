<template>
  <v-flex xs12 offset-xs1>
    <v-checkbox  v-bind:label="`Alles selecteren`" v-model="allSelect" @change="changeOpleidingCheckboxStates(allSelect)" light></v-checkbox>
    <v-checkbox class="ml-4" v-for="(item, i) in opleidingen" :key="i" v-bind:label="`${opleidingen[i].opleiding}`" @change="checkAll()" v-model="opleidingen[i].value" light></v-checkbox>
  </v-flex>
</template>

<script>
export default {
  name: 'Print',
  props: ['listobject'],
  data () {
    return {
      allSelect: true,
      opleidingen: []
    }
  },
  methods: {
    changeOpleidingCheckboxStates (val) {
      for (var i = 0; i < this.listobject.length; i++) {
        this.opleidingen[i].value = val
      }
    },
    checkAll () {
      for (var i = 0; i < this.opleidingen.length; i++) {
        if (this.opleidingen[i].value === false) {
          this.allSelect = false
          return
        } else {
          this.allSelect = true
        }
      }
    }
  },
  created () {
    for (var i = 0; i < this._props.listobject.length; i++) {
      this.opleidingen.push({'opleiding': this._props.listobject[i].name, 'value': true})
    }
  },
  computed: {
    /* opleidingen: function () {
      var data = []
      for (var i = 0; i < this._props.listobject.length; i++) {
        data.push({'opleiding': this._props.listobject[i].name, 'value': true})
      }
      return data
    } */
  }
}
</script>
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
