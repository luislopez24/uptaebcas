
<!DOCTYPE html>
<html>

<head>
 <!-- ============================================================== -->
 <!--               IMPORTACION DE CABECERA PRINCIPAL                -->
 <!-- ============================================================== -->
 <?php require_once 'vista/publico/Head.php';?>
 <script type="text/javascript" src="vista/config/js/validar_operativo.js"></script>
<style type="text/css">

   @media screen and (max-width: 400px) {
    
    table{

      font-size: 75%

    }

    #search{
      
      width: 80px!important;
      font-size: 60%;
      height: 30px!important;

    }

    a, button{
       font-size: 60%!important;
    }
  }
  
  
</style>
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
        <div class="white-text card-panel red darken-4">
          <center><span class="card-title"><h7>Operativos ocultos</h7></span></center>
        </div>
      </div>
    </div>

    <div class="row">
    
    <div class="col m1"></div>
     <div class="col s12 m10">
       <!--CARTA CONTENEDORA-->       
       <div class="card">

        <table class="centered">
          <thead>

            <table>
              <tr>
                <th class="priority-1"></th>
                <th class="priority-1"><center>N°</center></th>
                <th class="priority-1"></th>
                <th class="priority-1"><center>Nombre</center></th>
                <th class="priority-1"><center>Costo</center></th>
                <th class="priority-5"><center>Fecha inicial</center></th>
                <th class="priority-5"><center>Fecha Final</center></th>
                <th class="priority-5"><center>Descripción</center></th>
                <th class="priority-1"><center>Publicado</center></th>


              </tr>
            </thead>

            <tbody>
              <?php 

              $cont=0;
              foreach($datosOperativo as $operativo):

              if($operativo['estado']!='on' ||empty($operativo['estado'])){
              $cont++;
              ?>
              <tr><td></td>
                <th class="priority-1"><?php echo $cont; ?></th>
                <td class="priority-1"><img class="circle" src="<?php if(isset($operativo['foto'])){ echo $operativo['foto'];} else{ echo 'vista/config/img/fami.png';} ?>" style="width: 30px; height: 30px;"></td>
                <td class="priority-1"><center><?php echo $operativo['nombre_operativo']; ?></center></td>
                <td class="priority-1"><center><?php echo $operativo['precio_operativo']; ?></center></td>
                <td class="priority-5"><center><?php echo $operativo['fecha_inicio_operativo']; ?></center></td>
                <td class="priority-5"><center><?php echo $operativo['fecha_final_operativo']; ?></center></td>
                <td class="priority-5"><center><?php echo $operativo['descripcion']; ?></center></td>
                <td class="priority-1">
                 <center> 

                  <?php 

                  $id_operativo=$operativo["id_operativo"];
                  $estado=$operativo["estado"];

                  if ($operativo['conteo'] == 0) {
                  echo "Registre un producto antes de publicar";
                }else{

                if ($estado=='on') {
                ?>

                <a href="javascript:void(0);" onclick="ocultar('?url=publicar_operativo&id=<?php echo $id_operativo;?>&estado=off');" data-position="bottom" data-tooltip="Ocultar operativo" class="btn tooltipped waves-effect waves-light red darken-2 white-text btn-small">ocultar</a>

                <?php

              }else{

              if ($operativo['estado']=='clau') {

              echo "<a href='#mod-fecha-".$id_operativo."' data-position='bottom' data-tooltip='Cambiar fecha final del operativo vencido' class='btn tooltipped waves-effect waves-light yellow darken-3 white-text btn modal-trigger btn-small'>ACTIVAR</a>";
              ?>

              <!-- ============================================================== -->
              <!-- MODAL MODIFICAR FECHA -->
              <!-- ============================================================== -->
              <div id="mod-fecha-<?php echo $id_operativo;?>" class="modal modal-fixed-footer" style="width: 500px; height: 350px!important">
                <div class="modal-content">
                  <h5>Modificar fecha final del operativo</h5>
                  <div class="col s12">

                    <form method="POST" action="?url=operativo&opcion=modificar&fechaFinal=true?>">
                      <div class="row">

                       <div class="input-field col s2"> <i class="icon-next_week prefix" style="margin-top: 10px;"></i></div>

                       <input type="hidden" value="<?php echo $operativo['id_operativo'];?>" id="id_o"
                       name="id_o">
                       <input type="hidden" value="<?php echo $operativo['nombre_operativo'];?>" id="nombre"
                       name="nombre">
                       <input type="hidden" value="<?php echo $operativo['precio_operativo'];?>" id="precio"
                       name="precio">
                       <input type="hidden" value="<?php echo $operativo['fecha_inicio_operativo'];?>" id="fechai"
                       name="fechai">
                       <input type="hidden" value="<?php echo $operativo['descripcion'];?>" id="descrip"
                       name="descrip">
                       <input type="hidden" value="<?php echo $operativo['foto']; ?>" name="foto_ruta" id="foto_ruta">
                       <input type="hidden" value="off" id="estado"
                       name="estado">
                       <input type="hidden" value="<?php echo $operativo['banco_admitido'];?>" id="banco"
                       name="banco">

                       <div class="input-field col s3" style="margin-top: 20px;">
                        <label>Operativo</label>
                        <input type="text" disabled value="<?php echo $operativo['nombre_operativo'];?>" name="">
                      </div>

                      <div class="input-field col s6">
                        <input type="date" name="fechaf" id="fechaf" value="" maxlength="30" data-length="30" required style="margin-top: 10px;">
                        <label for="nombre">Fecha</label>
                      </div>

                      <div class="input-field col s12">
                        <button type="submit" class="btn-small btn-primary yellow darken-3">Modificar</button>
                      </div>
                    </div>  
                  </form>

                </div>
              </div>
              <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-brown btn-flat">Cerrar</a>
              </div>
            </div>

            <?php

          }else{
          ?>

          <?php

          echo "<a href='?url=operativo&opcion=publicar&id=$id_operativo&estado=on' data-position='bottom' data-tooltip='Publicar operativo' class='btn tooltipped waves-effect waves-light yellow darken-3 white-text btn-small'>publicar</a>";
        }
      }
    }

    ?>

  </center>
</td>
</tr>

<?php } endforeach; ?>


