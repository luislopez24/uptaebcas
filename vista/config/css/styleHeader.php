<?php 

require_once ("modelo/notificacion.php");
    $notificacion= new Notificacion();
    
    $mensajesBuzon = $notificacion->consultarMensajes($_SESSION['id_ussuario']);
    $mensajesBuzonNotificacion = $notificacion->consultarNotificaciones($_SESSION['id_ussuario']);
            
    $contBuzonMsj = 0;
    $contBuzonNotificaciones = 0;

    foreach ($mensajesBuzon as $value) {

    if ($value['leido'] == 0) {
        
        $contBuzonMsj = $contBuzonMsj + 1;    
    }
    
    
    }

    foreach ($mensajesBuzonNotificacion as $value) {
    
    if ($value['leido'] == 0) {
    $contBuzonNotificaciones = $contBuzonNotificaciones + 1;
    
    }
    }
?>

<style type="text/css">

tr.nose:hover{
  background-color: #DDDDDD!important;
}

img.izquierda {
  float: left;
}

span#not {
  background: red;
   border-radius: 0.8em;
  -moz-border-radius: 0.8em;
  -webkit-border-radius: 0.8em;
  color: #ffffff;
  display: inline-block;
  font-weight: bold;
  line-height: 1.8em;
  margin-right: 0px!important;
  text-align: center;
  width: 1.6em; 
  font-size: 70%;
}

span#two {
  background: red;
   border-radius: 1.8em;
  -moz-border-radius: 1.8em;
  -webkit-border-radius: 1.8em;
  color: #ffffff;
  display: inline-block;
  font-weight: bold;
  line-height: 1.8em;
  margin-right: 10px!important;
  text-align: center;
  width: 1.8em; 
  font-size: 120%;

}

span#three {
  background: green;
   border-radius: 1.8em;
  -moz-border-radius: 1.8em;
  -webkit-border-radius: 1.8em;
  color: #ffffff;
  display: inline-block;
  font-weight: bold;
  line-height: 1.8em;
  margin-right: 10px!important;
  text-align: center;
  width: 1.8em; 
  font-size: 120%;

}

span#four {
  background: blue;
   border-radius: 1.8em;
  -moz-border-radius: 1.8em;
  -webkit-border-radius: 1.8em;
  color: #ffffff;
  display: inline-block;
  font-weight: bold;
  line-height: 1.8em;
  margin-right: 10px!important;
  text-align: center;
  width: 1.8em; 
  font-size: 120%;

}

span#twoMensaje {
  background: red;
   border-radius: 1.8em;
  -moz-border-radius: 1.8em;
  -webkit-border-radius: 1.8em;
  color: #ffffff;
  display: inline-block;
  font-weight: bold;
  line-height: 2.8em;
  margin-right: 10px!important;
  text-align: center;
  width: 2.8em;   
  font-size: 120%;

}

span#threeMensaje {
  background: green;
   border-radius: 1.8em;
  -moz-border-radius: 1.8em;
  -webkit-border-radius: 1.8em;
  color: #ffffff;
  display: inline-block;
  font-weight: bold;
  line-height: 2.8em;
  margin-right: 10px!important;
  text-align: center;
  width: 2.8em; 
  font-size: 120%;

}

span#fourMensaje {
  background: blue;
   border-radius: 1.8em;
  -moz-border-radius: 1.8em;
  -webkit-border-radius: 1.8em;
  color: #ffffff;
  display: inline-block;
  font-weight: bold;
  line-height: 2.8em;
  margin-right: 10px!important;
  text-align: center;
  width: 2.8em; 
  font-size: 120%;

}

  .Blink {
       animation: blinker .8s cubic-bezier(.5, 0, 1, 1) infinite alternate;  
}

