
<?php 

  $options = [
              'cost' => 7,
              'salt' => 'UniversidadPolitecnicaTerritorialAEB'];

  if (isset($_GET["mensaje"]) || isset($_GET["cas"]) && $_GET["cas"] == 2 || password_hash($_SESSION['cedula'], PASSWORD_BCRYPT, $options)  == $_SESSION['contrasena']) {

  $bloqueo = 1;


  ?>

  <!DOCTYPE html>
  <html>

  <head>

    <!-- ============================================================== -->
    <!--               IMPORTACION DE CABECERA PRINCIPAL                -->
    <!-- ============================================================== -->
    <?php require_once 'vista/publico/Head.php'; 
    ?>
    <script type="text/javascript" src="vista/config/js/alertas.js"></script>
    <script type="text/javascript" src="vista/config/js/validar_contrasena.js"></script>
    <style type="text/css">
      header, footer, main {
        padding-left: 0;
      }
    </style>
  </head>

  <body>

    <!-- ============================================================== -->
    <!--            IMPORTACION DE LA BARRA DE NAVEGACION               -->
    <!-- ============================================================== -->
    <?php require_once 'vista/config/js/alertas.php';?>

    <!-- ============================================================== -->
    <!-- INICIO DEL CONTENIDO-->
    <!-- ============================================================== -->
    <main>

      <section class="section">
        <div class="row">

         <!--AQUI VA TODO EL CONTENIDO-->
         <div class="col s12 m12">
          <div class="white-text card-panel blue darken-2">
            <center><span class="card-title"><h7>Editar Perfil</h7></span></center>
          </div>
        </div>

        <div class="col s12 m12"> 
          <div class="card" style="margin-left: 20px; margin-right: 20px">
            <br>
            
            <!--DIV solamente para centrar-->
            <div style="margin-left: 20px; margin-right: 20px">

              <table class="highlight">
                <thead>
                  <tr>
                    <th colspan="2"><p style="margin-left: 20px;">Por favor, actualice estos datos para poder ingresar al sistema CAS</p></th>
                  </tr>
                </thead>

                <tbody>
                  <tr>
                    <td><center><?php if ($_SESSION["foto"] == null) {

                     $cas = 1;
                     ?>
                     <i class='icon-close'></i>
                     <?php
                   }else{ 

                     $cas = 2;
                     ?>
                     <i class='icon-check'></i>
                     <?php
                   } 
                   ?>Foto de perfil</center></td>
                   <td><a href="#fotoPerfil" data-position="bottom" data-tooltip="Actualizar foto de perfil" class="tooltipped modal-trigger"><i class="icon-person prefix"></i></a></td>
                 </tr>

                 <!-- ============================================================== -->
                 <!-- MODAL PERFIL -->
                 <!-- ============================================================== -->
                 <div id="fotoPerfil" class="modal modal-fixed-footer" style="height: 400px;">
                  <div class="modal-content">
                    <h5>Foto de perfil</h5>
                    <div class="col s12">

                      <form method="POST" id="perfil" name="perfil" action="?url=usuario&opcion=actualizarFoto" enctype="multipart/form-data">
                        <div class="row">

                          <input type="hidden" id="cas" name="cas" value="<?php if ($_SESSION['cedula'] !== $_SESSION['contrasena']) {
                            echo "2";
                          }else { echo $cas;} ?>">

                          <div class="input-field col s12">
                            <center>
                              <div id="preview"> <img src="<?php if(!empty($_SESSION['foto'])){ echo $_SESSION['foto'];} else{ echo 'vista/config/img/user3.png';} ?>" class="img-circle" width="150" /></div>
                              <label>Subir imagen</label><br>
                              <input type="file" class="form-control" id="foto_perfil" name="foto_perfil" style="color: transparent;">
                            </center>
                            <script type="text/javascript">
                              document.getElementById("foto_perfil").onchange = function(e) {
                                // Creamos el objeto de la clase FileReader
                                let reader = new FileReader();

                                // Leemos el archivo subido y se lo pasamos a nuestro fileReader
                                reader.readAsDataURL(e.target.files[0]);

                                // Le decimos que cuando este listo ejecute el código interno
                                reader.onload = function(){
                                  let preview = document.getElementById('preview'),
                                  image = document.createElement('img');

                                  image.src = reader.result;

                                  $("#preview").html('<img  class="img-circle" width="150" height="150" src="'+ image.src +'" >');
                                };
                              } 
                            </script>
                          </div>

                        </div>
                        <center>
                         <input type="submit" name="guardar" value="guardar" class="btn btn-primary yellow darken-3 btn-small">
                       </center>
                     </form>

                   </div>
                 </div>
                 <div class="modal-footer">
                  <a href="#!" class="modal-action modal-close waves-effect waves-brown btn-flat">Cerrar</a>
                </div>
              </div>             

              <tr>
                <td><center><?php if ($_SESSION["contrasena"] == password_hash($_SESSION['cedula'], PASSWORD_BCRYPT, $options)) {

                  $cas = 1;

                  ?>
                  <i class='icon-close'></i>
                  <?php
                }else{ 

                  $cas = 2;

                  ?>
                  <i class='icon-check'></i>
                  <?php
                } ?>Cambio de contraseña</center></td>
                <td><a href="#contra"data-position="bottom" data-tooltip="Cambiar contraseña" class="tooltipped modal-trigger"><i class="icon-mode_edit prefix"></i></a></td>
              </tr>

              <!-- ============================================================== -->
              <!-- MODAL CONTRASEÑA -->
              <!-- ============================================================== -->
              <div id="contra" class="modal modal-fixed-footer" style="height: 400px;">
                <div class="modal-content">
                  <h5>Actualizar contraseña</h5>

                  <div class="col s12 m6">
                    <br>
                    <center>
                      <img class="activator" src="vista/config/img/seg.png" style="margin-top: -20px; height: 200px;" >
                    </center>
                  </div> 

                  <div class="col s12 m6">
                    <form method="POST" action="?url=usuario&opcion=cambioContrasena" id="passw" name="passw" enctype="multipart/form-data">
                      <div class="row">

                        <div class="input-field col s9 m10">
                          <i class="icon-vpn_key prefix"></i>
                          <input id="con" name="con" type="password" class="validate" value="<?php if(isset($pass)){echo $pass;}?>"  class="invalid" required>
                          <label for="con">Antigua Contraseña</label>

                          <input type="hidden" name="antPass" id="antPass" value="<?php echo $_SESSION["contrasena"];?>">

                        </div>

                        <div class="input-field col s3 m2">
                         <i class="icon-enhanced_encryption prefix"></i>
                         <a href="javascript:void(0);" onclick="mos();" minlength="6" id='shol' class="btn waves-effect waves-light green darken-2 white-text"><i id="ho" class="icon-visibility"></i></a>
                       </div>

                       <div class="input-field col s9 m10">
                         <i class="icon-enhanced_encryption prefix"></i>
                         <input id="contra_" name="contra_" type="password" class="validate" minlength="6" title="Clave mayor de 6 digitos" required data-length="12" maxlength="12">
                         <label for="contra_">Nueva Contraseña</label>
                       </div>

                       <div class="input-field col s3 m2">
                         <i class="icon-enhanced_encryption prefix"></i>
                         <a href="javascript:void(0);" onclick="mostrarPassword2();" minlength="6" id='show' class="btn waves-effect waves-light green darken-2 white-text"><i id="hj" class="icon-visibility"></i></a>
                       </div>

                       <div class="input-field col s9 m10">
                         <i class="icon-enhanced_encryption prefix"></i>
                         <input  id="contra_2" name="contra_2" type="password" class="validate" minlength="6" required data-length="12" maxlength="12">
                         <label for="contra_2">Confirme su contraseña</label>
                       </div>

                       <div class="input-field col s3 m2">
                         <i class="icon-enhanced_encryption prefix"></i>
                         <a href="javascript:void(0);" onclick="mostrarPas2();" id='show_p' minlength="6" class="btn waves-effect waves-light green darken-2 white-text"><i id="hl" class="icon-visibility"></i></a>
                       </div>

                     </div>
                     <center>
                       <input type="button"  id="aceptar" name="aceptar" value="guardar"class="btn btn-primary yellow darken-3 btn-small">
                     </center>
                   </form>

                 </div>
               </div>
               <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-brown btn-flat">Cerrar</a>
              </div>
            </div>

            <tr>
              <td><center><?php if ($_SESSION["numQuestions"] == NULL) {

                $cas = 3;

                ?>
                <i class='icon-close'></i>
                <?php
              }else{ 

                $cas = 2;

                ?>
                <i class='icon-check'></i>
                <?php
              } ?>Preguntas de seguridad</center></td>
              <td><a href="#quest" data-position="bottom" data-tooltip="Registrar preguntas de seguridad" class="tooltipped modal-trigger"><i class="icon-mode_edit prefix"></i></a></td>
            </tr>

            <!-- ============================================================== -->
            <!-- MODAL CONTRASEÑA -->
            <!-- ============================================================== -->
            <div id="quest" class="modal modal-fixed-footer" style="height: 400px;">

              <div class="modal-content">
               <h5>Preguntas de seguridad</h5>
               <div class="col s12">
                <div class="row">

                   <div class="col s12 m3">
                    <br>
                    <center>
                      <img class="activator" src="vista/config/img/seg.png" style="height: 200px;" >
                    </center>
                  </div>

                  <form method="POST" action="?url=seguridad&opcion=addQuestion">

                    <input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $_SESSION['id_ussuario'];?>">

                    <div class="input-field col s5" >
                      <label style="margin-top: -30px;">Pregunta</label>
                      <select class="browser-default" id="quest_one" name="quest_one" style="margin-top: 10px;">

                        <option value="¿Nombre de madre?">¿Nombre de madre?</option>
                        <option value="¿Nombre de padre?">¿Nombre de padre?</option>
                        <option value="¿Nombre de tu mascota?">¿Nombre de tu mascota?</option>
                        <option value="¿Nombre de tu primer colegio?">¿Nombre de tu primer colegio?</option>
                        <option value="¿Nombre de tu primer hijo?">¿Nombre de tu primer hijo?</option>
                        <option value="¿Color favorito?">¿Color favorito?</option>
                        <option value="¿Animal favorito?">¿Animal favorito?</option>
                        <option value="¿Comida favorita?">¿Comida favorita?</option>
                        <option value="¿Pelicula favorita?">¿Pelicula favorita?</option>

                      </select>
                    </div>

                    <div class="input-field col s4" >
                      <input type="text" name="respuesta_one" id="respuesta_one">

                      <label for="respuesta_one">Respuesta</label>
                    </div>

                    <div class="input-field col s5" >
                      <label for="quest_two">Pregunta 2</label>
                      <input type="text" name="quest_two" id="quest_two">
                    </div>

                    <div class="input-field col s4" >
                      <input type="text" name="respuesta_two" id="respuesta_two">

                      <label for="respuesta_two">Respuesta 2</label>
                    </div>

                    <center>
                      <input type="submit" class="btn btn-primary cyan darken-2 btn-small" value="REGISTRAR" name="">

                  </center>
                  </form>
                </div>  

              </div>
            </div>
            <div class="modal-footer">
              <a href="#!" class="modal-action modal-close waves-effect waves-brown btn-flat">Cerrar</a>
            </div>
          </div>

        </div>

      </tbody>
    </table>

  </div>     
