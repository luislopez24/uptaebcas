 
$(document).ready(function() {  

  $('#ref').on('blur', function() {

    if ($('#ref').val().length != 0) {

      $('#result-num').html('<img src="vista/config/img/805.gif" style="width: 20px; height: auto;"/>').fadeOut(1000);

      var see = document.getElementById('check');  see.style.display = ''; 

      var ci = $(this).val();   
      var dataString = 'ref='+ref;

      var ci_comparacion = document.getElementById("ci_com");
      var ci1 = document.getElementById("ci");

      $.ajax({
        type: "POST",
        url: "?url=beneficiario&opcion=check_numero",
        data: dataString,
        success: function(data) {
          $('#result-ref').fadeIn(1000).html(data);
        }
      });

    }

    
  });
  
});   

 