import axios from 'axios'

var myStorage = window.localStorage
// myStorage.setItem('token', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjIiLCJjbGVhcmFuY2UiOiJBRE1JTiJ9.a1lD/can5gzGUL4yki6CAZmdm4ucsInRXYatqzi4Pzk=')

var Api = (function () {
  var my = {}
  my.all = axios.all
  my.spread = axios.spread
  my.login = function (username, password, cb) {
    axios.post('http://146.185.183.217/api/auth', {
      username: username,
      password: password
    })
      .then(function (response) {
        myStorage.setItem('token', response.data)
        window.location.href = '/#/home'
        return cb(response.data)
      })
      .catch(function (error) {
        console.log(error.response.data)
        return cb(error.response.data)
      })
  }

  my.validateToken = function (cb) {
    axios.post('http://146.185.183.217/api/auth', {
      token: myStorage.getItem('token')
    })
      .then(function (response) {
        return cb(response.data)
      })
      .catch(function (error) {
        return cb(error.response.data)
      })
  }

  my.getCurrentUser = function (cb) {
    axios.get('http://146.185.183.217/api/currentUser', {
      params: {
        token: myStorage.getItem('token')
      }
    })
      .then(function (response) {
        return cb(response.data)
      })
      .catch(function (error) {
        console.log(error)
      })
  }

  my.logout = function (cb) {
    myStorage.removeItem('token')
    return cb(myStorage.getItem('token'))
  }

  my.getStudentsWithEdu = function (callback) {
    axios.get('http://146.185.183.217/api/studentenMetOpleiding', {
      params: {
        token: myStorage.getItem('token')
      }
    })
      .then(function (response) {
        return callback(response.data)
      })
      .catch(function (error) {
        console.log(error)
      })
  }

  my.getOpleidingen = function (callback) {
    axios.get('http://146.185.183.217/api/opleidingen', {
      params: {
        token: myStorage.getItem('token')
      }
    })
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
        id: id,
        token: myStorage.getItem('token')
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
        id: id,
        token: myStorage.getItem('token')
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
        id: rapportid,
        token: myStorage.getItem('token')
      }
    })
      .then(function (response) {
        return cb(response.data)
      })
      .catch(function (error) {
        console.log(error)
      })
  }

  my.saveReport = function (report, cb) {
    axios.post('http://146.185.183.217/api/saveReport', {
      commentaarAlgemeen: report.commentaarAlgemeen,
      commentaarKlassenraad: report.commentaarKlassenraad,
      commentaarWerkplaats: report.commentaarWerkplaats,
      enddate: report.enddate,
      modules: report.modules,
      name: report.name,
      startdate: report.startdate,
      studentId: report.studentId
    })
      .then(function (response) {
        if (response.statusText === 'OK') return cb(response.data)
        else return cb(response.data)
      })
      .catch(function (error) {
        console.log(error)
      })
  }

  my.updateReport = function (report, cb) {
    axios.post('http://146.185.183.217/api/updateReport', {
      commentaarAlgemeen: report.commentaarAlgemeen,
      commentaarKlassenraad: report.commentaarKlassenraad,
      commentaarWerkplaats: report.commentaarWerkplaats,
      enddate: report.enddate,
      modules: report.modules,
      name: report.name,
      startdate: report.startdate,
      reportId: report.id,
      studentId: report.studentId
    })
      .then(function (response) {
        if (response.statusText === 'OK') return cb(response.data)
        else return cb(response.data)
      })
      .catch(function (error) {
        console.log(error)
      })
  }

  my.getFullOpleiding = function (id, cb) {
    axios.get('http://146.185.183.217/api/fullOpleiding', {
      params: {
        opleiding: id,
        token: myStorage.getItem('token')
      }
    })
      .then(function (response) {
        return cb(response.data)
      })
      .catch(function (error) {
        console.log(error)
      })
  }

  my.getEvalForStudent = function (id, cb) {
    axios.get('http://146.185.183.217/api/evaluatieVoorStudent', {
      params: {
        id: id,
        token: myStorage.getItem('token')
      }
    })
      .then(function (response) {
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
        id: id,
        token: myStorage.getItem('token')
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

  my.updateUser = function (firstname, lastname, email, id, cb) {
    axios.patch('http://146.185.183.217/api/updateUser', {
      firstname: firstname,
      lastname: lastname,
      email: email,
      id: id,
      token: myStorage.getItem('token')
    })
      .then(function (response) {
        if (response.statusText === 'OK') return cb(response.data)
      })
      .catch(function (error) {
        console.log(error)
      })
  }

  my.createEval = function (evalJSON, cb) {
    axios.post('http://146.185.183.217/api/saveEvaluatie', {
      aspecten: evalJSON.aspecten,
      name: evalJSON.name,
      studentId: evalJSON.studentId,
      moduleId: evalJSON.moduleId,
      date: evalJSON.date,
      token: myStorage.getItem('token')
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
    axios.patch('http://146.185.183.217/api/updateEvaluatie', {
      evalId: evalJSON.evalId,
      aspecten: evalJSON.aspecten,
      name: evalJSON.name,
      date: evalJSON.date,
      token: myStorage.getItem('token')
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
        studId: studId,
        token: myStorage.getItem('token')
      }
    })
      .then(function (response) {
        return cb(response.data)
      })
      .catch(function (error) {
        console.log(error)
      })
  }

  my.getAllEvalsByStudent = function (studId, cb) {
    axios.get('http://146.185.183.217/api/studentAllEvaluationsFull', {
      params: {
        student: studId
      }
    })
      .then(function (response) {
        return cb(response.data)
      })
      .catch(function (error) {
        console.log(error)
      })
  }

  my.deleteEval = function (id, cb) {
    axios.delete('http://146.185.183.217/api/deleteEvaluatie', {
      params: {
        id: id,
        token: myStorage.getItem('token')
      }
    })
      .then(function (response) {
        return cb(response.data)
      })
      .catch(function (error) {
        console.log(error)
      })
  }

  my.createOpleiding = function (creatorId, name, cb) {
    axios.post('http://146.185.183.217/api/createOpleiding', {
      name: name,
      creatorId: creatorId
    })
      .then(function (response) {
        return cb(response)
      })
      .catch(function (error) {
        console.log(error)
      })
  }

  my.updateOpleiding = function (opleidingId, name, cb) {
    axios.patch('http://146.185.183.217/api/updateOpleiding', {
      name: name,
      opleidingId: opleidingId
    })
      .then(function (response) {
        return cb(response)
      })
      .catch(function (error) {
        console.log(error)
      })
  }

  my.createModule = function (name, opleidingId, teacherId, creatorId, cb) {
    axios.post('http://146.185.183.217/api/createModule', {
      name: name,
      opleidingId: opleidingId,
      teacherId: teacherId,
      creatorId: creatorId
    })
      .then(function (response) {
        console.log('REACHED CALLBACK')
        return cb(response)
      })
      .catch(function (error) {
        console.log(error)
      })
  }

  my.updateModule = function (moduleId, name, cb) {
    axios.patch('http://146.185.183.217/api/updateModule', {
      name: name,
      moduleId: moduleId
    })
      .then(function (response) {
        return cb(response)
      })
      .catch(function (error) {
        console.log(error)
      })
  }

  my.createDoelstellingscategorie = function (name, moduleId, creatorId, cb) {
    axios.post('http://146.185.183.217/api/createDoelstellingscategorie', {
      name: name,
      moduleId: moduleId,
      creatorId: creatorId
    })
      .then(function (response) {
        console.log('REACHED CALLBACK')
        return cb(response)
      })
      .catch(function (error) {
        console.log(error)
      })
  }

  my.updateDoelstellingscategorie = function (doelstellingscategorieId, name, cb) {
    axios.patch('http://146.185.183.217/api/updateDoelstellingscategorie', {
      name: name,
      doelstellingscategorieId: doelstellingscategorieId
    })
      .then(function (response) {
        return cb(response)
      })
      .catch(function (error) {
        console.log(error)
      })
  }

  my.createDoelstelling = function (name, doelstellingscategorieId, creatorId, cb) {
    axios.post('http://146.185.183.217/api/createDoelstelling', {
      name: name,
      doelstellingscategorieId: doelstellingscategorieId,
      creatorId: creatorId
    })
      .then(function (response) {
        return cb(response)
      })
      .catch(function (error) {
        console.log(error)
      })
  }

  my.updateDoelstelling = function (doelstellingId, name, cb) {
    axios.patch('http://146.185.183.217/api/updateDoelstelling', {
      name: name,
      doelstellingId: doelstellingId
    })
      .then(function (response) {
        return cb(response)
      })
      .catch(function (error) {
        console.log(error)
      })
  }

  return my
}())

export default Api
