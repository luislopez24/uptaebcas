<!DOCTYPE html>
<html>

<head>
  <!-- ============================================================== -->
  <!--               IMPORTACION DE CABECERA PRINCIPAL                -->
  <!-- ============================================================== -->
  <?php require_once 'vista/publico/Head.php';?>
  <style type="text/css">

   @media screen and (max-width: 400px) {
    
    table{

      font-size: 50%

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
     <div class="col-s12-m6">   

      <div class="card"style="margin-left: 20px; margin-right: 20px">
       <div class="row">
        <div class="col s12 m12">
          <div class="white-text card-panel blue darken-2">
            <center><span class="card-title"><h6>Catálogo</h6></span></center>
          </div>
        </div>
      </div>

      <?php if(isset($registrarCatalogo)){ ?>
      <a href="#registrar-catalogo" data-position="bottom" data-tooltip="Registrar catálogo" class="btn tooltipped btn-floating waves-block  waves-effect  waves-light red darken-2 btn modal-trigger" style="width:50px; height:auto; margin-top:-140px; float:right;"><i class="icon-add "></i></a>
      <?php } ?>

      <div class="search">
        <input type="text" id="search" placeholder="Buscar ..." style="width: 200px; margin-left: 20px">
        <i class="fa fa-search"></i>
      </div>

      <!--DIV solamente para centrar-->
      <div style="margin-left: 20px; margin-right: 20px">

        <table id="tabla" class="centered">
          <thead>
            <tr>
              <th>N°</th>
              <th>Nombre</th>

              <?php if(isset($registrarDiversidad) || isset($modificarDiversidad) || isset($eliminarDiversidad)){ ?>
              <th>Diversidades</th>

              <?php } if(isset($modificarCatalogo)){ ?>
              <th>Modificar</th>
              <?php } ?>

              <?php if(isset($eliminarCatalogo)){ ?>
              <th>Eliminar</th>
              <?php } ?>

            </tr>
          </thead>
          
          <?php
          $con = 0;
          foreach($datos as $strExec):
            $con++;

            ?>

            <tbody>
              <tr>
                <td><?php echo $con;?></td>
                <td><?php echo $strExec["nombre_catalogo"]?></td>

                <?php if(isset($registrarDiversidad) || isset($modificarDiversidad) || isset($eliminarDiversidad)){ ?>
                <td> 
                  <a href="?url=diversidad&opcion=conDiversidad&idCatalogo=<?php echo $strExec['id_catalogo']?>&cata=<?php echo $cata;?>&clasificacion=<?php echo $strExec['id_clasificacion']?>"  name="modificar" data-position="bottom" data-tooltip="Gestionar diversidades" class="btn tooltipped waves-effect waves-light pink darken-2 white-text " value="editar"><i class="icon-local_mall"></i></a></div>
                </td>

                <?php } if(isset($modificarCatalogo)){ ?>
                <td>
                 <a href="#modificar-<?php echo $strExec['id_catalogo'];?>"  name="modificar" data-position="bottom" data-tooltip="Modificar catálogo" class="btn tooltipped waves-effect waves-light yellow darken-3 white-text btn modal-trigger" value="editar"><i class="icon-settings"></i></a>
               </td>                                

               <?php } if(isset($eliminarCatalogo)){ ?>
               <td>
                <a href="javascript:void(0);" onclick="eliminar('?url=catalogo&opcion=eliminarCatalogo&idCatalogo=<?php echo $strExec['id_catalogo'];?>&cata=false&clasificacion=<?php echo $id;?>');" data-position="bottom" data-tooltip="Eliminar catálogo" class="btn tooltipped waves-effect waves-light red darken-2 white-text "><i class="icon-delete"></i></a>
              </td>
            <?php } ?>

            </tr>

            <!-- ============================================================== -->
            <!-- MODAL MODIFICAR -->
            <!-- ============================================================== -->
            <div id="modificar-<?php echo $strExec['id_catalogo'];?>" class="modal modal-fixed-footer" style="height: 400px;">
              <div class="modal-content">
                <h5>Modificar catalogo</h5>
                <div class="col s12">

                  <form method="POST" action="?url=catalogo&opcion=modificarCatalogo&cata=false">
                    <div class="row">
                      <input type="hidden" id="id_clasificacion" name="id_clasificacion" value="<?php echo $id;?>">
                      <input type="hidden" value="<?php echo $strExec['id_catalogo'];?>" id="id_catalogo"
                      name="id_catalogo">

                      <div class="input-field col s12">
                        <i class="icon-next_week prefix" style="margin-top: 10px;"></i>
                        <input type="text" name="nombre_catalogo" id="nombre_catalogo" value="<?php echo $strExec['nombre_catalogo'];?>" maxlength="30" data-length="30" required style="margin-top: 10px;">

                        <input type="hidden" name="nombre_catalogo2" id="nombre_catalogo2" value="<?php echo $strExec['nombre_catalogo'];?>">

                        <label for="nombre_catalogo">Catalogo</label>
                      </div>

                      <div class="input-field col s12">
                        <button type="submit" class="btn-small btn-primary yellow darken-3">Modificar</button>
                      </div>
                    </div>  
                  </form>
                </div>
              </div>
              <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
              </div>
            </div>            
          </tbody>
        <?php endforeach;  ?>
      </table>

      <span class="left" id="total_reg" style="margin-top: 10px; margin-left: 24px"></span><br>

      <div class="col-md-12 center text-center">
        <span class="left" id="total_reg"></span>
      </div>

      <div class="col-md-12 center text-center">
        <ul class="pagination pager" id="myPager"></ul>
      </div><br>
      
    </form>
  </div>

</div>  
</div>

<center>
  <a href="?url=clasificacion&opcion=administrarClasificacion&cata=<?php echo $cata;?>" class="btn waves-effect waves-light blue darken-4 btn-small white-text ">Regresar</a>
</center>
</div>
</div>

<br>    

</section>
</main>

<!-- ============================================================== -->
<!-- MODAL REGISTRAR-->
<!-- ============================================================== -->
<div id="registrar-catalogo" class="modal modal-fixed-footer" style="height: 400px;">
  <div class="modal-content">
    <h5>Registrar catalogo</h5>
    <div class="col s12">
      <form method="POST" name="producto" id="producto" action="?url=catalogo&opcion=registrarCatalogo-operativo&cata=false">
        <div class="row">
         <div class="input-field col s12">
          <i class="icon-next_week prefix"></i>
          <input type="hidden" id="id_clasificacion" name="id_clasificacion" value="<?php echo $id;?>">
          <input type="text" name="nombre_catalogo" id="nombre_catalogo" maxlength="30" data-length="30" required>
          <label for="nombre_catalogo">Catalogo</label>
        </div>

        <div class="input-field col s12">
          <button onclick="validar();" class="btn-small btn-primary green darken-2">Registrar</button>
        </div>
      </div>  
    </form>
  </div>
</div>
<div class="modal-footer">
  <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
</div>
</div> 

<!-- ============================================================== -->
<!--FIN DEL CONTENIDO-->
<!-- ============================================================== -->

<!--**********************************************************************************************************************************-->

<!-- ============================================================== -->
<!--                     IMPORTACION DEL FOOTER                     -->
<!-- ============================================================== -->

<?php require_once 'vista/publico/Footer.php'; ?>

<!-- ============================================================== -->
<!--               IMPORTACION DE LOS SCRIPTS                       -->
<!-- ============================================================== -->

<!-------------------------------- SCRIPTS -------------------------------------->

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

<script type="text/javascript">
  
 $(document).ready(function(){

  $('input#input_text, input#nombre_catalogo').characterCounter();
})

</script>
<script type="text/javascript" src="vista/config/js/search.js"></script>
<script src="vista/config/js/searchMenu.js"></script>


</body>
</html>
