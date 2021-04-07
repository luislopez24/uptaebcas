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
      <div class="col s12 m12">
        <div class="white-text card-panel blue darken-2">
          <center><span class="card-title"><h7>Pagos de los beneficiarios</h7></span></center>
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
            <th class="priority-5">Cédula</th>
            <th class="priority-1">Nombre</th>
            <th class="priority-1">Apellido</th>
            <th class="priority-5">Pagó</th>
            <th class="priority-5">Banco</th>
            <th class="priority-5">Referencia</th>
            <th class="priority-1">Entregado</th>
            <th class="priority-1">Consultar</th>
          </tr>
        </thead>

        <?php

        $orden=0;        
        foreach($datosOperativo_Usuario as $operativo_usuario):

          $orden++;

          $idOperativo=$_GET['idOperativo'];
          $id_operativo_usuario = $operativo_usuario["id_operativo_usuario"];
          $id_usuario = $operativo_usuario["id_usuario"];

          if (empty($operativo_usuario["estatud"]) || $operativo_usuario["estatud"]=='no' ) {
            ?>
            <tbody>
              <tr>

                <td class="priority-2"><?= $orden; ?></td>
                <td class="priority-2"><img class="circle" src="<?php if(!empty($operativo_usuario['foto'])){ echo $operativo_usuario['foto'];} else{ echo 'vista/config/img/user3.png';} ?>" style="width: 30px; height: 30px;"></td>
                <td class="priority-5"><?php echo $operativo_usuario["tcedula"]."-".$operativo_usuario["cedula"];?></td>
                <td class="priority-1"><?php echo $operativo_usuario["nombre"]?></td>
                <td class="priority-1"><?php echo $operativo_usuario["apellido"]?></td>
              </td>
              <td class="priority-5">
               <?php

               if (empty($operativo_usuario["banco"] || $operativo_usuario["referencia"] )) {
                echo "No";
              }else{
                echo "Si";
              }
              ?>
            </td>
            <td class="priority-5">
              <?php 

              if(empty($operativo_usuario["banco"])){
                echo "-";
              } else{
                echo mb_strtoupper($operativo_usuario["banco"],'UTF-8');
              }

              ?>
            </td>
            <td class="priority-5">

              <?php 

              $id_usuario = $operativo_usuario["id_usuario"];

              if(empty($operativo_usuario["referencia"])){
                echo "-";
              } else{
                echo $operativo_usuario["referencia"];
              }

              ?></td>
              <td class="priority-1">

                <?php 
                $idOperativo=$_GET['idOperativo'];
                $id_operativo_usuario = $operativo_usuario["id_operativo_usuario"];

                if (empty($operativo_usuario["estatud"]) || $operativo_usuario["estatud"]=='no' ) {

                  echo  "<a href='?url=beneficiario&opcion=entregarOperativo&id_o=$idOperativo&id=$id_operativo_usuario&tatu=si&idUsuario=$id_usuario' name='hola' data-position='bottom' data-tooltip='Entregar operativo' class='btn tooltipped waves-effect waves-light red darken-2 white-text btn-small' value='hola'><i class='icon-close'></i></a>";
                }

                ?>

              </td>
              <td class="priority-1">
                 <a href="?url=usuario&opcion=buscar_perfil&id=<?php echo $operativo_usuario['id_usuario']?>&dis=true&id_o=<?php echo $idOperativo;?>" data-position="bottom" data-tooltip="Consultar perfil" class="btn tooltipped waves-effect waves-light yellow darken-3 white-text btn-small"><i class="icon-send"></i></a>
              </td>
            </tr>
          </tbody>
        <?php  } endforeach; ?>

        <?php

        $orden=0;
        foreach($datosOperativo_Usuario as $operativo_usuario):
    
          

          $idOperativo =$_GET['idOperativo'];
          $id_operativo_usuario = $operativo_usuario["id_operativo_usuario"];
          $id_usuario = $operativo_usuario["id_usuario"];
          
            
          if (empty($operativo_usuario["estatud"]) or $operativo_usuario["estatud"]=='si' ) {
            $orden++;
            ?>

            <tbody>
             <tr>

              <td class="priority-2"><?= $orden; ?></td>
              <td class="priority-2"><img class="circle" src="<?php if(!empty($operativo_usuario['foto'])){ echo $operativo_usuario['foto'];} else{ echo 'vista/config/img/user3.png';} ?>" style="width: 30px; height: 30px;"></td>
              <td class="priority-5"><?php echo $operativo_usuario["tcedula"]."-".$operativo_usuario["cedula"];?></td>
              <td class="priority-1"><?php echo $operativo_usuario["nombre"]?></td>
              <td class="priority-1"><?php echo $operativo_usuario["apellido"]?></td>
            </td>
            <td class="priority-5">
             <?php

             if (empty($operativo_usuario["banco"] || $operativo_usuario["referencia"] )) {

              echo "No";
            }else{
              echo "Si";
            }

            ?>

          </td>
          <td class="priority-5">
            <?php 

            if(empty($operativo_usuario["banco"])){
              echo "-";
            } else{
              echo mb_strtoupper($operativo_usuario["banco"],'UTF-8');
            }

            ?>
          </td>
          <td class="priority-5">

            <?php 

            $id_usuario = $operativo_usuario["id_usuario"];

            if(empty($operativo_usuario["referencia"])){
              echo "-";
            } else{
              echo $operativo_usuario["referencia"];
            }

            ?></td>
            <td class="priority-1">
              <a href="javascript:void(0);" onclick="entregarr('?url=beneficiario&opcion=entregarOperativo&id_o=<?php echo $idOperativo;?>&id=<?php echo $id_operativo_usuario;?>&tatu=no&quitado=true&idUsuario=<?php echo $id_usuario?>');" data-position="bottom" data-tooltip="Quitar operativo" class='btn tooltipped waves-effect waves-light green darken-2 white-text btn-small' value='hola'><i class='icon-check'></i></a>
            </td>
            <td class="priority-1">
              <a href="?url=usuario&opcion=buscar_perfil&id=<?php echo $operativo_usuario['id_usuario']?>&dis=true&id_o=<?php echo $idOperativo;?>" data-position="bottom" data-tooltip="Consultar perfil" class="btn tooltipped waves-effect waves-light yellow darken-3 white-text  btn-small"><i class="icon-send"></i></a>
            </td>
          </tr>    
        </tbody>
      <?php } endforeach;?>

      <?php
      
      $orden = 0;
      foreach($usuarioMoroso as $moroso):
        $orden++;

        ?>

        <tbody>
          <tr>

            <td class="priority-2"><?= $orden; ?></td>
            <td class="priority-2"><img class="circle" src="<?php if(!empty($moroso['foto'])){ echo $moroso['foto'];} else{ echo 'vista/config/img/user3.png';} ?>" style="width: 30px; height: 30px;"></td>
            <td class="priority-5"><?php echo $moroso["tcedula"]."-".$moroso["cedula"];?></td>
            <td class="priority-1"><?php echo $moroso["nombre"]?></td>
            <td class="priority-1"><?php echo $moroso["apellido"]?></td>
          </td>
          <td class="priority-5">
           <?php

           if (empty($moroso["banco"] || $moroso["referencia"] )) {

            echo "No";
          }else{
            echo "Si";
          }

          ?>

        </td>
        <td class="priority-5">
          <?php 

          if(empty($moroso["banco"])){
            echo "-";
          } else{
            echo mb_strtoupper($moroso["banco"],'UTF-8');
          }

          ?>
        </td>
        <td class="priority-5">

          <?php 

          if(empty($moroso["referencia"])){
            echo "-";
          } else{
            echo $moroso["referencia"];
          }

          ?></td>
          <td class="priority-1">

            <?php 
            $id=$_GET['idOperativo'];
            $id_operativo_usuario = $moroso["id_operativo_usuario"];

            if(empty($moroso["referencia"])){
             echo "-";
           } else{

            if (empty($moroso["estatud"]) or $moroso["estatud"]=='no' ) {

              echo  "<a href='?url=beneficiario&opcion=entregarOperativo&id_o=$id&id=$id_operativo_usuario&tatu=si' name='hola' data-position='bottom' data-tooltip='Entregar operativo' class='btn tooltipped waves-effect waves-light red darken-2 white-text btn-small' value='hola'><i class='icon-close'></i></a>";
            }else{

             ?>
             <a href="javascript:void(0);" onclick="entregarr('?url=beneficiario&opcion=entregarOperativo&id_o=<?php echo $idOperativo;?>&id=<?php echo $id_operativo_usuario;?>&tatu=no&quitado=true');" data-position="bottom" data-tooltip="Quitar operativo" class='btn tooltipped waves-effect waves-light green darken-2 white-text btn-small' value='hola'><i class='icon-check'></i></a>
             <?php
           }
         }

         ?>

       </td>
       <td class="priority-1">
       <a href="?url=usuario&opcion=buscar_perfil&id=<?php if(isset($moroso['id_usuario'])){ echo $moroso['id_usuario'];}?>&dis=true&id_o=<?php echo $idOperativo;?>" data-position="bottom" data-tooltip="Consultar beneficiario" class="btn tooltipped waves-effect waves-light yellow darken-3 white-text  btn-small"><i class="icon-send"></i></a>
      </td>
    </tr>
  </tbody>
<?php endforeach;  ?>
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
<center>
  <a href="?url=operativo&opcion=inicioDistribucion" class="btn waves-effect waves-light blue darken-4 white-text btn-small">Regresar</a>
</center>
</div>
</div>

<br>    

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
