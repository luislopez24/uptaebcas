
<!DOCTYPE html>
<html>

<head>
 <!-- ============================================================== -->
 <!--               IMPORTACION DE CABECERA PRINCIPAL                -->
 <!-- ============================================================== -->
 <?php require_once 'vista/publico/Head.php';?>

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
        <div class="col-s12-m6">   

          <div class="card"style="margin-left: 20px; margin-right: 20px">
           <div class="row">
            <div class="col s12 m12">
              <div class="white-text card-panel blue darken-2">
                <center><span class="card-title"><h6>Seguridad avanzada</h6></span></center>
              </div>
            </div>
          </div>

          <div class="col s12 m6">
           <!--CARTA CONTENEDORA-->       
           <div class="card-panel transparent waves-effect waves-block waves-light" onClick="document.location.href='?url=seguridad&opcion=inicioAdminUsuarios'">

            <center>
              <img class="activator" src="vista/config/img/administrador.png" style="width: 150px; height: 150px">
            </center>
            <center> <span class="black-text"><h6>Gestionar Permisos</h6> </span></center>
          </div>
        </div>

        <div class="col s12 m6">
         <!--CARTA CONTENEDORA-->       
         <div class="card-panel transparent waves-effect waves-block waves-light" onClick="document.location.href='?url=seguridad&opcion=inicioRoles'">

          <center>
            <img class="activator" src="vista/config/img/roles.png" style="width: 150px; height: 150px">
          </center>
          <center> <span class="black-text"><h6>Roles</h6> </span></center>
        </div>
      </div>

    </div>
  </div>
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
<!--                     IMPORTACION DEL FOOTER                     -->
<!-- ============================================================== -->

<?php require_once 'vista/publico/Footer.php'; ?>

<!-- ============================================================== -->
<!--               IMPORTACION DE LOS SCRIPTS                       -->
<!-- ============================================================== -->
<?php require_once 'vista/publico/Scripts.php'; ?>

</body>
</html>