</div>
</div>
</div>

<br>    

</section>

</div>

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
<script src="vista/publico/script-new.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('input#input_text, input#contra_').characterCounter();
    $('input#input_text, input#con').characterCounter();
    $('input#input_text, input#contra_2').characterCounter();
    $("select").formSelect();
  });
</script>

</body>
</html>

<?php }else{ ?>

  <!DOCTYPE html>
  <html>

  <head>

    <!-- ============================================================== -->
    <!--               IMPORTACION DE CABECERA PRINCIPAL                -->
    <!-- ============================================================== -->
    <?php require_once 'vista/publico/Head.php'; 
    ?>
    <script type="text/javascript" src="vista/config/js/alertas.js"></script>
    <script type="text/javascript" src="vista/config/js/validar_contrasena.js"></script>

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
            <center><span class="card-title"><h7>Editar Perfil</h7></span></center>
          </div>
        </div>

        <div class="col s12 m12"> 
          <div class="card" style="margin-left: 20px; margin-right: 20px">
            <br>
            
            <!--DIV solamente para centrar-->
            <div style="margin-left: 20px; margin-right: 20px">

              <table class="highlight">
                <thead>
                  <tr>
                    <th colspan="2"><p style="padding-left: 0;">¿Que desea editar?</p></th>
                  </tr>
                </thead>

                <tbody>
                  <tr>
                    <td><center>Foto de perfil</center></td>
                    <td><a href="#fotoPerfil" data-position="bottom" data-tooltip="Actualizar foto de perfil" class="tooltipped modal-trigger"><i class="icon-person prefix"></i></a></td>
                  </tr>

                  <!-- ============================================================== -->
                  <!-- MODAL PERFIL -->
                  <!-- ============================================================== -->
                  <div id="fotoPerfil" class="modal modal-fixed-footer" style="height: 400px;">
                    <div class="modal-content">
                      <h5>Foto de perfil</h5>
                      <div class="col s12">

                        <form method="POST" id="perfil" name="perfil" action="?url=usuario&opcion=actualizarFoto&pag=edit" enctype="multipart/form-data">
                          <div class="row">
 
                            <div class="input-field col s12">
                              <center>
                                <div id="preview"> <img src="<?php if(!empty($_SESSION['foto'])){ echo $_SESSION['foto'];} else{ echo 'vista/config/img/user3.png';} ?>" class="img-circle" width="150" /></div>
                                <label>Subir imagen</label><br>
                                <input type="file" class="form-control" id="foto_perfil" name="foto_perfil" style="color: transparent;">
                              </center>
                              <script type="text/javascript">
                                document.getElementById("foto_perfil").onchange = function(e) {
                                // Creamos el objeto de la clase FileReader
                                let reader = new FileReader();

                                // Leemos el archivo subido y se lo pasamos a nuestro fileReader
                                reader.readAsDataURL(e.target.files[0]);

                                // Le decimos que cuando este listo ejecute el código interno
                                reader.onload = function(){
                                  let preview = document.getElementById('preview'),
                                  image = document.createElement('img');

                                  image.src = reader.result;

                                  $("#preview").html('<img  class="img-circle" width="150" src="'+ image.src +'" >');
                                };
                              }
                            </script>
                          </div>

                        </div>
                        <center>
                         <input type="submit" name="aceptar" value="guardar" class="btn btn-primary yellow darken-3 btn-small">
                       </center>
                     </form>

                   </div>
                 </div>
                 <div class="modal-footer">
                  <a href="#!" class="modal-action modal-close waves-effect waves-brown btn-flat">Cerrar</a>
                </div>
              </div>             

              <tr>
                <td><center>Cambio de contraseña</center></td>
                <td><a href="#contra" data-position="bottom" data-tooltip="Cambiar contraseña" class="tooltipped modal-trigger"><i class="icon-mode_edit prefix"></i></a></td>
              </tr>

              <!-- ============================================================== -->
              <!-- MODAL CONTRASEÑA -->
              <!-- ============================================================== -->
              <div id="contra" class="modal modal-fixed-footer" style="height: 400px;">
                <div class="modal-content">
                  <h5>Actualizar contraseña</h5>

                  <div class="col s12 m6">
                    <br>
                    <center>
                      <img class="activator" src="vista/config/img/seg.png" style=" height: 200px;" >
                    </center>
                  </div>
 
                  <div class="col s12 m6">
                    <form method="POST" action="?url=usuario&opcion=cambioContrasena&pag=edit" id="passw" name="passw" enctype="multipart/form-data">
                      <div class="row">

                        <div class="input-field col s9 m10">
                          <i class="icon-vpn_key prefix"></i>
                          <input id="con" name="con" type="password" class="validate" value="<?php if(isset($pass)){echo $pass;}?>"  class="invalid" required>
                          <label for="con">Antigua Contraseña</label>

                          <input type="hidden" name="antPass" id="antPass" value="<?php echo $_SESSION["contrasena"];?>">

                        </div>

                        <div class="input-field col s3 m2">
                         <i class="icon-enhanced_encryption prefix"></i>
                         <a href="javascript:void(0);" onclick="mos();" minlength="6" id='shol' class="btn waves-effect waves-light green darken-2 white-text"><i id="ho" class="icon-visibility"></i></a>
                       </div>

                       <div class="input-field col s9 m10">
                         <i class="icon-enhanced_encryption prefix"></i>
                         <input id="contra_" name="contra_" type="password" class="validate" minlength="6" title="Clave mayor de 6 digitos" required data-length="12" maxlength="12">
                         <label for="contra_">Nueva Contraseña</label>
                       </div>

                       <div class="input-field col s3 m2">
                         <i class="icon-enhanced_encryption prefix"></i>
                         <a href="javascript:void(0);" onclick="mostrarPassword2();" minlength="6" id='show' class="btn waves-effect waves-light green darken-2 white-text"><i id="hj" class="icon-visibility"></i></a>
                       </div>

                       <div class="input-field col s9 m10">
                         <i class="icon-enhanced_encryption prefix"></i>
                         <input  id="contra_2" name="contra_2" type="password" class="validate" minlength="6" required data-length="12" maxlength="12">
                         <label for="contra_2">Confirme su contraseña</label>
                       </div>

                       <div class="input-field col s3 m2">
                         <i class="icon-enhanced_encryption prefix"></i>
                         <a href="javascript:void(0);" onclick="mostrarPas2();" id='show_p' minlength="6" class="btn waves-effect waves-light green darken-2 white-text"><i id="hl" class="icon-visibility"></i></a>
                       </div>

                     </div>
                     <center>
                       <input type="button" id="aceptar" name="aceptar" value="guardar" class="btn btn-primary yellow darken-3 btn-small">
                     </center>
                   </form>

                 </div>
               </div>
               <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-brown btn-flat">Cerrar</a>
              </div>
            </div>
          </tbody>
        </table>

      </div>     
    </div>
  </div>
</div>

<br>    

</section>

</main>

</div>

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
<script src="vista/publico/script-new.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('input#input_text, input#contra_').characterCounter();
    $('input#input_text, input#con').characterCounter();
    $('input#input_text, input#contra_2').characterCounter();
    $("select").formSelect();
  });
</script>

</body>
</html>

<?php } ?>