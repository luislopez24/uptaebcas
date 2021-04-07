 <!DOCTYPE html>
 <html>

 <head>

  <!-- ============================================================== -->
  <!--               IMPORTACION DE CABECERA PRINCIPAL                -->
  <!-- ============================================================== -->
  <?php require_once 'vista/publico/Head.php';?>
  <script type="text/javascript" src="vista/config/js/catalogo/producto/validar_producto.js"></script>

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
        <div class="row">
          <div class="col s12 m12">
            <div class="white-text card-panel blue darken-2">
              <center><span class="card-title"><h7>Catálogo</h7></span></center>
            </div>
          </div>
        </div>

        <?php if(isset($registrarCatalogo)){ ?>
        <a href="#registrar-catalogo" data-position="bottom" data-tooltip="Registrar catálogo" class="btn tooltipped btn-floating waves-block  waves-effect  waves-light red darken-2 btn modal-trigger" style="width:50px; height:auto; margin-top:-140px; float:right;"><i class="icon-add "></i></a>
        <?php } ?>


        <div class="col s12 m4">
          <!--CARTA CONTENEDORA-->      

          <div class="card">
            <div class="row">

              <div class="col m12 s12">
                <div class="card-image waves-effect waves-block waves-light">
                  <center>
                    <br>
                    <br>
                    <img class="circle" src="<?php foreach($info as $operativo): if(isset($operativo['foto'])){ echo $operativo['foto'];} else{ echo 'vista/config/img/user3.png';} endforeach;?>"  style="width: 250px; height: 250px; margin-top: -20px; border-radius: 50%;">
                    <br>
                  </center>
                </div>
              </div>
              
            </div>
          </div>
        </div>

        <div class="col s12 m8">
         <!--CARTA CONTENEDORA-->      

         <div class="card">
          <div class="card-image waves-effect waves-block waves-light">
            <div class="search" style="position: right!important">
              <input type="text" id="search" name="search" placeholder="Buscar ..." style="width: 200px; margin-left: 20px; margin-top: 20px">
              <i class="fa fa-search"></i>
              
            </div>
            <center>
              <br>
              <div style="margin-left: 2px;">
               <table id="tabla" class="centered">
                
                <?php
                foreach($datos as $strExec):

                  $array_para_enviar_via_url = serialize($tipo);
                  $array_para_enviar_via_url = urlencode($array_para_enviar_via_url);

                  for ($i=0; $i < count($tipo) ; $i++) { 
                    if ($strExec['id_clasificacion'] == $tipo[$i]) {

                      foreach ($datosClasificacion as $clasificacion){ if ($strExec['id_clasificacion'] == $clasificacion['id_clasificacion']){ $nClasificacion = $clasificacion['nombre_clasificacion'];}}   
                      ?>
                        
                      <?php 
                          if (!isset($n)) {
                             $n = $nClasificacion;
                             echo "<thead><th colspan='5'>".$n."</th></thead>"; ?>

                                <thead>
                                 <tr>
                                   <th>Nombre</th>
                                   <th>Diversidad</th>

                                   <?php if(isset($modificarCatalogo)){ ?>
                                   <th>Modificar</th>

                                 <?php } if(isset($eliminarCatalogo)){ ?>
                                   <th>Eliminar</th>
                                 <?php } ?>
                                 
                                 </tr>
                                </thead>
                              <?php
                          } else{
                          if ($nClasificacion != $n) {
                             echo "<thead><th colspan='5'>".$nClasificacion."</th></thead>";
                              ?> 
                               <thead>
                                  <tr>
                                    <th>Nombre</th>
                                    <th>Diversidad</th>

                                    <?php if(isset($modificarCatalogo)){ ?>
                                    <th>Modificar</th>

                                  <?php } if(isset($eliminarCatalogo)){ ?>
                                    <th>Eliminar</th>
                                  <?php } ?>

                                  </tr>
                                </thead>

                              <?php
                              $n = $nClasificacion;
                            }}
                          ?>    
                      <tbody>
                        <tr>
                          <td><?php echo $strExec["nombre_catalogo"]?></td>
                          <td> 
                            <a onclick="bPreguntar = false;" href="?url=diversidad&opcion=diversidadesCarrito&tipo=<?php echo $array_para_enviar_via_url; ?>&identificacionCatalogo=<?php echo $strExec['id_catalogo'] ;?>&id_o=<?php echo $id_o;?>&nuevo_registro=<?php echo $nuevo_registro;?>&ope=<?php echo $ope;?>" name="modificar" data-position="bottom" data-tooltip="Gestionar diversidades" class="btn tooltipped waves-effect waves-light pink darken-2 white-text btn-small" value="editar"><i class="icon-local_mall"></i></a></div>
                          </td>

                          <?php if(isset($modificarCatalogo)){ ?>
                          <td>
                            <a href="#modificar-<?php echo $strExec['id_catalogo'];?>"  name="modificar" data-position="bottom" data-tooltip="Modificar catálogo" class="btn tooltipped waves-effect waves-light yellow darken-3 white-text btn modal-trigger btn-small" value="editar"><i class="icon-settings"></i></a>
                          </td>

                         <?php } if(isset($eliminarCatalogo)){ ?>
                          <td>
                            <a  href="javascript:void(0);" onclick="bPreguntar = false; eliminar('?url=catalogo&opcion=eliminarCatalogo&idCatalogo=<?php echo $strExec['id_catalogo'];?>&tipo=<?php echo $array_para_enviar_via_url;?>&id_o=<?php echo $id_o;?>&nuevo_registro=<?php echo $nuevo_registro;?>&ope=<?php echo $ope;?>');" data-position="bottom" data-tooltip="Eliminar catalogo" class="btn tooltipped waves-effect waves-light red darken-3 white-text btn-small"><i class="icon-delete"></i></a>
                          </td>
                         <?php } ?>
                        
                        </tr>
                        <?php 
                      }
                    } 

                    ?>

                    <!-- ============================================================== -->
                    <!-- MODAL MODIFICAR -->
                    <!-- ============================================================== -->
                    <div id="modificar-<?php echo $strExec['id_catalogo'];?>" class="modal modal-fixed-footer" style="height: 400px;">
                      <div class="modal-content">
                        <h5>Modificar catalogo</h5>
                        <div class="col s12">

                          <form method="POST" action="?url=catalogo&opcion=modificarCatalogo&tipo=<?php echo $array_para_enviar_via_url; ?>&id_o=<?php echo $id_o;?>&nuevo_registro=<?php echo $nuevo_registro;?>&ope=<?php echo $ope;?>">
                            <div class="row">

                             <div class="input-field col s2"> <i class="icon-next_week prefix" style="margin-top: 10px;"></i></div>

                             <input type="hidden" value="<?php echo $strExec['id_catalogo'];?>" id="id_catalogo"
                             name="id_catalogo">

                             <div class="input-field col s3" >
                              <label style="margin-top: -30px;">Clasificación</label>
                              <select class="browser-default" id="clasificacion" name="clasificacion" style="margin-top: 10px;">
                                <option value="<?php echo $strExec['id_clasificacion'];?>"selected><?php echo $nClasificacion?></option>
                                <?php foreach ($datosClasificacion as $clasificacion): if($clasificacion['nombre_clasificacion'] !== $nClasificacion){?>
                                  <option value="<?php echo $clasificacion['id_clasificacion'];?>"><?php echo $clasificacion['nombre_clasificacion'];?></option>
                                <?php } endforeach ?>
                              </select>
                            </div>

                            <div class="input-field col s6">
                              <input type="text" name="nombre_catalogo" id="nombre_catalogo" value="<?php echo $strExec['nombre_catalogo'];?>" maxlength="30" data-length="30" required style="margin-top: 10px;">

                              <input type="hidden" name="nombre_catalogo2" id="nombre_catalogo2" value="<?php echo $strExec['nombre_catalogo'];?>" maxlength="30" data-length="30" required style="margin-top: 10px;">

                              <label for="nombre">Catalogo</label>
                            </div>

                            <div class="input-field col s12">
                              <button onclick="bPreguntar = false;" type="submit" class="btn-small btn-primary yellow darken-3">Modificar</button>
                            </div>
                          </div>  
                        </form>

                      </div>
                    </div>
                    <div class="modal-footer">
                      <a href="#!" class="modal-action modal-close waves-effect waves-brown btn-flat">Cerrar</a>
                    </div>
                  </div>             

                <?php endforeach;  ?>

              </tbody>

            </table>
          </div>
        </center>
      </div>

    </div></div>
  </section>
