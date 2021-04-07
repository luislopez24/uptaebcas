<!DOCTYPE html>
<html>

<head>  

  <script language="JavaScript" type="text/javascript">
   
    var bPreguntar = true;
    
    window.onbeforeunload = preguntarAntesDeSalir;
    
    function preguntarAntesDeSalir()
    {
      if (bPreguntar)
        return "¿Seguro que quieres salir?";
    }
  </script>

  <!-- ============================================================== -->
  <!--               IMPORTACION DE CABECERA PRINCIPAL                -->
  <!-- ============================================================== -->
  <?php require_once 'vista/publico/Head.php'; ?>
  <script type="text/javascript" src="vista/config/js/catalogo/diversidad/validar_diversidad.js"></script>
  <script type="text/javascript" src="vista/config/js/alertas.js"></script>
  
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
    <div style="position: relative;">
      <section class="section">
       <div class="row">

        <!--AQUI VA TODO EL CONTENIDO-->
        <div class="row">
         <div class="col s12 m12">
          <div class="white-text card-panel blue darken-2">
            <center><span class="card-title"><h7>Diversidades de <?php foreach($datos2 as $strExec): echo $strExec["nombre_catalogo"]; endforeach; ?></h7></span></center>
          </div>
        </div>
      </div>

      <?php if(isset($registrarDiversidad)){ ?>
      <a href="#registrar-diversidad" data-position="bottom" data-tooltip="Registrar diversidad" class="btn tooltipped btn-floating waves-block  waves-effect  waves-light red darken-2 btn modal-trigger" style="width:50px; height:auto; margin-top:-140px; float:right;"><i class="icon-add"></i></a> 
      <?php } ?>
      
      <!-- Foto y datos del operativo-->
      <div class="col s12 m4">
        <div class="row">
          <div class="col s12 m12">
            <div class="card">
              <div class="card-image waves-effect waves-block waves-light">
                <center>
                  <br>
                  <br>
                  <img class="activator" src="<?php foreach($info as $operativo): if(isset($operativo['foto'])){ echo $operativo['foto'];} else{ echo 'vista/config/img/user3.png';} endforeach;?>"  style="width: 250px; height: 250px; margin-top: -20px; border-radius: 50%;">
                  <br>
                </center>
              </div>
            </div>     
          </div>
          <div class="col s12 m12">
            <?php 

            foreach ($boton as $bot):

              if(!empty($bot['id_diversidad_operativo'])){

                if(!empty($bot['cantidad_por_persona'])){

                  $producto='si';
                }else{
                  $producto=null;
                }
              }else{
                $producto=null;
              }
            endforeach;


            if(isset($producto)){
              ?>
              <center>
               <a onclick="bPreguntar = false;" href="?url=operativo&opcion=registroFinal&matriz=<?php echo $array_para_enviar_via_url;?>&ope=<?php echo $ope;?>&id=<?php echo $id_o;?>&carrito=active&registroOperativo=true" data-position="bottom" data-tooltip="Culminar registro" class="btn tooltipped btn-small waves-effect waves-light green darken-2 white-text ">REGISTRAR</a>


              <?php if(isset($eliminarOperativo)){ ?>
               <a href="javascript:void(0);" onclick="bPreguntar = false; cancelar('?url=operativo&opcion=eliminarUltimoRegistro&id=<?php echo $id_o;?>')" data-position="bottom" data-tooltip="Cancelar registro del operativo" class="btn tooltipped btn-small waves-effect waves-light red darken-2 white-text ">CANCELAR</a>
              <?php } ?>
              
               <a onclick="bPreguntar = false;" href='?url=operativo&opcion=carrito&matriz=<?php echo $array_para_enviar_via_url;?>&id_o=<?php echo $id_o;?>&nuevo_registro=<?php echo $nuevo_registro;?>&ope=<?php echo $ope;?>' class='btn-small waves-effect waves-light purple darken-2 white-text'>Volver</a>
             </center>             
             <?php
           }else{        
             ?>  
             <center>
              <a href="" class="btn-small waves-effect waves-light red darken-2 white-text" title="Por favor, registre algún producto con su cantidad" disabled>REGISTRAR</a>

              <?php if(isset($eliminarOperativo)){ ?>
              <a href="javascript:void(0);" onclick="bPreguntar = false; cancelar('?url=operativo&opcion=eliminarUltimoRegistro&id=<?php echo $id_o;?>')" data-position="bottom" data-tooltip="Cancelar registro del operativo" class="btn tooltipped btn-small waves-effect waves-light red darken-2 white-text ">CANCELAR</a>
              <?php } ?>

              <a onclick="bPreguntar = false;" href='?url=operativo&opcion=carrito&matriz=<?php echo $array_para_enviar_via_url;?>&id_o=<?php echo $id_o;?>&nuevo_registro=<?php echo $nuevo_registro;?>&ope=<?php echo $ope;?>' class='btn-small waves-effect waves-light purple darken-2 white-text'>Volver</a>
              <br>
              <h7>Por favor, registre un producto con su cantidad, para poder poder finalizar el registro</h7>
            </center>
            <?php
          } 

          ?>
        </div>
      </div>
    </div>

    <div class="col s12 m8">
      <div class="card">
        <div class="card-image waves-effect waves-block waves-light">

         <div class="search" style="position: right!important">
          <input type="text" id="search" name="search" placeholder="Buscar ..." style="width: 200px; margin-left: 20px; margin-top: 20px">
          <i class="fa fa-search"></i>
        </div>
        <br>

        <div style="margin-left: 2px;">

          <table id="tabla" class="centered">
            <thead>
              <tr>

                <th class="priority-1">Producto</th>
                <th class="priority-5">Marca</th>
                <th class="priority-5">Contenido</th>
                <th class="priority-1">Seleccionar</th>
                <th class="priority-1">Cantidad por persona</th>

                <?php if(isset($modificarDiversidad)){ ?>
                <th class="priority-1">Modificar</th>

              <?php } if(isset($eliminarDiversidad)){ ?>
                <th class="priority-1">Eliminar</th>
              <?php } ?>

              </tr>
            </thead>

            <tbody>
              <?php
              foreach($datos as $strExec):

                ?>

                <tr>
                  <td class="priority-1"><?php echo $strExec["nombre_diversidad"]?></td>
                  <td class="priority-5"><?php echo $strExec["marca"]?></td>
                  <td class="priority-5"><?php echo $strExec["contenido"]?></td>
                  <td class="priority-1">
                    <?php 

                    $id_diversidad=$strExec['id_diversidad'];
                    $tipo=$_GET['tipo'];
                    $id_o=$_GET['id_o'];

                    if (empty($strExec["id_diversidad_operativo"])) {

                      echo  "<a onclick='bPreguntar = false;' href='?url=diversidad&opcion=addProducto-carrito&producto=$id_diversidad&tipo=$array_para_enviar_via_url&id_o=$id_o&ope=$ope&nuevo_registro=$nuevo_registro&idCatalogo=$identificacionCatalogo' name='hola' data-position='bottom' data-tooltip='Agregar diversidad' class='btn tooltipped  waves-effect waves-light red darken-2 white-text btn-small' value='hola'><i class='icon-close'></i></a>";
                    }else{

                      ?>

                      <a href="javascript:void(0);" onclick="bPreguntar = false; elimi('?url=diversidad&opcion=deleteProducto&producto=<?php echo $id_diversidad;?>&tipo=<?php echo $array_para_enviar_via_url;?>&id_o=<?php echo $id_o;?>&nuevo_registro=<?php echo $nuevo_registro;?>&ope=<?php echo $ope;?>&idCatalogo=<?php echo $identificacionCatalogo;?>');" data-position="bottom" data-tooltip="Quitar diversidad" class="btn tooltipped btn waves-effect waves-light green darken-2 white-text btn-small"><i class="icon-check"></i></a>

                      <?php
                    }

                    ?>

                  </td>
                  <td class="priority-1">
                   <?php

                   $hola = $strExec["id_operativo_diversidad"];

                   if (empty($strExec["id_diversidad_operativo"])) {
                     echo "-";
                   }else{

                     if (!empty($strExec["cantidad_por_persona"])) {

                       echo  $strExec["cantidad_por_persona"];
                     }else{

                       echo "<a href='#registrar-cantidad' name='hola' data-position='bottom' data-tooltip='Registrar cantidad' class='btn tooltipped waves-effect waves-light purple darken-2 white-text btn modal-trigger btn-small' value='hola'><i class='icon-add'></i></a>";
                       ?>
                       
                       <!-- Modal registrar cantidad -->
                       <div id="registrar-cantidad" class="modal modal-fixed-footer" style="height: 300px;">
                        <div class="modal-content">
                          <h5>Registrar cantidad</h5>
                          <div class="col s12">

                           <form method="POST" action="?url=diversidad&opcion=addCantidad&tipo=<?php echo $array_para_enviar_via_url;?>&id_o=<?php echo $id_o;?>&nuevo_registro=<?php echo $nuevo_registro;?>&ope=<?php echo $ope;?>&idCatalogo=<?php echo $identificacionCatalogo;?>">

                            <div class="row">
                             <div class="input-field col s12 m8">
                               <i class="icon-add_box prefix"></i>
                               <input type="text" name="cant" id="cant" title="Solo números" pattern="[0-9-]+" maxlength="20" data-length="20" required>
                               <label for="cant">Cantidad</label>
                             </div>

                             <input type="hidden" id="id_Odiversidad" name="id_Odiversidad" value="<?php echo $strExec['id_operativo_diversidad'];?>">

                             <div class="input-field col s4">
                              <input onclick='bPreguntar = false;' type="submit" name="aceptar" value="Registrar"class="btn-small btn-primary green darken-2">
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
                }
              }

              ?>
            </td>

            <?php if(isset($modificarDiversidad)){ ?>
            <td class="priority-1">
              <a href="#modificar-diversidad-<?php echo $strExec['id_diversidad'];?>"  name="modificar" data-position="bottom" data-tooltip="Modificar diversidad" class="btn tooltipped waves-effect waves-light yellow darken-3 white-text btn modal-trigger btn-small" value="editar"><i class="icon-settings"></i></a>
            </td>

            <!-- Modal modificar -->
            <div id="modificar-diversidad-<?php echo $strExec['id_diversidad'];?>" class="modal modal-fixed-footer" style="height: 500px; z-index: 1000;">
              <div class="modal-content">
                <h5>Modificar diversidad</h5>
                <div class="col s12">

                 <form method="POST" id="diversidad" name="diversidad" action="?url=diversidad&opcion=actualizarDiversidad&ope=<?php echo $ope;?>">

                  <div class="row">
                   <div class="input-field col s12 m6">
                    <i class="icon-shopping_cart prefix"></i>
                    <input type="text" name="descrip" id="descrip" value="<?php echo $strExec['nombre_diversidad']?>" maxlength="40" data-length="40" required>
                    <label for="descrip">Nombre</label>
                  </div>

                  <div class="input-field col s12 m6">
                    <i class="icon-copyright prefix"></i>
                    <input type="text" name="marca" id="marca" value="<?php echo $strExec['marca']?>" maxlength="40" data-length="40" required>
                    <label for="marca">Marca</label>
                  </div>

                  <div class="input-field col s12 m6">
                    <i class="icon-move_to_inbox prefix"></i>
                    <input type="text" name="contenido" id="contenido" value="<?php echo $strExec['contenido']?>" maxlength="20" data-length="20" required>
                    <label for="contenido">Contenido</label>
                  </div>

                  <div class="input-field col s12 m6">
                   <i class="icon-add_box prefix"></i>
                   <?php if(isset($strExec['cantidad_por_persona'])){ ?>
                     <input type="text" name="cant" id="cant" title="Solo números" value="<?php echo $strExec['cantidad_por_persona'];?>" pattern="[0-9-]+"  required>
                   <?php }else{
                     ?>
                     <input type="text" title="Solo números" pattern="[0-9-]+" disabled>
                     <?php
                   } ?>
                   <label for="nombre">Cantidad</label>
                 </div>

                 <div class="input-field col s12">
                  <i class="icon-border_color prefix"></i>
                  <input type="text" name="descripcion" id="descripcion" value="<?php echo $strExec['descripcion']?>" maxlength="200" data-length="200" required>
                  <label for="descripcion">Descripción</label>
                </div>

                <div>
                  <input type='hidden' id='idCatalogo' name='idCatalogo' value="<?php echo $identificacionCatalogo;?>">
                  <input type='hidden' id='id_o' name='id_o' value="<?php echo $id_o;?>">
                  <input type='hidden' id='tipo' name='tipo' value="<?php echo $array_para_enviar_via_url;?>">
                  <input type='hidden' id='nuevo_registro' name='nuevo_registro' value="<?php echo $nuevo_registro;?>">
                  <input type='hidden' id='ope' name='ope' value="<?php echo $ope;?>">
                  <input type='hidden' id='id_diversidad' name='id_diversidad' value="<?php echo $strExec['id_diversidad'];?>">
                  <input type='hidden' id='id_Odiversidad' name='id_Odiversidad' value="<?php echo $strExec['id_operativo_diversidad'];?>">
                </div>

                <div class="input-field col s12">
                  <button onclick="bPreguntar = false; validar_diversidad();" class="btn-small btn-primary yellow darken-3">Modificar</button>
                  <button type="reset" name="limpiar" class="btn-small waves-effect waves-light red darken-2 white-text"> Restaurar  </button>
                </div>
              </div>  
            </form>
          </div>
        </div>
        <div class="modal-footer">
          <a href="#!" class="modal-action modal-close waves-effect waves-brown btn-flat">Cerrar</a>
        </div>
      </div>

      <?php } if(isset($eliminarDiversidad)){ ?>
      <td class="priority-1">
        <a href="javascript:void(0);" onclick="bPreguntar = false; eliminar('?url=diversidad&opcion=eliminarDiversidad&producto=<?php echo $strExec['id_diversidad']?>&tipo=<?php echo $array_para_enviar_via_url;?>&id_o=<?php echo $id_o;?>&nuevo_registro=<?php echo $nuevo_registro;?>&ope=<?php echo $ope;?>&idCatalogo=<?php echo $identificacionCatalogo;?>');" data-position="bottom" data-tooltip="Eliminar diversidad" class="btn tooltipped waves-effect waves-light red darken-2 white-text btn-small"><i class="icon-delete"></i></a>
      </td>
    <?php } ?>
    </tr>

  <?php endforeach;  ?>

