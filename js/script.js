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

    $('.courseCreator').on('click', '.del-fiche-btn', function(e){
        e.stopPropagation();
        $('.' + $(this).data('fiche')).remove();
    });

    $('.courseCreator').on('click', '.add-criteria-btn', function(){
        addCriteria(this);
    });

    $('.courseCreator').on('click', '.del-module-btn', function(){
        $('.' + $(this).data('module')).remove();
    });

    $('.courseCreator').on('click', '.del-criteria-btn', function(){
        $('.' + $(this).data('criteria')).remove();
    });

    $('.opleiding-submit').on('click', function(e){
        e.preventDefault();
        createEditCourseJSON();
    });

    $("#report-search").on('keyup', function(){
      $.ajax({
        type: "POST",
        url: "studentSearch.php",
        dataType: 'json',
        data:'keyword='+$(this).val(),
        success: function(data){
          if(data !== 'no students'){
            $('.dropdown-content').html('');
            $.each(data, function(i, student){
              var studentName = student.firstname + " " + student.lastname;
              $('.dropdown-content').append('<li data-email='+student.email+'>'+studentName+'</li>');
            })
            $('.autocomplete-content li').on('click', function(){
              var student = $(this).text();
              $('#report-search').val(student);
              $('.dropdown-content').html('');
              $('.selectedStudent span').text(student);

            });
          }
        }
      });
    });

    $('#educationsCheckboxesOnShowStudentsPage').find('input').on('change', handleCheckboxesOnShowStudentsPage);

});

var ficheNr = 0;
var moduleNr = 0;
var criteriaNr = 0;

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
        "<li class='fiche-container fiche"+ ficheNr +"'>" +
            "<div class='valign-wrapper collapsible-header collapsible-fiche'><i class='collapse-icon material-icons'>add_box</i>" +
                "<div class='input-field fiche-input'>" +
                    "<input class='fiche-name' name='fiche-name' type='text'>" +
                    "<label for='fiche-name'>Fiche naam</label>" +
                "</div>"+
                "<div class='creator-btns'>"+
                    "<a class='add-module-btn waves-effect waves-light btn' data-fiche='fiche"+ ficheNr +"'><i class='material-icons left'>add</i>Module toevoegen</a>"+
                    "<a class='del-fiche-btn waves-effect waves-light btn red' data-fiche='fiche"+ ficheNr +"'><i id='fiche-del-icon' class='material-icons'>delete</i></a>"+
                "</div>"+
            "</div>" +
            "<div class='collapsible-body'>" +
                "<table class='striped bordered module-table'>"+
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
    "<div class='module-container module" + moduleNr + "'>"+
    "<tr><th>" +
    "<div class='row'>"+
        "<div class='input-field module-input'>" +
        "<input class='module-name' name='module-name' type='text'>" +
        "<label for='module-name'>Module naam</label>" +
        "</div>"+
        "<div class='creator-btns'>"+
        "<a class='add-criteria-btn waves-effect waves-light btn' data-module='module"+ moduleNr +"'><i class='material-icons left'>add</i>Criteria toevoegen</a>"+
        "<a class='del-module-btn waves-effect waves-light btn red' data-module='module"+ moduleNr +"'><i id='fiche-del-icon' class='material-icons'>delete</i></a>"+
        "</div>"+
    "</div>"+
    "</th></tr><div class='criteria-rows'></div></div>"
    );
    $('.module' + moduleNr + ' input').focus();
};

var addCriteria = function(el){
    criteriaNr++;
    var module = $(el).data('module');

    $('.' + module + ' .criteria-rows').append(
        "<div class='criteria-container criteria" + criteriaNr + " criteria-row'>" +
            "<div class='valign-wrapper row'>"+
                "<i style='margin-right: 10px' class='material-icons'>navigate_next</i>"+
                "<div class='input-field criteria-input'>" +
                    "<input class='criteria-name' name='criteria-name' type='text'>" +
                    "<label for='criteria-name'>Criteria naam</label>" +
                "</div>"+
                "<div class='creator-btns'>"+
                    "<a class='del-criteria-btn waves-effect waves-light btn red' data-criteria='criteria"+ criteriaNr +"'><i id='fiche-del-icon' class='material-icons'>delete</i></a>"+
                "</div>"+
            "</div>"+
        "</div>"
    );
    $('.criteria' + criteriaNr + ' input').focus();
};

var createEditCourseJSON = function(){
    var final = [];
    var modules = [];
    var criteria = [];
    var moduleName;
    var ficheName;

    var CourseName = $('#opleiding-name').val();
    final.push({CourseName: CourseName});
    $('.fiche-container').each(function(){
        modules = [];
        $(this).find('.module-container').each(function(){
            criteria = [];
            $(this).find('.criteria-container').each(function(){
                criteria.push($(this).find('.criteria-name').val());
            });
            moduleName =$(this).find('.module-name').val();
            modules.push({module: [moduleName, criteria]});
        });
        ficheName = $(this).find('.fiche-name').val();
        final.push({fiche: [ficheName,modules]});
    });
    var myJsonString = JSON.stringify(final);
    console.log(myJsonString);
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