</main>

<!-- ============================================================== -->
<!-- MODAL REGISTRAR-->
<!-- ============================================================== -->
<div id="registrar-catalogo" class="modal modal-fixed-footer" style="height: 400px;">
  <div class="modal-content">
    <h5>Registrar catalogo</h5>
    <div class="col s12">
      <form method="POST" name="producto" id="producto" action="?url=catalogo&opcion=registrarCatalogo-operativo&tipo=<?php echo $array_para_enviar_via_url; ?>&id_o=<?php echo $id_o;?>&nuevo_registro=<?php echo $nuevo_registro;?>&ope=<?php echo $ope;?>">
        <div class="row">
         <div class="input-field col s6 m4">
          <i class="icon-next_week prefix"></i>

          <select id="clasificacion" name="clasificacion">
            <?php foreach ($datosClasificacion as $clasificacion):
              for ($i=0; $i < count($tipo) ; $i++) { 
               if ($clasificacion['id_clasificacion'] == $tipo[$i]) { ?>

                <option value="<?php echo $clasificacion['id_clasificacion']?>"><?php echo $clasificacion['nombre_clasificacion']?></option>
              <?php }}endforeach;?>
            </select>

            <label for="nombre">Clasificación</label>
          </div>

          <div class="input-field col s5 m8">
            <input type="text" name="nombre_catalogo" id="nombre_catalogo" maxlength="30" data-length="30" required>
            <input type="hidden" name="nombre_catalogo2" id="nombre_catalogo2">
            <label for="nombre_catalogo2">Catalogo</label>
          </div>

          <div class="input-field col s12">
            <button onclick="validar();" class="btn-small btn-primary green darken-2">Registrar</button>
          </div>
        </div>  
      </form>
    </div>
  </div>
  <div class="modal-footer">
    <a href="#!" class="modal-action modal-close waves-effect waves-brown btn-flat">Cerrar</a>
  </div>
</div> 

<!--*******************************************************************************************************************************-->
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


