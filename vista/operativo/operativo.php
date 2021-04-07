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
            <center><span class="card-title"><h6>Inicio operativo</h6></span></center>
          </div>
        </div>
      </div>
      
      
      <div class="col s12 m6">
       <!--CARTA CONTENEDORA-->       
       <div class="card small">
        <div class="card-image waves-effect waves-block waves-light">
          <center>
            <br>
            <img class="activator" src="vista/config/img/tienda.png" style="width: 155px; height:">
          </center>
        </div>
        
        <div class="card-content">
          <span class="card-title activator grey-text text-darken-4">Operativo<i class="icon-more_vert right"></i></span>
          
          <center>
            <div class="card-action">             
              <a href="?url=operativo&opcion=operativo" class="btn-small waves-effect waves-light purple darken-2 white-text">Ingresar</a>
            </div>
          </div>
        </center>
        
        <div class="card-reveal">
          <span class="card-title grey-text text-darken-4"> Operativo<i class="icon-close right"></i></span>
          <p>En esta sección puede registrar un nuevo operativo; consultar los que ya esten registrados, publicar multiples operativos y a su vez puede incluirles productos a cada uno de ellos
          </p>
        </div>
        
      </div>
    </div>

    <div class="col s12 m6">
     <!--CARTA CONTENEDORA-->       
     <div class="card small">
      <div class="card-image waves-effect waves-block waves-light">
        <center>
          <br>
          <img class="activator" src="vista/config/img/carrito.png" style="width: 155px; height:">
        </center>
      </div>
      
      <div class="card-content">
        <span class="card-title activator grey-text text-darken-4">Clasificación<i class="icon-more_vert right"></i></span>
        
        <center>
          <div class="card-action">
            

            <a href="?url=clasificacion&opcion=administrarClasificacion&cata=false" class="btn-small waves-effect waves-light purple darken-2 white-text">Ingresar</a>
          </div>
        </div>
      </center>
      
      <div class="card-reveal">
        <span class="card-title grey-text text-darken-4"> Clasificación<i class="icon-close right"></i></span>
        <p>En esta sección usted puede registrar una clasificación, para poder así usarlos mas adelante al registrar un operativo nuevo</p><p>Ejemplo de una clasificación: alimentos, gas, útiles, articulos escolares, medicinas, etc... 
        </p>
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