</tbody>
</table>

</div>

</div>
</div>
</div>


</div>
</section>
</div>
</main>

<!-- Modal registrar -->
<div id="registrar-diversidad" class="modal modal-fixed-footer" style="height: 600px;">
  <div class="modal-content">
    <h5>Registrar diversidad</h5>
    <div class="col s12">

     <form method="POST" id="diversidad" name="diversidad" action="?url=diversidad&opcion=registrar&ope=<?php echo $ope;?>">

      <div class="row">
       <div class="input-field col s6">
        <i class="icon-shopping_cart prefix"></i>
        <input type="text" name="descrip" id="descrip" maxlength="40" data-length="40" required>
        <label for="descrip">Nombre</label>
      </div>

      <div class="input-field col s6">
        <i class="icon-copyright prefix"></i>
        <input type="text" name="marca" id="marca" maxlength="40" data-length="40" required>
        <label for="marca">Marca</label>
      </div>

      <div class="input-field col s12">
        <i class="icon-move_to_inbox prefix"></i>
        <input type="text" name="contenido" id="contenido" maxlength="30" data-length="30" required>
        <label for="contenido">Contenido</label>
      </div>

      <div class="input-field col s12">
        <i class="icon-border_color prefix"></i>
        <input type="text" name="descripcion" id="descripcion" maxlength="300" data-length="200" required>
        <label for="descripcion">Descripción</label>
      </div>

      <div>
        <input type='hidden' id='idCatalogo' name='idCatalogo' value="<?php echo $identificacionCatalogo;?>">
        <input type='hidden' id='id_o' name='id_o' value="<?php echo $id_o;?>">
        <input type='hidden' id='tipo' name='tipo' value="<?php echo $array_para_enviar_via_url;?>">
        <input type='hidden' id='nuevo_registro' name='nuevo_registro' value="<?php echo $nuevo_registro;?>">
        <input type='hidden' id='id_diversidad' name='id_diversidad' value="<?php echo $strExec['id_diversidad'];?>">
      </div>

      <div class="input-field col s12">
        <button onclick="bPreguntar = false; validar_diversidad();" class="btn-small btn-primary green darken-2">Registrar</button>
        <button type="reset" name="limpiar" class="btn waves-effect waves-light red darken-2 white-text btn-small"> limpiar </button>
      </div>
    </div>  
  </form>
</div>
</div>
<div class="modal-footer">
  <a href="#!" class="modal-action modal-close waves-effect waves-brown btn-flat">Cerrar</a>
</div>
</div> 

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
<script type="text/javascript" src="vista/config/js/search.js"></script>
  <script src="vista/config/js/searchMenu.js"></script>

</body>
</html>