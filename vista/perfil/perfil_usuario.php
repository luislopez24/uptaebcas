<!DOCTYPE html>
<html>

<head>

  <!-- ============================================================== -->
  <!--               IMPORTACION DE CABECERA PRINCIPAL                -->
  <!-- ============================================================== -->
  <?php require_once 'vista/publico/Head.php';?>
 
  <style type="text/css">

   @media screen and (max-width: 800px) {
    
      #gola{
          
          height: 1060px!important;
      }
    }

  </style>

</head>
<body>

  <!-- ============================================================== -->
  <!--            IMPORTACION DE LA BARRA DE NAVEGACION               -->
  <!-- ============================================================== -->   
  <?php require_once 'vista/publico/Header.php'; ?>

  <!-- ============================================================== -->
  <!-- INICIO DEL CONTENIDO-->
  <!-- ============================================================== -->
  <main>

    <section class="section">
       <div class="row">
        <div class="col s12 m12">
          <div class="white-text card-panel blue darken-2">
            <center><span class="card-title">
              <?php if(isset($consultar_usuario)){
                ?>
                <h7>Perfil del usuario <?php foreach ($datos as $key):
                echo  $key["nombre"]; endforeach; ?> </h7>
                <?php
              }else{ ?>
                <h6>Bienvenido a su perfil <?php echo $_SESSION["nombre"];}?> </h6>
              </span></center>
            </div>
          </div>

          <div class="col s1 m1">
          </div>

          <?php 

           foreach($datos as $usuario): 

          if (!empty($usuario['foto'])){

                  $foto = $usuario['foto'];

                }else {

                  $foto = 'vista/config/img/user3.png';
                }

          ?>

          <div class="col s10 m10">
            <div name="gola" id="gola" class="card-panel light-blue lighten-5" style="height: 700px">

             <form action="#" method="POST">
              <div class="row">
              <div class="input-field col s12 m6">
                <center>
                <img src="<?php echo $foto;?>" style="width: 250px; height: 250px; border-radius: 50%;">
                </center>
              </div>

              <div class="input-field col s12 m6">
               <i class="icon-accessibility prefix"></i>
               <input disabled value="<?php echo $usuario['nombreRol'];?>" id="#" type="text" class="validate">
                 <label for="disabled">Rol</label>
               </div>


               <div class="input-field col s12 m6">
                 <i class="icon-person prefix"></i>
                 <input disabled value="<?php echo $usuario['nombre'];?>" id="#" type="text" class="validate">
                  <label for="disabled">Nombre</label>
                </div>

                <div class="input-field col s12 m6">
                 <i class="icon-person_outline prefix"></i>
                 <input disabled value="<?php echo $usuario['apellido'];?>" id="#" type="text" class="validate">
                  <label for="disabled">Apellido</label>
                </div>

                <div class="input-field col s12 m12">
                 <i class="icon-event_note prefix"></i>
                 <input type="date" name="fecha" id="fecha" autocomplete="off" id="fecha_docente" value="<?php echo $usuario['fecha_n'];?>" disabled>
                  <label for="fecha">Fecha Nacimiento </label>
                </div>

                <div class="input-field col s12 m6">
                 <i class="icon-payment prefix"></i>
                 <input disabled value="<?php echo $usuario['cedula'];?>" id="#" type="text" class="validate">
                  <label for="disabled">Cédula</label>
                </div>

                <div class="input-field col s12 m6">
                 <i class="icon-drafts prefix"></i>
                 <input disabled value="<?php echo $usuario['email'].$usuario['temail'];?>" id="#" type="text" class="validate">
                  <label for="disabled">Email</label>
                </div>

                <div class="input-field col s12 m6">
                 <i class="icon-phone prefix"></i>
                 <input disabled value="<?php echo $usuario['tcelular'].$usuario['celular'];?>" id="#" type="text" class="validate">
                  <label for="disabled">Telefono</label>
                </div>

                <div class="input-field col s12 m6">
                 <i class="icon-assignment_ind prefix"></i>
                 <input disabled value="<?php echo $usuario['dependencia'];?>" id="#" type="text" class="validate">
                  <label for="disabled">Dependencia</label>
                </div>
                <div class="input-field col s12 m12">
                 <i class="icon-pin_drop prefix"></i>
                 <input disabled value="<?php  echo $usuario['direccion'];?>" id="#" type="text" class="validate">
                  <label for="disabled">Dirección</label>
                </div>
              
              <?php endforeach; ?>
                <center>
                 <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
               </center>
             </form>
             </div>
           </div>
         </div>

         <div class="col s12 m1">
         </div>

       </div>

       <div class="card-action">

        <center>
          <?php if (!isset($header)) { ?>
          <a href="
          <?php 
            if($tipo == 'usuario'){ echo "?url=usuario&opcion=consultar-usuarios"; }
            if($tipo == 'beneficiario'){ echo "?url=usuario&opcion=consultarpersonal"; }
            if($tipo == 'distribucion'){ echo "?url=beneficiario&opcion=distribuirBeneficiado&idOperativo=$id_o";}
          ?>" class="btn waves-effect waves-light blue darken-4 white-text btn-small">Volver</a>
          <?php } ?>
        </center>
      </div>

    </div>    
  </section> 
</main>

<!-- ============================================================== -->
<!--FIN DEL CONTENIDO-->
<!-- ============================================================== -->

<!--***********************************************************************************************************************************-->
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