</tbody>
</table>
</div>
</div>
</div>

<div class="row">

 <div class="col s12 m12">
  <div class="white-text card-panel green darken-4">
    <center><span class="card-title"><h7>Operativos publicados</h7></span></center>
  </div>
</div>
</div>


<div class="row">
<div class="col m1"></div>
 <div class="col s12 m10">
   <!--CARTA CONTENEDORA-->       
   <div class="card">

    <table class="centered">
      <thead>

        <table>
          <tr>
            <th class="priority-1"></th>
            <th class="priority-1"><center>N°</center></th>
            <th class="priority-1"></th>
            <th class="priority-1"><center>Nombre</center></th>
            <th class="priority-1"><center>Costo</center></th>
            <th class="priority-5"><center>Fecha inicial</center></th>
            <th class="priority-5"><center>Fecha Final</center></th>
            <th class="priority-5"><center>Descripción</center></th>
            <th class="priority-1"><center>Publicado</center></th>


          </tr>
        </thead>

        <tbody>
          <?php 

          $cont=0;
          foreach($datosOperativo as $operativo):

          if($operativo['estado']=='on'){
          $cont++;
          ?>
          <tr><td class="priority-1"></td>
            <th><?php echo $cont; ?></th>
            <td class="priority-1"><img class="circle" src="<?php if(isset($operativo['foto'])){ echo $operativo['foto'];} else{ echo 'vista/config/img/fami.png';} ?>" style="width: 30px; height: 30px;"></td>
            <td class="priority-1"><center><?php echo $operativo['nombre_operativo']; ?></center></td>
            <td class="priority-1"><center><?php echo $operativo['precio_operativo']; ?></center></td>
            <td class="priority-5"><center><?php echo $operativo['fecha_inicio_operativo']; ?></center></td>
            <td class="priority-5"><center><?php echo $operativo['fecha_final_operativo']; ?></center></td>
            <td class="priority-5"><center><?php echo $operativo['descripcion']; ?></center></td>
            <td class="priority-1">
              <center> 

                <?php 

                $id_operativo=$operativo["id_operativo"];
                $estado=$operativo["estado"];

                if ($operativo['conteo'] == 0) {
                echo "Registre un producto antes de publicar";
              }else{

              if ($estado=='on') {
              ?>

              <a href="javascript:void(0);" onclick="ocultar('?url=operativo&opcion=publicar&id=<?php echo $id_operativo;?>&estado=off');"  data-position="bottom" data-tooltip="Ocultar operativo" class="btn tooltipped waves-effect waves-light red darken-2 white-text btn-small">ocultar</a>

              <?php
            }else{

            echo "<a href='?url=operativo&opcion=publicar&id=$id_operativo&estado=on' data-position='bottom' data-tooltip='Publicar operativo' class='btn tooltipped waves-effect waves-light yellow darken-2 white-text btn-small'>publicar</a>";
          }
        }

        ?>

      </center>
    </td>

    <?php } endforeach; ?>


  </tbody>
</table>
</div>
</div>
</div>

</div>      

<center>
  <a href="?url=operativo&opcion=operativo" class="btn waves-effect waves-light blue darken-4 white-text btn-small">REGRESAR</a>
</center>

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