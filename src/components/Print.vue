<template>

<main>
  <h2 class="">Rapporten afdrukken</h2>

  <div class="row">
      <p style="color: #9e9e9e">Selecteer opleidingen</p>


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
                                  <label
                                      for="student-checkbox"></label>
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
      </div>
  </div>
</main>
</template>

<script>
export default {
  name: 'Print',
  data () {
    return {

    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
