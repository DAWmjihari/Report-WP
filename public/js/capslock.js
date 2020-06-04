$(function() {
    $('#sh_password').click(function() {
        if ($('#password').attr('type') == "password") {
            $('#password').attr('type', 'text');
            $($(this).children()[0]).toggleClass("fa-eye-slash fa-eye");
        } else {
            $('#password').attr('type', 'password');
            $($(this).children()[0]).toggleClass("fa-eye fa-eye-slash");
        }
    });

    $('#user_login').keyup(function(e) {
        if (e.originalEvent.getModifierState("CapsLock")) {
            $('#capslockdiv').fadeIn();

        } else {
            $('#capslockdiv').fadeOut();
        }
    });
    $('#password').keyup(function(e) {
        if (e.originalEvent.getModifierState("CapsLock")) {
            $('#capslockdiv').fadeIn();
        } else {
            $('#capslockdiv').fadeOut();
        }
    });
});