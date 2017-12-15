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
            <v-text-field label="Name" v-model="name" :rules="nameRules" :counter="10" required></v-text-field>
            <v-text-field label="E-mail" v-model="email" :rules="emailRules" required></v-text-field>
            <v-select label="Item" v-model="select" :items="items" :rules="[v => !!v || 'Item is required']" required></v-select>
            <v-checkbox label="Do you agree?" v-model="checkbox" :rules="[v => !!v || 'You must agree to continue!']" required></v-checkbox>

            <v-btn @click="submit" :disabled="!valid"> submit
            </v-btn>
            <v-btn @click="clear">clear</v-btn>
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
  })
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->

<style scoped>
/* TODO custom css for the logo to fit the drawer */

</style>
