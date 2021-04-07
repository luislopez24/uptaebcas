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
              <center><span class="card-title"><h6>Roles</h6></span></center>
            </div>
          </div>
        </div>

         <!--DIV solamente para centrar-->
        <div style="margin-left: 20px; margin-right: 20px">

         <div class="search">
          <input type="text" id="search" placeholder="Buscar ..." style="width: 200px; margin-left: 20px">
          <i class="fa fa-search"></i>
        </div> 

        <table id="tabla" class="centered">
          <thead>
            <tr>
              <th class="priority-5">N°</th>
              <th class="priority-1">Tipo Rol</th>
              <th class="priority-1">Estatus</th>
              <th class="priority-1">Modificar</th>

            </tr>
          </thead>
          
          <?php
          $con=0;
          foreach($datos as $strExec): 
            if ($strExec["nombreRol"] !== 'Super Usuario') {
          $con++;
          ?>

          <tbody>
            <tr>
              <td class="priority-5"><?php echo $con;?></td>
              <td class="priority-1"><?php echo $strExec["nombreRol"]?></td>
              <td class="priority-1"><?php echo $strExec["statusRol"];?></td>

              <td class="priority-1">
                <a href="#modificar-<?php echo $strExec['idRol'];?>"  name="consultar"  name="modificar" data-position="bottom" data-tooltip="Modificar estatus" class="btn tooltipped waves-effect waves-light yellow darken-3 white-text btn modal-trigger btn-small" value="editar"><i class="icon-sync"></i></a></div>

              </td>

              <!-- Modal modificar -->
              <div id="modificar-<?php echo $strExec['idRol'];?>" class="modal modal-fixed-footer" style="height: 400px;">
                <div class="modal-content">
                  <h5>Modificar rol</h5>
                  <div class="col s12">
                    <form  method="POST" id="rol" name="rol" action="?url=seguridad&opcion=modificarTodoRol">
                      <div class="row">
                       <div class="input-field col s6">
                        <i class="icon-next_week prefix"></i>
                       
                        <input type="hidden" name="id_rol" id="id_rol" value="<?php echo $strExec['idRol'];?> ">
                        <input type="text" value="<?php echo $strExec['nombreRol'];?>" disabled>

                        <input type="hidden" name="nom" id="nom"value="<?php echo $strExec['nombreRol'];?>">

                        <label for="nombre">Rol</label>
                      </div>

                      <div class="input-field col s6" >
                        <label style="margin-top: -30px;">Estatus</label>
                        <select class="browser-default" id="estatus" name="estatus" style="margin-top: 10px;">
                        
                          <option value="<?php echo $strExec['statusRol'];?>" selected><?php echo $strExec["statusRol"];?> </option>

                          <?php if ($strExec['statusRol'] == 'Enabled') { ?>
                          <option value="Disabled">Disabled</option>
                          <?php } 

                                if ($strExec['statusRol'] == 'Disabled') { ?>
                          <option value="Enabled">Enabled</option>
                          <?php } ?>

                        </select>
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
          </tr>
        </tbody>
        <?php } endforeach;  ?>

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

  <center>
    <a href="?url=seguridad&opcion=inicioSeguridadAvanzada" class="btn waves-effect waves-light blue darken-4 white-text btn-small">Regresar</a>
  </center>

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
    <h5>Registrar rol</h5>
    <div class="col s6">
      <form  method="POST" id="rol" name="rol" action="?url=seguridad&opcion=registrarRol">
        <div class="row">
         <div class="input-field col s6">
          <i class="icon-next_week prefix"></i>
          <input type="text" name="nom" id="nom" maxlength="20" data-length="20">
          <label for="nombre">Nombre rol</label>
        </div>

        <div class="input-field col s6" >
          <label style="margin-top: -30px;">Estatus</label>
          <select class="browser-default" id="estatus" name="estatus" style="margin-top: 10px;">
            <option value="0" selected>Activo</option>
            <option value="1">Inactivo</option>
          </select>
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

<script type="text/javascript" src="vista/config/js/search.js"></script>

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

<script src="vista/config/js/searchMenu.js"></script>


</body>
</html>
