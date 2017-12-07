import axios from 'axios'

var Api = (function () {
  var my = {}

  my.getStudentsWithEdu = function (callback) {
    axios.get('http://146.185.183.217/api/studentenMetOpleiding')
      .then(function (response) {
        return callback(response.data)
      })
      .catch(function (error) {
        console.log(error)
      })
  }

  my.getOpleidingen = function (callback) {
    axios.get('http://146.185.183.217/api/opleidingen')
      .then(function (response) {
        return callback(response.data)
      })
      .catch(function (error) {
        console.log(error)
      })
  }

  my.getStudent = function (id, cb) {
    axios.get('http://146.185.183.217/api/student', {
      params: {
        id: id
      }
    })
      .then(function (response) {
        return cb(response.data)
      })
      .catch(function (error) {
        console.log(error)
      })
  }

  my.getStudentReports = function (id, cb) {
    axios.get('http://146.185.183.217/api/studentReports', {
      params: {
        id: id
      }
    })
      .then(function (response) {
        return cb(response.data)
      })
      .catch(function (error) {
        console.log(error)
      })
  }

  my.getStudentReport = function (rapportid, cb) {
    axios.get('http://146.185.183.217/api/studentReport', {
      params: {
        id: rapportid
      }
    })
      .then(function (response) {
        return cb(response.data)
      })
      .catch(function (error) {
        console.log(error)
      })
  }

  my.getFullOpleiding = function (id, cb) {
    axios.get('http://146.185.183.217/api/fullOpleiding', {
      params: {
        opleiding: id
      }
    })
      .then(function (response) {
        console.log(response.data)
        return cb(response.data)
      })
      .catch(function (error) {
        console.log(error)
      })
  }

  my.getEvalForStudent = function (id, cb) {
    axios.get('http://146.185.183.217/api/evaluatieVoorStudent', {
      params: {
        id: id
      }
    })
      .then(function (response) {
        console.log(response.data)
        return cb(response.data)
      })
      .catch(function (error) {
        console.log(error)
      })
  }

  return my
}())

export default Api
