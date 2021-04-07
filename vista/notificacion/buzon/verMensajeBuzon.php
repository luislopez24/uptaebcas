<!DOCTYPE html>
<html>
<head>
  <!-- ============================================================== -->
  <!--               IMPORTACION DE CABECERA PRINCIPAL                -->
  <!-- ============================================================== -->
  <?php require_once 'vista/publico/Head.php';?>
  <link rel="stylesheet" type="text/css" href="vista/config/css/fecha.css">
  <link rel="stylesheet" type="text/css" href="vista/config/css/bn.css">  
  <link href="vista/config/css/select2.min.css" rel="stylesheet"/>

<script src="vista/config/js/select2.min.js"></script>
  
  
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

    <?php foreach ($vermensaje as $msj) { 

       $f = $msj['fecha']; 
       $Mensajefecha = date('Y-m-d',strtotime($f));    
       $Mensajehora = date('H:i:s',strtotime($f)); 
    
    ?>
    
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

                    <?php $eMsj = false; if($msj['foto_icono'] == 1 || $msj['foto_icono'] == 2 || $msj['foto_icono'] == 3){ $eMsj = true; } if($eMsj == true){ ?>
                    <tr onClick="document.location.href='?url=notificacion&opcion=buzon'" style="border: none!important">
                    <?php } else {  ?>
                    
                    <tr onClick="document.location.href='?url=notificacion&opcion=buzon'" <?php if($direc =='imbox'){ ?> style="border: none!important; background: #EEEEEE" <?php } ?> style="border: none!important">
                    <?php } ?>
                      

                    <td class="waves-effect waves-block waves-light"><i class="icon-markunread prefix" style="margin-left: 15px;"></i><font face="arial" >Mensajes <?php if($contBuzonMsj >0){ ?><span style="margin-right: 15px; border-radius: 3em;" class="new badge green accent-4 right" data-badge-caption=""><?php echo $contBuzonMsj; ?></span><?php } ?> </font></td>
                  </tr>
                  <tr onClick="document.location.href='?url=notificacion&opcion=notificacionBuzon'" style="border: none!important; <?php if($_GET['direc'] == 'noti'){ ?> background: #EEEEEE;border: none!important;  <?php } ?>">
                    <td class="waves-effect waves-block waves-light"><i class="icon-chat_bubble prefix" style="margin-left: 15px"></i><font face="arial">Notificaciones<?php if($contBuzonNotificaciones >0){ ?><span class="new badge right" style="background-color: #f5153d; margin-right: 15px; border-radius: 3em;" data-badge-caption=""><?php echo $contBuzonNotificaciones; ?></span><?php } ?></font></td>
                  </tr>
                  <tr onClick="document.location.href='?url=notificacion&opcion=enviadosBuzon'" <?php if($direc =='send'){ ?> style="border: none!important; background: #EEEEEE" <?php } ?> style="border: none!important">
                    <td class="waves-effect waves-block waves-light"><i class="icon-send prefix" style="margin-left: 15px"></i><font face="arial">Enviados</font></td>
                  </tr>
                  <tr onClick="document.location.href='?url=notificacion&opcion=favoritosBuzon'" <?php if($direc =='fav'){ ?> style="border: none!important; background: #EEEEEE" <?php } ?> style="border: none!important">
                    <td class="waves-effect waves-block waves-light"><i class="icon-star prefix" style="margin-left: 15px"></i><font face="arial">Favoritos</font></td>
                  </tr>
                  <tr onClick="document.location.href='?url=notificacion&opcion=archivadosBuzon'" <?php if($direc =='archi'){ ?> style="border: none!important; background: #EEEEEE" <?php } ?> style="border: none!important">
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
            <div  style="margin-left: 20px; margin-right: 20px; margin-top: 15px">

             <table>
              <tbody>
                <tr style="border: none!important">
                  <td>
                    
                    <form action="?url=notificacion&opcion=eliminarMsj&ruta=<?php if($_GET['direc'] == 'imbox'){ echo 'inicioBuzon.php'; } if($_GET['direc'] == 'noti'){ echo 'notificacionBuzon.php'; } if($_GET['direc'] == 'fav'){ echo 'favoritosBuzon.php'; } if($_GET['direc'] == 'send'){ echo 'enviadosBuzon.php'; } if($_GET['direc'] == 'archi'){ echo 'archivadosBuzon.php'; } ?>&accion=<?php if($_GET['direc']== 'imbox'){ echo 'buzon';} if($_GET['direc']== 'send'){ echo 'send';}  if($_GET['direc']== 'fav'){ echo 'buzon';}  if($_GET['direc']== 'noti'){ echo 'buzon';} if($_GET['direc']== 'archi'){ echo 'buzon';} ?>" method="POST" id="eliminarMsj" name="eliminarMsj">

                    <?php if ($_GET['direc'] == 'imbox' || $_GET['direc'] == 'fav') { ?>
                    

                    <a href="#" onclick="document.getElementById('eliminarMsj').action='?url=notificacion&opcion=actualizarArchivar&ruta=<?php if($_GET['direc'] == 'imbox'){ echo 'inicioBuzon.php'; } if($_GET['direc'] == 'fav'){ echo 'favoritosBuzon.php'; } ?>'; document.eliminarMsj.submit();" data-position="bottom" data-tooltip="Archivar mensaje" class="btn tooltipped waves-effect waves-light purple darken-2 white-text btn-small" style="border-radius: 3em;"><i class="icon-archive prefix"></i></a>

                    <?php } ?>

                    <?php if ($_GET['direc'] == 'archi') { ?>
                      
                      <a href="#" onclick="document.getElementById('eliminarMsj').action='?url=notificacion&opcion=actualizarDesarchivar&ruta=archivadosBuzon.php'; document.eliminarMsj.submit();" data-position="bottom" data-tooltip="Desarchivar mensajes seleccionados" class="btn tooltipped waves-effect waves-light purple darken-2 white-text btn-small" style="border-radius: 3em;"><i class="icon-unarchive prefix"></i></a>

                    <?php } ?>
                    
                    <a href="#" onclick="eliminarMensajes();" data-position="bottom" data-tooltip="Eliminar mensajes seleccionados" class="btn tooltipped waves-effect waves-light red darken-2 white-text btn-small" style="border-radius: 3em;"><i class="icon-delete prefix"></i></a>
                  </td>
                </tr>

                <tr style="border: none!important"><td>
                  <font face="arial" size="5"><?php echo $msj['asunto']; ?></font>
                </td></tr>
              </tbody> 
            </table>

          </div>
          <div class="divider"></div>

          <div style="margin-top: 2%; margin-left: 40px; margin-right: 40px"> 
            <div>
              <div class="row">

                <div class="col s1 m1">
                  <a href="javascript:void(0)"><?php if ($msj['foto_icono'] == 1 || $msj['foto_icono'] == 2 || $msj['foto_icono']== 3) {?>  <span <?php if($msj["foto_icono"] == 1){ echo "class='floating icon-hourglass_empty prefix' id='twoMensaje'";} if($msj["foto_icono"] == 2){ echo "class='floating icon-today prefix' id='threeMensaje'";} if($msj["foto_icono"] == 3){ echo "class='floating icon-settings prefix' id='fourMensaje'";} ?> style="height:auto; float:left;"></span> <?php }else{ if(empty($msj['foto'])){ $foto = 'vista/config/img/user3.png'; }else { $foto = $msj['foto'];}?> <img src="<?php echo $foto; ?>" alt="user" width="60" style="width: 60px;  height: 60px;" class="circle" /><?php } ?></a>
                </div>

                <input type="hidden" name="id_delete[]" value="<?php echo $msj['idBuzon']; ?>">

                <?php if ($msj['foto_icono'] == 1 || $msj['foto_icono'] == 2 || $msj['foto_icono']== 3) {?>  
                <div class="col s11 m11">
                  <h6 style="margin-top: 1%; margin-left: 15px">System CAS</h6>
                  <label style="margin-top: -10px; margin-left: 15px">Correo: uptaebcas@gmail.com</label>
                </div>
                
                <?php }else{ ?>
                
                <div class="col s11 m11">
                  <h6 style="margin-top: 1%; margin-left: 15px"><?php echo $msj["nombre"]." ".$msj["apellido"]; ?></h6>
                  <label style="margin-top: -10px; margin-left: 15px">Correo: <?php echo $msj["email"].$msj["temail"]; ?></label>
                </div>

                <?php } ?>
              </div>

              <p><b><?php echo $_SESSION['nombre']." ".$_SESSION["apellido"]; ?></b></p><br>
              <p>   <?php echo $msj['mensaje'];?></p>
               <label style="height:auto; margin-top: 15px; margin-left: -28px; float:right;">El <?php echo $Mensajefecha;?> a las <?php echo $Mensajehora;?></label><br>
            </div>
          </div>
          <br>
          <div class="divider"></div>

          <div class="card-action" style="float: right;">
              <?php if($msj['foto_icono'] == 1 || $msj['foto_icono'] == 2 || $msj['foto_icono'] == 3 || $_GET['direc'] == 'send'){ ?>
              
              <?php }else{ ?> <a data-position="bottom" id="ocultar" name="ocultar" onclick="mostrarForm()" data-tooltip="Responder mensaje" class="tooltipped" href="#">Responder</a> <?php } ?>
            
          </div>
        </form>

          <div id="formReply" style="margin-top: 2%; margin-left: 40px; margin-right: 40px; display: none">
            <div class="row" >

             <form method="POST" action="?url=notificacion&opcion=responderEmail" >

              <div class="col s12 m12">

                <div class="input-field col s12 m12">
                  <i class="icon-announcement prefix"></i>
                  <input id="txtasuntico" name="txtasuntico" type="text" value="Reply: <?php echo $msj['asunto']; ?>">
                  <label class="center-align">Asunto:</label>   
                </div> 

                <tr>
                  <i class="icon-person_outline prefix"></i>
                  <th colspan="1">Ingrese su mensaje</th>
                  <TD colspan="2"><TEXTAREA rows=5 cols=30 name="txtmensaje" class="validate" style="background-color: white; height: 100px; border-radius: 6px;">  </TEXTAREA>
                </td>

                <input type="hidden" name="tipoo[]" value="<?php echo $msj['idEmisor']; ?>">
                <br>

                <input align="right" data-position="left" data-tooltip="Enviar mensaje" class="tooltipped" type=image src="vista/config/img/icomail.png" width="30" height="30" onclick="return enviarcorreo()" name="enviar" id="enviar" / style="margin-top: 5px; text-align: right;">
                <br>
              </tr>


            </TD></tr></div></form>
          </div>

            <?php } ?>

        </div>

      </div>
    </div>
  </div><br>
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


  function mostrarForm(){
          var cambio = document.getElementById("formReply");

          var bot = document.getElementById("ocultar");

          if(cambio.style.display == "none"){
            cambio.style.display = "";
            bot.style.display = "none";
          }else{
            cambio.style.display = "";
            bot.style.display = "none";
          }
        }
        

</script>


<script src="vista/config/js/searchMenu.js"></script>
<script type="text/javascript" src="vista/config/js/search.js"></script>

</body>
</html>
