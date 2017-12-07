import pdfMake from 'pdfmake/build/pdfmake.js'
// require('pdfmake/build/pdfmake.js')
import pdfFonts from 'pdfmake/build/vfs_fonts'
pdfMake.vfs = pdfFonts.pdfMake.vfs

var Printer = (function () {
  var printer = {}

  printer.print = function (student, rapport) {
    var docDefinition = {
      content: [
        {
          style: 'tableExample',
          table: {
            widths: ['*'],
            body: [
              [
                { text: 'Leerlinge(e): ' + student.student.firstname + ' ' + student.student.lastname, style: 'headerLeft' }
              ],
              [
                {
                  stack: [
                    'Let\'s try an unordered list',
                    {
                      ul: [
                        'item 1',
                        'item 2'
                      ]
                    }
                  ]
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
