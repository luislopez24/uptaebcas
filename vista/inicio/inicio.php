
<!DOCTYPE html>
<html>
<head>
  <!-- ============================================================== -->
  <!--               IMPORTACION DE CABECERA PRINCIPAL                -->
  <!-- ============================================================== -->
  <?php require_once 'vista/publico/Head.php';?>
  <link rel="stylesheet" type="text/css" href="vista/config/css/fecha.css">
  <link rel="stylesheet" type="text/css" href="vista/config/css/bn.css">  
  
  
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
        <?php 
        
        $id;
        foreach ($datos as $strExec): 

          if($strExec['estado']=='on'){
            ?>

            <div class="col s12 m4">
              <!--CARTA CONTENEDORA-->       
              <div class="card small">

                <div class="card-title">
                  <center>
                    <h7>
                      <?php echo $strExec['nombre_operativo'];?>
                    </h7>
                    <br>
                  </center>
                </div>
                
                <div class="divider"></div>
                
                <div class="card-image waves-effect waves-block waves-light">
                  <center>
                    <br>
                    <img class="activator" src="<?php if(isset($strExec['foto'])){ echo $strExec['foto'];} else{ echo 'vista/config/img/fami.png';} ?>" style="width: 155px;border-radius: 50%; margin-top: -10px;">

                  </center>
                </div>
                
                <div class="card-content">
                  <center>
                    <div class="card-action">

                      <span class="card-title activator grey-text text-darken-4"><a href="?url=operativo&opcion=consulta_operativo_index&id=<?php echo $strExec["id_operativo"]?>"  data-position="bottom" data-tooltip="Detalles del operativo" class="btn tooltipped waves-effect waves-light yellow darken-3 white-text btn-small">consultar</a>

                        <?php 

                        require_once 'modelo/pdf.php';
                        $objOperativo = new Pdf_1();

                        $id = $strExec["id_operativo"];
                        $r5 = $objOperativo->consultarMoroso($id);

                        $existe = 0;

                        foreach ($r5 as $usuario) {

                          if (isset($usuario['nombre'])) {

                            $existe = true;

                          }else{

                            $existe = false;

                          }

                        }

                        $fechaO = $strExec['fecha_final_operativo'];

                        $fechaO = strtotime($fechaO."- 3 days");                       
                        $fechaO = date("Y-m-d",$fechaO);

                        $date = $fechaO;

                        if ($existe == true && empty($strExec["notificar_vencimiento"]) || $strExec["notificar_vencimiento"] == 'false' && $fechaO == $date) {                               

                          ?>

                          <?php if ($_SESSION['tipo_rol'] !=4) {?>
                          <a href="javascript:void(0);" onclick="users_morosos('?url=notificacion&opcion=usuarios_morosos&operativo=<?php echo $strExec['id_operativo'];?>');" data-position="bottom" data-tooltip="Notificar a beneficiarios deudores" class="btn tooltipped waves-effect waves-light red darken-3 white-text btn-small">notificar</a></span>

                        <?php } } ?>

                      </div>
                    </center>
                  </div>

                </div>

              </div>  

            <?php } endforeach; ?>

            <div class='col s12 m4'>
              <div class="wrap">
               <div class="widget">
                <div class="fecha">
                 <p id="diaSemana" class="diaSemana"></p>
                 <p id="dia" class="dia"></p>
                 <p id="mes" class="mes"></p>
                 <p id="year" class="year"></p>
               </div>
               <div class="reloj">      
                 <p id="horas" class="horas"></p>
                 <p>:</p>
                 <p id="minutos" class="minutos"></p>
                 <p>:</p>

                 <div class="caja-segundos">
                   <p id="ampm" class="ampm"></p>
                   <p id="segundos" class="segundos"></p>
                 </div>
               </div>
             </div>
           </div>
         </div>
         <script src="vista/config/js/reloj.js"></script>

         <div class="col s12 m4">
         </div> 
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
</body>
</html>