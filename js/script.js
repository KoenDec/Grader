/**
 * Created by Kenny on 9/10/2017.
 */
$(document).ready(function () {

  $('#login').on('click', function(e) {
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: 'api/auth',
      content: 'application/json',
      data: '{"username": "'+$('#username').val()+'", "password": "'+$('#password').val()+'"}',
      success: function(r) {
        console.log('Logged in');
        window.location.replace('index.php');
      },
      error: function(xhr,status,err) {
        console.log(status);
        $('#error').append('<p style="color:red;">Incorrect username or password.</p>')
      }
    });
  });

  $('#logout').on('click', function() {
    var token = document.cookie.replace(/(?:(?:^|.*;\s*)GID\s*\=\s*([^;]*).*$)|^.*$/, "$1");
    $.ajax({
      type: 'DELETE',
      url: 'api/auth?' + $.param({"token":token}),
      content: 'application/json',
      success: function(r) {
        console.log('Logged out',r);
      },
      error: function(r) {
        console.log(r);
      }
    });
  });

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

    $('#all-checkboxes, #more-checkboxes').change(function () {
        var checkboxes = $(this).closest('form').find(':checkbox');
        checkboxes.prop('checked', $(this).is(':checked'));
    });

    $('.openPopup').on('click', popup);
    $('.popup-submit, .popup-exit').on('click', closePopup);

    $('select').material_select();

    $('.collapsible').on('click', '.collapsible-module', function(){
        changeCollapseIcon(this);
    });

    $('.addModule').on('click', function(e){
        e.preventDefault();
        addModule();
    });

    $('.courseCreator').on('click', '.add-doelstelling-btn', function (e) {
        e.stopPropagation();
        addDoelstelling(this);
    });

    $('.courseCreator').on('click', '.del-module-btn', function(e){
        e.stopPropagation();
        $('.' + $(this).data('module')).remove();
    });

    $('.courseCreator').on('click', '.add-criteria-btn', function(){
        addCriteria(this);
    });

    $('.courseCreator').on('click', '.del-doelstelling-btn', function(){
        $('.' + $(this).data('doelstelling')).remove();
    });

    $('.courseCreator').on('click', '.del-criteria-btn', function(){
        $('.' + $(this).data('criteria')).remove();
    });

    /*$('.opleiding-submit').on('click', function(e){
        e.preventDefault();
        createEditCourseJSON();
    });*/

    $('.edit-opslaan-rapport').on('click', handleReportEdit);

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

    $('#educationsCheckboxes').find('input').on('change', handleEducationsCheckboxes);

});

var moduleNr = 0;
var doelstellingNr = 0;
var criteriaNr = 0;

var popup = function(){
    $('.popup').removeClass('hidden');
    $('.blur-overlay').removeClass('hidden');
};

