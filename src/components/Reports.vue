<template>
  <main>
    <v-layout row-wrap>
        <v-flex xs12 offset-xs1 class="text-xs-left">
          <h1 class="display-3">Rapporten</h1>
        </v-flex>
    </v-layout>
    <v-layout row-wrap>
      <v-flex xs4 offset-xs1 ref="results" @>
        <searchbar @select-student="applySelection" :list="items" :concat_keys="keys" :labeltext="zoeklabel" :item_concat_key="item_name" :item_value="item_value"></searchbar>
      </v-flex>
        <v-flex>
          <v-btn @click="" large color="primary"><v-icon>get_app</v-icon></v-btn>
          <v-btn @click="" large color="primary"><v-icon>print</v-icon></v-btn>
        </v-flex>
    </v-layout>
    <v-layout row-wrap>
        <v-flex xs12 offset-xs1 class="text-xs-left">
          <h2 class="headline" v-if="currentstudent != null">Studiemodules van: {{ currentstudent.name }}</h2>
        </v-flex>
    </v-layout>
    <v-layout row-wrap>
        <v-flex xs10 offset-xs1>
            <v-list two-line v-if="currentstudent != null">
              <v-subheader>{{'Rapporten van ' + currentstudent.student.firstname + ' ' + currentstudent.student.lastname}}</v-subheader>
              <template v-for="report in current_student_reports">
                <v-divider></v-divider>
                <v-list-tile v-bind:key="report.id" @click="">
                  <v-list-tile-content>
                    <v-list-tile-title v-html="report.name"></v-list-tile-title>
                    <!-- <v-list-tile-sub-title v-html="report.class"></v-list-tile-sub-title>-->
                  </v-list-tile-content>
                </v-list-tile>
              </template>
            </v-list>
        </v-flex>
    </v-layout>
    {{Opleidingen}}
  </main>
</template>

<script>
export default {
  name: 'Reports',
  data () {
    return {
      items: [],
      keys: ['firstname', 'lastname'],
      item_name: 'fullname',
      item_value: 'id',
      zoeklabel: 'student',
      currentstudent: null,
      currentreport: null,
      current_student_reports: null,
      usercredentials: {
        username: 'thomas.de.nil@student.howest.be',
        password: 'Student'
      },
      headers: {
        'Content-Type': 'text/plain'
      }
    }
  },
  methods: {
    applySelection (payload) {
      var self = this
      this.$http.get('http://146.185.183.217/api/student', {
        params: {
          id: payload
        }
      })
        .then(function (response) {
          console.log(response)
          self.currentstudent = response.data
          self.getCurrentStudentReports()
        })
        .catch(function (error) {
          console.log(error)
        })
    },
    getCurrentStudentReports () {
      var self = this
      this.$http.get('http://146.185.183.217/api/studentReports', {
        params: {
          id: self.currentstudent.student.id
        }
      })
        .then(function (response) {
          console.log(response)
          self.current_student_reports = response.data
        })
        .catch(function (error) {
          console.log(error)
        })
    }
  },
  computed: {
    Opleidingen () {

    }
  },
  created () {
    var self = this
    this.$http.get('http://146.185.183.217/api/studentenMetOpleiding')
      .then(function (response) {
        self.items = response.data
        console.log(self.items)
      })
      .catch(function (error) {
        console.log(error)
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
