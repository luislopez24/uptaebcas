<!DOCTYPE html>
<html>

<head>

  <!-- ============================================================== -->
  <!--               IMPORTACION DE CABECERA PRINCIPAL                -->
  <!-- ============================================================== -->
  <?php require_once 'vista/publico/Head.php'; ?>
  <script src="vista/config/js/check_ci.js"></script>
  
</head>
<body>

  <!-- ============================================================== -->
  <!--            IMPORTACION DE LA BARRA DE NAVEGACION               -->
  <!-- ============================================================== -->
  <?php require_once 'vista/publico/Header.php'; 
  require_once 'vista/config/js/alertas.php';?>

  <!-- ============================================================== -->
  <!-- INICIO DEL CONTENIDO-->
  <!-- ============================================================== -->
  <main>

    <section class="section">
     <div class="row">
      <div class="col s12 m12">
        <div class="white-text card-panel blue darken-2">
          <center><span class="card-title"><h7>Registrar Beneficiario</h7></span></center>
        </div>
      </div>

      <div class="col s1 m2">
      </div>

      <form id="user" name="user" method="POST" action="?url=usuario&opcion=registro_personal" >

        <div class="col s10 m8">
          <div class="card-panel blue lighten-5">

            <div class="input-field col s12 m12" style="display: none" id="check">
              <div id="result-ci" style="margin-top: -20px"></div>
            </div>

            <div class="input-field col s5 m4">

              <i class="icon-payment prefix"></i>

              <select id="tci" name="tci" class="validate" required>
                <option value="V">V</option>
                <option value="E">E</option>
              </select>

            </div>

            <div class="input-field col s7 m8">
              <input type="text" name="ci" id="ci" value="<?php if(isset($ci)){echo $ci;}?>" autofocus>
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
            
            <div class="input-field col s12 m6">
              <i class="icon-event_note prefix"></i>
              <input type="date" name="fechan" id="fechan" autocomplete="off" class="validate" required>
              <label for="fechan">Fecha Nacimiento </label>
            </div> 
            
            <div class="row">
              <div class="input-field col s7 m3">
                <i class="icon-drafts prefix"></i>
                <input id="correo" name="correo" type="text" data-length="16" class="validate" required>
                <label for="correo">Email</label> 
              </div>            

              <div class="input-field col s5 m3">

                <select id="tcorreo" name="tcorreo" class="validate" required>
                  <option value="@hotmail.com" selected>@hotmail.com</option>
                  <option value="@gmail.com">@gmail.com</option>
                  <option value="@yahoo.com">@yahoo.com</option>
                  <option value="@yahoo.es">@yahoo.es</option>
                  <option value="@outlook.com">@outlook.com</option>
                </select>

              </div>
            </div>

            <div class="input-field col s5 m3">
              <i class="icon-phone prefix"></i>
              <select id="tcel" name="tcel" class="validate" required>
                <option value="0424" selected>0424</option>
                <option value="0414">0414</option>
                <option value="0426">0426</option>
                <option value="0416">0416</option>
                <option value="0412">0412</option>
                <option value="0251">0251</option>
              </select>

            </div>

            <div class="input-field col s7 m3">
              <input id="cel" name="cel" type="text">
              <label for="cel">Celular</label> 
            </div>            

            <div class="input-field col s12 m6">
              <i class="icon-accessibility prefix"></i>
              <select id="tipo" name="tipo">
                <?php    if ( $_SESSION["tipo_rol"] == '2' || $_SESSION["tipo_rol"] == '1') { ?>
                 <option value="" disabled selected>Seleccione el area</option>
                 <option value="4">Docente</option>
                 <option value="5">Administrativo</option>
                 <option value="6">Obrero</option>
               <?php }  if ($identificacionOperador == 'Obrero') { ?>
                <option value="" disabled>Seleccione un rol</option>
                <option value="6" selected>Obrero</option>
              <?php }  if ($identificacionOperador == 'Administrativo') { ?>
                <option value="" disabled>Seleccione un rol</option>
                <option value="5" selected>Administrativo</option>
              <?php }  if ($identificacionOperador == 'Docente') { ?>
                <option value="" disabled>Seleccione un rol</option>
                <option value="4" selected>Docente</option>
              <?php  }?>
            </select>
            <label for="descrip">Area</label>
          </div>

          <div class="input-field col s12">
            <i class="icon-pin_drop prefix"></i>
            <textarea id="direc" class="materialize-textarea"  pattern="[A-Za-z0-9/ ]+"  data-length="120" name="direc" class="validate" required></textarea>
            <label for="direc">Dirección</label>
          </div>

          <div class="input-field col s12">
            <i class="icon-assignment_ind prefix"></i>


            <select name="are"  id="categoria" style="width: 350px!important;">
                
                <?php if ( $_SESSION["tipo_rol"] == '3') { ?>
                <option value="<?php echo $_SESSION['dependencia'];?>"><?php echo $_SESSION['dependencia'];?></option>
                <?php } ?>

            </select>

          <label for="descrip">Dependencia</label>
        </div>

        <center>
         <input type="button" onclick="validarform();" name="aceptar" value="Registrar"class="btn btn-primary green darken-2 btn-small" >
         <button type="reset" name="limpiar" class="btn waves-effect waves-light red darken-2 white-text btn-small">limpiar </button>
       </center>

     </form>
   </div>
 </div>

 <div class="col s12 m2">
 </div> 

</div>


</div>
</section>
</main>
<!-- ============================================================== -->
<!--FIN DEL CONTENIDO-->
<!-- ============================================================== -->

<!--*********************************************************************************************************************************-->

<!-- ============================================================== -->
<!--                     IMPORTACION DEL FOOTER                     -->
<!-- ============================================================== -->
<?php require_once 'vista/publico/Footer.php'; ?>

<!-- ============================================================== -->
<!--               IMPORTACION DE LOS SCRIPTS                       -->
<!-- ============================================================== -->
<?php require_once 'vista/publico/Scripts.php'; ?>
<script src="vista/config/js/validacion_usuario-cas.js"></script>

</body>
</html>
