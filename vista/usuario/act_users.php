<!DOCTYPE html>
<html>

<head>

  <!-- ============================================================== -->
  <!--               IMPORTACION DE CABECERA PRINCIPAL                -->
  <!-- ============================================================== -->
  <?php require_once 'vista/publico/Head.php'; 
  ?>
  <script type="text/javascript" src="vista/config/js/alertas.js"></script>
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
          <center><span class="card-title"><h7>Actualizar Usuario</h7></span></center>
        </div>
      </div>

      <div class="col s1 m2">
      </div>

      <div class="col s11 m8">

        <?php
        foreach($datos as $strExec):
          ?>

          <div class="card-panel light-blue lighten-5">
            <div class="row">

              <form id="user" name="user" method="POST" action="?url=usuario&opcion=modificar">

                <input type='hidden' id='id' name='id' value="<?php echo $strExec['id_usuario']?>">

                <div class="input-field col s5 m2">
                  <i class="icon-payment prefix"></i>

                  <input type="hidden" name="tci" id="tci" value="<?php if(isset($_GET['tci'])){echo $_GET['tci'];}else{echo $strExec['tcedula'];}?>">

                  <select disabled>
                    <option value="<?php if(isset($_GET['tci'])){echo $_GET['tci'];}else{echo $strExec['tcedula'];}?>"><?php if(isset($_GET['tci'])){echo $_GET['tci'];}else{echo $strExec["tcedula"];}?></option>
                  </select>
                </div>

                <div class="input-field col s7 m4">
                  <input type="hidden" name="ci_com" value="<?php if(isset($_GET['ci'])){echo $_GET['ci'];}else{ echo $strExec['cedula'];}?>" id="ci_com">
                  <input type="text" value="<?php if(isset($_GET['ci'])){echo $_GET['ci'];}else{ echo $strExec['cedula'];}?>" disabled>

                  <input type="hidden" name="ci" id="ci" value="<?php if(isset($_GET['ci'])){echo $_GET['ci'];}else{ echo $strExec['cedula'];}?>">
                  <label for="nombre">Cédula</label>
                </div>

                <input id="pass" name="pass" type="hidden" value="<?php echo $strExec['contrasena']?>">

                <div class="input-field col s12 m6">
                  <i class="icon-event_note prefix"></i>
                  <input type="date" name="fechan" id="fechan" autocomplete="off" value="<?php echo $strExec['fecha_n']?>" class="validate" required>
                  <label for="fecha">Fecha Nacimiento </label>
                </div> 

                <div class="input-field col s12 m6">
                  <i class="icon-person prefix"></i>
                  <input id="nom" name="nom" type="text" value="<?php echo $strExec['nombre']?>" class="validate" required>
                  <label for="username" class="center-align">Nombre</label>   
                </div>  

                <div class="input-field col s12 m6">
                  <i class="icon-person_outline prefix"></i>
                  <input id="ape" name="ape" type="text" value="<?php echo $strExec['apellido']?>" class="validate" required>
                  <label for="username" class="center-align">Apellido</label>
                </div>

                <div class="row" style="margin-left: 0.3%; margin-right: 0.3%">
                  
                  <div class="input-field col s7 m3">
                    <i class="icon-drafts prefix"></i>
                    <input id="correo" name="correo" type="text" value="<?php echo $strExec['email']?>" data-length="16" class="validate" required>
                    <label for="email">Email</label>  
                  </div>           

                  <div class="input-field col s5 m3">

                    <select id="tcorreo" name="tcorreo">
                      <option value="<?php echo $strExec['temail']?>" selected><?php echo $strExec['temail']?></option>
                      <option value="@hotmail.com">@hotmail.com</option>
                      <option value="@gmail.com">@gmail.com</option>
                      <option value="@yahoo.com">@yahoo.com</option>
                      <option value="@yahoo.es">@yahoo.es</option>
                      <option value="@outlok.com">@outlok.com</option>
                    </select>

                  </div>

                  <div class="input-field col s6 m3">
                    <i class="icon-phone prefix"></i>
                    <select id="tcel" name="tcel">
                      <option value="<?php echo $strExec['tcelular']?>" selected><?php echo $strExec['tcelular'];?></option>
                      <option value="0424">0424</option>
                      <option value="0414">0414</option>
                      <option value="0426">0426</option>
                      <option value="0416">0416</option>
                      <option value="0412">0412</option>
                      <option value="0251">0251</option>
                    </select>

                  </div>

                  <div class="input-field col s6 m3">
                    <input id="cel" name="cel" type="text" value="<?php echo $strExec['celular']?>" class="validate" required>
                    <label for="email">Celular</label> 
                  </div>            

                  
                </div>          

                <div class="hola input-field col s12 m4">
                  <i class="icon-accessibility prefix"></i>
                  <select name="tipo" id="tipo">
                    <option value="<?php echo $strExec['tipo_rol']?>" selected><?php echo $strExec['nombreRol'];?></option>
                    
                    <?php if ($strExec['tipo_rol'] == '1') {
                      ?>

                      <option value="2">Administrador</option>
                      <option value="3">Operador</option>

                    <?php } ?>

                    <?php if ($strExec['tipo_rol'] == '2') {

                      if ($_SESSION['tipo_rol'] == '1') { ?>
                       
                        <option value="1">Super Usuario</option>
                        
                      <?php }

                      ?>

                      <option value="3">Operador</option>

                    <?php } ?>

                    <?php if ($strExec['tipo_rol'] == '3') {

                      if ($_SESSION['tipo_rol'] == '1') { ?>
                       
                        <option value="1">Super Usuario</option>
                        
                      <?php }

                      ?>

                      <option value="2">Administrador</option>

                    <?php } ?>

                  </select>
                  <label for="descrip">Rol</label>
                </div>

                <div class="hola input-field col s12 m8">
                  <i class="icon-pin_drop prefix"></i>
                  <textarea id="direc" class="materialize-textarea"  pattern="[A-Za-z0-9/ ]+"  data-length="120" name="direc"><?php echo $strExec['direccion']?></textarea>
                  <label for="descrip">Dirección</label>
                </div>

                <div class="hola input-field col s12 m12">
                  <i class="icon-assignment_ind prefix"></i>
                  <select name="are" id="categoria" required>
                    <option value="<?php echo $strExec['dependencia'];?>" selected><?php echo $strExec['dependencia'];?></option>
                    <!-- ADMINISTRATIVO -->
                    <option value="Administrativo">Administrativo</option>
                    <!-- DOCENTE -->
                    <option value="Agroalimentación">Agroalimentación</option>
                    <option value="Administración">Administración</option>
                    <option value="Ciencias de la información">Ciencias de la información</option>
                    <option value="Contaduria Pública">Contaduria Pública</option>
                    <option value="Deporte">Deporte</option>
                    <option value="Higiene y Seguridad Laboral">Higiene y Seguridad Laboral</option>
                    <option value="Informática">Informática</option>
                    <option value="Logística">Logística</option>
                    <option value="Sistema de Calidad y Ambiente">Sistema de Calidad y Ambiente</option>
                    <option value="Turismo">Turismo</option>
                    <!-- OBRERO -->
                    <option value="Area Obrera">Area Obrera</option>
                  </select>
                  <label for="descrip">Dependencia</label>
                </div>

                <input type="hidden" value="<?php echo $strExec['contrasena'];?>" name="contra" id="contra">
                <center>

                 <input type="button" onclick="validarform();" value="Actualizar"class="btn btn-primary yellow darken-3 btn-small">
                 <input type="reset" value="restaurar" class="btn btn-primary red darken-2 btn-small">

               </center>

             </form>

           </div>
         </div>
       <?php endforeach; ?>  
       <center>
         <a href="?url=usuario&opcion=consultar-usuarios" class="btn waves-effect waves-light blue darken-4 white-text  btn-small">Regresar</a>
       </center>
     </div>

     <div class="col s1 m2">
     </div>

     

   </div>
 </section>
</main>

<!-- ============================================================== -->
<!--FIN DEL CONTENIDO-->
<!-- ============================================================== -->

<!--************************************************************************************************************************************-->

<!-- ============================================================== -->
<!--                     IMPORTACION DEL FOOTER                     -->
<!-- ============================================================== -->
<?php require_once 'vista/publico/Footer.php'; ?>

<!-- ============================================================== -->
<!--               IMPORTACION DE LOS SCRIPTS                       -->
<!-- ============================================================== -->
<?php require_once 'vista/publico/Scripts.php'; ?>
<script src="vista/config/js/activador_conteo.js"></script>
<script type="text/javascript" src="vista/config/js/validacion_act_usu.js"></script>

</body>
</html>
