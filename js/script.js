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

});

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