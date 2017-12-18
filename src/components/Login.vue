<template>
  <v-layout>
    <v-flex xs12 sm6 offset-sm3>
      <v-card>
        <v-card-title primary-title>
          <div>
            <h3 class="headline mb-0">Login</h3>
          </div>
        </v-card-title>
        <v-card-actions>
          <v-form v-model="valid" ref="form" lazy-validation>
            <v-text-field
                    label="E-mail"
                    v-model="email"
                    :rules="emailRules"
                    required
            ></v-text-field>
            <v-text-field
                    label="Passwoord"
                    v-model="password"
                    :rules="passwordRules"
                    required
            ></v-text-field>
            <v-btn color="primary" :disabled="!valid" @click="submit">Log in<v-icon class="ml-2">send</v-icon></v-btn>
          </v-form>
        </v-card-actions>
      </v-card>
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
      (v) => !!v || 'passwoord moet ingevuld worden'
    ],
    email: '',
    emailRules: [
      (v) => !!v || 'E-mail moet ingevuld worden',
      (v) => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail moet geldig zijn'
    ]
  })
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->

<style scoped>
/* TODO custom css for the logo to fit the drawer */

</style>
