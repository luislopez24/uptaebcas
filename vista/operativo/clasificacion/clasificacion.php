<!DOCTYPE html>
<html>

<!-- ============================================================== -->
<!--               IMPORTACION DE CABECERA PRINCIPAL                -->
<!-- ============================================================== -->
<?php require_once 'vista/publico/Head.php';?>
<script type="text/javascript" src="vista/config/js/catalogo/validar_catalogo.js"></script>

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
              <center><span class="card-title"><h6>Clasificación</h6></span></center>
            </div>
          </div>
        </div>

        <?php if(isset($registrarClasificacion)){ ?>
        <a href="#registrar" data-position="bottom" data-tooltip="Registrar clasificación" class="btn tooltipped btn-floating waves-block  waves-effect  waves-light red darken-2 btn modal-trigger" style="width:50px; height:auto; margin-top:-140px; margin-right: -20px ; float:right;"><i class="icon-add "  ></i></a> 
      <?php } ?>

        <!--DIV solamente para centrar-->
        <div style="margin-left: 20px; margin-right: 20px">

         <div class="search">
          <input type="text" id="search" name="search" placeholder="Buscar ..." style="width: 200px; margin-left: 20px">                         <i class="fa fa-search"></i>
        </div> 

        <table id="tabla" class="centered">
          <thead>
            <tr>
              <th class="priority-5">N°</th>
              <th class="priority-1">Clasificación</th>
              <?php 
              if(empty($operativo)){
                ?>
                <th class="priority-1">Catalogo</th>
              <?php } ?>

              <?php if(isset($registrarCatalogo) || isset($modificarCatalogo) || isset($eliminarCatalogo) || isset($registrarDiversidad) || isset($modificarDiversidad) || isset($eliminarDiversidad)){ ?>
              <th class="priority-1">Consultar</th>

              <?php } if(isset($modificarClasificacion)){ ?>
              <th class="priority-1">Modificar</th>

            <?php } if(isset($eliminarClasificacion)){ ?>
              <th class="priority-1">Eliminar</th>
            <?php } ?>

            </tr>
          </thead>
          
          <?php
          $con=0;
          foreach($datos as $strExec):
            $con++;
            ?>

            <tbody>
              <tr>
                <td class="priority-5"><?php echo $con;?></td>
                <td class="priority-1"><?php echo $strExec["nombre_clasificacion"]?></td>
                <?php 
                if(empty($operativo)){
                  ?>

                  <?php if(isset($registrarCatalogo) || isset($modificarCatalogo) || isset($eliminarCatalogo) || isset($registrarDiversidad) || isset($modificarDiversidad) || isset($eliminarDiversidad)){ ?>
                  <td class="priority-1"> 
                    <a href="?url=catalogo&opcion=consultarPuro&id=<?php echo $strExec['id_clasificacion']?>&cata=false" data-position="bottom" data-tooltip="Gestionar catalogo" class="btn tooltipped waves-effect waves-light pink darken-2 white-text  btn-small" value="editar"><i class="icon-local_library"></i></a></div>
                  </td>
                <?php } } ?>
                <td class="priority-1"><a href="?url=catalogo&opcion=consultarProductos&id=<?php echo $strExec['id_clasificacion']?>&cata=false&operativo=<?php if(!empty($operativo)){ echo $operativo;}?>"  name="consultar" data-position="bottom" data-tooltip="Consultar diversidades" class="btn tooltipped waves-effect waves-light purple darken-2 white-text  btn-small" value="consultar"><i class="icon-shop_two"></i></a></div></td>

                <?php if(isset($modificarClasificacion)){ ?>
                <td class="priority-1">
                  <a href="#modificar-<?php echo $strExec['id_clasificacion'];?>"  name="consultar"  name="modificar" data-position="bottom" data-tooltip="Modificar clasificación" class="btn tooltipped waves-effect waves-light yellow darken-3 white-text btn modal-trigger btn-small" value="editar"><i class="icon-settings"></i></a></div>

                </td>

                <!-- Modal modificar -->
                <div id="modificar-<?php echo $strExec['id_clasificacion'];?>" class="modal modal-fixed-footer" style="height: 400px;">
                  <div class="modal-content">
                    <h5>Modificar clasificación</h5>
                    <div class="col s12">
                      <form  method="POST" id="clasificacion" name="clasificacion" action="?url=clasificacion&opcion=modificar&cata=<?php echo $cata;?>">
                        <div class="row">
                         <div class="input-field col s12">
                          <i class="icon-next_week prefix"></i>
                          <input type="hidden" name="id_cla" id="id_cla" value="<?php echo $strExec['id_clasificacion'];?> ">
                          <input type="text" name="nom" id="nom" pattern="[A-Za-z ]+" title="Ingrese solo letras" maxlength="20" data-length="20" value="<?php echo $strExec['nombre_clasificacion'];?>">

                          <input type="hidden" name="nom2" id="nom2" pattern="[A-Za-z ]+" title="Ingrese solo letras" maxlength="20" data-length="20" value="<?php echo $strExec['nombre_clasificacion'];?>">

                          <label for="nom2">Clasificación</label>
                        </div>
                        <div class="input-field col s12">
                          <button onclick="validar();" class="btn btn-primary yellow darken-3 btn-small">Modificar</button>
                        </div>
                      </div>  
                    </form>
                  </div>
                </div>
                <div class="modal-footer">
                  <a href="#!" class="modal-action modal-close waves-effect waves-brown btn-flat">Cerrar</a>
                </div>
              </div> 

              <?php } if(isset($eliminarClasificacion)){ ?>
              <td class="priority-1">
                <a href="javascript:void(0);" onclick="eliminar('?url=clasificacion&opcion=eliminarClasificacion&id=<?php echo $strExec["id_clasificacion"]?>&cata=<?php echo $cata;?>');" data-position="bottom" data-tooltip="Eliminar clasificación" class="btn tooltipped waves-effect waves-light red darken-2 white-text btn-small"><i class="icon-delete"></i></a>
              </td>
            <?php } ?>

            </tr>
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

