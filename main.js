window.onload = function() {

    $("textarea").keyup(function(){
      var diary = $("textarea").val();
//      $.redirect("ajax.php", {content: diary});
        $.ajax({
          type: "POST",
          url: "./ajax.php",
          data: {content: diary},
         });
    });
}