<template>
  <v-layout row-wrap class="ml-5">
    <!-- MODULES & CATEGORIEEN DISPLAY-->
    <v-flex xs3 class="mr-0 pa-0">
      <v-card color="blue-grey darken-2" class="white--text pa-0">
        <v-list dark class="blue darken-3 pa-0">
            <v-list-group class="blue darken-3" dark v-for="(item, moduleIndex) in opleiding" :value="item.active" v-bind:key="item.name">
              <v-list-tile slot="item" @click="enterAddition('', opleiding)">
                <v-list-tile-content>
                  <v-list-tile-title>{{ moduleIndex +1 + ' ' + item.name }}</v-list-tile-title>
                </v-list-tile-content>
                <v-list-tile-action>
                  <v-icon>keyboard_arrow_down</v-icon>
                </v-list-tile-action>
              </v-list-tile>
              <v-list-tile class="blue-grey darken-2" v-for="(categorie,categorieIndex) in item.categorieen" v-bind:key="categorieIndex" @click="setCategorie(categorie)">
                <v-list-tile-content>
                  <v-list-tile-title>{{ categorie.indexes.toString().replace(",", ".") + ' ' + categorie.name}}</v-list-tile-title>
                </v-list-tile-content>
              </v-list-tile>
              <v-list-tile class="blue-grey darken-2">
                <v-text-field
                  class="pb-2"
                  auto-focus
                  v-if="addCategorieActive"
                  @keyup.enter="enterAddition(CategorieAddString, item.categorieen, 'categorie', item.indexes)"
                  prepend-icon="add"
                  label="Nieuwe Categorie"
                  v-model="CategorieAddString"
                  single-line
                  hide-details
                  dark
                ></v-text-field>
                <v-btn flat color="white darken-1" v-if="!addCategorieActive" @click="addCategorieActive = true">+ Nieuwe Categorie</v-btn>
              </v-list-tile>
            </v-list-group>
            <v-list-tile class="white--text">
              <v-text-field
                class="pb-2"
                auto-focus
                v-if="addModuleActive"
                @keyup.enter="enterAddition(ModuleAddString, opleiding, 'module')"
                prepend-icon="add"
                label="Nieuwe Module"
                v-model="ModuleAddString"
                single-line
                hide-details
                dark
              ></v-text-field>
              <v-btn flat color="white darken-1" v-if="!addModuleActive" @click="addModuleActive = true" full-width>+ Nieuwe Module</v-btn>
            </v-list-tile>
          </v-list>
      </v-card>
    </v-flex>
    <!-- DOELSTELLINGEN & EVALUATIECRITERIA DISPLAY-->
    <v-flex xs4 class="ml-0 pa-0" v-if="selectedcategorie !== null">
      <v-card color="blue-grey darken-2" class="white--text">
        <v-list dark class="blue darken-3 pa-0">
          <v-list-group class="blue darken-3" dark v-for="(doelstelling, doelstellingsIndex) in selectedcategorie" :value="doelstelling.active" v-bind:key="doelstelling.name">
            <v-list-tile slot="doelstelling" @click="enterAddition('', opleiding)">
              <v-list-tile-content>
                <v-list-tile-title>{{ doelstellingsIndex +1 + ' ' + doelstelling.name }}</v-list-tile-title>
              </v-list-tile-content>
              <v-list-tile-action>
                <v-icon>keyboard_arrow_down</v-icon>
              </v-list-tile-action>
            </v-list-tile>
            <v-list-tile class="blue-grey darken-2" v-for="(evaluatiecrit,evaluatiecritIndex) in doelstelling.evaluatiecriteria" v-bind:key="evaluatiecritIndex" @click="setCategorie(categorie)">
              <v-list-tile-content>
                <v-list-tile-title>{{ evaluatiecrit.indexes.toString().replace(",", ".") + ' ' + evaluatiecrit.name}}</v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>
            <v-list-tile class="blue-grey darken-2">
              <v-text-field
                class="pb-2"
                auto-focus
                v-if="addDoelstellingActive"
                @keyup.enter="enterAddition(DoelstellingAddString, selectedcategorie.doelstellingen, 'doelstelling', selectedcategorie.indexes)"
                prepend-icon="add"
                label="Nieuwe Categorie"
                v-model="DoelstellingAddString"
                single-line
                hide-details
                dark
              ></v-text-field>
              <v-btn flat color="white darken-1" v-if="!addCategorieActive" @click="addCategorieActive = true">+ Nieuwe Categorie</v-btn>
            </v-list-tile>
          </v-list-group>
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
      addDoelstellingActive: false,
      selectedcategorie: null,
      ModuleAddString: '',
      CategorieAddString: '',
      DoelstellingAddString: '',
      opleiding: [
      ]
    }
  },
  methods: {
    enterAddition (title, object, level, parentIndexes) {
      if (title !== '') {
        if (level === 'module') {
          object.push({name: title, indexes: [], categorieen: []})
          object[object.length - 1].indexes.push(object.length)
        } else if (level === 'categorie') {
          var array = []
          parentIndexes.forEach(function (item) {
            array.push(item)
          })
          object.push({name: title, indexes: array, doelstellingen: []})
          object[object.length - 1].indexes.push(object.length)
        } else if (level === 'doelstelling') {
          array = []
          parentIndexes.forEach(function (item) {
            array.push(item)
          })
          object.push({name: title, indexes: array, evaluatiecriteria: []})
          object[object.length - 1].indexes.push(object.length)
        }
      }
      this.ModuleAddString = ''
      this.CategorieAddString = ''
      this.addModuleActive = false
      this.addCategorieActive = false
    },
    setCategorie (data) {
      this.selectedcategorie = data
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->

<style scoped>


</style>
