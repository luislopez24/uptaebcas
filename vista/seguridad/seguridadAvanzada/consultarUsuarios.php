<!DOCTYPE html>
<html>

<head>  
  <!-- ============================================================== -->
  <!--               IMPORTACION DE CABECERA PRINCIPAL                -->
  <!-- ============================================================== -->
  <?php require_once 'vista/publico/Head.php'; ?>
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
        <div class="white-text card-panel green darken-2">
          <center><span class="card-title"><h7><?php if($idRol == '1'){ echo "Super Usuarios"; } if($idRol == '2'){ echo "Administradores"; } if($idRol == '3'){ echo "Operadores"; } if($idRol == '4'){ echo "Beneficiarios"; } ?></h7></span></center>
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
          <div style="margin-left: 20px; margin-right: 20px">

            <table id="tabla" class="centered">
              <thead>     
                <tr>
                  <th class="priority-2">N°</th>
                  <th class="priority-2"></th>
                  <th class="priority-2">Cédula</th>
                  <th class="priority-1">Nombre</th>
                  <th class="priority-1">Apellido</th>
                  <th class="priority-4">Celular</th>
                  <th class="priority-5">Dependencia</th>
                  <th class="priority-1">Permisos</th>
                  <th class="priority-1">Estatud</th>
                  <th class="priority-1">Restaurar</th>
                  <th class="priority-1">Eliminar</th>
                  
                </tr>
              </thead>
              
              <?php
              
              $orden=0;

              foreach($datos as $strExec):

                if (!empty($strExec['foto'])){

                  $foto = $strExec['foto'];

                }else {

                  $foto = 'vista/config/img/user3.png';
                }

                $orden++;
                ?>

                <tbody>


                 <tr>

                   <td class="priority-2"><?= $orden; ?></td>
                   <td class="priority-2"><img class="circle" src="<?php echo $foto; ?>" style="width: 30px; height: 30px;"><?php if($strExec["status"] == 'Enabled'){ ?> <img class="circle" src="vista/config/img/enabled.png" style="width: 10px; height: 10px; margin-left: -23%"> <?php } if($strExec["status"] == 'Disabled'){ ?> <img class="circle" src="vista/config/img/disabled.png" style="width: 10px; height: 10px; margin-left: -23%"> <?php } ?></td>
                   <td class="priority-2"><?php echo $strExec["tcedula"]."-".$strExec["cedula"]?></td>
                   <td class="priority-1"><?php echo $strExec["nombre"]?></td>
                   <td class="priority-1"><?php echo $strExec["apellido"]?></td>
                   <td class="priority-4"><?php echo $strExec["tcelular"]."-".$strExec["celular"]?></td>
                   <td class="priority-5"><?php echo $strExec["dependencia"]?></td>

                   <td class="priority-1"> 
                    <a href="?url=seguridad&opcion=consultarPermisos&id_rol=<?php echo $strExec['tipo_rol'];?>&idUser=<?php echo $strExec['id_usuario'];?>" data-position="bottom" data-tooltip="Asignar permisos" class="btn tooltipped waves-effect waves-light green darken-2 white-text  btn-small" value="editar"><i class="icon-add"></i></a></div>
                  </td>

                  <td class="priority-1">
                    <a href="#modificar-<?php echo $strExec['id_usuario'];?>"  name="consultar"  name="modificar"  data-position="bottom" data-tooltip="Modificar estatud" class="btn tooltipped waves-effect waves-light yellow darken-3 white-text btn modal-trigger btn-small" value="editar"><i class="icon-settings"></i></a>

                  </td>

                  <!-- Modal modificar -->
                  <div id="modificar-<?php echo $strExec['id_usuario'];?>" class="modal modal-fixed-footer" style="height: 400px;">
                    <div class="modal-content">
                      <h5>Modificar usuario <?php echo $strExec["nombre"]." ".$strExec["apellido"];?></h5>
                      <div class="col s12">
                        <form  method="POST" id="userRol" name="userRol" action="?url=seguridad&opcion=modificarRol&id=<?php echo $_GET['id'];?>">

                          <input type="hidden" value="<?php echo $strExec['id_usuario'];?>" name="idUsuario" id="idUsuario">
                          <input type="hidden" value="<?php echo $strExec['tipo_rol'];?>" name="tipo_rol" id="tipo_rol">

                          <div class="row"> 
                            <div class="input-field col s6" >
                              <label style="margin-top: -30px;">Rol</label>
                              <select class="browser-default" id="tipo" name="tipo" style="margin-top: 10px;">
                                <option value="<?php echo $strExec['tipo_rol'];?>" selected><?php if($strExec["tipo_rol"] == '1'){ echo 'Super Usuario';?> </option>
                                <option value="2">Administrador</option>
                                <option value="3">Operador</option>
                                <option value="4">Beneficiario</option>

                                <?php } if($strExec["tipo_rol"] == '2'){ echo 'Administrador';?> </option>
                                <option value="1">Super Usuario</option>
                                <option value="3">Operador</option>
                                <option value="4">Beneficiario</option>

                                <?php } if($strExec["tipo_rol"] == '3'){ echo 'Operador';?> </option>
                                <option value="1">Super Usuario</option>p
                                <option value="2">Administrador</option>
                                <option value="4">Beneficiario</option>

                                <?php } if($strExec["tipo_rol"] == '4'){ echo 'Beneficiario';?> </option>
                                <option value="1">Super Usuario</option>
                                <option value="2">Administrador</option>
                                <option value="3">Operador</option>

                              <?php } ?>
                            </select>
                          </div>

                          <div class="input-field col s6" >
                            <label style="margin-top: -30px;">Estatud</label>
                            <select class="browser-default" id="estatus" name="estatus" style="margin-top: 10px;">
                              <option value="<?php echo $strExec['status'];?>" selected><?php if($strExec["status"] == 'Disabled'){ echo 'Inactivo';?> </option>
                              <option value="Enabled">Activo</option>

                            <?php } else{ echo 'Activo'; ?>
                            <option value="Disabled">Inactivo</option>
                          <?php } ?>
                        </select>
                      </div>

                      <div class="input-field col s12">
                        <input type="submit"class="btn btn-primary yellow darken-3 btn-small" value="modificar">

                      </div>
                    </div>  
                  </form>
                </div>
              </div>
              <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-brown btn-flat">Cerrar</a>
              </div>
            </div>

            <td class="priority-1">
              <a href="#reiniciar-<?php echo $strExec['id_usuario'];?>"  name="consultar"  name="reiniciar"  data-position="bottom" data-tooltip="Restaurar valores" class="btn tooltipped waves-effect waves-light cyan darken-3 white-text btn modal-trigger btn-small" value="editar"><i class="icon-sync"></i></a>

            </td>

            <!-- Modal reiniciar -->
            <div id="reiniciar-<?php echo $strExec['id_usuario'];?>" class="modal modal-fixed-footer" style="height: 400px;">
              <div class="modal-content">
                <h5>Restaura los valores del usuario <?php echo $strExec["nombre"]." ".$strExec["apellido"];?></h5>
                <div class="col s12">

                    <div class="row"> 
                      <div class="input-field col s6" >
                        <!--CARTA CONTENEDORA-->       
                        <div class="card-panel transparent waves-effect waves-block waves-light" onClick="validar_resetContrasena('?url=seguridad&opcion=resetContrasena&id=1&idU=<?php echo $strExec['id_usuario'];?>');">

                          <center>
                            <img class="activator" src="vista/config/img/reiniciar_contraseña.png" style="width: 150px; height: 150px">
                          </center>
                          <center> <span class="black-text"><h6>Contraseña</h6> </span></center>
                        </div>
                      </div>

                      <div class="input-field col s6" >
                        <!--CARTA CONTENEDORA-->       
                        <div class="card-panel transparent waves-effect waves-block waves-light" onClick="validar_resetQuest('?url=seguridad&opcion=resetQuest&id=1&idU=<?php echo $strExec['id_usuario'];?>');">

                          <center>
                            <img class="activator" src="vista/config/img/securitysuite.png" style="width: 150px; height: 150px">
                          </center>
                          <center> <span class="black-text"><h6>Preguntas de seguridad</h6> </span></center>
                        </div>
                        
                      </div>
                    </div>  
      
                 </div>
              </div>
              <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-brown btn-flat">Cerrar</a>
              </div>
            </div> 

            <td class="priority-1">
             <a href="javascript:void(0);" onclick="eliminar('?url=usuario&opcion=eliminar_usuario&rol=beneficiario&id=<?php echo $strExec['id_usuario']?>&redirigir=<?php echo $_GET['id']; ?>');" data-position="bottom" data-tooltip="Eliminar usuario" class="btn tooltipped waves-effect waves-light red darken-2 white-text btn-small"><i class="icon-delete_sweep"></i></a>
           </td>

         </tr>

       </tbody>

     <?php  endforeach;  ?>


   </table>

   <span class="left" id="total_reg" style="margin-top: 10px; margin-left: 10px"></span><br>

   <div class="col-md-12 center text-center">
    <span class="left" id="total_reg"></span>
  </div>

  <div class="col-md-12 center text-center">
    <ul class="pagination pager" id="myPager"></ul>
  </div><br>

</div>     
</div>
<center>
  <a href="?url=seguridad&opcion=inicioAdminUsuarios" class="btn waves-effect waves-light blue darken-4 white-text btn-small">Regresar</a>
</center>
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
