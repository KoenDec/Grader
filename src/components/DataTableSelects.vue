<template>
  <v-flex xs12 offset-xs1 @input="emitStudents">
    <v-data-table
          v-model="selected"
          v-bind:headers="headers"
          v-bind:items="items"
          select-all
          v-bind:pagination.sync="pagination"
          item-key="id"
          class="elevation-1"
        >
        <template slot="headers" slot-scope="props">
          <tr>
            <th>
              <v-checkbox
                primary
                hide-details
                @click.native="toggleAll"
                :input-value="props.all"
                :indeterminate="props.indeterminate"
              ></v-checkbox>
            </th>
            <th v-for="header in props.headers" :key="header.text"
              :class="['column sortable', pagination.descending ? 'desc' : 'asc', header.value === pagination.sortBy ? 'active' : '']"
              @click="changeSort(header.value)"
            >
              <v-icon>arrow_upward</v-icon>
              {{ header.text }}
            </th>
          </tr>
        </template>
        <template slot="items" slot-scope="props">
          <tr :active="props.selected" @click="props.selected = !props.selected" v-if="!filteredMajors.includes(props.item.opleidingName)">
            <td>
              <v-checkbox
                primary
                hide-details
                :input-value="props.selected"
              ></v-checkbox>
            </td>
            <td>{{ props.item.firstname + ' ' + props.item.lastname }}</td>
            <td class="text-xs-right">{{ props.item.opleidingName }}</td>
          </tr>
        </template>
      </v-data-table>
  </v-flex>
</template>

<script>
export default {
  name: 'DataTableSelects',
  props: ['filters'],
  data () {
    return {
      pagination: {
        sortBy: 'name'
      },
      selected: [],
      headers: [
        {
          text: 'Student',
          align: 'left',
          value: 'name'
        },
        { text: 'Opleiding', value: 'opleiding' }
      ],
      items: []
    }
  },
  computed: {
    filteredMajors: function () {
      var array = []
      var self = this
      this.filters.forEach(function (major) {
        if (major.value === false) {
          array.push(major.opleiding)
          var indexesToBeRemoved = []
          self.selected.forEach(function (student, index) {
            if (student.opleidingName === major.opleiding) {
              indexesToBeRemoved.push(index)
            }
          })
          indexesToBeRemoved.forEach(function (index) {
            self.selected.splice(index, 1)
          })
        }
      })
      return array
    }
  },
  watch: {
    selected: function (newSelected) {
      var array = []
      var self = this
      newSelected.forEach(function (student) {
        if (!self.filteredMajors.includes(student.opleidingName)) {
          array.push(parseInt(student.id))
        }
      })
      this.$emit('selected-students', array)
    }
  },
  methods: {
    toggleAll () {
      if (this.selected.length) this.selected = []
      else this.selected = this.items.slice()
    },
    checkStudentMajor (student) {
      return !this.filteredMajors.includes(student.opleidingName)
    },
    changeSort (column) {
      if (this.pagination.sortBy === column) {
        this.pagination.descending = !this.pagination.descending
      } else {
        this.pagination.sortBy = column
        this.pagination.descending = false
      }
    },
    emitStudents () {
      console.log('lel')
    }
  },
  created () {
    var self = this
    this.$http.getStudentsWithEdu(function (data) {
      self.items = data
      self.items.forEach(function (student) {
        student['value'] = false
      })
    })
  }
}
</script>
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
