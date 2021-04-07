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

      font-size: 60%

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
  
</head>
<body>

  <!-- ============================================================== -->
  <!--            IMPORTACION DE LA BARRA DE NAVEGACION               -->
  <!-- ============================================================== -->
  <?php require_once 'vista/publico/Header.php';?>

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
              <?php
              
              foreach($datos2 as $strExec):
                
                ?>
                <center><span class="card-title"><h6>Clasificación <?php echo $strExec["nombre_clasificacion"]?></h6></span></center>
              <?php endforeach;?>
            </div>
          </div>  
        </div>
        
        <!--DIV solamente para centrar-->
        <div style="margin-left: 20px; margin-right: 20px">

         <?php
         foreach ($datos1 as $strExe){ 
           ?>

           <table class="centered">
            <tr>
              <td><?php 
              echo $strExe['nombre_catalogo'];  ?></td>
            </tr>
          </table> 
          <table class="centered">
            <thead> 
              <tr>
                <th>N°</th>
                <th>Producto</th>
                <th>Marca</th>
                <th>Contenido</th>
                <th>Descripción</th>

              </tr>
            </thead>
            <?php 
            $con=0;
            foreach ($datos as $strExec):
             $con++;
             if($strExe['id_catalogo']==$strExec['id_catalogo']){

               ?>
               <tbody>
                <tr>
                  <td><?php if(isset($strExec['id_catalogo'])){ echo $con;} ?></td>
                  <td><?php echo $strExec['nombre_diversidad'];?></td>
                  <td><?php echo $strExec['marca'];?></td>
                  <td><?php echo $strExec['contenido'];?></td>                                
                  <td><?php echo $strExec['descripcion'];?></td> <?php } ?>
                </tr>
              </tbody>
            <?php endforeach; }  ?>
          </table>
          

          <div class="card-action">
           <?php if(empty($operativo)){ ?>
             <center>
              <a href="?url=clasificacion&opcion=administrarClasificacion&cata=false" class="btn waves-effect waves-light blue darken-4 white-text btn-small">Regresar</a>
            </center>
          <?php } ?>

          <?php if(!empty($operativo)){ ?>
           <center>
            <a href="?url=clasificacion&opcion=administrarClasificacion&operativo=true" class="btn waves-effect waves-light blue darken-4 white-text btn-small">Regresar</a>
          </center>
        <?php } ?>

      </div>
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
<?php require_once 'vista/publico/Scripts.php'; ?>

</body>
</html>
