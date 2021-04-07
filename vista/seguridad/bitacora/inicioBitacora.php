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
  <?php require_once 'vista/publico/Header.php'; ?>

  <!-- ============================================================== -->
  <!-- INICIO DEL CONTENIDO-->
  <!-- ============================================================== -->
  <main>
    
    <section class="section">
     <div class="row">
      
      <!--AQUI VA TODO EL CONTENIDO-->
      <div class="row">
        <div class="col s12 m12">
          <div class="white-text card-panel blue darken-2">
            <center><span class="card-title"><h6>Consultar Bitacoras</h6></span></center>
          </div>
        </div>
      </div>
      
    <div class="col s12 m3"></div>
  
    <div class="col s12 m6">
     <!--CARTA CONTENEDORA-->       
     <div class="card small">
      <div class="card-image waves-effect waves-block waves-light">
        <center>
          <br>
          <img class="activator" src="vista/config/img/descarga.jpg" style="width: 155px; height:">
        </center>
      </div>
      
      <div class="card-content">

            <div class="row">
            <form method="POST" action="?url=seguridad&opcion=consultarFechasBitacoras">
              <div class="col s12 m4"><label>Del</label><input type="date" name="fechaI" id="fechaI" required></div>
              <div class="col s12 m5"><label>Al</label><input type="date" name="fechaF" id="fechaF" required></div>
              <div class="col s12 m3"><input type="submit" data-tooltip="Consultar Bitacoras" class="btn tooltipped btn-primary yellow darken-3 btn-small" style="margin-top: 30px" value="Consultar"></div>

            </form> 

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

<!--**********************************************************************************************************************************-->

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
