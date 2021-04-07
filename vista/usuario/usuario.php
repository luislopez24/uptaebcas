<!DOCTYPE html>
<html>

<head>
  <!-- ============================================================== -->
  <!--               IMPORTACION DE CABECERA PRINCIPAL                -->
  <!-- ============================================================== -->
  <?php require_once 'vista/publico/Head.php'; ?>

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
      
      <!--AQUI VA TODO EL CONTENIDO-->
      <div class="row">
        <div class="col s12 m12">
          <div class="white-text card-panel blue darken-2">
            <center><span class="card-title"><h6>Usuario</h6></span></center>
          </div>
        </div>
      </div>
      
      <div class="col s12 m6">
       <!--CARTA CONTENEDORA-->      

       <div class="card small">
        <div class="card-image waves-effect waves-block waves-light">
          <center>
            <br>
            <img class="activator" src="vista/config/img/supersu.png" style="width: 155px; height:">
          </center>
        </div>
        
        <div class="card-content">
          <span class="card-title activator grey-text text-darken-4">Nuevo Usuario</span>
          
          <center>
            <div class="row">
              <a href="?url=usuario&opcion=formulario_registro" class="btn waves-effect waves-light green darken-2 ">REGISTRAR</a>
            </div>
          </div>
        </center></div></div>
        
        <div class="col s12 m6">
          <!--CARTA CONTENEDORA-->      
          
          <div class="card small">
            <div class="card-image waves-effect waves-block waves-light">
              <center>
                <br>
                <img class="activator" src="vista/config/img/administrador.png" style="width: 155px; height:">
              </center>
            </div>
            
            <div class="card-content">
              <span class="card-title activator grey-text text-darken-4">Usuarios Registrados</span>
              
              <center>
                <div class="row">
                  <a href="?url=usuario&opcion=consultar-usuarios" class="btn waves-effect waves-light red darken-2 white-text ">CONSULTAR</a>
                </div>
              </div>
            </center></div></div>
            
            
          </div>


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