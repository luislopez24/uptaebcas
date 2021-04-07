
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
                <center><span class="card-title"><h6>Estadisticas</h6></span></center>
              </div>
            </div>
          </div>

          <div class="col s12 m6">
           <!--CARTA CONTENEDORA-->       
           <div class="card-panel transparent waves-effect waves-block waves-light" onClick="document.location.href='?url=reporte&opcion=inicioOperativos'">

            <center>
              <img class="activator" src="vista/config/img/estadisticas1.png" style="width: 150px; height: 150px">
            </center>
            <center> <span class="black-text"><h6>Operativos realizados</h6> </span></center>
          </div>
        </div>

        <div class="col s12 m6">
         <!--CARTA CONTENEDORA-->       
         <div class="card-panel transparent waves-effect waves-block waves-light" onClick="document.location.href='?url=reporte&opcion=inicioBeneficio'">

          <center>
            <img class="activator" src="vista/config/img/producto.png" style="width: 150px; height: 150px">
          </center>
          <center> <span class="black-text"><h6>Beneficios entregados</h6> </span></center>
        </div>
      </div>

      <div class="col s12 m6">
         <!--CARTA CONTENEDORA-->       
         <div class="card-panel transparent waves-effect waves-block waves-light" onClick="document.location.href='?url=reporte&opcion=inicioDineroI'">

          <center>
            <img class="activator" src="vista/config/img/estadisticas2.png" style="width: 150px; height: 150px">
          </center>
          <center> <span class="black-text"><h6>Dinero ingresado</h6> </span></center>
        </div>
      </div>

      <div class="col s12 m6">
         <!--CARTA CONTENEDORA-->       
         <div class="card-panel transparent waves-effect waves-block waves-light" onClick="document.location.href='?url=reporte&opcion=inicioBeneficioLo'">

          <center>
            <img class="activator" src="vista/config/img/estadisticas.png" style="width: 150px; height: 150px">
          </center>
          <center> <span class="black-text"><h6>Beneficiarios logueados</h6> </span></center>
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