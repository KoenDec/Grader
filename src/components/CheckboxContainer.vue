<template>
  <v-flex xs12 offset-xs1>
    <v-checkbox  v-bind:label="`Alles selecteren`" v-model="allSelect" @change="changeOpleidingCheckboxStates(allSelect)" light></v-checkbox>
    <v-checkbox class="ml-4" v-for="(item, i) in opleiding" v-bind:label="`Opleiding ${i}`" @change="checkAll(opleiding[i])" v-model="opleiding[i]" light></v-checkbox>
  </v-flex>
</template>

<script>
export default {
  name: 'Print',
  data () {
    return {
      allSelect: true,
      opleiding: [true, true, true, true, true]
    }
  },
  methods: {
    changeOpleidingCheckboxStates (val) {
      this.opleiding = [val, val, val, val, val]
    },
    checkState (val) {
      return val
    },
    checkAll (val) {
      if (this.opleiding.every(this.checkState)) {
        this.allSelect = true
      } else {
        this.allSelect = false
      }
    }
  }
}
</script>
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
