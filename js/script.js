/**
 * Created by Kenny on 9/10/2017.
 */
$(document).ready(function () {
    $(".button-collapse").sideNav({
        onOpen: function (el) {
            $('main').css('padding-left', '300px');
            $('header').css('padding-left', '300px');
            $('body').css('overflow', 'visible');
            $('.button-collapse i').html('close');
        },
        onClose: function (el) {
            $('main').css('padding-left', '0');
            $('header').css('padding-left', '0');
            $('.button-collapse i').html('menu');
        }
    });

    var href = window.location.href;
    if (href.substr(href.length - 10) === "/index.php") {
        $(".button-collapse").sideNav('show');
    }

    $(".dropdown-button").dropdown();

    $('#all-checkboxes').change(function () {
        var checkboxes = $(this).closest('form').find(':checkbox');
        checkboxes.prop('checked', $(this).is(':checked'));
    });

    $('.csv-upload').on('click', popup_csv);
    $('.csv-submit, .popup-exit').on('click', closePopup_csv);


    $('.addMessage').on('click', popupMessage);
    $('.message-submit, .popup-exit').on('click', closePopupMessage);

    $('select').material_select();

    $('.collapsible').on('click', '.collapsible-fiche', function(){
        changeCollapseIcon(this);
    });

    $('.addFiche').on('click', function(e){
        e.preventDefault();
        addFiche();
    });

    $('.courseCreator').on('click', '.add-module-btn', function (e) {
        e.stopPropagation();
        addModule(this);
    });

    $("#report-search").on('keyup', function(){
      console.log('new input');
      $.ajax({
        type: "POST",
        url: "studentSearch.php",
        data:'keyword='+$(this).val(),
        success: function(data){
          console.log(data);
          $.each(JSON.parse(data), function(i, student){
            var studentName = student.firstname + " " + student.lastname;
            $('#report-search').append('<ul class="autocomplete-content dropdown-content"><li>'+studentName+'</li></ul>');
          })
        }
      });
    });

    $('#educationsCheckboxesOnShowStudentsPage').find('input').on('change', handleCheckboxesOnShowStudentsPage);

});

var ficheNr = 0;
var moduleNr = 0;

var popupMessage = function(){
    $('.addMessage-popup').removeClass('hidden');
    $('.addMessage').addClass('hidden');
    $('.blur-overlay').removeClass('hidden');
};

var closePopupMessage = function(){
    $('.addMessage-popup').addClass('hidden');
    $('.addMessage').removeClass('hidden');
    $('.blur-overlay').addClass('hidden');

};

var popup_csv = function(){
    $('.csv-upload-popup').removeClass('hidden');
    $('.addstudent').addClass('hidden');
    $('.blur-overlay').removeClass('hidden');
};

var closePopup_csv = function(){
    $('.csv-upload-popup').addClass('hidden');
    $('.addstudent').removeClass('hidden');
    $('.blur-overlay').addClass('hidden');

};

var changeCollapseIcon = function(el){
    if(!$(el).hasClass('active')){
        $(el).find('.collapse-icon').html('add_box');
    }
    else{
        $(el).find('.collapse-icon').html('indeterminate_check_box');
    }
};

var addFiche = function(){
    ficheNr++;
    $('.courseCreator').append(
        "<li class='fiche"+ ficheNr +"'>" +
            "<div class='valign-wrapper collapsible-header collapsible-fiche'><i class='collapse-icon material-icons'>add_box</i>" +
                "<div class='input-field fiche-input'>" +
                    "<input class='fiche-name' name='fiche-name' type='text'>" +
                    "<label for='fiche-name'>Fiche naam</label>" +
                "</div>"+
                "<div class='fiche-btns'>"+
                    "<a class='add-module-btn waves-effect waves-light btn' data-fiche='fiche"+ ficheNr +"'><i class='material-icons left'>add</i>Module toevoegen</a>"+
                    "<a class='del-fiche-btn waves-effect waves-light btn red' data-fiche='fiche"+ ficheNr +"'><i id='fiche-del-icon' class='material-icons'>delete</i></a>"+
                "</div>"+
            "</div>" +
            "<div class='collapsible-body'>" +
                "<table class='module-table'>"+
                    "<p class='no-modules'>Geen modules</p>"+
                "</table>"+
            "</div>"+
        "</li>"
    );
    $('.fiche'+ ficheNr + ' input').focus();

};

var addModule = function(el){
    moduleNr++;
    var fiche =  $(el).data('fiche');
    var colHead = $('.' + fiche + ' .collapsible-header');
    if(!colHead.hasClass('active')){
        colHead.trigger('click');
    }
    $('.'+ fiche + ' .no-modules').addClass('hidden');

    $('.'+ fiche + ' .module-table').append(
    "<tr><th>" +
    "<div class='input-field fiche-input'>" +
        "<input class='module-name' name='module-name' type='text'>" +
        "<label for='module-name'>Module naam</label>" +
    "</div>"+
    "</th></tr>"
    );
};

var handleCheckboxesOnShowStudentsPage = function(){
    var showOrHideStudents = function(educationId, show, trsStudents){
        for (var i = 0; i < trsStudents.length - 1; i++) {
            var cur = $(trsStudents[i + 1]);
            if (educationId === null || cur.attr('data-opleidingid') === educationId) {
                if (show) {
                    cur[0].setAttribute("style", "display:normal");
                }
                else {
                    cur[0].setAttribute("style", "display:none");
                }
            }
        }
    };

    var trsStudents = $(this).parent().parent().parent().find('table').find('tr');
    var show = $(this).is(':checked');
    if(!show) $("#all-checkboxes").prop('checked', show); // TODO opposite of this: set checked if all educations are checked

    if ($(this).attr('id') === 'all-checkboxes') {
        showOrHideStudents(null, show, trsStudents);
    } else {
        var id = $(this).attr('id').substr(9);
        showOrHideStudents(id, show, trsStudents);
    }
};