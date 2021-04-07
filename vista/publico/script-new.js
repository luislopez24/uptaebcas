      $('input#input_text, textarea#direc').characterCounter();
      $('input#input_text, input#correo').characterCounter();
      $('input#input_text, input#password').characterCounter();
      $('input#input_text, input#passwo').characterCounter();
      $('input#input_text, input#cant').characterCounter();
    
  
    function mostrarPassword(){
          var cambio = document.getElementById("password");
          if(cambio.type == "password"){
            cambio.type = "text";
            $('a#show_password').removeClass('btn waves-effect waves-light green darken-2 white-text').addClass('btn waves-effect waves-light red darken-2 white-text');
            $('i#h').removeClass('icon-visibility').addClass('icon-visibility_off');
          }else{
            cambio.type = "password";
            $('a#show_password').removeClass('btn waves-effect waves-light red darken-2 white-text').addClass('btn waves-effect waves-light green darken-2 white-text');
            $('i#h').removeClass('icon-visibility_off').addClass('icon-visibility');
          }
        }

    function mos(){
          var cambio = document.getElementById("con");
          if(cambio.type == "password"){
            cambio.type = "text";
            $('a#shol').removeClass('btn waves-effect waves-light green darken-2 white-text').addClass('btn waves-effect waves-light red darken-2 white-text');
            $('i#ho').removeClass('icon-visibility').addClass('icon-visibility_off');
          }else{
            cambio.type = "password";
            $('a#shol').removeClass('btn waves-effect waves-light red darken-2 white-text').addClass('btn waves-effect waves-light green darken-2 white-text');
            $('i#ho').removeClass('icon-visibility_off').addClass('icon-visibility');
          }
        } 

    function mostrarPas(){
          var cambio = document.getElementById("passwo");
          if(cambio.type == "password"){
            cambio.type = "text";
            $('a#show_password1').removeClass('btn waves-effect waves-light green darken-2 white-text').addClass('btn waves-effect waves-light red darken-2 white-text');
            $('i#h1').removeClass('icon-visibility').addClass('icon-visibility_off');
          }else{
            cambio.type = "password";
            $('a#show_password1').removeClass('btn waves-effect waves-light red darken-2 white-text').addClass('btn waves-effect waves-light green darken-2 white-text');
            $('i#h1').removeClass('icon-visibility_off').addClass('icon-visibility');
          }
        }

    function mostrarPassword2(){
          var cambio = document.getElementById("contra_");
          if(cambio.type == "password"){
            cambio.type = "text";
            $('a#show').removeClass('btn waves-effect waves-light green darken-2 white-text').addClass('btn waves-effect waves-light red darken-2 white-text');
            $('i#hj').removeClass('icon-visibility').addClass('icon-visibility_off');
          }else{
            cambio.type = "password";
            $('a#show').removeClass('btn waves-effect waves-light red darken-2 white-text').addClass('btn waves-effect waves-light green darken-2 white-text');
            $('i#hj').removeClass('icon-visibility_off').addClass('icon-visibility');
          }
        } 

    function mostrarPas2(){
          var cambio = document.getElementById("contra_2");
          if(cambio.type == "password"){
            cambio.type = "text";
            $('a#show_p').removeClass('btn waves-effect waves-light green darken-2 white-text').addClass('btn waves-effect waves-light red darken-2 white-text');
            $('i#hl').removeClass('icon-visibility').addClass('icon-visibility_off');
          }else{
            cambio.type = "password";
            $('a#show_p').removeClass('btn waves-effect waves-light red darken-2 white-text').addClass('btn waves-effect waves-light green darken-2 white-text');
            $('i#hl').removeClass('icon-visibility_off').addClass('icon-visibility');
          }
        } 
