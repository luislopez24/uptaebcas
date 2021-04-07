<!DOCTYPE html>
<html>

<head>
    <title>Beneficiario</title>
<!----------------------IMPORTACION DE CABECERA PRINCIPAL--------------------->
    
    <?php require_once 'vista/publico/Head.php'; ?>

</head>
<body>


<!-------------------------BARRA DE NAVEGACIÓN-------------------------------->      

    <?php require_once 'vista/publico/Header.php'; ?>

<!--CUERPO-->
  <main>
    
    <section class="section">

                 
       <div class="row">
          
                   <div class="col s12 m12">
                      <div class="white-text card-panel blue darken-2">
                          <center><span class="card-title"><h6>Beneficiario</h6></span></center>
                      </div>
                    </div>
                  </div>
            
          <!--AQUI VA TODO EL CONTENIDO-->
            <div class="row">

              <div class="col s12 m6">
                <div class="card small">
                      
                        <div class="card-image waves-effect waves-block waves-light">
                            <center>
                              <br>
                               <img class="activator" src="vista/config/img/añ.png" style="width: 150px; height:">
                              </center>
                        </div>

                        <div class="card-content">
                          <span class="card-title activator grey-text text-darken-4">Nuevo Beneficiario</span>
                       
                        <center>
                        <div class="row">
                              <a href="?url=usuario&opcion=formularioPersonal" class="btn waves-effect waves-light green darken-2 ">REGISTRAR</a>
                        </div>
                        </div>

                  </div>
              </div>

              <div class="col s12 m6">
                <div class="card small">
                      
                        <div class="card-image waves-effect waves-block waves-light">
                            <center>
                              <br>
                               <img class="activator" src="vista/config/img/benef.png" style="width: 300px; height:">
                              </center>
                        </div>

                        <div class="card-content">
                          <span class="card-title activator grey-text text-darken-4">Beneficiarios Registrados</span>
                       
                        <center>
                        <div class="row">
                              <a href="?url=usuario&opcion=consultarpersonal" class="btn waves-effect waves-light red darken-2 ">CONSULTAR</a>
                        </div>
                        </div>

                  </div>
              </div>

            </div>
               
      </section>
  </main>

<!-------------------------------- FOOTER -------------------------------------->

   <?php require_once 'vista/publico/Footer.php'; ?>

<!-------------------------------- SCRIPTS -------------------------------------->

   <?php require_once 'vista/publico/Scripts.php'; ?>

</body>
</html>