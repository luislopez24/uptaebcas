<!DOCTYPE html>
<html>
<!DOCTYPE html>
<html>

<head>

 <?php require_once 'vista/publico/Head.php'; ?>
 <link rel="stylesheet" type="text/css" href="vista/config/css/login/style.css">
 <link rel="stylesheet" type="text/css" href="vista/config/css/login/login.css">
 <script src="vista/config/js/check_ci.js"></script>
 <style type="text/css">

   #aceptar{
    color: white!important;
  }

  @media screen and (max-width: 400px) {



    body{

      background-size: auto!important;
      background-image: url("vista/config/img/FondoPantallaUPTAEB3.jpg");
    }
  }
}

</style>
</head>
<body background="vista/login/Fondolab.bmp" style="background-size: cover; background-repeat: no-repeat;
background-attachment: fixed">

  <?php require_once 'vista/config/js/alertas.php';?>

  <!-- ============================================================== -->
  <!-- INICIO DEL CONTENIDO-->
  <!-- ============================================================== -->
  <main>

    <section class="section">
     <div class="row">

      <div class="col s1 m2"></div>
      <div class="fondo-transparente-cont-opaco col s10 m5 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8" style="color: black;">


        <form id="user" name="user" action="?paso=usuario&opcion=loginenviarmail" method="POST" class="login-form" style="margin-left: 20px; margin-right: 20px;" >

          <div class="row">
            <div class="input-field col s12">
              <h5>Contactanos</h5>
              <p>¡Comunicate con nuestro soporte técnico!</p>
            </div>
          </div>

          <div class="row" style="margin-top: -80px">

            <div class="input-field col s12 m12">
              <i class="icon-announcement prefix"></i>
              <input id="txtasuntico" name="ltxtasuntico" type="text" class="validate" required>
              <label class="center-align">Ingrese Asunto</label>   
            </div>

            <div class="input-field col s12 m12">
              <i class="icon-contact_mail prefix"></i>
              <input id="txtsucorreo" name="ltxtsucorreo" type="text" class="validate" required>
              <label class="center-align">Ingrese su correo</label>
            </div>

            <div class="input-field col s12 m12">
              <i class="icon-drafts prefix"></i>
              <input id="txtpara" name="ltxtpara" type="text" value="uptaebcas@gmail.com" readonly>
              <label class="center-align">Correo del Fabricante</label>
            </div>  

            <div class="input-field col s12 m12">
              <i class="icon-payment prefix"></i>
              <input id="txtcedula" name="ltxtcedula" type="text" class="validate" value="">
              <label class="center-align">Cedula</label> 
            </div>

            <div class="input-field col s12 m6">
              <i class="icon-person prefix"></i>
              <input id="txtnombre" name="ltxtnombre" type="text" class="validate" value="">
              <label class="center-align">Nombre</label> 
            </div>

            <div class="input-field col s12 m6">
              <i class="icon-person_outline prefix"></i>
              <input id="txtapellido" name="ltxtapellido" type="text" class="validate" value="">
              <label class="center-align">Apellido</label>
            </div>
          </div>



          <div class="row">
            <div class="input-field col s12 m12">
              <i class="icon-accessibility prefix"></i>
              <input id="txrol" name="ltxtrol" type="text" value="Usuario no Logeado" readonly>
              <label class="center-align">Rol</label>

            </div>

          </div>

          <div class="row">
            <p align="center">Ingrese su mensaje</p>
            <div class="input-field col s12 m12">
                
                <i class="icon-person_outline prefix"></i>
                <TEXTAREA rows=5 cols=30 name="ltxtmensaje" class="validate" style="background-color: white; border-radius: 6px;"></TEXTAREA>

            </div>
            </div>


          <div class="row">
            
            <div class="input-field col s8 m8" style="margin-top: 7px"><p class="medium-small"><a href="?url=inicio">Cancelar mensaje</a></p></div>

            <div class="input-field col s4 m4">

              <input align="center" type=image src="vista/config/img/icomail.png" width="30" height="30" onclick="document.user.submit();" name="enviar" />Enviar

            </div>
          </div>

        </form>
      </div>
      <div class="col s1 m2"></div>
    </div>

  </div>

</div>

</div>
</section>
</main>

<!-- ============================================================== -->
<!--FIN DEL CONTENIDO-->
<!-- ============================================================== -->

<!--************************************************************************************************************************************-->

<!-- ============================================================== -->
<!--               IMPORTACION DE LOS SCRIPTS                       -->
<!-- ============================================================== -->
<?php require_once 'vista/publico/Scripts.php'; ?>
<script src="vista/config/js/validacion_usu.js"></script>
<script src="vista/publico/script-new.js"></script>


</body>
</html>
