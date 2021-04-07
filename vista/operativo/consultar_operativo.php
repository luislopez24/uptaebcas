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
<script type="text/javascript" src="vista/config/js/pagination.js"></script>

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
       <div class="col s12 m12">
        <div class="white-text card-panel blue darken-2">
          <center><span class="card-title"><h7>Operativos</h7></span></center>
        </div>
      </div>
      <div class="col s12 m12"> 
        <div class="card" style="margin-left: 20px; margin-right: 20px">
          <br>
          <div class="search">
            <input type="text" id="search" placeholder="Buscar ..." style="width: 200px; margin-left: 20px">
            <i class="fa fa-search"></i>
          </div>

          <!--DIV solamente para centrar-->
          <div class="col-s12-m6">
            <table id="tabla" class="centered">    
              <thead>
                <tr>
                  <th class="priority-5"></th>
                  <th class="priority-5"><center>N°</center></th>
                  <th class="priority-5"></th>
                  <th class="priority-1"><center>Nombre</center></th>
                  <th class="priority-1"><center>Clasificación</center></th>
                  <th class="priority-5"><center>Costo</center></th>
                  <th class="priority-5"><center>Fecha Inicio</center></th>
                  <th class="priority-5"><center>Fecha Final</center></th>
                  <th class="priority-5"><center>Descripción</center></th>

                  <?php if(isset($modificarOperativo) || isset($addProductosOperativo)){ ?>
                  <th class="priority-1"><center>Consultar</center></th>
                
                <?php } if(isset($eliminarOperativo)){ ?>
                  <th class="priority-1"><center>Eliminar</center></th>
                <?php } ?>
                
                  <th></th>
                  <th></th>
                </tr>
              </thead>

              <tbody>

                <?php

                $orden=0 ;
                foreach($datosOperativo as $operativo):
                  $matriz = array(); 
                  $orden++;
                  ?>

                  <tr>
                    <td class="priority-5"></td>
                    <th class="priority-5"><center><?=$orden ;?></center></th>
                    <td class="priority-5"><img class="circle" src="<?php if(isset($operativo['foto'])){ echo $operativo['foto'];} else{ echo 'vista/config/img/user3.png';} ?>" style="width: 30px; height: 30px;"></td>
                    <td><center><?php echo $operativo["nombre_operativo"]?></center></td>
                    <td><center><?php  $idO = $operativo["id_operativo"];



                    echo "<div style='text-align: left'>";

                    $cant = 0;

                    foreach ($datosClasificacion as $clasificacion) {

                      if ($clasificacion['id_operativo_nuevo'] == $idO) {

                        $matriz[] = $clasificacion['id_clasificacion'];
                        echo "<center>○ ".$clasificacion['nombre_clasificacion']."</center><br>";
                        $cant++;


                      }
                    }

                    echo "</div>";

                    if ($cant == 0) {

                      foreach ($clasificaciones as $class):

                        $matriz[] = $class['id_clasificacion'];

                      endforeach;

                      echo "<center>Sin productos</center><br>";


                    }

                    $array_para_enviar_via_url = serialize($matriz);
                    $array_para_enviar_via_url = urlencode($array_para_enviar_via_url);

                    ?></center></td>
                    <td class="priority-5"><center><?php echo $operativo["precio_operativo"]?></center></td>
                    <td class="priority-5"><center><?php echo $operativo["fecha_inicio_operativo"]?></center></td> 
                    <td class="priority-5"><center><?php echo $operativo["fecha_final_operativo"]?></center></td>
                    <td class="priority-5"><center><?php echo $operativo["descripcion"]?></center></td>

                    <?php if(isset($modificarOperativo) || isset($addProductosOperativo)){ ?>
                    <td class="priority-1"><center><a href="?url=operativo&opcion=registroFinal&id=<?php echo $operativo['id_operativo'];?>&matriz=<?php echo $array_para_enviar_via_url;?>&ope=consultar" data-position="bottom" data-tooltip="Consultar operativo/diversidad" class="btn tooltipped btn-small btn waves-effect waves-light yellow darken-2 white-text "><i class="icon-shop_two"></i></a></center></td>

                  <?php } if(isset($eliminarOperativo)){ ?>
                    <td class="priority-1"><center><a href="javascript:void(0);" onclick="cancelar('?url=operativo&opcion=eliminar&id=<?php echo $operativo["id_operativo"]?>&ope=consultar&matriz=<?php echo $array_para_enviar_via_url;?>&registrofinalizado=true');" data-position="bottom" data-tooltip="Eliminar operativo" class="btn tooltipped btn-small btn waves-effect waves-light red darken-2 white-text "><i class="icon-delete"></i></a></center></td>
                  <?php } ?>
                  
                  <?php endforeach;  ?> 
                </tbody>
              </table>

              <span class="left" id="total_reg" style="margin-top: 10px; margin-left: 22px"></span><br>

              <div class="col-md-12 center text-center">
                <ul class="pagination pager" id="myPager"></ul>
              </div><br>

            </div>
          </div>
        </div>
      </section>
      <div class="card-action">
       <center>
        <a href="?url=operativo&opcion=operativo" class="btn waves-effect waves-light blue darken-4 white-text btn-small">Regresar</a>
      </center>
    </div>
  </main>
  <!-- ============================================================== -->
  <!--FIN DEL CONTENIDO-->
  <!-- ============================================================== -->

  <!--*****************************************************************************************************************************-->

  <!-- ============================================================== -->
  <!--                     IMPORTACION DEL FOOTER                     -->
  <!-- ============================================================== -->
  <?php require_once 'vista/publico/Footer.php'; ?>

  <!-- ============================================================== -->
  <!--               IMPORTACION DE LOS SCRIPTS                       -->
  <!-- ============================================================== -->

  <!--JQUERY QUE USA MATERIALIZE-->
  <script type="text/javascript" src="vista/config/js/materialize.min.js"></script>

  <!--JQUERY PARA ACTIVAR LAS HERRAMIENTAS DE LA PAGINA-->
  <script type="text/javascript" src="vista/config/js/activador.js"></script>
  <script src="vista/config/js/alertas.js"></script>
  <script src="vista/config/js/activador_conteo.js"></script>

  <script>        
    
    $(document).ready(function(){
      $('.modal').modal();
    });

    $(document).ready(function(){
      $('.tooltipped').tooltip();
    });

  </script>

<script type="text/javascript" src="vista/config/js/search.js"></script>
  <script src="vista/config/js/searchMenu.js"></script>
  

</body> 
</html>