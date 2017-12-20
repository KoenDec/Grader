<template>
  <v-layout column>
      <v-flex xs4 offset-xs4>
        <form v-model="valid">
          <v-flex xs12 class="text-xs-center" mt-5>
            <h3>Sign In</h3>
          </v-flex>
          <v-layout column>
            <v-flex>
              <v-text-field
                      name="email"
                      label="Email"
                      id="email"
                      type="email"
                      :rules="emailRules"
                      v-model="email"
                      required></v-text-field>
            </v-flex>
            <v-flex>
              <v-text-field
                      name="paswoord"
                      label="Password"
                      id="password"
                      type="password"
                      :rules="passwordRules"
                      v-model="password"
                      required></v-text-field>
            </v-flex>
            <v-flex class="text-xs-center" mt-5>
              <v-btn primary type="submit" v-on:submit.prevent @click="login">Sign In</v-btn>
            </v-flex>
          </v-layout>
        </form>
      </v-flex>
  </v-layout>
</template>


<script>
export default {
  name: 'Login',
  data: () => ({
    valid: true,
    password: '',
    passwordRules: [
      (v) => !!v || 'paswoord moet ingevuld worden'
    ],
    email: '',
    emailRules: [
      (v) => !!v || 'E-mail moet ingevuld worden',
      (v) => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail moet geldig zijn'
    ]
  }),
  methods: {
    login () {
      this.$http.login(this.email, this.password, function (data) {
        console.log(data)
      })
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->

<style scoped>
/* TODO custom css for the logo to fit the drawer */
</style>