var closePopup = function(){
    $('.popup').addClass('hidden');
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

var handleReportEdit = function(){
    console.log($(this).data('editing'));
    if($(this).data('editing') === false){
        $(this).find('i').text('save');
        $('select').removeClass("hidden").prop('disabled', false).material_select();

        $('input').prop('disabled', false);
        $('textarea').prop('disabled', false);
        $(this).data('editing', true);
    }
    else{
        $(this).find('i').text('edit');
        $('select').addClass("hidden").prop('disabled', true).material_select();
        $('input').prop('disabled', true);
        $(this).data('editing', false);
    }
};

var addModule = function(){
    moduleNr++;
    $('.courseCreator').append(
        "<li class='module-container module"+ moduleNr +"'>" +
            "<div class='valign-wrapper collapsible-header collapsible-module'><i class='collapse-icon material-icons'>add_box</i>" +
                "<div class='input-field module-input'>" +
                    "<input name='module-name' data-doelstelling='module"+ moduleNr +"' type='text'>" +
                    "<label for='module-name'>Doelstelling naam</label>" +
                "</div>"+
                "<div class='creator-btns'>"+
                    "<a class='add-doelstelling-btn waves-effect waves-light btn' data-module='module"+ moduleNr +"'><i class='material-icons left'>add</i>Doelstelling toevoegen</a>"+
                    "<a class='del-module-btn waves-effect waves-light btn red' data-module='module"+ moduleNr +"'><i id='module-del-icon' class='material-icons'>delete</i></a>"+
                "</div>"+
            "</div>" +
            "<div class='collapsible-body'>" +
                "<table class='striped bordered doelstelling-table'>"+
                    "<p class='no-doelstellingen'>Geen doelstellingen</p>"+
                "</table>"+
            "</div>"+
        "</li>"
    );
    $('.module'+ moduleNr + ' input').focus();

};

var addDoelstelling = function(el){
    doelstellingNr++;
    var module =  $(el).data('module');
    var colHead = $('.' + module + ' .collapsible-header');
    if(!colHead.hasClass('active')){
        colHead.trigger('click');
    }
    $('.'+ module + ' .no-doelstellingen').addClass('hidden');

    $('.'+ module + ' .doelstelling-table').append(
    "<div class='doelstelling-container doelstelling" + doelstellingNr + "'>"+
    "<tr><th>" +
    "<div class='row'>"+
        "<div class='input-field doelstelling-input'>" +
        "<input class='doelstelling-name' name='doelstelling-name' type='text'>" +
        "<label for='doelstelling-name'>Doelstelling naam</label>" +
        "</div>"+
        "<div class='creator-btns'>"+
        "<a class='add-criteria-btn waves-effect waves-light btn' data-doelstelling='doelstelling"+ doelstellingNr +"'><i class='material-icons left'>add</i>Criteria toevoegen</a>"+
        "<a class='del-doelstelling-btn waves-effect waves-light btn red' data-doelstelling='doelstelling"+ doelstellingNr +"'><i id='module-del-icon' class='material-icons'>delete</i></a>"+
        "</div>"+
    "</div>"+
    "</th></tr><div class='criteria-rows'></div></div>"
    );
    $('.doelstelling' + doelstellingNr + ' input').focus();
};

var addCriteria = function(el){
    criteriaNr++;
    var doelstelling = $(el).data('doelstelling');

    $('.' + doelstelling + ' .criteria-rows').append(
        "<div class='criteria-container criteria" + criteriaNr + " criteria-row'>" +
            "<div class='valign-wrapper row'>"+
                "<i style='margin-right: 10px' class='material-icons'>navigate_next</i>"+
                "<div class='input-field criteria-input'>" +
                    "<input class='criteria-name' name='criteria-name' type='text'>" +
                    "<label for='criteria-name'>Criteria naam</label>" +
                "</div>"+
                "<div class='creator-btns'>"+
                    "<a class='del-criteria-btn waves-effect waves-light btn red' data-criteria='criteria"+ criteriaNr +"'><i id='module-del-icon' class='material-icons'>delete</i></a>"+
                "</div>"+
            "</div>"+
        "</div>"
    );
    $('.criteria' + criteriaNr + ' input').focus();
};

var createEditCourseJSON = function(){
    var final = [];
    var doelstellingen = [];
    var criteria = [];
    var doelstellingName;
    var moduleName;

    var CourseName = $('#opleiding-name').val();
    final.push({CourseName: CourseName});
    $('.module-container').each(function(){
        doelstellingen = [];
        $(this).find('.doelstelling-container').each(function(){
            criteria = [];
            $(this).find('.criteria-container').each(function(){
                criteria.push($(this).find('.criteria-name').val());
            });
            doelstellingName =$(this).find('.doelstelling-name').val();
            doelstellingen.push({doelstelling: [doelstellingName, criteria]});
        });
        moduleName = $(this).find('.module-name').val();
        final.push({module: [moduleName,doelstellingen]});
    });
    var myJsonString = JSON.stringify(final);
    console.log(myJsonString);
};

var handleEducationsCheckboxes = function(){
    console.log("test");
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
