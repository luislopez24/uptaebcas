
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
                <center><span class="card-title"><h6>Operativo</h6></span></center>
              </div>
            </div>
          </div>

          <?php if(isset($registrarOperativo)){ ?>
          <div class="col s12 m4">
           <!--CARTA CONTENEDORA-->       
           <div class="card small">

            <div class="divider"></div>
            <div class="card-image waves-effect waves-block waves-light">
              <center>
                <br>
                <img class="activator" src="vista/config/img/añ.png" style="width: 155px; height:">
              </center>
            </div>

            <div class="card-content">

              <center>
                <div class="card-action">
                  <span class="card-title activator grey-text text-darken-4"><a href="?url=operativo&opcion=formularioOperativo" data-position="bottom" data-tooltip="Registrar operativo" class="btn tooltipped waves-effect waves-light green darken-2 white-text btn-small">registrar</a></span>
                </div>
              </div>
            </center>

          </div>
        </div>
        <?php } ?>

        <?php if(isset($modificarOperativo) || isset($eliminarOperativo) || isset($addProductosOperativo)){ ?>
        <div class="col s12 m4">
         <!--CARTA CONTENEDORA-->       
         <div class="card small">

          <div class="divider"></div>
          <div class="card-image waves-effect waves-block waves-light">
            <center>
              <br>
              <img class="activator" src="vista/config/img/fami.png" style="width: 155px; height:">
            </center>
          </div>

          <div class="card-content">
            <center>
              <div class="card-action">
                <span class="card-title activator grey-text text-darken-4"><a href="?url=operativo&opcion=consultarOperativos" data-position="bottom" data-tooltip="Consultar operativos" class="btn tooltipped waves-effect waves-light yellow darken-3 white-text btn-small">consultar</a></span>
              </div>
            </div>
          </center>
        </div>
      </div>
      <?php } ?>

      <?php if(isset($publicarOperativo)){ ?>
      <div class="col s12 m4">
       <!--CARTA CONTENEDORA-->       
       <div class="card small">

        <div class="divider"></div>
        <div class="card-image waves-effect waves-block waves-light">
          <center>
            <br>
            <img class="activator" src="vista/config/img/publicar.png" style="width: 155px; height:">
          </center>
        </div>

        <div class="card-content">

          <center>
            <div class="card-action">

              <span class="card-title activator grey-text text-darken-4"><a href="?url=operativo&opcion=inicioPublicar" data-position="bottom" data-tooltip="Publicar operativos" class="btn tooltipped waves-effect waves-light purple darken-2 white-text btn-small">publicar</a></span>

            </div>
          </div>
        </center>

      </div>
    </div>
    <?php } ?>
  
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