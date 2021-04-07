<!DOCTYPE html>
<html>

<head>
  <!-- ============================================================== -->
  <!--               IMPORTACION DE CABECERA PRINCIPAL                -->
  <!-- ============================================================== -->
  <?php require_once 'vista/publico/Head.php';?>
  <script src="vista/config/js/validar_pago.js"></script>
  
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
      <div class="col s12 m12">
        <div class="white-text card-panel blue darken-2"> 
          <center><span class="card-title"><h7>Registrar pago</h7></span></center>
        </div>
      </div>

      <div class="col s12 m1">
      </div>

      <form action="?url=beneficiario&opcion=registrarPago" method="POST" id="pagar" name="pagar" onsubmit="return validar();">

        <div class="col s12 m10">
          <div class="card-panel light-blue lighten-5">

            <div>
              <input type='hidden' id='id_usuario' name='id_usuario' value=" <?php echo $_SESSION['id_ussuario']; ?> ">
            </div>         

            <div class="input-field col s12">
              <i class="icon-shopping_cart prefix"></i>
              <input type="text" name="ref" id="ref" value="<?php if(isset($_GET['ref'])){echo $_GET['ref'];} if(isset($ref)){ echo $ref;}?>" autofocus>
              <label for="ref">N° de Movimiento</label>
            </div>

            <div class="input-field col s6">
              <i class="icon-next_week prefix"></i>
              <select id="id_operativo" name="id_operativo">

                <?php  
                foreach ($porPagar as $codigo):
                  ?>
                  <option value="<?php echo $codigo['id_operativo'];?>"><?php if(isset($codigo['nombre_operativo'])){echo $codigo["nombre_operativo"];}?></option>
                  <?php 
                endforeach; 
                ?>
              </select>
            </div>

            <div class="input-field col s6">
              <i class="icon-event_note prefix"></i>
              <input type="date" name="fecha" id="fecha1" autocomplete="off" required value="<?php echo $date;?>">
              <label for="fecha">Fecha de Pago </label>
            </div>

            <div class="input-field col s12">
             <div id="select2lista" name="select2lista"></div>
           </div>

           <center>
             <button type="button" onclick="validar();" name="enviar" class="btn waves-effect waves-light green darken-2 white-text btn-small">REGISTRAR</button>
             <button type="reset" name="limpiar" class="btn waves-effect waves-light red darken-2 white-text btn-small"> limpiar </button>
           </center>

         </form>

       </div>
     </div>

     <div class="col s12 m1">
     </div>

   </div>
 </div>
</section>
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


<?php require_once 'vista/publico/Scripts.php'; ?>
<script type="text/javascript">
  $(document).ready(function(){

    $('#id_operativo').val();
    recargarLista();

    $('#id_operativo').change(function(){
      recargarLista();
    });
  })
</script>

<script type="text/javascript">
  function recargarLista(){
    $.ajax({
      type:"POST",
      url:"?url=beneficiario&opcion=validarRef&banco=si",
      data:"operativo=" + $('#id_operativo').val(),
      success:function(r){
        $('#select2lista').html(r);
      }
    });
  }
</script>


</body>
</html>