<!DOCTYPE html>
<html>
<head>
  <!-- ============================================================== -->
  <!--               IMPORTACION DE CABECERA PRINCIPAL                -->
  <!-- ============================================================== -->
  <?php require_once 'vista/publico/Head.php';?>
  <link rel="stylesheet" type="text/css" href="vista/config/css/fecha.css">
  <link rel="stylesheet" type="text/css" href="vista/config/css/bn.css">  

  
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
                    <td><center><a href="?url=notificacion&opcion=redactar" class="btn waves-effect waves-light white-text btn-small" style="background-color: #f5153d; width: 100%; border-radius: 0.4em; line-height: 250%;" disabled>redactar</a></center></td>
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

                <tr onClick="document.location.href='?url=notificacion&opcion=favoritosBuzon'" style="border: none!important">
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
            <div  style="margin-left: 20px; margin-right: 20px; margin-top: 15px">

              <h7>Redactar Nuevo Mensaje</h7>
              <div class="divider"></div>
              <br>
              <div class="row" >

               <form id="email" name="email" method="POST" action="?url=notificacion&opcion=enviarCorreo">

                <div class="col s12 m12">

                  <div class="input-field col s12 m9">
                    <i class="icon-person prefix"></i>

                    <select id="tipoo" name="tipoo[]" multiple>

                      <?php
                      foreach($datosU as $strExec):
                       // if($strExec['id_usuario'] != $_SESSION['id_ussuario']){
                        ?>
                        <option value="<?php echo $strExec["id_usuario"]?>"><?php echo $strExec["nombre"]." ".$strExec["apellido"]; ?></option>
                      <?php //} 
                    endforeach;  ?>

                    </select>

                    <label class="center-align">Para:</label>   
                  </div> 

                  <div class="input-field col s12 m3">

                    <center>

                      <a href="#" onclick="seleccionarTodo('tipoo')" data-position="bottom" data-tooltip="Seleccionar todos" class="btn tooltipped waves-effect waves-light yellow darken-3 white-text btn modal-trigger btn-small"><i class="icon-select_all"></i></a>

                      <a href="#"  onclick="eliminarSeleccion('tipoo')" data-position="bottom" data-tooltip="Eliminar todos" class="btn tooltipped waves-effect waves-light red darken-3 white-text btn modal-trigger btn-small"><i class="icon-clear_all"></i></a>

                    </center>

                  </div>

                  <div class="input-field col s12 m12">
                    <i class="icon-announcement prefix"></i>
                    <input id="txtasuntico" name="txtasuntico" type="text">
                    <label for="txtasuntico" class="center-align">Asunto:</label>   
                  </div> 

                  <div class="input-field col s12 m6">
                    <i class="icon-accessibility prefix"></i>
                    <input id="txrol" name="txtrol" type="text" value="<?php if($_SESSION['tipo_rol']=='2'){ echo 'Administrador';} if($_SESSION['tipo_rol']=='3'){ echo 'Operador';} if($_SESSION['tipo_rol']=='4'){ echo 'Beneficiario';} if($_SESSION['tipo_rol']=='1'){ echo 'Super Usuario';} ?>" readonly="readonly">
                    <label class="center-align">Rol</label>
                  </div>


                  <div class="input-field col s12 m6">
                    <i class="icon-contact_mail prefix"></i>
                    <input id="txtsucorreo" name="txtsucorreo" type="text" value="<?php echo $date; ?>" readonly="readonly">
                    <label class="center-align">Fecha</label>
                  </div>

                  <tr>
                    <i class="icon-person_outline prefix"></i>
                    <th colspan="1">Ingrese su mensaje</th>
                    <TD colspan="2"><TEXTAREA rows=5 cols=30 name="txtmensaje" id="txtmensaje" class="validate" style="background-color: white; height: 300px; border-radius: 6px;"></TEXTAREA>
                  </td>

                  <br>

                  <input type=image src="vista/config/img/icomail.png" onclick="validarcorreo()" style="margin-top: 5px; text-align: right;" align="right" width="30" height="30" data-position="left" data-tooltip="Enviar mensaje" class="tooltipped" >
                  
                  <br>
                </tr>


              </TD></tr></div></form></div></div></div>

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
  <script src="vista/config/js/validarCorreo.js"></script>
<!--JQUERY QUE USA MATERIALIZE-->
<script type="text/javascript" src="vista/config/js/materialize.min.js"></script>

<!--JQUERY PARA ACTIVAR LAS HERRAMIENTAS DE LA PAGINA-->
<script type="text/javascript" src="vista/config/js/activador.js"></script>
<script src="vista/config/js/alertas.js"></script>
<script src="vista/config/js/activador_conteo.js"></script>
<script>
    /**
     * Función que selecciona todos los valores del select
     * Recibe el id del select al que tiene que hacer referencia
     */
     function seleccionarTodo(id)
     {
        // Recorremos todos los valores
        $("#"+id+" option").each(function(){

            // Marcamos cada valor como seleccionado
            $("#"+id+" option[value="+this.value+"]").prop("selected",true);
            $('select').formSelect()

          });
      }

    /**
     * Funcion que elimina la seleccion de cualquier elemento del select
     * Recibe el id del select al que tiene que hacer referencia
     */
     function eliminarSeleccion(id)
     {
        // Recorremos todos los valores
        $("#"+id+" option").each(function(){

            // Marcamos cada valor como NO seleccionado
            $("#"+id+" option[value="+this.value+"]").prop("selected",false);
            $('select').formSelect()
          });
      }
    </script>
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
    


  </body>
  </html>
