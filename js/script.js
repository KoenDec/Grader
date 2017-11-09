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
            success: function() {
                console.log('Logged in');
                window.location.replace('index.php');
            },
            error: function(xhr,status) {
                console.log(status);
                $('#error').append('<p style="color:red;">Incorrect username or password.</p>');
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
                window.location.replace('index.php');
            },
            error: function(r) {
                console.log(r);
            }
        });
    });

    $(".button-collapse").sideNav({
        onOpen: function() {
            $('main').css('padding-left', '300px');
            $('header').css('padding-left', '300px');
            $('body').css('overflow', 'visible');
            $('.button-collapse i').html('close');
        },
        onClose: function() {
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

    $('.courseCreator').on('click', '.add-doelstelling-btn', function(){
        addDoelstelling(this);
    });

    $('.courseCreator').on('click', '.del-doelstellingscat-btn', function(){
        $('.' + $(this).data('doelstellingscat')).remove();
    });

    $('.courseCreator').on('click', '.del-doelstelling-btn', function(){
        $('.' + $(this).data('doelstelling')).remove();
    });

    /*$('.opleiding-submit').on('click', function(e){
     e.preventDefault();
     createEditCourseJSON();
     });*/

    $('.edit-opslaan-rapport').on('click', handleReportEdit);

    $("#report-search").on('keyup', function(){

        var submitbutton = $(this).parent().find($("button"));
        submitbutton.addClass("disabled");

        var resultsDropdownlist = $('#studentSearchDropdown.dropdown-content');

        $.ajax({
            type: "POST",
            url: "studentSearch.php",
            dataType: 'json',
            data:'keyword='+$(this).val(),
            success: function(data){
                resultsDropdownlist.html('');
                if(data !== 'no students') {
                    $.each(data, function (i, student) {
                        var studentName = student.firstname + " " + student.lastname;
                        resultsDropdownlist.append('<li data-email="' + student.email + '" data-studentId="' + student.id + '">' + studentName + '</li>');
                    });
                    $('.autocomplete-content li').on('click', function () {
                        var student = $(this).text();
                        $("#foundStudentId").val($(this).attr("data-studentId"));
                        $('#report-search').val(student);
                        submitbutton.removeClass("disabled");
                        resultsDropdownlist.html('');
                    });
                } else if($(this).val() == ""){

                } else {
                    resultsDropdownlist.append('<li><em>No students found</em></li>');
                }
            }
        });
    });

    $('.add-doelstellingscat-btn').on('click', addDoelstellingscat);
    $('#educationsCheckboxes').find('input').on('change', handleEducationsCheckboxes);
    $('.addModule').on('click', submitModule);

});

var doelstellingscatNr = 0;
var doelstellingNr = 0;

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

var addDoelstellingscat = function(){
    console.log("test");
    doelstellingscatNr++;
    $(' .no-doelstellingen').addClass('hidden');

    $(' .doelstelling-table').append(
        "<div class='doelstellingscat-container doelstellingscat" + doelstellingscatNr + "'>"+
        "<tr><th>" +
        "<div class='row'>"+
        "<div class='input-field doelstellingscat-input'>" +
        "<input class='doelstellingscat-name' name='doelstellingscat" + doelstellingscatNr + "-name' type='text'>" +
        "<label for='doelstellingscat" + doelstellingscatNr + "-name'>Doelstellingscategorie naam</label>" +
        "</div>"+
        "<div class='creator-btns'>"+
        "<a class='add-doelstelling-btn waves-effect waves-light btn' data-doelstellingscat='doelstellingscat"+ doelstellingscatNr +"'><i class='material-icons left'>add</i>Doelstelling toevoegen</a>"+
        "<a class='del-doelstellingscat-btn waves-effect waves-light btn red' data-doelstellingscat='doelstellingscat"+ doelstellingscatNr +"'><i id='module-del-icon' class='material-icons'>delete</i></a>"+
        "</div>"+
        "</div>"+
        "</th></tr><div class='doelstellingen-rows'></div></div>"
    );
    $('.doelstellingscat' + doelstellingscatNr + ' input').focus();
};

var addDoelstelling = function(doelstellingscat){
    doelstellingNr++;
    console.log($(doelstellingscat));
    var doelstellingsCategorie = $(doelstellingscat).data('doelstellingscat');

    $('.' + doelstellingsCategorie + ' .doelstellingen-rows').append(
        "<div class='doelstellingen-container doelstellingen" + doelstellingNr + " doelstelling-row'>" +
        "<div class='valign-wrapper row'>"+
        "<i style='margin-right: 10px' class='material-icons'>navigate_next</i>"+
        "<div class='input-field doelstelling-input'>" +
        "<input class='doelstelling-name' name='criterium" + doelstellingNr + "-name' type='text'>" +
        "<label for='criterium" + doelstellingNr + "-name'>Doelstelling naam</label>" +
        "</div>"+
        "<div class='creator-btns'>"+
        "<a class='del-doelstelling-btn waves-effect waves-light btn red' data-doelstelling='doelstelling"+ doelstellingNr +"'><i id='module-del-icon' class='material-icons'>delete</i></a>"+
        "</div>"+
        "</div>"+
        "</div>"
    );
    $('.doelstelling' + doelstellingNr + ' input').focus();
};

var createEditCourseJSON = function(){
    var final = [];
    var doelstellingscategories = [];
    var doelstellingen = [];
    var doelstellingscatName;
    var moduleName;

    var CourseName = $('#opleiding-name').val();
    final.push({CourseName: CourseName});
    $('.module-container').each(function(){
        doelstellingscategories = [];
        $(this).find('.doelstellingscat-container').each(function(){
            doelstellingen = [];
            $(this).find('.doelstellingen-container').each(function(){
                doelstellingen.push($(this).find('.doelstelling-name').val());
            });
            doelstellingscatName =$(this).find('.doelstellingscat-name').val();
            doelstellingscategories.push({doelstellingscategorie: [doelstellingscatName, doelstellingen]});
        });
        moduleName = $(this).find('.module-name').val();
        final.push({module: [moduleName,doelstellingscategories]});
    });
    var myJsonString = JSON.stringify(final);
    console.log(myJsonString);
};

var handleEducationsCheckboxes = function(){
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

var submitModule = function(e){
    e.preventDefault();
    var form = $(this).parent().parent();

    var stopAddingModules = $(this).attr('data-stopAddingModules');
    if(stopAddingModules == "true"){
        form.attr('action', 'index.php?page=opleidingen');
    } else {
        form.attr('action','index.php?page=addModuleToOpleiding');
    }
    form.submit();
};
