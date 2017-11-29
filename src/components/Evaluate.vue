<template>
    <div>
        <v-layout row wrap>
            <v-flex xs12 offset-xs1 class="text-xs-left">
                <h1 class="display-3">Evaluatie</h1>
            </v-flex>
        </v-layout>
        <v-layout row-wrap>
            <v-flex xs12 offset-xs1 class="text-xs-left">
                <h2 class="headline">Evaluatiefiche voor: {{ student.firstname }} {{student.name}}</h2>
            </v-flex>
        </v-layout>
    </div>
</template>

<script>
    export default {
      name: 'Studenten',
      data () {
        return {
          student: {name: '', firstname: ''}
        }
      },
      created () {
        var self = this
        var studentId = this.$route.query.id
        this.$http.get('http://146.185.183.217/api/student?id=' + studentId)
          .then(function (response) {
            console.log(response.data)
            self.student.firstname = response.data.student.firstname
            self.student.name = response.data.student.lastname
          })
          .catch(function (error) {
            console.log(error)
          })
      }
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
