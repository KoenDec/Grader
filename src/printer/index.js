import pdfMake from 'pdfmake/build/pdfmake.js'
import pdfFonts from 'pdfmake/build/vfs_fonts'
pdfMake.vfs = pdfFonts.pdfMake.vfs

var Printer = (function () {
  var printer = {}
  var docDefinition

  function getAcademicYear (string) {
    var years = string.match(/[0-9]{4}/g)
    years.sort()
    return years
  }

  function writeRotatedText (text) {
    var canvas = document.createElement('canvas')
    var ctx = document.createElement('canvas')
    // I am using predefined dimensions so either make this part of the arguments or change at will
    canvas.width = 36
    canvas.height = 120
    ctx = canvas.getContext('2d')
    ctx.font = '8pt Arial'
    ctx.save()
    ctx.translate(18, 118)
    ctx.rotate(-0.5 * Math.PI)
    ctx.fillStyle = '#000'
    ctx.fillText(text, 0, 0)
    ctx.restore()
    return canvas.toDataURL()
  }

  function textToIMG (text) {
    var canvas = document.createElement('canvas')
    var ctx = document.createElement('canvas')

    canvas.width = 320
    canvas.height = 400
    ctx = canvas.getContext('2d')
    ctx.font = '36pt Arial'
    ctx.save()
    ctx.translate(25, 300)
    ctx.fillStyle = '#000'
    ctx.fillText(text, 0, 0)
    ctx.restore()
    return canvas.toDataURL()
  }

  function verticalText (text) {
    return {image: writeRotatedText(text), fit: [50, 100], alignment: 'center'}
  }

  function addModule (module) {
    docDefinition.content.push({text: 'MODULE: ' + module.naam.toUpperCase(), style: 'moduleStyle', margin: [ 0, 5, 0, 10 ]})
    module.doelstellingscategories.forEach(function (item, index) {
      docDefinition.content.push({text: item.name, margin: [0, 5, 0, 5]})
      var object = {
        table: {
          widths: [160, 20, 20, 20, 20, 20, '*'],
          body: []
        }
      }
      item.doelstellingen.forEach(function (item, index) {
        var score = [item.name, '', '', '', '', '', item.opmerking]
        switch (item.score) {
          case 'ZG':
            score[1] = 'X'
            break
          case 'G':
            score[1] = 'X'
            break
          case 'V':
            score[2] = 'X'
            break
          case 'OV':
            score[3] = 'X'
            break
          case 'RO':
            score[4] = 'X'
            break
          case 'A':
            score[4] = 'X'
            break
          default:
            break
        }
        object.table.body.push(score)
      })
      docDefinition.content.push(object)
    })
    // docDefinition.content[docDefinition.content.length - 1].pageBreak = 'after'
  }

  printer.print = function (student, rapport) {
    docDefinition = {
      content: [
        {
          style: 'tableExample',
          table: {
            widths: ['*'],
            body: [
              [
                {
                  stack: [
                    {
                      text: 'Leerling(e): ' + student.student.firstname + ' ' + student.student.lastname, style: 'headerLeft'
                    },
                    {text: 'Studierichting: ' + student.opleiding.name, style: 'headerLeft'}// ,
                    // {text: 'Academiejaar: ' + getAcademicYear(rapport.name)[0] + '-' + getAcademicYear(rapport.name)[1], style: 'headerLeft'}
                  ]
                }
              ]
            ]
          }
        },
        {
          table: {
            widths: [160, 20, 20, 20, 20, 20, '*'],
            body: [
              [{image: textToIMG('Vakken'), fit: [70, 140], alignment: 'center'}, verticalText('GOED'), verticalText('VOLDOENDE'), verticalText('ONVOLDOENDE'), verticalText('RUIM ONVOLDOEND'), verticalText('AFWEZIG'), {image: textToIMG('Opmerkingen'), fit: [70, 140], alignment: 'center'}]
            ]
          }
        }
      ],
      styles: {
        header: {
          fontSize: 22,
          bold: true
        },
        anotherStyle: {
          italic: true,
          alignment: 'right'
        },
        headerLeft: {
          alignment: 'left'
        },
        headerRight: {
          alignment: 'right'
        },
        tableExample: {
          width: '100%'
        },
        centerStyle: {
          alignment: 'center'
        },
        moduleStyle: {
          bold: true
        }
      }
    }

    rapport.modules.forEach(function (item) {
      addModule(item)
    })

    pdfMake.createPdf(docDefinition).print()
  }
  return printer
}())

export default Printer
