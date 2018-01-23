<template>
  <main>
    <v-layout row class="ml-5">
        <v-flex xs4>
          <v-text-field
            name="opleidingsnaam"
            label="Naam van de opleiding"
            single-line
          ></v-text-field>
        </v-flex>
        <v-flex xs5>
          <v-btn
                color="success"
                :loading="loading"
                @click.native="loader = 'loading'"
                :disabled="loading"
              >
                Opslaan
                <span slot="loader" class="custom-loader">
                  <v-icon light>cached</v-icon>
                </span>
              </v-btn>
        </v-flex>
    </v-layout>
    <v-layout row-wrap class="ml-5">
      <!-- MODULES & CATEGORIEEN DISPLAY-->
      <v-flex xs3 class="mr-0 pa-0">
          <v-list dark class="blue darken-3 pa-0">
              <v-list-group class="blue darken-3" dark v-for="(item, moduleIndex) in opleiding" :value="item.active" v-bind:key="item.name">
                <v-list-tile slot="item" @click="hideCategorie">
                  <v-list-tile-content>
                    <v-list-tile-title>{{ moduleIndex +1 + ' ' + item.name }}</v-list-tile-title>
                  </v-list-tile-content>
                  <v-list-tile-action>
                    <v-icon>keyboard_arrow_down</v-icon>
                  </v-list-tile-action>
                </v-list-tile>
                <v-list-tile class="blue-grey darken-2" v-for="(categorie,categorieIndex) in item.categorieen" v-bind:key="categorieIndex" @click="setCategorie(categorie)">
                  <v-list-tile-content>
                    <v-list-tile-title>{{ categorie.indexes.toString().replace(/,/g, ".") + ' ' + categorie.name}}</v-list-tile-title>
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
      </v-flex>
      <!-- DOELSTELLINGEN & EVALUATIECRITERIA DISPLAY-->
      <v-flex xs4 class="mr-0 pa-0" v-if="selectedcategorie != null">
        <v-list dark class="blue darken-3 pa-0">
            <v-list-group class="blue darken-3" dark v-for="(item, doelstellingIndex) in selectedcategorie.doelstellingen" :value="item.active" v-bind:key="item.name">
              <v-list-tile slot="item" @click="hideAspects">
                <v-list-tile-content>
                  <v-list-tile-title>{{ item.indexes.toString().replace(/,/g, ".") + ' ' + item.name }}</v-list-tile-title>
                </v-list-tile-content>
                <v-list-tile-action>
                  <v-icon>keyboard_arrow_down</v-icon>
                </v-list-tile-action>
              </v-list-tile>
              <v-list-tile class="blue-grey darken-2" v-for="(criteria,categorieIndex) in item.criteria" v-bind:key="categorieIndex" @click="setCriteria(criteria)">
                <v-list-tile-content>
                  <v-list-tile-title>{{ criteria.indexes.toString().replace(/,/g, ".") + ' ' + criteria.name}}</v-list-tile-title>
                </v-list-tile-content>
              </v-list-tile>
              <v-list-tile class="blue-grey darken-2">
                <v-text-field
                  class="pb-2"
                  auto-focus
                  v-if="addCriteriaActive"
                  @keyup.enter="enterAddition(CriteriaAddString, item.criteria, 'criteria', item.indexes)"
                  prepend-icon="add"
                  label="Nieuwe Criteria"
                  v-model="CriteriaAddString"
                  single-line
                  hide-details
                  dark
                ></v-text-field>
                <v-btn flat color="white darken-1" v-if="!addCriteriaActive" @click="addCriteriaActive = true">+ Nieuwe Criteria</v-btn>
              </v-list-tile>
            </v-list-group>
            <v-list-tile class="white--text">
              <v-text-field
                class="pb-2"
                auto-focus
                v-if="addDoelstellingActive"
                @keyup.enter="enterAddition(DoelstellingAddString, selectedcategorie.doelstellingen, 'doelstelling', selectedcategorie.indexes )"
                prepend-icon="add"
                label="Nieuwe Doelstelling"
                v-model="DoelstellingAddString"
                single-line
                hide-details
                dark
              ></v-text-field>
              <v-btn flat color="white darken-1" v-if="!addDoelstellingActive" @click="addDoelstellingActive = true" full-width>+ Nieuwe Doelstelling</v-btn>
            </v-list-tile>
          </v-list>
      </v-flex>
      <!-- DOELSTELLINGEN & EVALUATIECRITERIA DISPLAY-->
      <v-flex xs4 class="mr-0 pa-0" v-if="selectedcriteria != null">
        <v-list dark class="blue darken-3 pa-0">
            <v-list-group class="blue darken-3" dark v-for="(aspect, aspectIndex) in selectedcriteria.aspecten" :value="aspect.active" v-bind:key="aspect.name">
              <v-list-tile slot="item" @click="enterAddition('', opleiding)">
                <v-list-tile-content>
                  <v-list-tile-title>{{ aspect.indexes.toString().replace(/,/g, ".") + ' ' + aspect.name }}</v-list-tile-title>
                </v-list-tile-content>
              </v-list-tile>
            </v-list-group>
            <v-list-tile class="white--text">
              <v-text-field
                class="pb-2"
                auto-focus
                v-if="addAspectenActive"
                @keyup.enter="enterAddition(AspectenAddString, selectedcriteria.aspecten, 'aspect', selectedcriteria.indexes )"
                prepend-icon="add"
                label="Nieuw Aspect"
                v-model="AspectenAddString"
                single-line
                hide-details
                dark
              ></v-text-field>
              <v-btn flat color="white darken-1" v-if="!addAspectenActive" @click="addAspectenActive = true" full-width>+ Nieuw Aspect</v-btn>
            </v-list-tile>
          </v-list>
      </v-flex>
    </v-layout>
  </main>
