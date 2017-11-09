<template>

<main>
  <v-layout row-wrap>
      <v-flex xs12 offset-xs1 class="text-xs-left">
        <h1 class="display-3">Rapporten afdrukken</h1>
      </v-flex>
  </v-layout>
  <v-layout row-wrap>
  <v-flex xs2>
    <checkboxes></checkboxes>
  </v-flex>
<!--
      <form class="col s7" action="#">
          <p>
              <input type="checkbox" id="more-checkboxes" checked="checked" />
              <label for="more-checkboxes">Alles selecteren</label>
          </p>
          <table class="striped bordered">
              <tr><th>Student</th></tr>
              <tr data-opleidingId="">
                  <td>
                      <p class="opleiding-checkbox " style="display:inline-block">
                          <input type="checkbox" id="student-checkbox" checked="checked"/>
                          <label for="student-checkbox"></label>
                      </p>
                      <a class="waves-effect waves-light btn tooltipped right" data-delay="50"
                         data-tooltip="Rapport bekijken"><i class="material-icons right">import_contacts</i>Rapport</a>
                  </td>
              </tr>
          </table>
      </form>
      <div class="right-align col s2 reports-btns">
          <a class="waves-effect waves-light btn tooltipped" style="margin-bottom: 5px" data-delay="50" data-tooltip="Rapporten downloaden"><i class="material-icons">file_download</i></a>
          <a class="waves-effect waves-light btn tooltipped" style="margin-bottom: 5px" data-delay="50" data-tooltip="Rapporten afdrukken"><i class="material-icons">print</i></a>
      </div>-->
    </v-layout>
</main>
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
