<!DOCTYPE html>
<html>
<head>

   <?php require_once 'vista/publico/Head.php'; ?>
  <script type="text/javascript" src="vista/config/js/alertas.js"></script>
  <script type="text/javascript" src="vista/config/js/validacion_act_usu.js"></script>
  
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
      <div class="white-text card-panel blue darken-2">
        <center><span class="card-title"><h7>Bitácora</h7></span></center>
      </div>
    </div>

    <div class="col s12 m12"> 
      <div class="card" style="margin-left: 20px; margin-right: 20px">
        <br>
        <div class="search">
          <input type="text" id="search" name="search" placeholder="Buscar ..." style="width: 200px; margin-left: 20px">
          <i class="fa fa-search"></i>
        </div>

        <!--DIV solamente para centrar-->
        <div style="margin-left: 20px; margin-right: 20px">
    
          <table  id="tabla" class="display" cellspacing="1" width="100%">
            <thead>
             <tr>
              
              <?php if(isset($eliminarBitacoras)){ ?>
              <th></th>
              <?php } ?>
              
              <th class="priority-2">Nombre</th>
              <th class="priority-2">Cédula</th>
              <th>Rol</th>
              <th>Dependencia</th>
              <th class="priority-2">Fecha</th>

              <th class="priority-1">Hora</th>
              <th class="priority-4">Acción</th> 
              <th class="priority-5">IP Address</th>
            </tr>
          </thead>
          
          <form action="?url=seguridad&opcion=eliminarBi" method="POST" id="eliminarBi" name="eliminarBi">
              <input type="hidden" name="fechaI" value="<?php echo $fechaI; ?>">
              <input type="hidden" name="fechaF" value="<?php echo $fechaF; ?>">
          <?php foreach ($datos as $bitacora){ ?> 

          <tbody id="bitacoraResult">
            
              <tr>
              
              <?php if(isset($eliminarBitacoras)){ ?>
                <td>
                  <center>
                   <label>
                    <input type="checkbox" name="id_delete[]" class="id_delete" value="<?php echo $bitacora['id_bitacora'];?>" />
                    <span></span>
                  </label>
                </center>
              </td>
              <?php } ?>

              <td class="priority-2"><?php echo $bitacora['nombre']." ".$bitacora['apellido']; ;?></td>
              <td class="priority-2"><?php echo $bitacora['cedula'];?></td>
              <td class="priority-1"><?php echo $bitacora['nombreRol'];?></td>
              <td class="priority-2"><?php echo $bitacora['dependencia'];?></td>
              <td class="priority-1"><?php echo $bitacora['fecha'];?></td>
              <td class="priority-1"><?php echo $bitacora['hora'];?></td>
              <td class="priority-3" style="<?php if($bitacora['accion']=='Login error'){ echo "color: red;"; } if($bitacora['accion']=='Login success'){ echo "color: green;"; } if($bitacora['accion']=='Login out'){ echo "color: green;"; } ?>" ><?php echo $bitacora['accion'];?></td>
              <td class="priority-4" style="color: blue"><?php echo $bitacora['ip_address'];?></td>
            </tr>
           

        </tbody>

     <?php } ?> 
      </table>

    </div> 

    <!--DIV solamente para centrar-->
    <div style="margin-left: 20px; margin-right: 20px">

      <?php if(isset($eliminarBitacoras)){ ?>
      <table cellpadding="0" cellspacing="0" class="table table-hover">
        <thead>
         <tr>
          <th><label>
            <input type="checkbox" id="selectall">
            <span>Seleccionar todos</span>
          </label></th>
        </tr>
      </thead>
    </table>
    <?php } ?>

    <span class="left" id="total_reg" style="margin-top: 10px; margin-left: 8px"></span><br>

     <div class="col-md-12 center text-center">
        <span class="left" id="total_reg"></span>
      </div>

      <div class="col-md-12 center text-center">
        <ul class="pagination pager" id="myPager"></ul>
      </div>
    <br>

 </div>  

</div>

<div id="contenido" name="contenido"></div>

<center>

  <?php if (isset($eliminarBitacoras)){ ?>
  <input type="button" onclick="confirmarBitacora();" value="Eliminar" data-position="bottom" data-tooltip="Eliminar registros" class="btn tooltipped btn-primary red darken-3 btn-small">
  <?php } ?>

  <?php if(isset($verBitacoras)){ ?>
    <button onclick="hola();" data-position="bottom" data-tooltip="Exportar registros" class="btn tooltipped btn-primary green darken-2 btn-small" target="_blank">Exportar</button>
<!--
  <a href="#" id="send" name="send" data-position="bottom" data-tooltip="Exportar registros" class="btn tooltipped btn-primary green darken-2 btn-small" target="_blank">Exportar</a>-->
  <?php } ?>

  <a href="?url=seguridad&opcion=inicioBitacora" data-tooltip="Volver" class="btn tooltipped btn-primary yellow darken-4 btn-small">Volver</a>
 
</form>

</center>

</div>

</div>

</body>
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

    function hola(){

      document.eliminarBi.action = '?url=reporte&opcion=generar_bitacoras';
      document.eliminarBi.submit();
    
    }

</script>


<script type="text/javascript" src="vista/config/js/search.js"></script>
<script src="vista/config/js/searchMenu.js"></script>



</html>