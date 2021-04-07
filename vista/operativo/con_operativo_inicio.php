<!DOCTYPE html>
<html>

<head>
 <!-- ============================================================== -->
 <!--               IMPORTACION DE CABECERA PRINCIPAL                -->
 <!-- ============================================================== -->
 <?php require_once 'vista/publico/Head.php';?>
 <script type="text/javascript" src="vista/config/js/validar_operativo.js"></script>

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

       <!--AQUI VA TODO EL CONTENIDO-->
       <div class="col-s12-m6">   

        <div class="card"style="margin-left: 20px; margin-right: 20px">
         <div class="row">
          <div class="col s12 m12">
            <div class="white-text card-panel blue darken-2">
              <?php

              foreach($datosOperativo as $strExec):

                ?>
                <center><span class="card-title"><h6>Operativo <?php echo $strExec["nombre_operativo"]?></h6></span></center>
              <?php endforeach;?>
            </div>
          </div>  
        </div>

        <!--DIV solamente para centrar-->
        <div style="margin-left: 20px; margin-right: 20px">

          <table class="centered">
            <thead>
              <tr>
                <th>Descripción</th>
                <th>Costo</th>
                <th>Fecha inicial</th>
                <th>Fecha final</th>
                <th>Clasificación</th>
              </tr>
            </thead>

            <tbody>
              <?php

              foreach($datosOperativo as $strExec):

                ?>
                <tr>
                  <td><?php echo $strExec["descripcion"]?></td>
                  <td><?php echo $strExec["precio_operativo"]?> BsS</td>
                  <td><?php echo $strExec["fecha_inicio_operativo"]?></td>
                  <td><?php echo $strExec["fecha_final_operativo"]?></td>  
                  <td><?php 

                  echo "<div style='text-align: left'>";
                  foreach ($clasificacionDelOperativo as $clasificacion) {

                    echo "○ ".$clasificacion['nombre_clasificacion']."<br>";
                  }
                  echo "</div>";
                  ?></td>
                   
                </tr>

              <?php endforeach;  ?>
            </tbody>
          </table>

          <table class="centered">
           <thead>
            <tr>
              <th>Banco admitido</th> 
            </tr>
          </thead>

          <tbody>
            <?php

            foreach($datosOperativo as $strExec):

              ?>
              <tr>
                <td><?php echo $strExec["banco_admitido"]?></td>
              </tr>

            <?php endforeach;  ?>
          </tbody>
        </table>

        <table class="centered">
          <thead>
            <tr>
              <th>Producto</th>
              <th>Marca</th>
              <th>Contenido</th>
              <th>Descripción</th>
              <th>Cantidad por Persona</th>

            </tr>
          </thead>

          <?php foreach ($diversidadesRegistradas as $strExec): 

            $id=$_GET['id'];

            if ($strExec['id_operativo_nuevo']==$id) {


              ?>

              <tbody>
                <tr>
                  <td><?php echo $strExec['nombre_diversidad'];?></td>
                  <td><?php echo $strExec['marca'];?></td>
                  <td><?php echo $strExec['contenido'];?></td>
                  <td><?php echo $strExec['descripcion'];?></td>
                  <td><?php echo $strExec['cantidad_por_persona'];?></td>                                
                </tr>
              </tbody>
            <?php } endforeach; ?>
          </table>


          <div class="card-action">

            <center>

                <a href="?url=inicio&opcion=index" class="btn waves-effect waves-light blue darken-4 white-text btn-small">Volver</a>

            </center>

          </div>

        </div>     
      </div>
    </div>
  </div>

  <br>    

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

