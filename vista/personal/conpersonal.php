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
        <div class="white-text card-panel blue darken-2">
          <center><span class="card-title"><h7>Beneficiarios</h7></span></center>
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
                  <th class="priority-3">Area</th>
                  <th class="priority-4">Celular</th>
                  <th class="priority-5">Dependencia</th>
                  <th class="priority-1">Consultar</th>

                  <?php if(isset($modificarBeneficiario)){ ?>
                    <th class="priority-1">Modificar</th>
                  <?php } 

                  if(isset($eliminarBeneficiario)){ ?>
                    <th class="priority-1">Eliminar</th>
                  <?php } ?>

                </tr>
              </thead>
              
              <?php
              
              $orden=0;

              foreach($datos as $strExec):
                

                if ($strExec["tipo_rol"] !== '1' && $strExec["tipo_rol"] !== '2' && $strExec["tipo_rol"] !== '3' ) {

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
                   <td class="priority-3"><?php echo $strExec["area"];?></td>
                   <td class="priority-4"><?php echo $strExec["tcelular"]."-".$strExec["celular"]?></td>
                   <td class="priority-5"><?php echo $strExec["dependencia"]?></td>
                   <td class="priority-1">
                    <a href="?url=usuario&opcion=buscar_perfil&tipo=beneficiario&id=<?php echo $strExec['id_usuario']?>&person=true"  data-position="bottom" data-tooltip="Consultar perfil" class="btn tooltipped waves-effect waves-light green darken-2 white-text btn-small"><i class="icon-send"></i></a>
                  </td>

                  <?php if(isset($modificarBeneficiario)){ ?>
                    <td class="priority-1">
                      <a href="?url=usuario&opcion=modificar_personal&id=<?php echo $strExec['id_usuario']?>" data-position="bottom" data-tooltip="Modificar beneficiario" class="btn tooltipped waves-effect waves-light yellow darken-3 white-text btn-small"><i class="icon-settings"></i></a>
                    </td>

                  <?php } if(isset($eliminarBeneficiario)){ ?>
                    <td class="priority-1">
                     <a href="javascript:void(0);" onclick="eliminar('?url=usuario&opcion=eliminar_usuario&rol=<?php echo $strExec['tipo_rol']; ?>&id=<?php echo $strExec['id_usuario']?>');" data-position="bottom" data-tooltip="Eliminar beneficiario" class="btn tooltipped waves-effect waves-light red darken-2 white-text btn-small"><i class="icon-delete"></i></a>
                   </td>
                 <?php } ?>

               </tr>
               
             </tbody>

           <?php  } endforeach;  ?>

           
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
