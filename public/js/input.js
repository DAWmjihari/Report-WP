$(function() {
    $("input:text, input:password").focus(function() {
        $(this).css("font-weight", "bold");
    });

    $("input:text, input:password").focusout(function() {
        $(this).css("font-weight", "normal");
    });
});