</div>     

</div>

<?php if($cata == 'false'){
        ?>
        <center>

        </center>
      <?php  }else{ ?>
       <center>
        <a href="?url=operativo&opcion=formularioOperativo" class="btn waves-effect waves-light blue darken-4 white-text btn-small">Regresar</a>
      </center>
    <?php } ?>
</div>
</div>

<br>    

</section>

<!-- ============================================================== -->
<!--INICIO DE MODALS-->
<!-- ============================================================== -->

<!-- Modal registrar -->
<div id="registrar" class="modal modal-fixed-footer" style="height: 400px;">
  <div class="modal-content">
    <h5>Registrar clasificación</h5>
    <div class="col s6">
      <form  method="POST" id="clasificacion" name="clasificacion" action="?url=clasificacion&opcion=registrar&cata=<?php echo $cata;?>">
        <div class="row">
         <div class="input-field col s12">
          <i class="icon-next_week prefix"></i>
          <input type="text" name="nom" id="nom" pattern="[A-Za-z ]+" title="Ingrese solo letras" maxlength="20" data-length="20">
          <label for="nom">Clasificación</label>
        </div>
        <div class="input-field col s12">
          <button onclick="validar();" class="btn btn-primary green darken-2">Registrar</button>
        </div>
      </div>  
    </form>
  </div>
</div>
<div class="modal-footer">
  <a href="#!" class="modal-action modal-close waves-effect waves-brown btn-flat">Cerrar</a>
</div>
</div> 

</main>

<!-- ============================================================== -->
<!--FIN DEL CONTENIDO-->
<!-- ============================================================== -->

<!--**********************************************************************************************************************************-->

<!-- ============================================================== -->
<!--                     IMPORTACION DEL FOOTER                     -->
<!-- ============================================================== -->

<script type="text/javascript" src="vista/config/js/search.js"></script>
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

        $('input#input_text, input#nom').characterCounter();
    })

</script>
<script type="text/javascript" src="vista/config/js/search.js"></script>
<script src="vista/config/js/searchMenu.js"></script>


</body>
</html>
