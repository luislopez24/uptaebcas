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
          <center><span class="card-title"><h7>Pagos</h7></span></center>
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
                <th></th>
                <th><center>N°</center></th>
                <th></th>
                <th ><center>Operativo</center></th>
                <th><center>Costo</center></th>
                <th><center>Referencia</center></th>
                <th><center>Banco</center></th>
                <th><center>Fecha Pago</center></th>
                <th ><center>Retirado</center></th>

                <?php if(isset($modificarPago)){ ?>
                <th ><center>Modificar</center></th>
                <?php } ?>

                <th></th>
              </tr>
            </thead>

            <?php

            $orden=0 ;
            foreach($datos as $strExec):
              $orden++;

              ?>
              <tbody>
                <tr>
                  <td></td>
                  <th><center><?=$orden ;?></center></th>
                  <td><img class="circle" src="<?php if(isset($strExec['foto'])){ echo $strExec['foto'];} else{ echo 'vista/config/img/user3.png';} ?>" style="width: 30px; height: 30px;"></td>
                  <td><center><?php echo $strExec["nombre_operativo"]?></center></td>
                  <td><center><?php echo $strExec["precio_operativo"]." BsS"?></center></td>
                  <td><center><?php echo $strExec["referencia"]?></center></td>
                  <td><center><?php echo $strExec["banco"]?></center></td>
                  <td><center><?php echo $strExec["fecha_pago"]?></center></td>
                  <td><center>
                    <?php if (empty($strExec['estatud']) || $strExec['estatud']=='no') {
                     echo "No";
                     ?>
                   </center>
                 </td>
                 <?php if(isset($modificarPago)){ ?>
                 <td>
                  <center>
                    <a href="#modificar-<?php echo $strExec['id_operativo_usuario'];?>" data-position="bottom" data-tooltip="Modificar pago" class="btn tooltipped waves-effect waves-light yellow darken-3 white-text btn modal-trigger btn-small"><i class="icon-settings"></i></a> 
                  </center>
                </td>

                <!-- Modal modificar -->
                <div id="modificar-<?php echo $strExec['id_operativo_usuario'];?>" class="modal modal-fixed-footer" style="height: 400px;">
                  <div class="modal-content">
                    <h5>Modificar pago</h5>
                    <div class="col s12">
                      <form action="?url=beneficiario&opcion=modificarPago" method="POST" id="act_pago" name="act_pago">
                        <div class="row">
                         <div>
                          <input type='hidden' id='id_operativo_usuario' name='id_operativo_usuario' value="<?php echo $strExec['id_operativo_usuario'];?>">
                          <input type="hidden" id="idOperativo" name="idOperativo" value="<?php echo $strExec['id_operativo_'];?>">
                          <input type="hidden" id="referenciaComparativa" name="referenciaComparativa" value="<?php echo $strExec['id_operativo_usuario'];?>">
                        </div>

                        <div class="input-field col s6">
                          <i class="icon-shopping_cart prefix"></i>
                          <input type="text" name="ref" id="price" value="<?php echo $strExec["referencia"];?>" required>
                          <label for="Price">N° de Movimiento</label>
                        </div>

                        <div class="input-field col s6">
                         <i class="icon-event_note prefix"></i>
                         <input type="date" name="fecha" id="fecha1"  value="<?php echo $strExec["fecha_pago"]?>" required>
                         <label for="fecha">Fecha de Pago </label>
                       </div>      

                       <input type="hidden" name="banco" id="banco" value="<?php echo $strExec["banco"];?>">


                       <div class="input-field col s12">
                        <button onclick="validar();" class="btn btn-primary yellow darken-3 btn-small">Modificar</button>
                      </div>
                    </div>  
                  </form>
                </div>
              </div>
              <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
              </div>
            </div> 

            <?php }
          }else{
            echo "Si";
            ?>
            <td>
              <center>
                <p>-</p>
              </center>
            </td>
            <?php
          }
          ?>
        </td>
      </tr>
    </tbody>
  <?php endforeach;  ?> 

</table>

<span class="left" id="total_reg" style="margin-top: 10px; margin-left: 20px"></span><br>

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

  $('#tipo').change(function(){
    recargarLista();
  });

  $('#reporte').change(function(){
    recargarListaReporte();
  });
})

 function recargarLista(){
  $.ajax({
    type:"POST",
    url:"vista/personal/cate.php",
    data:"tipo=" + $('#tipo').val(),
    success:function(r){

      $('#categoria').html(r);
      $('select').formSelect();

    }
  });
}

function recargarListaReporte(){
  $.ajax({
    type:"POST",
    url:"vista/generar_rep/cate_oficial.php",
    data:"reporte=" + $('#reporte').val(),
    success:function(r){

      $('#categoria').html(r);
      $('select').formSelect();

    }
  });
}

$("#precio").on({
  "focus": function (event) {
    $(event.target).select();
  },
  "keyup": function (event) {
    $(event.target).val(function (index, value ) {
      return value.replace(/\D/g, "")
      .replace(/([0-9])([0-9]{2})$/, '$1,$2')
      .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
    });
  }
});


</script>
<script src="vista/config/js/searchMenu.js"></script>
<script type="text/javascript" src="vista/config/js/search.js"></script>

</body>
</html>
