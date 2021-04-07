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
            <center><span class="card-title"><h7>Distribución de operativo</h7></span></center>
          </div>
        </div>
      </div>

      <?php foreach ($operativosOn as $operativo): ?>


       <div class="col s12 m4">
         <!--CARTA CONTENEDORA-->       
         <div class="card small">
          <div class="card-image waves-effect waves-block waves-light">
            <center>
              <br>
              <img class="activator" src="<?php if(isset($operativo['foto'])){ echo $operativo['foto'];} else{ echo 'vista/config/img/fami.png';} ?>"  style="width: 155px; height:">
            </center>
          </div>

          <div class="card-content">
            <span class="card-title activator grey-text text-darken-4"> <?php echo $operativo['nombre_operativo'];?><i class="icon-more_vert right"></i></span>

            <center>
              <div class="card-action">

                <a href="?url=beneficiario&opcion=distribuirBeneficiado&idOperativo=<?php echo $operativo['id_operativo']; ?>" data-position="bottom" data-tooltip='Distribuir operativo "<?php echo $operativo['nombre_operativo'].'" a los beneficiados';?>' class="btn tooltipped btn-small waves-effect waves-light yellow darken-3 white-text">beneficiados</a>
              
              </div>
            </div>
          </center>

          <div class="card-reveal">
            <span class="card-title grey-text text-darken-4">Descripción del operativo <?php echo $operativo['nombre_operativo'];?> <i class="icon-close right"></i></span>
            <p><?php echo $operativo['descripcion'];?>
          </p>
        </div>

      </div>
    </div>
  <?php endforeach ?>

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
