import pdfMake from 'pdfmake/build/pdfmake.js'
// require('pdfmake/build/pdfmake.js')
import pdfFonts from 'pdfmake/build/vfs_fonts'
pdfMake.vfs = pdfFonts.pdfMake.vfs

var Printer = (function () {
  var printer = {}

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
    ctx.translate(18, 115)
    ctx.rotate(-0.5 * Math.PI)
    ctx.fillStyle = '#000'
    ctx.fillText(text, 0, 0)
    ctx.restore()
    return canvas.toDataURL()
  }

  function verticalText (text) {
    return {image: writeRotatedText(text), fit: [50, 100], alignment: 'center'}
  }

  printer.print = function (student, rapport) {
    var docDefinition = {
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
                      text: 'Leerlinge(e): ' + student.student.firstname + ' ' + student.student.lastname, style: 'headerLeft'
                    },
                    {text: 'Studierichting: ' + student.opleiding.name, style: 'headerLeft'},
                    {text: 'Academiejaar: ' + getAcademicYear(rapport.name)[0] + '-' + getAcademicYear(rapport.name)[1], style: 'headerLeft'}
                  ]
                }
              ],
              [
                {
                  table: {
                    widths: ['*', 20, 20, 20, 20, 20, '*'],
                    body: [
                      ['Vakken', verticalText('GOED'), verticalText('VOLDOENDE'), verticalText('ONVOLDOENDE'), verticalText('RUIM ONVOLDOEND'), verticalText('AFWEZIG'), 'Opmerkingen']
                    ]
                  }
                }
              ]
            ]
          }
        },
        { text: 'This is a header', style: 'header' },
        'No styling here, this is a standard paragraph',
        { text: 'Another text', style: 'anotherStyle' },
        { text: 'Multiple styles applied', style: [ 'header', 'anotherStyle' ] }
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
        }
      }
    }
    pdfMake.createPdf(docDefinition).open()
  }
  return printer
}())

export default Printer
