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


        <form id="user" name="user" action="?paso=usuario&opcion=registroNuevo" method="POST" class="login-form" style="margin-left: 20px; margin-right: 20px;" >

          <div class="row">
            <div class="input-field col s12">
              <h5>Registrate</h5>
              <p>¡Ingresa a nuetro sistema UPTAEB-CAS ahora!</p>
            </div>
          </div>

          <div class="row" style="margin-top: -80px">

            <div class="input-field col s12" style="display: none" id="check">
              <div id="result-ci" style="margin-top: -20px"></div>
            </div>

            <div class="input-field col s2 m2">
             <i class="icon-payment prefix"></i>
           </div>

           <div class="input-field col s3 m4">
            <select id="tci" name="tci">
             <option value="V">V</option>
             <option value="E">E</option>
           </select>
         </div>

         <div class="input-field col s7 m6">
          <input type="text" name="ci" id="ci"><br><br>
          <label for="ci">Cédula</label>
        </div>  

        <div class="input-field col s12 m6">
          <i class="icon-person prefix"></i>
          <input id="nom" name="nom" type="text" class="validate" required>
          <label for="nom" class="center-align">Nombre</label>
        </div>

        <div class="input-field col s12 m6">
          <i class="icon-person_outline prefix"></i>
          <input id="ape" name="ape" type="text" class="validate" required>
          <label for="ape" class="center-align">Apellido</label>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s9 m9">
          <i class="icon-lock_outline prefix"></i>
          <input id="passwo" name="passwo" type="password" data-length="12" class="validate" required minlength="6"  maxlength="12">
          <label for="passwo">Contraseña</label>
        </div>

        <div class="input-field col s3 m3">
          <a href="javascript:void(0);" onclick="mostrarPas();" id='show_password1' class="btn waves-effect waves-light green darken-2 white-text"><i id="h1" class="icon-visibility"></i></a>
        </div>

      </div>

      <div class="row">
        <div class="input-field col s9 m9">
          <i class="icon-lock_outline prefix"></i>
          <input id="password" name="password" type="password" minlength="6" data-length="12" class="validate" required maxlength="12">
          <label for="password">Repite la contraseña</label>

        </div>

        <div class="input-field col s3 m3">
          <a href="javascript:void(0);" onclick="mostrarPassword();" id='show_password' class="btn waves-effect waves-light green darken-2 white-text"><i id="h" class="icon-visibility"></i></a>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s7">
          <i class="icon-drafts prefix"></i>
          <input id="correo" name="correo" type="text" data-length="30" maxlength="30" class="validate" required>
          <label for="correo">Email</label>
        </div>

        <div class="input-field col s5">
          <select id="tcorreo" name="tcorreo">
            <option value="@hotmail.com" selected>@hotmail.com</option>
            <option value="@gmail.com">@gmail.com</option>
            <option value="@yahoo.com">@yahoo.com</option>
            <option value="@yahoo.es">@yahoo.es</option>
            <option value="@outlook.com">@outlook.com</option>
          </select>
        </div>
      </div>

      <div class="row">


        <div class="input-field col s6 m4">
          <i class="icon-phone prefix"></i>
          <select id="tcel" name="tcel">
            <option value="0424" selected>0424</option>
            <option value="0414">0414</option>
            <option value="0426">0426</option>
            <option value="0416">0416</option>
            <option value="0412">0412</option>
            <option value="0251">0251</option>
          </select>
        </div>

        <div class="input-field col s6 m8">
          <input id="cel" name="cel" type="text" class="validate" required>
          <label for="cel">Celular</label>
        </div>

        <div class="input-field col s12 m12">
          <i class="icon-pin_drop prefix"></i>
          <textarea id="direc" class="materialize-textarea" data-length="120" maxlength="120" name="direc" class="validate" required></textarea>
          <label for="direc">Dirección</label>
        </div>

      </div>

      <div class="row">
        <div class="input-field col s12 m6">
          <i class="icon-accessibility prefix"></i>
          <select id="tipo" name="tipo">
            <option value="" disabled selected>Seleccione un rol</option>
            <option value="4">Docente</option>
            <option value="5">Administrativo</option>
            <option value="6">Obrero</option>
          </select>
          <label for="tipo">Rol</label>
        </div>

        <div class="input-field col s12 m6">
         <i class="icon-event_note prefix"></i>
         <input type="date" name="fechan" id="fechan" autocomplete="off" class="validate" required>
         <label for="fechan">Fecha Nacimiento </label>
       </div>
     </div>

     <div class="input-field col s12 m12">
      <i class="icon-assignment_ind prefix"></i>

      <select name="are" id="categoria" style="width: 350px!important;">
        <option disabled>Seleccione primero su rol en la UPTAEB</option>
      </select>
      <label for="are">Dependencia</label>
    </div>


    <div class="row">
      <div class="input-field col s12">

        <input type="button" onclick="validarform();" name="aceptar" id="aceptar" value="Registrar" class="btn waves-effect waves-light border-round gradient-45deg-blue-grey-blue col s12 " style="border-radius: 60px 60px 60px 60px; color: white!important">

      </div>
    </div>

    <div class="row">
      <div class="input-field col s6 m6 l6">
        <p class="medium-small"><a href="?url=inicio">¿Ya tienes cuenta? Ingresa ahora</a></p>
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

<script type="text/javascript">
    
   $(document).ready(function(){

        $('#tipo').change(function(){
            recargarLista();
        });

      

    })
    
    function recargarLista(){
        $.ajax({
            type:"POST",
            url:"vista/personal/cate.php",
            data:"tipo=" + $('#tipo').val(),
            success:function(r){
                
                $('#categoria').html(r);
                $('select').formSelect();

            }
        });
    }

    

</script>

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
