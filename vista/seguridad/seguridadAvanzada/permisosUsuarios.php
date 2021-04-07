
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
              <div class="white-text card-panel green darken-2">
                <center><span class="card-title"><h6>Usuarios</h6></span></center>
              </div>
            </div>
          </div>

        <div class="col s12 m4">
         <!--CARTA CONTENEDORA-->       
         <div class="card-panel transparent waves-effect waves-block waves-light" onClick="document.location.href='?url=seguridad&opcion=consultarUsuarios&id=2'">

          <center>
            <img class="activator" src="vista/config/img/avatar.png" style="width: 150px; height: 160px">
          </center>
          <center> <span class="black-text"><h6>Administradores</h6> </span></center>
        </div>
      </div>

      <div class="col s12 m4">
       <!--CARTA CONTENEDORA-->       
       <div class="card-panel transparent waves-effect waves-block waves-light" onClick="document.location.href='?url=seguridad&opcion=consultarUsuarios&id=3'">

        <center>
          <img class="activator" src="vista/config/img/avatar2.png" style="width: 150px; height: 160px">
        </center>
        <center> <span class="black-text"><h6>Operadores</h6> </span></center>
      </div>
    </div>

    <div class="col s12 m4">
     <!--CARTA CONTENEDORA-->       
     <div class="card-panel transparent waves-effect waves-block waves-light" onClick="document.location.href='?url=seguridad&opcion=consultarUsuarios&id=4'">

      <center>
        <img class="activator" src="vista/config/img/avatar3.png" style="width: 160px; height: 160px">
      </center>
      <center> <span class="black-text"><h6>Beneficiarios</h6> </span></center>
    </div>
  </div>

</div>
 <center>
    <a href="?url=seguridad&opcion=inicioSeguridadAvanzada" class="btn waves-effect waves-light blue darken-4 white-text btn-small">Regresar</a>
  </center>
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