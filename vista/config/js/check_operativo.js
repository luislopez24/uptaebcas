 
$(document).ready(function() {  

  $('#nombre').on('blur', function() {

    if ($('#nombre').val().length != 0) {

      $('#result-operativo').html('<img src="vista/config/img/805.gif" style="width: 20px; height: auto;"/>').fadeOut(1000);

      var see = document.getElementById('check');  see.style.display = ''; 

      var nombre = $(this).val();   
      var dataString = 'nombre='+nombre;

      $.ajax({
        type: "POST",
        url: "?url=operativo&opcion=check_operativo",
        data: dataString,
        success: function(data) {
          $('#result-operativo').fadeIn(1000).html(data);
        }
      });

    }

    
  });
  
});   

