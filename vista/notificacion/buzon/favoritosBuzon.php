<!DOCTYPE html>
<html>
<head>

 <?php require_once 'vista/publico/Head.php'; ?>
 <script type="text/javascript" src="vista/config/js/alertas.js"></script>
 <script type="text/javascript" src="vista/config/js/validacion_act_usu.js"></script>

 <style type="text/css">

   @media screen and (max-width: 400px) {

    table{

      font-size: 60%

    }

    #search{

      width: 80px!important;
      font-size: 60%;
      height: 30px!important;

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
        <center><span class="card-title"><h7>Buzón App</h7></span></center>
      </div>
    </div>

    <div class="col s12 m12"> 
      <div class="card" style="margin-left: 0px;">

       <div class="row">
        <div class="col s12 m4">
          <div style="margin-left: 20px!important; margin-right: 20px;">
            <table>
              <tbody>
                <tr style="border: none!important">
                  <?php if ($_SESSION['tipo_rol'] !=4) {?>
                  <td><center><a href="?url=notificacion&opcion=redactar" class="btn waves-effect waves-light white-text btn-small" style="background-color: #f5153d; width: 100%; border-radius: 0.4em; line-height: 250%;">redactar</a></center></td>
                  <?php  } else{ echo '<br>';} ?>
                </tr>
              </tbody> 
            </table>

            <table class="highlight">
              <tbody>    

                <tr onClick="document.location.href='?url=notificacion&opcion=buzon'" style="border: none!important">
                  <td class="waves-effect waves-block waves-light"><i class="icon-markunread prefix" style="margin-left: 15px;"></i><font face="arial" >Mensajes<?php if(!empty($contBuzonMsj)){ ?> <span style="margin-right: 15px; border-radius: 3em;" class="new badge green accent-4 right" data-badge-caption=""><?php echo $contBuzonMsj; ?></span><?php } ?></font></td>
                </tr>

                <tr onClick="document.location.href='?url=notificacion&opcion=notificacionBuzon'" style="border: none!important">
                  <td class="waves-effect waves-block waves-light"><i class="icon-chat_bubble prefix" style="margin-left: 15px"></i><font face="arial">Notificaciones<?php if(!empty($contBuzonNotificaciones)){ ?><span class="new badge right" style="background-color: #f5153d; margin-right: 15px; border-radius: 3em;" data-badge-caption=""><?php echo $contBuzonNotificaciones; ?></span><?php }?></font></td>
                </tr>

                <tr onClick="document.location.href='?url=notificacion&opcion=enviadosBuzon'" style="border: none!important">
                  <td class="waves-effect waves-block waves-light"><i class="icon-send prefix" style="margin-left: 15px"></i><font face="arial">Enviados</font></td>
                </tr>

                <tr onClick="document.location.href='?url=notificacion&opcion=favoritosBuzon'" style="background: #EEEEEE; border: none!important;">
                  <td class="waves-effect waves-block waves-light"><i class="icon-star prefix" style="margin-left: 15px"></i><font face="arial">Favoritos</font></td>
                </tr>

                <tr onClick="document.location.href='?url=notificacion&opcion=archivadosBuzon'" style="border: none!important">
                  <td class="waves-effect waves-block waves-light"><i class="icon-archive prefix" style="margin-left: 15px"></i><font face="arial">Archivados</font></td>
                </tr>

              </tbody>
            </table>

            <table>
              <tbody>
                <tr style="border: none!important">
                  <td><font face="arial" size="5">Labels</font></td>
                </tr>

                <tr style="border: none!important">
                  <td><span style="margin-right: 15px; border-radius: 0.5em; background-color: #f5153d; margin-left: 15px;" class="new badge left" data-badge-caption="">Admin</span> Administrador</td>
                </tr>

                <tr style="border: none!important">
                  <td><span style="margin-right: 15px; border-radius: 0.5em; margin-left: 15px;" class="new badge green accent-4 left" data-badge-caption="">Oper</span> Operador</td>
                </tr>

                <tr style="border: none!important">
                  <td><span style="margin-right: 15px; border-radius: 0.5em; background-color: #f5153d; margin-left: 15px;" class="new badge purple accent-4 left" data-badge-caption="">Benef</span> Beneficiario</td>
                </tr>

              </tbody> 
            </table>

          </div>
        </div>

        <div class="col s12 m8">
          <div  style="margin-left: 20px!important; margin-right: 20px;">
            <table>
              <tbody>
                <tr>
                  <td>

                    <form action="?url=notificacion&opcion=eliminarMsj&ruta=favoritosBuzon.php&accion=buzon" method="POST" id="eliminarMsj" name="eliminarMsj">

                    <a href="#" onclick="document.getElementById('eliminarMsj').action='?url=notificacion&opcion=actualizarArchivar&ruta=favoritosBuzon.php'; document.eliminarMsj.submit();" data-position="bottom" data-tooltip="Archivar mensajes seleccionados" class="btn tooltipped waves-effect waves-light purple darken-2 white-text btn-small" style="border-radius: 3em;"><i class="icon-archive prefix"></i></a>
                    
                    <a href="#" onclick="eliminarMensajes();" data-position="bottom" data-tooltip="Eliminar mensajes seleccionados" class="btn tooltipped waves-effect waves-light red darken-2 white-text btn-small" style="border-radius: 3em;"><i class="icon-delete prefix"></i></a>
                    
                    <a href="#" onclick="location.reload();" data-position="bottom" data-tooltip="Actualizar buzón" class="btn tooltipped waves-effect waves-light green darken-2 white-text btn-small" style="border-radius: 3em;"><i class="icon-refresh prefix"></i></a>
                  </td>
                </tr>
              </tbody> 
            </table>

            <table id="tabla" class="highlight" > 
              <tbody>    

                <?php foreach ($mensajesFav as $msj): 

                  $f = $msj['fecha']; 
                  $Mensajefecha = date('Y-m-d',strtotime($f));    
                  $Mensajehora = date('H:i:s',strtotime($f)); 

                  ?>

                <tbody >
                 <tr class="nose" <?php if($msj["leido"]=='1'){ ?> style="background: #EEEEEE; border: none!important" <?php } ?>
                   <form>

                    <td>
                      <center>
                       <label>
                        <input type="checkbox" name="id_delete[]" class="id_delete" value="<?php echo $msj['idBuzon'];?>" />
                        <span></span>
                      </label>
                    </center>
                  </td>

                  <?php if($msj["favorito"] == "0"){ ?>
                  <td ><i onClick="document.location.href='?url=notificacion&opcion=actualizarFavorito&idMensaje=<?php echo $msj["idBuzon"];?>&ruta=inicioBuzon.php&setFav=1'" class="waves-effect waves-block waves-light icon-star_border"></i></td>
                  <?php }else { ?>
                  <td><i onClick="document.location.href='?url=notificacion&opcion=actualizarFavorito&idMensaje=<?php echo $msj["idBuzon"];?>&ruta=inicioBuzon.php&setFav=0'"  class="waves-effect waves-block waves-light icon-star"></i></td>
                  <?php } ?>


                  <td><img class="circle" src="<?php echo $msj['foto'];?>" style="width: 30px; height: 30px;"></td>

                  <td><div style="margin-top: -10px"><?php echo $msj['nombre']." ".$msj["apellido"];?></div></td>

                  <td><div style="margin-top: -10px"><?php echo $msj['asunto'];?></div></td>    

                  <?php $resultado = $msj['mensaje'];

                  $resultado= substr($resultado, 0, 18); 
                  $n_s = strlen($resultado);

                  if ($n_s > 15) {
                    
                    $resultado = $resultado."..";

                  } ?>

                  <td align="center">

                    <?php if($msj["tipo_rol"] == '1'){ ?> <span style="border-radius: 0.5em; background-color: black;" class="new badge" data-badge-caption="">SuperU</span> <?php } ?>

                    <?php if($msj["tipo_rol"] == '2'){ ?> <span style="border-radius: 0.5em; background-color: #f5153d;" class="new badge" data-badge-caption="">Admin</span> <?php } ?>

                    <?php if($msj["tipo_rol"] == '3'){ ?> <span style="border-radius: 0.5em;" class="new badge green accent-4 left" data-badge-caption="">Oper</span> <?php } ?>

                    <?php if($msj["tipo_rol"] == '4'){ ?><span style="border-radius: 0.5em; background-color: #f5153d;" class="new badge purple accent-4 left" data-badge-caption="">Benef</span> <?php } ?>

                  </td>
                  <td onClick="document.location.href='?url=notificacion&opcion=verMensajeBuzon&idMensaje=<?php echo $msj["idBuzon"];?>&direc=fav&view=0'"  class="waves-effect waves-block waves-light"><?php echo $resultado; ?></td> 
                  <td><div style="margin-top: -10px"><i class="icon-hourglass_empty"></i></div></td>
                  <td><div style="margin-top: -10px"><?php if ($Mensajefecha == $date) { echo  "Hoy a las ".$Mensajehora; } else { echo "El ".$Mensajefecha." a las ".$Mensajehora;} ?></div></td>

                </tr>

                <?php endforeach ?>

              </tbody>
            </table>
          </div> 

          <!--DIV solamente para centrar-->
          <div style="margin-left: 20px; margin-right: 20px">

            <table cellpadding="0" cellspacing="0" class="table table-hover">
              <thead>
               <tr>
                <th><label>
                  <input type="checkbox" id="selectall">
                  <span>Seleccionar todos</span>
                </label></th>
              </tr>
            </thead>
          </table>

          <span class="left" id="total_reg" style="margin-top: 10px; margin-left: 8px"></span><br>

          <div class="col-md-12 center text-center">
            <span class="left" id="total_reg"></span>
          </div>

          <div class="col-md-12 center text-center">
            <ul class="pagination pager" id="myPager"></ul>
          </div>
          <br>

        </div>  

      </div>

 </div>

</div>

</body>
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


<script src="vista/config/js/searchMenu.js"></script>
<script type="text/javascript" src="vista/config/js/search.js"></script>


</html>