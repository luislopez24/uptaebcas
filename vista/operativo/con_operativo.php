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

      font-size: 60%

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
                <th class="priority-1">Descripción</th>
                <th class="priority-1">Costo</th>
                <th class="priority-5">Fecha inicial</th>
                <th class="priority-5">Fecha final</th>
                <th class="priority-5">Clasificación</th>

                <?php if(isset($addProductosOperativo)){ ?>
                <th class="priority-1">Productos</th>

              <?php } if(isset($modificarOperativo)){ ?>
                <th class="priority-1">Modificar</th>

              <?php } if(isset($eliminarOperativo)){ ?>
                <th class="priority-1">Eliminar</th>
              <?php } ?>

              </tr>
            </thead>

            <tbody>
              <?php

              foreach($datosOperativo as $strExec):

                ?>
                <tr>
                  <td class="priority-1"><?php echo $strExec["descripcion"]?></td>
                  <td class="priority-1"><?php echo $strExec["precio_operativo"]?> BsS</td>
                  <td class="priority-5"><?php echo $strExec["fecha_inicio_operativo"]?></td>
                  <td class="priority-5"><?php echo $strExec["fecha_final_operativo"]?></td>  
                  <td class="priority-5"><?php 

                  echo "<div style='text-align: left'>";
                  $cant = 0;
                  
                  foreach ($clasificacionDelOperativo as $clasificacion) {
                   $cant++;
                 }

                 if ($cant == 0) {

                   echo "<center>Sin productos</center><br>";
                   
                 }else{

                   echo "<center>○ ".$clasificacion['nombre_clasificacion']."</center><br>";
                   
                 }

                 echo "</div>";
                 ?></td>

                 <?php if(isset($addProductosOperativo)){ ?>
                 <td class="priority-1"><a href="?url=operativo&opcion=carrito&id_o=<?php echo $strExec["id_operativo"]?>&nuevo_registro=true&ope=<?php echo $ope;?>&matriz=<?php echo $array_para_enviar_via_url;?>&registrofinalizado=true" data-position="bottom" data-tooltip="Seleccionar diversidades" class="btn tooltipped waves-effect waves-light black darken-2 white-text btn-small"><i class="icon-add"></i></a></td>

               <?php } if(isset($modificarOperativo)){ ?>
                 <td class="priority-1"><a href="#modificar" data-position="bottom" data-tooltip="Modificar operativo" class="btn tooltipped waves-effect waves-light darken-2 white-text btn modal-trigger btn-small"><i class="icon-sync"></i></a></td>

               <?php } if(isset($eliminarOperativo)){ ?>
                 <td class="priority-1"><a href="javascript:void(0);" onclick="cancelar('?url=operativo&opcion=eliminar&id=<?php echo $strExec["id_operativo"]?>&ope=<?php echo $ope;?>&matriz=<?php echo $array_para_enviar_via_url;?>&registrofinalizado=true');" data-position="bottom" data-tooltip="Eliminar operativo" class="btn tooltipped waves-effect waves-light red darken-2 white-text btn-small"><i class="icon-delete"></i></a></td> 
                <?php } ?>

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
              <th class="priority-1">Producto</th>
              <th class="priority-1">Marca</th>
              <th class="priority-1">Contenido</th>
              <th class="priority-5">Descripción</th>
              <th class="priority-1">Cantidad por Persona</th>

            </tr>
          </thead>

          <?php foreach ($diversidadesRegistradas as $strExec): 

            $id=$_GET['id'];

            if ($strExec['id_operativo_nuevo']==$id) {


              ?>

              <tbody>
                <tr>
                  <td class="priority-1"><?php echo $strExec['nombre_diversidad'];?></td>
                  <td class="priority-1"><?php echo $strExec['marca'];?></td>
                  <td class="priority-1"><?php echo $strExec['contenido'];?></td>
                  <td class="priority-5"><?php echo $strExec['descripcion'];?></td>
                  <td class="priority-1"><?php echo $strExec['cantidad_por_persona'];?></td>                                
                </tr>
              </tbody>
            <?php } endforeach; ?>
          </table>


          <div class="card-action">

            <center>

              <?php if ($ope == 'consultar') {
                ?>

                <a href="?url=operativo&opcion=consultarOperativos" class="btn waves-effect waves-light blue darken-4 white-text btn-small">regresar</a>

                <?php 
              }else{  ?>
                
                <?php if(isset($publicarOperativo)){ ?>
                <a href="?url=operativo&opcion=inicioPublicar" data-position="bottom" data-tooltip="Publicar operativo" class="btn tooltipped waves-effect waves-light red darken-2 white-text btn-small">Publicar</a>
                <?php } ?>
                
                <?php if(isset($modificarOperativo) || isset($eliminarOperativo) || isset($addProductosOperativo)){ ?>
                <a href="?url=operativo&opcion=consultarOperativos" data-position="bottom" data-tooltip="Culminar registro" class="btn tooltipped waves-effect waves-light green darken-2 white-text btn-small">Finalizar</a>
                <?php } ?>

                <?php if(!isset($modificarOperativo) && !isset($eliminarOperativo) && !isset($addProductosOperativo)){ ?>
                <a href="?url=operativo&opcion=operativo" class="btn waves-effect waves-light green darken-2 white-text btn-small">Volver</a>
                <?php } ?>

              <?php } ?>

            </center>

          </div>

        </div>     
      </div>
    </div>
  </div>

  <br>    