@keyframes blinker {  
     from { opacity: 1; }
     to { opacity: 0; }
}


  /* Scroll Personalizado */
  #mobile-demo::-webkit-scrollbar {
    width: 8px;     /* Tamaño del scroll en vertical */
    height: 4px;    /* Ocultar scroll */
  }

  /* Ponemos un color de fondo y redondeamos las esquinas del thumb */
  #mobile-demo::-webkit-scrollbar-thumb {
    background: #ccc;
    border-radius: 4px;
  }

  /* Cambiamos el fondo y agregamos una sombra cuando esté en hover */
  #mobile-demo::-webkit-scrollbar-thumb:hover {
    background: darkblue;
    box-shadow: 0 0 2px 1px rgba(0, 0, 0, 0.2);
  }

  /* Cambiamos el fondo cuando esté en active */
  #mobile-demo::-webkit-scrollbar-thumb:active {
    background-color: black;
  }

  /* Ponemos un color de fondo y redondeamos las esquinas del track */
  #mobile-demo::-webkit-scrollbar-track {
    background: #e1e1e1;
    border-radius: 4px;
  }

  /* Cambiamos el fondo cuando esté en active o hover */
  #mobile-demo::-webkit-scrollbar-track:hover,
  #mobile-demo::-webkit-scrollbar-track:active {
    background: #d4d4d4;
  }

  .waves-effect.waves-brown .waves-ripple {
   /* The alpha value allows the text and background color
   of the button to still show through. */
   background-color: rgba(27, 132, 243 , 0.65);
 }

 element.style {
 }

 ul.sidenav.sidenav-fixed ul.collapsible-accordion .collapsible-body li a {
  font-weight: 400;
  padding: 0 37.5px 0 45px;
}

ul.sidenav.sidenav-fixed li#hola a {
  font-size: 13px;
  line-height: 44px;
  height: 44px;
  padding: 0 30px;
  outline: none;
}

li.active>a#color{

  background-color: rgba(27, 132, 243 , 0.65);
  color: white!important;
}

.sidenav .collapsible-body li a, .sidenav.fixed .collapsible-body li a {
  padding: 0 23.5px 0 31px;
}
.sidenav li>a {
  color: rgba(0,0,0,0.87);
  display: block;
  font-size: 14px;
  font-weight: 500;
  height: 48px;
  line-height: 48px;
  padding: 0 32px;
}
a {
  text-decoration: none;
}
a {
  color: #039be5;
  text-decoration: none;
  -webkit-tap-highlight-color: transparent;
}
a {
  background-color: transparent;
  -webkit-text-decoration-skip: objects;
}
*, *:before, *:after {
  -webkit-box-sizing: inherit;
  box-sizing: inherit;
}
user agent stylesheet
a:-webkit-any-link {
  color: -webkit-link;
  cursor: pointer;
  text-decoration: underline;
}
ul.sidenav.sidenav-fixed li {
  line-height: 44px;
}
ul:not(.browser-default)>li {
  list-style-type: none;
}
.sidenav li {
  float: none;
  line-height: 48px;
}
user agent stylesheet
li {
  text-align: -webkit-match-parent;
}
ul:not(.browser-default) {
  padding-left: 0;
  list-style-type: none;
}
user agent stylesheet
ul ul ul {
  list-style-type: square;
}
user agent stylesheet
ul ul {
  list-style-type: circle;
}
user agent stylesheet
ul {
  list-style-type: disc;
}
user agent stylesheet
li {
  text-align: -webkit-match-parent;
}
user agent stylesheet
ul ul {
  list-style-type: circle;
}
user agent stylesheet
ul {
  list-style-type: disc;
}
user agent stylesheet
li {
  text-align: -webkit-match-parent;
}
user agent stylesheet
ul {
  list-style-type: disc;
}
body {
  color: rgba(0,0,0,0.87);
  line-height: 1.6;
  font-size: 16px;
  -webkit-font-smoothing: antialiased;
}
@media only screen and (min-width: 0)
html {
  font-size: 14px;
}
html {
  line-height: 1.5;
  font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif;
  font-weight: normal;
  color: rgba(0,0,0,0.87);
}
html {
  line-height: 1.15;
  -ms-text-size-adjust: 100%;
  -webkit-text-size-adjust: 100%;
}
user agent stylesheet
html {
  color: -internal-root-color;
}
*, *:before, *:after {
  -webkit-box-sizing: inherit;
  box-sizing: inherit;
}
*, *:before, *:after {
  -webkit-box-sizing: inherit;
  box-sizing: inherit;
}

</style>

<script type="text/javascript">
  var elemento = document.getElementsByClassName("body");
for(var i = 0; i < elemento.length; i++)
    elemento[i].className += " col-md-6";
</script>

