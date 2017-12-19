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

  my.createUser = function (firstname, lastname, email, pw, moduleIds, id, cb) {
    axios.post('http://146.185.183.217/api/createUser', {
      params: {
        firstname: firstname,
        lastname: lastname,
        email: email,
        pw: pw,
        moduleIds: moduleIds,
        id: id
      }
    })
      .then(function (response) {
        // console.log(resvar res = 'Student created'ponse)
        if (response.statusText === 'OK') return cb(response.data)
        else return cb(response.data)
      })
      .catch(function (error) {
        console.log(error)
      })
  }

  my.createEval = function (evalJSON, cb) {
    console.log(evalJSON.name)
    axios.post('http://146.185.183.217/api/saveEvaluatie', {
      aspecten: evalJSON.aspecten,
      name: evalJSON.name,
      studentId: evalJSON.studentId,
      moduleId: evalJSON.moduleId,
      date: evalJSON.date
    })
      .then(function (response) {
        if (response.statusText === 'OK') return cb(response.data)
        else return cb(response.data)
      })
      .catch(function (error) {
        console.log(error)
      })
  }

  my.updateEval = function (evalJSON, cb) {
    axios.put('http://146.185.183.217/api/updateEvaluatie', {
      params: {
        evalId: evalJSON.evalId,
        aspecten: evalJSON.aspecten,
        name: evalJSON.name,
        studentId: evalJSON.studentId,
        moduleId: evalJSON.moduleId,
        date: evalJSON.date
      }
    })
      .then(function (response) {
        if (response.statusText === 'OK') return cb(response.data)
        else return cb(response.data)
      })
      .catch(function (error) {
        console.log(error)
      })
  }

  my.getEvalsByStudent = function (modId, studId, cb) {
    axios.get('http://146.185.183.217/api/getEvaluatiesPerStudent', {
      params: {
        modId: modId,
        studId: studId
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

  my.deleteEval = function (id, cb) {
    axios.delete('http://146.185.183.217/api/deleteEvaluatie', {
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
