<!DOCTYPE html>
<html>

<head>
  <!-- ============================================================== -->
  <!--               IMPORTACION DE CABECERA PRINCIPAL                -->
  <!-- ============================================================== -->
  <?php require_once 'vista/publico/Head.php'; ?>
  <script type="text/javascript" src="vista/config/js/alertas.js"></script>
  
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
    <?php
    foreach($datos as $strExec):
     ?>
     <section class="section">
       <div class="row">
        <div class="col s12 m12">
          <div class="white-text card-panel blue darken-2">
            <center><span class="card-title"><h7>Actualizar Beneficiario</h7></span></center>
          </div>
        </div>

        <div class="col s1 m2">
        </div>

        <form id="user" name="user" method="POST" action="?url=usuario&opcion=modificar&direc=benef" >
          
          <input type='hidden' id='id' name='id' value="<?php echo $strExec["id_usuario"]?>">

          <div class="col s10 m8">
            <div class="card-panel blue lighten-5">
              <div class="input-field col s5 m2">

                <i class="icon-payment prefix"></i>
                
                <input type="hidden" name="tci" id="tci" value="<?php if(isset($_GET['tci'])){echo $_GET['tci'];}else{echo $strExec['tcedula'];}?>">

                <input type="hidden" name="estatus" id="estatus" value="<?php echo $strExec['status'];?>">

                <select class="validate" required disabled>
                 <option value="<?php if(isset($_GET['tci'])){echo $_GET['tci'];}else{echo $strExec['tcedula'];}?>" selected><?php if(isset($_GET['tci'])){echo $_GET['tci'];}else{echo $strExec["tcedula"];}?></option>
               </select>

             </div>

             <div class="input-field col s7 m4">
              <input type="text" value="<?php if(isset($_GET['ci'])){echo $_GET['ci'];}else{echo $strExec['cedula'];}?>" disabled>
              <input type="hidden" name="ci" id="ci" value="<?php if(isset($_GET['ci'])){echo $_GET['ci'];}else{ echo $strExec['cedula'];}?>">
              <label for="nombre">Cédula</label>
            </div>

            <input id="pass" name="pass" type="hidden" value="<?php echo $strExec['contrasena']?>">

            <div class="input-field col s12 m6">
              <i class="icon-event_note prefix"></i>
              <input type="date" name="fechan" id="fechan" value="<?php echo $strExec['fecha_n']?>" autocomplete="off" class="validate" required>
              <label for="fechan">Fecha Nacimiento </label>
            </div> 

            <div class="input-field col s12 m6">
              <i class="icon-person prefix"></i>
              <input id="nom" name="nom" type="text" class="validate" value="<?php echo $strExec['nombre']?>" required>
              <label for="nom" class="center-align">Nombre</label>   
            </div>

            <div class="input-field col s12 m6">
              <i class="icon-person_outline prefix"></i>
              <input id="ape" name="ape" type="text" class="validate" value="<?php echo $strExec['apellido']?>" required>
              <label for="ape" class="center-align">Apellido</label>
            </div>  

             <div class="row" style="margin-left: 0.3%; margin-right: 0.3%">

            <div class="input-field col s7 m3">
              <i class="icon-drafts prefix"></i>
              <input id="correo" name="correo" type="text" data-length="16" value="<?php echo $strExec['email']?>" class="validate" required>
              <label for="correo">Email</label> 
            </div>            

            <div class="input-field col s5 m3">

              <select id="tcorreo" name="tcorreo" class="validate" required>
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
              <select id="tcel" name="tcel" class="validate" required>
                <option value="<?php echo $strExec['tcelular']?>" selected><?php echo $strExec['tcelular']?></option>
                <option value="0424" >0424</option>
                <option value="0414">0414</option>
                <option value="0426">0426</option>
                <option value="0416">0416</option>
                <option value="0412">0412</option>
                <option value="0251">0251</option>
              </select>

            </div>

            <div class="input-field col s6 m3">
              <input id="cel" name="cel" type="text" value="<?php echo $strExec['celular']?>">
              <label for="cel">Celular</label> 
            </div>            

            </div>
            
            <input type="hidden" name="tipo" id="tipo" value="<?php echo $strExec['tipo_rol']?>">

             <div class="input-field col s12 m4">
            <i class="icon-accessibility prefix"></i>
            <select disabled>
            <?php    if ( $_SESSION["tipo_rol"] == '2' || $_SESSION["tipo_rol"] == '1') { ?>
               <option value="<?php echo $strExec['tipo_rol']?>" selected><?php  if ($strExec['tipo_rol'] == '5') { echo "Administrativo"; } if ($strExec['tipo_rol'] == '6') { echo "Obrero"; } if ($strExec['tipo_rol'] == '4') { echo "Docente"; } ?></option>
               
               <?php if ($strExec['area'] == 'Docente') { ?>
                  
                  <option value="5">Administrativo</option>
                  <option value="6">Obrero</option>

               <?php } ?>

               <?php if ($strExec['area'] == 'Administrativo') { ?>
                  
                  <option value="4">Docente</option>
                  <option value="6">Obrero</option>

               <?php } ?>

               <?php if ($strExec['area'] == 'Obrero') { ?>
                  
                  <option value="4">Docente</option>
                  <option value="5">Administrativo</option>

               <?php } ?>
               
            <?php }  if ($identificacionOperador == 'Obrero') { ?>
              <option value="6" selected>Obrero</option>
            <?php }  if ($identificacionOperador == 'Administrativo') { ?>
              <option value="5" selected>Administrativo</option>
            <?php }  if ($identificacionOperador == 'Docente') { ?>
              <option value="4" selected>Docente</option>
            <?php  }?>
            </select>
            <label for="descrip">Area</label>
          </div>

           <div class="input-field col s12 m8">
            <i class="icon-pin_drop prefix"></i>
            <textarea id="direc" class="materialize-textarea"  pattern="[A-Za-z0-9/ ]+"  data-length="120" name="direc" class="validate" required><?php echo $strExec['direccion']?></textarea>
            <label for="descrip">Dirección</label>
          </div>

          <div class="input-field col s12 m12">
            <i class="icon-assignment_ind prefix"></i>

            <input type="hidden" name="are" id="categoria" value="<?php echo $strExec['dependencia']?>">

            <select style="width: 350px!important;" disabled>
              <option value=""><?php echo $strExec['dependencia']?></option>
            </select>
            <label for="descrip">Dependencia</label>
          </div>

          <center>

           <input type="button" onclick="actualizar();" name="aceptar" value="actualizar"class="btn btn-primary yellow darken-3 btn-small">
           <button type="reset" name="limpiar" class="btn waves-effect waves-light red darken-2 white-text btn-small">Restablecer</button>
         </center>

       </form>
     </div>
   </div>

   <div class="col s1 m2">
   </div>

 </div>

 <center>
   <a href="?url=usuario&opcion=consultarpersonal" class="btn waves-effect waves-light blue darken-4 white-text  btn-small">Regresar</a>
 </center>

</div>
</section>
</main>
<?php endforeach;?>

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
<script src="vista/config/js/validacion_act_usu.js"></script>

</body>
</html>