</template>

<script>
export default {
  name: 'SubjectEditor',
  props: ['givenmajor'],
  data () {
    return {
      snackbar: false,
      addModuleActive: false,
      addCategorieActive: false,
      addDoelstellingActive: false,
      addCriteriaActive: false,
      addAspectenActive: false,
      selectedcategorie: null,
      selectedcriteria: null,
      ModuleAddString: '',
      CategorieAddString: '',
      DoelstellingAddString: '',
      CriteriaAddString: '',
      AspectenAddString: '',
      opleiding: [
      ],
      loader: null,
      loading: false
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
          object.push({name: title, indexes: array, criteria: []})
          object[object.length - 1].indexes.push(object.length)
        } else if (level === 'criteria') {
          array = []
          parentIndexes.forEach(function (item) {
            array.push(item)
          })
          object.push({name: title, indexes: array, aspecten: []})
          object[object.length - 1].indexes.push(object.length)
        } else if (level === 'aspect') {
          array = []
          parentIndexes.forEach(function (item) {
            array.push(item)
          })
          object.push({name: title, indexes: array})
          object[object.length - 1].indexes.push(object.length)
        }
      }
      this.ModuleAddString = ''
      this.CategorieAddString = ''
      this.DoelstellingAddString = ''
      this.CriteriaAddString = ''
      this.AspectenAddString = ''
      this.addModuleActive = false
      this.addCategorieActive = false
      this.addDoelstellingActive = false
      this.addCriteriaActive = false
      this.addAspectenActive = false
    },
    setCategorie (data) {
      this.selectedcategorie = data
    },
    setCriteria (data) {
      this.selectedcriteria = data
    },
    hideCategorie () {
      this.selectedcategorie = null
      this.selectedcriteria = null
      this.enterAddition('', this.opleiding)
    },
    hideAspects () {
      this.selectedcriteria = null
      this.enterAddition('', this.opleiding)
    },
    saveOpleiding () {

    }
  },
  watch: {
    loader () {
      const l = this.loader
      this[l] = !this[l]

      setTimeout(() => (this[l] = false), 3000)

      this.loader = null
    }
  },
  created () {
    var self = this
    if (this.givenmajor != null) {
      this.$http.getFullOpleiding(this.givenmajor.id, function (data) {
        console.log(data)

        data.modules.forEach(function (module, moduleindex) {
          module['indexes'] = [moduleindex + 1]
          module.categorieen.forEach(function (categorie, categorieIndex) {
            categorie['indexes'] = [moduleindex + 1, categorieIndex + 1]
            categorie.doelstellingen.forEach(function (doelstelling, doelstellingIndex) {
              doelstelling['indexes'] = [moduleindex + 1, categorieIndex + 1, doelstellingIndex + 1]
              doelstelling.criteria.forEach(function (criterium, criteriumIndex) {
                criterium['indexes'] = [moduleindex + 1, categorieIndex + 1, doelstellingIndex + 1, criteriumIndex + 1]
                criterium.aspecten.forEach(function (aspect, aspectIndex) {
                  aspect['indexes'] = [moduleindex + 1, categorieIndex + 1, doelstellingIndex + 1, criteriumIndex + 1, aspectIndex + 1]
                })
              })
            })
          })
        })
        self.opleiding = data.modules
      })
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->

<style scoped>
  .custom-loader {
    animation: loader 1s infinite;
    display: flex;
  }
  @-moz-keyframes loader {
    from {
      transform: rotate(0);
    }
    to {
      transform: rotate(360deg);
    }
  }
  @-webkit-keyframes loader {
    from {
      transform: rotate(0);
    }
    to {
      transform: rotate(360deg);
    }
  }
  @-o-keyframes loader {
    from {
      transform: rotate(0);
    }
    to {
      transform: rotate(360deg);
    }
  }
  @keyframes loader {
    from {
      transform: rotate(0);
    }
    to {
      transform: rotate(360deg);
    }
  }
</style>
