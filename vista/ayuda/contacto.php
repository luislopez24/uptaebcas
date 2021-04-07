<!DOCTYPE html>
<html>

<head>
  <!-- ============================================================== -->
  <!--               IMPORTACION DE CABECERA PRINCIPAL                -->
  <!-- ============================================================== -->
  <?php require_once 'vista/publico/Head.php';?>
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
          <center><span class="card-title"><h7>Contáctanos para soporte técnico</h7></span></center>
        </div>
      </div>

      <div class="col s1 m2">
      </div>

      <form method="POST" action="?url=usuario&opcion=enviar_mail" >

        <div class="col s10 m8">
          <div class="card-panel blue lighten-5">



            <div class="input-field col s12 m6">
              <i class="icon-announcement prefix"></i>
              <input id="txtasuntico" name="txtasuntico" type="text" class="validate" required>
              <label class="center-align"><b>Ingrese Asunto</b></label>   
            </div> 

            <div class="input-field col s12 m6">
              <i class="icon-drafts prefix"></i>
              <input id="txtpara" name="txtpara" type="text" value="uptaebcas@gmail.com" readonly="readonly">
              <label class="center-align">Correo del Fabricante</label>
            </div>

            <div class="input-field col s12 m6">
              <i class="icon-person prefix"></i>
              <input id="txtnombre" name="txtnombre" type="text" value="<?php echo $_SESSION['nombre'];?>" readonly="readonly">
              <label class="center-align">Nombre</label>   
            </div> 

            <div class="input-field col s12 m6">
              <i class="icon-person_outline prefix"></i>
              <input id="txtapellido" name="txtapellido" type="text" value="<?php echo $_SESSION['apellido'];?>" readonly="readonly">
              <label class="center-align">Apellido</label>
            </div>


            <div class="input-field col s12 m6">
              <i class="icon-payment prefix"></i>
              <input id="txtcedula" name="txtcedula" type="text" value="<?php echo $_SESSION['cedula'];?>" readonly="readonly">
              <label class="center-align">Cedula</label>   
            </div> 

            <div class="input-field col s12 m6">
              <i class="icon-accessibility prefix"></i>
              <input id="txrol" name="txtrol" type="text" value="<?php if($_SESSION['tipo_rol']=='2'){ echo 'Administrador';} if($_SESSION['tipo_rol']=='3'){ echo 'Operador';} if($_SESSION['tipo_rol']=='4'){ echo 'Beneficiario';} if($_SESSION['tipo_rol']=='1'){ echo 'Super Usuario';} ?>" readonly="readonly">
              <label class="center-align">Rol</label>
            </div>


            <div class="input-field col s12 m6">
              <i class="icon-contact_mail prefix"></i>
              <input id="txtsucorreo" name="txtsucorreo" type="text" class="validate" required>
              <label class="center-align"><b>Ingrese Correo</b></label>
            </div>


            <div class="input-field col s12 m6">
              <i class="icon-phone_android prefix"></i>
              <input id="txtcelular" name="txtcelular" type="text" class="validate" required>
              <label class="center-align"><b>Ingrese celular</b></label>
            </div>

            <tr>
              <i class="icon-person_outline prefix"></i>
              <th colspan="1">Ingrese su mensaje</th>
              <TD colspan="2"><TEXTAREA rows=5 cols=30 name="txtmensaje" class="validate" style="background-color: white; border-radius: 6px;"></TEXTAREA>
              </td>

              <br>

              <input align="right" data-position="right" data-tooltip="Enviar correo" class="tooltipped" type=image src="vista/config/img/icomail.png" width="30" height="30" onclick="return enviarcorreo()" name="enviar" id="enviar" / style="margin-top: 5px; text-align: right;">
              <br>
            </tr>
          


          </form>
        </div>
      </div>

      <div class="col s1 m2">
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
<!--                     IMPORTACION DEL FOOTER                     -->
<!-- ============================================================== -->
<?php require_once 'vista/publico/Footer.php'; ?>

<!-- ============================================================== -->
<!--               IMPORTACION DE LOS SCRIPTS                       -->
<!-- ============================================================== -->
<?php require_once 'vista/publico/Scripts.php'; ?>
<script src="vista/config/js/activador_conteo.js"></script>
<script src="vista/config/js/validacion_usuario-cas.js"></script>


</body>
</html>
