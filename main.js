window.onload = function() {

    $("textarea").keyup(function(){
      //When key pressed, update SQL via ajax.php
      var diary = $("textarea").val();
        $.ajax({
          type: "POST",
          url: "./ajax.php",
          data: {content: diary},
         });
    });
}