<template>
  <v-layout row-wrap class="ml-5">
    <v-flex xs3>
      <v-card color="blue-grey darken-2" class="white--text">
        <v-list dark class="blue darken-3">
            <v-list-group class="blue darken-3" dark v-for="item in opleiding" :value="item.active" v-bind:key="item.name">
              <v-list-tile slot="item" @click="enterAddition('', opleiding)">
                <v-list-tile-content>
                  <v-list-tile-title>{{ item.name }}</v-list-tile-title>
                </v-list-tile-content>
                <v-list-tile-action>
                  <v-icon>keyboard_arrow_down</v-icon>
                </v-list-tile-action>
              </v-list-tile>
              <v-list-tile class="blue-grey darken-2" v-for="subItem in item.categorieen" v-bind:key="subItem" @click="">
                <v-list-tile-content>
                  <v-list-tile-title>{{ subItem.name}}</v-list-tile-title>
                </v-list-tile-content>
              </v-list-tile>
              <v-list-tile class="blue-grey darken-2">
                <v-text-field
                  auto-focus
                  v-if="addCategorieActive"
                  @keyup.enter="enterAddition(currentAddString, item.categorieen)"
                  prepend-icon="add"
                  label="Nieuwe Categorie"
                  v-model="currentAddString"
                  single-line
                  hide-details
                  dark
                ></v-text-field>
                <v-btn flat color="white darken-1" v-if="!addCategorieActive" @click="addCategorieActive = true">+ Nieuwe Categorie</v-btn>
              </v-list-tile>
            </v-list-group>
            <v-list-tile class="white--text">
              <v-text-field
                auto-focus
                v-if="addModuleActive"
                @keyup.enter="enterAddition(currentAddString, opleiding)"
                prepend-icon="add"
                label="Nieuwe Module"
                v-model="currentAddString"
                single-line
                hide-details
                dark
              ></v-text-field>
              <v-btn flat color="white darken-1" v-if="!addModuleActive" @click="addModuleActive = true" full-width>+ Nieuwe Module</v-btn>
            </v-list-tile>
          </v-list>

      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
export default {
  name: 'SubjectEditor',
  data () {
    return {
      addModuleActive: false,
      addCategorieActive: false,
      currentAddString: '',
      opleiding: [
        {id: 1, name: 'Initiatie Keuken', categorieen: []}
      ]
    }
  },
  methods: {
    enterAddition (title, object) {
      if (title !== '') {
        object.push({id: 1, name: title, categorieen: []})
      }
      this.currentAddString = ''
      this.addModuleActive = false
      this.addCategorieActive = false
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->

<style scoped>


</style>
