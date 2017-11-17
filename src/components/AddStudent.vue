<template>
  <div>
    <v-layout row wrap>
        <v-flex xs12 offset-xs1 class="text-xs-left">
          <h1 class="display-3">Studenten</h1>
        </v-flex>
    </v-layout>
    <v-layout row wrap>
      <v-flex>
        <v-stepper v-model="e1">
          <v-stepper-header>
            <v-stepper-step step="1" :complete="e1 > 1">Details</v-stepper-step>
            <v-divider></v-divider>
            <v-stepper-step step="2" :complete="e1 > 2">Modules toekennen</v-stepper-step>
          </v-stepper-header>
          <v-stepper-items>
            <v-stepper-content step="1">
              <v-form v-model="valid" ref="form" lazy-validation>
                <v-text-field
                  label="Name"
                  v-model="name"
                  :rules="nameRules"
                  required
                ></v-text-field>
                <v-text-field
                  label="E-mail"
                  v-model="email"
                  :rules="emailRules"
                  required
                ></v-text-field>
                <v-select
                  label="Item"
                  v-model="select"
                  :items="items"
                  :rules="[v => !!v || 'Item is required']"
                  required
                ></v-select>
                <v-btn
                  @click=""
                  :disabled="!valid"
                >
                  submit
                </v-btn>
                <v-btn @click="clear">clear</v-btn>
              </v-form>
              <v-btn color="primary" @click.native="e1 = 2">Continue</v-btn>
              <v-btn flat>Cancel</v-btn>
            </v-stepper-content>
            <v-stepper-content step="2">
              <v-card color="grey lighten-1" class="mb-5" height="200px"></v-card>
              <v-btn color="primary" @click.native="e1 = 3">Continue</v-btn>
              <v-btn flat>Cancel</v-btn>
            </v-stepper-content>
          </v-stepper-items>
        </v-stepper>
      </v-flex>
    </v-layout>
  </div>
</template>

<script>
export default {
  name: 'Home',
  data () {
    return {
      valid: true,
      name: '',
      nameRules: [
        (v) => !!v || 'Name is required'
      ],
      email: '',
      emailRules: [
        (v) => !!v || 'E-mail is required',
        (v) => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
      ],
      select: null,
      items: [
        'Item 1',
        'Item 2',
        'Item 3',
        'Item 4'
      ],
      checkbox: false,
      methods: {
        clear () {
          this.$refs.form.reset()
        }
      }
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