</section>
</main>

<?php foreach ($datosOperativo as $operativo) { ?>
 <!-- ============================================================== -->
 <!--INICIO DEL MODAL MODIFICAR-->
 <!-- ============================================================== -->
 <div id="modificar" class="modal modal-fixed-footer" style="height: 600px;">
  <div class="modal-content">
    <h5>Modificar operativo</h5>
    <div class="col s12">
      <form method="POST" name="producto" id="producto" action="?url=operativo&opcion=modificar&id=<?php echo $strExec["id_operativo"]?>&tipo=<?php echo $array_para_enviar_via_url;?>&ope=<?php echo $ope;?>" enctype="multipart/form-data">

       <input type="hidden" name="date" id="date" value="<?php echo date("Y").'-'.date("m").'-'.date("d");?>">
       <input type="hidden" name="id_o" id="id_o" value="<?php echo $operativo['id_operativo'];?>">
       
       <div class="row">

        <div class="input-field col s12 m6">
          <center>
            <div id="preview"> <img src="<?php if(isset($strExec['foto'])){ echo $strExec['foto'];} else{ echo 'vista/config/img/fami.png';} ?>" class="circle" width="200" /></div>
            <label>Subir imagen</label><br>
            <input type="file" class="form-control" style="color: transparent;" id="foto_perfil" name="foto_perfil">
            <input type="hidden" value="<?php echo $strExec['foto']; ?>" name="foto_ruta" id="foto_ruta">
          </center>
          <script type="text/javascript">
            document.getElementById("foto_perfil").onchange = function(e) {
                                    // Creamos el objeto de la clase FileReader
                                    let reader = new FileReader();

                                    // Leemos el archivo subido y se lo pasamos a nuestro fileReader
                                    reader.readAsDataURL(e.target.files[0]);

                                    // Le decimos que cuando este listo ejecute el código interno
                                    reader.onload = function(){
                                      let preview = document.getElementById('preview'),
                                      image = document.createElement('img');

                                      image.src = reader.result;

                                      $("#preview").html('<img  class="circle" width="200" src="'+ image.src +'" >');
                                    };
                                  }
                                </script>
                              </div>

                              <div class="input-field col s12 m6">
                                <i class="icon-next_week prefix"></i>
                                <input type="text" value="<?php echo $strExec['nombre_operativo'];?>" data-length="30" class="validate" disabled>

                                <input type="hidden" name="nombre" id="nombre" value="<?php echo $strExec['nombre_operativo'];?>">

                                <label for="nombre">Nombre del Operativo</label>
                              </div>


                              <input type="hidden" name="date" id="date" value="<?php echo date("Y").'-'.date("m").'-'.date("d");?>">
                              <input type="hidden" name="id_o" id="id_o" value="<?php echo $operativo['id_operativo'];?>">



                              <div class="input-field col s10 m5">
                                <i class="icon-shopping_cart prefix"></i>
                                <input type="text" name="precio" id="precio" title="Solo Numero" required value="<?php echo $operativo['precio_operativo'];?>" class="validate" required>
                                <label for="Price">Precio del Operativo</label>
                              </div>

                              <div class="input-field col s2 m1" style="margin-top: 30px">
                                BsS
                              </div>

                              <div class="input-field col s12 m6">
                                <i class="icon-event_note prefix"></i>
                                <input type="date" name="fechai" id="fechai" autocomplete="off" value="<?php echo $operativo['fecha_inicio_operativo'];?>" required>
                                <label for="fecha">Fecha Inicio </label>
                              </div> 

                              <div class="input-field col s12 m6">
                                <i class="icon-event_note prefix"></i>
                                <input type="date" name="fechaf" id="fechaf" autocomplete="off" value="<?php echo $operativo['fecha_final_operativo'];?>" required>
                                <label for="fecha">Fecha Final</label>
                              </div>            

                              <div class="input-field col s12 m6">
                                <i class="icon-mode_edit prefix"></i>
                                <textarea id="descrip" class="materialize-textarea"  pattern="[A-Za-z0-9/ ]+"  data-length="100" name="descrip"><?php echo $operativo['descripcion'];?></textarea>
                                <label for="descrip">Descripción</label>
                              </div>

                              <div class="input-field col s12 m6">
                               <i class="icon-work prefix"></i>
                               <select  id="banco" name="banco" required>
                                <option value="<?php echo $operativo['banco_admitido'];?>"><?php echo $operativo['banco_admitido'];?></option>
                                <option value="Banco de Venezuela S.A.C.A. Banco Universal"> Banco de Venezuela S.A.C.A. Banco Universal</option>
                                <option value="Banco Mercantil, C.A S.A.C.A. Banco Universal"> Banco Mercantil, C.A S.A.C.A. Banco Universal</option>
                                <option value="Banco Industrial de Venezuela, C.A. Banco Universal"> Banco Industrial de Venezuela, C.A. Banco Universal</option>
                                <option value="Venezolano de Crédito, S.A. Banco Universal"> Venezolano de Crédito, S.A. Banco Universal</option>
                                <option value="Banco Provincial, S.A. Banco Universal"> Banco Provincial, S.A. Banco Universal</option>
                                <option value="Bancaribe C.A. Banco Universal"> Bancaribe C.A. Banco Universal</option>
                                <option value="Banco Exterior C.A. Banco Universal"> Banco Exterior C.A. Banco Universal</option>
                                <option value="Banco Occidental de Descuento, Banco Universal C.A."> Banco Occidental de Descuento, Banco Universal C.A.</option>
                                <option value="Banco Caroní C.A. Banco Universal"> Banco Caroní C.A. Banco Universal</option>
                                <option value="Banesco Banco Universal S.A.C.A."> Banesco Banco Universal S.A.C.A.</option>
                                <option value="Banco Sofitasa Banco Universal"> Banco Sofitasa Banco Universal</option>
                                <option value="Banco Plaza Banco Universal"> Banco Plaza Banco Universal</option>
                                <option value="Banco de la Gente Emprendedora C.A."> Banco de la Gente Emprendedora C.A.</option>
                                <option value="Banco del Pueblo Soberano, C.A. Banco de Desarrollo"> Banco del Pueblo Soberano, C.A. Banco de Desarrollo</option>
                                <option value="BFC Banco Fondo Común C.A Banco Universal"> BFC Banco Fondo Común C.A Banco Universal</option>
                                <option value="100% Banco, Banco Universal C.A."> 100% Banco, Banco Universal C.A.</option>
                                <option value="DelSur Banco Universal, C.A."> DelSur Banco Universal, C.A.</option>
                                <option value="Banco del Tesoro, C.A. Banco Universal"> Banco del Tesoro, C.A. Banco Universal</option>
                                <option value="Banco Agrícola de Venezuela, C.A. Banco Universal"> Banco Agrícola de Venezuela, C.A. Banco Universal</option>
                                <option value="Bancrecer, S.A. Banco Microfinanciero"> Bancrecer, S.A. Banco Microfinanciero</option>
                                <option value="Mi Banco Banco Microfinanciero C.A."> Mi Banco Banco Microfinanciero C.A.</option>
                                <option value="Banco Activo, C.A. Banco Universal"> Banco Activo, C.A. Banco Universal</option>
                                <option value="Bancamiga Banco Microfinanciero C.A."> Bancamiga Banco Microfinanciero C.A.</option>
                                <option value="Banco Internacional de Desarrollo, C.A. Banco Universal"> Banco Internacional de Desarrollo, C.A. Banco Universal</option>
                                <option value="Banplus Banco Universal, C.A."> Banplus Banco Universal, C.A.</option>
                                <option value="Banco Bicentenario Banco Universal C.A."> Banco Bicentenario Banco Universal C.A.</option>
                                <option value="Banco Espirito Santo, S.A. Sucursal Venezuela B.U."> Banco Espirito Santo, S.A. Sucursal Venezuela B.U.</option>
                                <option value="Banco de la Fuerza Armada Nacional Bolivariana, B.U."> Banco de la Fuerza Armada Nacional Bolivariana, B.U.</option>
                                <option value="Citibank N.A."> Citibank N.A.</option>
                                <option value="Banco Nacional de Crédito, C.A. Banco Universal"> Banco Nacional de Crédito, C.A. Banco Universal</option>
                                <option value="Instituto Municipal de Crédito Popular"> Instituto Municipal de Crédito Popular</option>
                              </select>
                              <label>Banco Admitido</label>
                            </div>

                            <div class="input-field col s12">
                              <center>
                                <button type="submit" class="btn-small btn-primary yellow darken-3">Modificar</button>
                                <button type="reset" name="limpiar" class="btn-small waves-effect waves-light red darken-2 white-text"> Restaurar  </button>
                              </center>
                            </div>
                          </div>  
                        </form>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <a href="#!" class="modal-action modal-close waves-effect waves-brown btn-flat">Cerrar</a>
                    </div>
                  </div> 
                <?php } ?>
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

