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
            <center><span class="card-title"><h6>Diversidades del catalogo "<?php foreach($datosCatalogo as $strExec): echo $strExec["nombre_catalogo"]; endforeach; ?>"</h6></span></center>
          </div>
        </div>
      </div>

      <?php if(isset($registrarDiversidad)){ ?>
      <a href="#registrar-diversidad" data-position="bottom" data-tooltip="Registrar diversidad" class="btn tooltipped btn-floating waves-block  waves-effect  waves-light red darken-2 btn modal-trigger" style="width:50px; height:auto; margin-top:-140px; float:right;"><i class="icon-add"></i></a> 
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
              <th class="priority-1">N°</th>
              <th class="priority-1">Producto</th>
              <th class="priority-1">Marca</th>
              <th class="priority-1">Contenido</th>
              <th class="priority-5">Descripcion</th>

              <?php if(isset($modificarDiversidad)){ ?>
              <th class="priority-1">Modificar</th>

              <?php } if(isset($eliminarDiversidad)){ ?>
              <th class="priority-1">Eliminar</th>
              <?php } ?>

            </tr>
          </thead>

          <tbody>

            <?php
            $con=0;
            foreach($datos as $strExec):
              $con++;

              ?>

              <tr>
                <td class="priority-1"><?php echo $con;?></td>
                <td class="priority-1"><?php echo $strExec["nombre_diversidad"]?></td>
                <td class="priority-1"><?php echo $strExec["marca"]?></td>
                <td class="priority-1"><?php echo $strExec["contenido"]?></td>
                <td class="priority-5"><?php echo $strExec["descripcion"]?></td>

                <?php if(isset($modificarDiversidad)){ ?>
                <td class="priority-1">
                 <a href="#modificar-diversidad-<?php echo $strExec['id_diversidad'];?>"  name="modificar" data-position="bottom" data-tooltip="Modificar diversidad" class="btn tooltipped waves-effect waves-light yellow darken-3 white-text btn modal-trigger" value="editar"><i class="icon-settings"></i></a>
               </td>

               <!-- Modal modificar -->
               <div id="modificar-diversidad-<?php echo $strExec['id_diversidad'];?>" class="modal modal-fixed-footer" style="height: 500px; z-index: 1000;">
                <div class="modal-content">
                  <h5>Modificar diversidad</h5>
                  <div class="col s12">

                   <form method="POST" id="diversidad" name="diversidad" action="?url=diversidad&opcion=actualizarDiversidad&cata=<?php echo $cata;?>&idCatalogo=<?php echo $idCatalogo;?>&clasificacion=<?php echo $clasificacion;?>">

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
                      <i class="icon-border_color prefix"></i>
                      <input type="text" name="descripcion" id="descripcion" value="<?php echo $strExec['descripcion']?>" maxlength="200" data-length="200" required>
                      <label for="descripcion">Descripción</label>
                    </div>

                    <div>
                      <input type='hidden' id='id_diversidad' name='id_diversidad' value="<?php echo $strExec['id_diversidad'];?>">
                    </div>

                    <div class="input-field col s12">
                      <button onclick="validar_diversidad();" class="btn-small btn-primary yellow darken-3">Modificar</button>
                      <button type="reset" name="limpiar" class="btn-small waves-effect waves-light red darken-2 white-text"> Restaurar  </button>
                    </div>
                  </div>  
                </form>
              </div>
            </div>
            <div class="modal-footer">
              <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
            </div>
          </div>

          <?php } if(isset($eliminarDiversidad)){ ?>                                
          <td>
            <a href="javascript:void(0);" onclick="eliminar('?url=diversidad&opcion=eliminarDiversidad&cata=<?php echo $cata;?>&idCatalogo=<?php echo $idCatalogo;?>&clasificacion=<?php echo $clasificacion;?>&producto=<?php echo $strExec['id_diversidad'];?>')"  data-position="bottom" data-tooltip="Eliminar diversidad" class="btn tooltipped waves-effect waves-light red darken-2 white-text "><i class="icon-delete"></i></a>
          </td>
          <?php } ?>
        
        </tr>
      <?php endforeach;  ?>
    </tbody>
  </table>

  <span class="left" id="total_reg" style="margin-top: 10px; margin-left: 20px"></span><br>

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
  <a href="?url=catalogo&opcion=consultarPuro&id=<?php echo $clasificacion;?>&cata=<?php echo $cata ?>" class="btn waves-effect waves-light blue darken-4 white-text btn-small">Regresar</a>
</center>
</div>
</div>

<br>    
</section>

<section id="principal">
  <br>
</section>

</main>

<!-- Modal registrar -->
<div id="registrar-diversidad" class="modal modal-fixed-footer" style="height: 600px;">
  <div class="modal-content">
    <h5>Registrar diversidad</h5>
    <div class="col s12">

      <form method="POST" id="diversidad" name="diversidad" action="?url=diversidad&opcion=registrar&cata=<?php echo $cata;?>&idCatalogo=<?php echo $idCatalogo;?>&clasificacion=<?php echo $clasificacion;?>">

        <div class="row">
         <div class="input-field col s12 m6">
          <i class="icon-shopping_cart prefix"></i>
          <input type="text" name="descrip" id="descrip" maxlength="40" data-length="40" required>
          <label for="descrip">Nombre</label>
        </div>

        <div class="input-field col s12 m6">
          <i class="icon-copyright prefix"></i>
          <input type="text" name="marca" id="marca" maxlength="40" data-length="40" required>
          <label for="marca">Marca</label>
        </div>

        <div class="input-field col s12 m6">
          <i class="icon-move_to_inbox prefix"></i>
          <input type="text" name="contenido" id="contenido" maxlength="30" data-length="30" required>
          <label for="contenido">Contenido</label>
        </div>

        <div class="input-field col s12 m6">
          <i class="icon-border_color prefix"></i>
          <input type="text" name="descripcion" id="descripcion" maxlength="200" data-length="200" required>
          <label for="descripcion">Descripción</label>
        </div>

        <div class="input-field col s12 m6">
          <button onclick="validar_diversidad();" class="btn-small btn-primary green darken-2">Registrar</button>
          <button type="reset" name="limpiar" class="btn-small waves-effect waves-light red darken-2 white-text"> limpiar </button>
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
  $('input#input_text, textarea#descrip').characterCounter();

  $('input#input_text, input#descripcion').characterCounter();

  $('input#input_text, input#descrip').characterCounter();
  $('input#input_text, input#marca').characterCounter();
  $('input#input_text, input#contenido').characterCounter();
  $('input#input_text, input#descripcion').characterCounter();

})

</script>
<script type="text/javascript" src="vista/config/js/search.js"></script>

<script src="vista/config/js/searchMenu.js"></script>

</body>
</html>
