<template>
  <main>
    <v-layout row class="ml-5">
        <v-flex xs4>
          <v-text-field
            name="opleidingsnaam"
            label="Naam van de opleiding"
            v-model="opleidingsnaam"
            single-line
          ></v-text-field>
        </v-flex>
        <v-flex xs5>
          <v-btn
                color="success"
                :loading="loading"
                @click.native="saveOpleiding"
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
              <v-list-group v-for="(item, moduleIndex) in opleiding" :value="item.active" v-bind:key="item.name" v-if="editingModule">
                <v-list-tile slot="item">
                  <v-list-tile-content>
                    <v-list-tile-title v-if="moduleIndex !== payload">{{ moduleIndex + 1 + ' ' + item.name }}</v-list-tile-title>
                    <v-text-field @keyup.enter="editModule(null)" dark autofocus v-if="moduleIndex === payload" name="module" label="Module naam" v-model="item.name" single-line></v-text-field>
                  </v-list-tile-content>
                </v-list-tile>
              </v-list-group>
              <v-list-group uid="0" class="blue darken-3" dark v-for="(item, moduleIndex) in opleiding" :value="item.active" v-bind:key="item.name" v-if="!editingModule">
                <v-list-tile slot="item">
                  <v-list-tile-content>
                    <v-list-tile-title>{{ moduleIndex +1 + ' ' + item.name }}</v-list-tile-title>
                  </v-list-tile-content>
                  <v-btn flat icon color="blue lighten-2" @click="editModule(moduleIndex)">
                    <v-icon>edit</v-icon>
                  </v-btn>
                  <v-list-tile-action @click="hideCategorie()">
                    <v-icon>keyboard_arrow_down</v-icon>
                  </v-list-tile-action>
                </v-list-tile>
                <v-list-tile class="blue-grey darken-2" v-for="(categorie,categorieIndex) in item.categorieen" v-bind:key="categorieIndex" @click="payload=categorieIndex">
                  <v-list-tile-content @click="setCategorie(categorie)" v-if="!editingCategorie || categorieIndex != payload">
                    <v-list-tile-title>{{ categorie.indexes.toString().replace(/,/g, ".") + ' ' + categorie.name}}</v-list-tile-title>
                  </v-list-tile-content>
                  <v-btn flat icon color="blue lighten-2 text-xs-right" v-if="!editingCategorie" @click="editCategorie(categorieIndex)">
                    <v-icon>edit</v-icon>
                  </v-btn>
                  <v-text-field v-if="editingCategorie && payload === categorieIndex" @keyup.enter="editCategorie(null)" dark autofocus name="module" label="Categorie naam" v-model="categorie.name" single-line></v-text-field>
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
            <v-list-group v-for="(item, doelstellingIndex) in selectedcategorie.doelstellingen" :value="item.active" v-bind:key="item.name" v-if="editingDoelstelling">
              <v-list-tile slot="item">
                <v-list-tile-content>
                  <v-list-tile-title v-if="doelstellingIndex !== payload">{{ item.indexes.toString().replace(/,/g, ".") + ' ' + item.name }}</v-list-tile-title>
                  <v-text-field @keyup.enter="editDoelstelling(null)" dark autofocus v-if="doelstellingIndex === payload" name="module" label="Doelstelling naam" v-model="item.name" single-line></v-text-field>
                </v-list-tile-content>
              </v-list-tile>
            </v-list-group>
            <v-list-group v-if="!editingDoelstelling" class="blue darken-3" dark v-for="(item, doelstellingIndex) in selectedcategorie.doelstellingen" :value="item.active" v-bind:key="item.name">
              <v-list-tile slot="item" @click="hideAspects">
                <v-list-tile-content>
                  <v-list-tile-title>{{ item.indexes.toString().replace(/,/g, ".") + ' ' + item.name }}</v-list-tile-title>
                </v-list-tile-content>
                <v-btn flat icon color="blue lighten-2" @click="editDoelstelling(doelstellingIndex)">
                  <v-icon>edit</v-icon>
                </v-btn>
                <v-list-tile-action>
                  <v-icon>keyboard_arrow_down</v-icon>
                </v-list-tile-action>
              </v-list-tile>
              <v-list-tile class="blue-grey darken-2" v-for="(criteria, criteriaIndex) in item.criteria" v-bind:key="criteriaIndex" @click="setCriteria(criteria)">
                <v-list-tile-content @click="setCriteria(criteriaIndex)" v-if="!editingCriteria || criteriaIndex != payload">
                  <v-list-tile-title>{{ criteria.indexes.toString().replace(/,/g, ".") + ' ' + criteria.name}}</v-list-tile-title>
                </v-list-tile-content>
                <v-btn flat icon color="blue lighten-2 text-xs-right" v-if="!editingCriteria" @click="editCriteria(criteriaIndex)">
                  <v-icon>edit</v-icon>
                </v-btn>
                <v-text-field v-if="editingCriteria && payload === criteriaIndex" @keyup.enter="editCriteria(null)" dark autofocus name="module" label="Criteria naam" v-model="criteria.name" single-line></v-text-field>
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
            <v-list-group v-for="(aspect, aspectIndex) in selectedcriteria.aspecten" :value="aspect.active" v-bind:key="aspect.name" v-if="editingAspect">
              <v-list-tile slot="item">
                <v-list-tile-content>
                  <v-list-tile-title v-if="aspectIndex !== payload">{{ aspect.indexes.toString().replace(/,/g, ".") + ' ' + aspect.name }}</v-list-tile-title>
                  <v-text-field @keyup.enter="editAspect(null)" dark autofocus v-if="aspectIndex === payload" name="module" label="Aspect naam" v-model="aspect.name" single-line></v-text-field>
                </v-list-tile-content>
              </v-list-tile>
            </v-list-group>
            <v-list-group v-if="!editingAspect" class="blue darken-3" dark v-for="(aspect, aspectIndex) in selectedcriteria.aspecten" :value="aspect.active" v-bind:key="aspect.name">
              <v-list-tile slot="item" @click="enterAddition('', opleiding)">
                <v-list-tile-content>
                  <v-list-tile-title>{{ aspect.indexes.toString().replace(/,/g, ".") + ' ' + aspect.name }}</v-list-tile-title>
                </v-list-tile-content>
                <v-btn flat icon color="blue lighten-2" @click="editAspect(aspectIndex)">
                  <v-icon>edit</v-icon>
                </v-btn>
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
      opleidingsnaam: '',
      editingModule: false,
      editingCategorie: false,
      editingDoelstelling: false,
      editingCriteria: false,
      editingAspect: false,
      payload: null,
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
          object.push({name: title, new: true, indexes: [], categorieen: []})
          object[object.length - 1].indexes.push(object.length)
        } else if (level === 'categorie') {
          var array = []
          parentIndexes.forEach(function (item) {
            array.push(item)
          })
          object.push({name: title, new: true, indexes: array, doelstellingen: []})
          object[object.length - 1].indexes.push(object.length)
        } else if (level === 'doelstelling') {
          array = []
          parentIndexes.forEach(function (item) {
            array.push(item)
          })
          object.push({name: title, new: true, indexes: array, criteria: []})
          object[object.length - 1].indexes.push(object.length)
        } else if (level === 'criteria') {
          array = []
          parentIndexes.forEach(function (item) {
            array.push(item)
          })
          object.push({name: title, new: true, indexes: array, aspecten: []})
          object[object.length - 1].indexes.push(object.length)
        } else if (level === 'aspect') {
          array = []
          parentIndexes.forEach(function (item) {
            array.push(item)
          })
          object.push({name: title, new: true, indexes: array})
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
    editModule (payload) {
      this.payload = payload
      this.editingModule = !this.editingModule
      this.hideCategorie()
    },
    editCategorie (payload) {
      this.payload = payload
      this.editingCategorie = !this.editingCategorie
      this.hideCategorie()
    },
    editDoelstelling (payload) {
      this.payload = payload
      this.editingDoelstelling = !this.editingDoelstelling
    },
    editCriteria (payload) {
      this.payload = payload
      this.editingCriteria = !this.editingCriteria
    },
    editAspect (payload) {
      this.payload = payload
      this.editingAspect = !this.editingAspect
    },
    createOpleiding () {
      var self = this
      this.$http.createOpleiding(3, this.opleidingsnaam, function (response) {
        console.log(response.data)
        console.log(!isNaN(response.data))
        if (!isNaN(response.data)) {
          self.givenmajor.id = response.data
          self.givenmajor.name = self.opleidingsnaam
        }
        console.log('opleiding gemaakt met id: ' + response.data)
        self.saveModules()
      })
    },
    saveDoelstellingen (doelstellingscategorie) {
      var self = this
      doelstellingscategorie.doelstellingen.forEach(function (doelstelling) {
        if (doelstelling.id && !doelstelling.new) {
          self.$http.updateDoelstelling(doelstelling.id, doelstelling.name, function (response) {
            console.log(response)
            console.log(response.data)
          })
        } else {
          self.$http.createDoelstelling(doelstelling.name, doelstellingscategorie.id, 3, function (response) {
            console.log(response)
            console.log(response.data)
            doelstelling['id'] = response.data
            doelstelling.new = false
          })
        }
      })
    },
    saveDoelstellingscategorieen (module) {
      var self = this
      module.categorieen.forEach(function (categorie) {
        if (categorie.id && !categorie.new) {
          self.$http.updateDoelstellingscategorie(categorie.id, categorie.name, function (response) {
            self.saveDoelstellingen(categorie)
          })
        } else {
          self.$http.createDoelstellingscategorie(categorie.name, module.id, 3, function (response) {
            categorie['id'] = response.data
            categorie.new = false
            self.saveDoelstellingen(categorie)
          })
        }
      })
    },
    saveModules () {
      var self = this
      this.opleiding.forEach(function (module) {
        if (module.id && !module.new) {
          self.$http.updateModule(module.id, module.name, function (response) {
            self.saveDoelstellingscategorieen(module)
          })
        } else {
          self.$http.createModule(module.name, self.givenmajor.id, 13, 3, function (response) {
            module['id'] = response.data
            module.new = false
            self.saveDoelstellingscategorieen(module)
          })
        }
      })
      this.loading = null
    },
    saveOpleiding () {
      this.loading = true
      var self = this
      if (this.givenmajor.id === null) {
        this.createOpleiding()
      } else {
        this.$http.updateOpleiding(this.givenmajor.id, this.opleidingsnaam, function (response) {
          self.saveModules()
        })
      }
    }
  },
  watch: {
  },
  computed: {
    deactivateModuleHeaders: function () {
      if (this.editingModule === true) {
        this.$children[2].$children[this.payload + 1].isActive = false
      }
    }
  },
  created () {
    var self = this
    if (this.givenmajor != null) {
      this.opleidingsnaam = self.givenmajor.name
      this.$http.getFullOpleiding(this.givenmajor.id, function (data) {
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
