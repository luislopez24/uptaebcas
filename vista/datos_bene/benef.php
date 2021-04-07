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
            <center><span class="card-title"><h6>Pago operativos</h6></span></center>
          </div>
        </div>
      </div>

      <div class="col s12 m6">

        <div class="card small">

          <div class="card-image waves-effect waves-block waves-light">
            <center>
              <br>
              <img class="activator" src="vista/config/img/añ.png" style="width: 150px; height:">
            </center>
          </div>
          
          <center>
           <div class="card-action">
            <?php if($cod !== 'no'){
              ?>
              <a href="?url=beneficiario&opcion=formularioPago" class="btn-small waves-effect waves-light green darken-2 white-text">Pagar</a>  
              <?php
            }else{
              ?>
              <a href="#!" class="btn-small waves-effect waves-light green darken-2 white-text" disabled>No tiene operativos por pagar</a>  
              <?php
            } ?>
          </center>
          
        </div>
      </div>
      <div class="col s12 m6">
       <!--CARTA CONTENEDORA-->       
       <div class="card small">
        <div class="card-image waves-effect waves-block waves-light">
          <center>
            <br>
            <img class="activator" src="vista/config/img/fami.png" style="width: 155px; height:">
          </center>
        </div>

        <div class="card-content">
          <span class="card-title activator grey-text text-darken-4"></span>

          <center>
            <div class="card-action">
              <a href="?url=beneficiario&opcion=consultarPagos" class="btn-small waves-effect waves-light purple darken-2 white-text">consultar pagos</a>
            </div>
          </center>

        </div>
      </div>
    </div>
  </div>
</div>
</section>
</main>
</center>
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
