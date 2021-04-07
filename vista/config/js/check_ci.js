 
$(document).ready(function() {  

  $('#ci').on('blur', function() {

    if ($('#ci').val().length != 0) {

      $('#result-ci').html('<img src="vista/config/img/805.gif" style="width: 20px; height: auto;"/>').fadeOut(1000);

      var see = document.getElementById('check');  see.style.display = ''; 

      var ci = $(this).val();   
      var dataString = 'ci='+ci;

      var ci_comparacion = document.getElementById("ci_com");
      var ci1 = document.getElementById("ci");

      $.ajax({
        type: "POST",
        url: "?paso=usuario&opcion=check_ci",
        data: dataString,
        success: function(data) {
          $('#result-ci').fadeIn(1000).html(data);
        }
      });

    }

    
  });
  
});   

 