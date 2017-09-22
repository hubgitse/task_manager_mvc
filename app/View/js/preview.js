
$(document).ready(function(){
    $(".btn.btn-info").click(function(){
        var name;
        var mail;
        var text;
        name = $("#username").val();
        mail = $("#mail").val();
        text = $("#tasktext").val();

        $( ".name" ).text(name);
        $( ".email" ).text(mail);
        $( ".text" ).text(text);
        $( "button.submit" ).click(function () {
            $("#addform").submit();
        });
    });
});