<!DOCTYPE html>
<html>

<head>

 <!-- ============================================================== -->
 <!--               IMPORTACION DE CABECERA PRINCIPAL                -->
 <!-- ============================================================== -->
 <?php require_once 'vista/publico/Head.php';?>
 <script type="text/javascript" src="vista/config/js/validar_operativo.js"></script>
 <script src="vista/config/js/check_operativo.js"></script>
 
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


       <div class="row">
        <div class="col s12 m12">
          <div class="white-text card-panel blue darken-2">
            <center><span class="card-title"><h7>Registrar Operativo</h7></span></center>
          </div>
        </div>

        <div class="col s1 m1">
        </div>

        <form id="1" name="ope" method="POST" action="?url=operativo&opcion=registrar" enctype="multipart/form-data">

          <div class="col s10 m10">
            <div class="card-panel light-blue lighten-5">

               <div class="input-field col s12 m12" style="display: none" id="check">
              <div id="result-operativo" style="margin-top: -20px"></div>
            </div>

              <div class="input-field col s12 m6">
                <center>
                  <div id="preview"> <img src="<?php if(isset($_COOKIE['foto'])){ echo $_COOKIE['foto'];} else{ echo 'vista/config/img/fami.png';} ?>" class="img-circle" width="200" /></div>
                  <label>Subir imagen</label><br>
                  <input type="file" class="form-control" id="foto_perfil" name="foto_perfil" required style="color: transparent;">
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

                              <div class="input-field col s12 m6">
                                <i class="icon-next_week prefix"></i>
                                <input type="text" name="nombre" id="nombre" value="<?php if(isset($_COOKIE['nombre'])){ $nombre = $_COOKIE['nombre']; echo $nombre;}else if(isset($nom)){ echo $nom;}?>" data-length="30" class="validate" required autofocus>
                                <label for="nombre">Nombre del Operativo</label>
                              </div>

                              <div class="input-field col s9 m5">

                                <i class="icon-add_shopping_cart prefix"></i>

                                <select id="tipoo" name="tipoo[]" multiple>

                                  <?php
                                  foreach($datos as $strExec):
                                    ?>
                                    <option value="<?php echo $strExec["id_clasificacion"]?>"><?php echo $strExec["nombre_clasificacion"]?></option>
                                  <?php endforeach;  ?>

                                </select>
                                      
                                <label for="clasificacion">Asignar clasificación</label>
                              </div>


                              <div class="input-field col s3 m1">

                                <a href="#" onclick="bPreguntar = false; document.getElementById('1').action = '?url=clasificacion&opcion=cookiesClasificacion';document.getElementById('1').submit();" data-position="bottom" data-tooltip="Gestionar clasificaciones" class="btn tooltipped waves-effect waves-light pink darken-2 white-text"><i class="icon-shopping_basket"></i></a>

                              </div>

                              <input type="hidden" name="date" id="date" value="<?php echo date("Y").'-'.date("m").'-'.date("d");?>">

                              <div class="input-field col s12 m6">
                                <i class="icon-event_note prefix"></i>
                                <input type="date" name="fechai" id="fechai" autocomplete="off" value="<?php if(isset($_COOKIE['fechai'])){ $fechai = $_COOKIE['fechai']; echo $fechai;}else{ echo date("Y").'-'.date("m").'-'.date("d"); } ?>" required>
                                <label for="fechai">Fecha Inicio </label>
                              </div> 

                              <div class="input-field col s12 m6">
                                <i class="icon-event_note prefix"></i>
                                <input type="date" name="fechaf" id="fechaf" autocomplete="off" value="<?php if(isset($_COOKIE['fechaf'])){ $fechaf = $_COOKIE['fechaf']; echo $fechaf;}else{ echo date("Y").'-'.date("m").'-'.date("d"); } ?>" required>
                                <label for="fechaf">Fecha Final</label>
                              </div> 

                              <div class="input-field col s12 m6">
                                <i class="icon-shopping_cart prefix"></i>
                                <input type="text" name="precio" id="precio" title="Solo Numero" required value="<?php if(isset($_COOKIE['precio'])){ $precio = $_COOKIE['precio']; echo $precio;}?>" class="validate" required pattern="[0-9]{10}">
                                <label for="precio">Precio del Operativo</label>
                              </div>                            

                              <div class="hola input-field col s12 m6">
                                <i class="icon-mode_edit prefix"></i>
                                <textarea id="descrip" class="materialize-textarea"  pattern="[A-Za-z0-9/ ]+"  data-length="100" name="descrip"><?php if(isset($_COOKIE['descrip'])){ $descrip = $_COOKIE['descrip']; echo $descrip;}?></textarea>
                                <label for="descrip">Descripción</label>
                              </div>

                              <div class="hola input-field col s12 m6">
                               <i class="icon-work prefix "></i>
                               <select  id="banco" name="banco" required>
                                <option value="Banco de Venezuela S.A.C.A. Banco Universal" selected> Banco de Venezuela S.A.C.A. Banco Universal</option>
                                <option value="Banco Mercantil, C.A S.A.C.A. Banco Universal"> Banco Mercantil, C.A S.A.C.A. Banco Universal</option>
                                <option value="Banco Industrial de Venezuela, C.A. Banco Universal"> Banco Industrial de Venezuela, C.A. Banco Universal</option>
                                <option value="Venezolano de Crédito, S.A. Banco Universal"> Venezolano de Crédito, S.A. Banco Universal</option>
                                <option value="Banco Provincial, S.A. Banco Universal"> Banco Provincial, S.A. Banco Universal</option>
                                <option value="Bancaribe C.A. Banco Universal"> Bancaribe C.A. Banco Universal</option>
                                <option value="Banco Exterior C.A. Banco Universal"> Banco Exterior C.A. Banco Universal</option>
                                <option value="Banco Occidental de Descuento, Banco Universal C.A."> Banco Occidental de Descuento, Banco Universal C.A.</option>
                                <option value="Banco Caroní C.A. Banco Universal"> Banco Caroní C.A. Banco Universal</option>
                                <option value="Banesco Banco Universal S.A.C.A."> Banesco Banco Universal S.A.C.A.</option>
                                <option value="Banco Sofitasa Banco Universal"> Banco Sofitasa Banco Universal</option>
                                <option value="Banco Plaza Banco Universal"> Banco Plaza Banco Universal</option>
                                <option value="Banco de la Gente Emprendedora C.A."> Banco de la Gente Emprendedora C.A.</option>
                                <option value="Banco del Pueblo Soberano, C.A. Banco de Desarrollo"> Banco del Pueblo Soberano, C.A. Banco de Desarrollo</option>
                                <option value="BFC Banco Fondo Común C.A Banco Universal"> BFC Banco Fondo Común C.A Banco Universal</option>
                                <option value="100% Banco, Banco Universal C.A."> 100% Banco, Banco Universal C.A.</option>
                                <option value="DelSur Banco Universal, C.A."> DelSur Banco Universal, C.A.</option>
                                <option value="Banco del Tesoro, C.A. Banco Universal"> Banco del Tesoro, C.A. Banco Universal</option>
                                <option value="Banco Agrícola de Venezuela, C.A. Banco Universal"> Banco Agrícola de Venezuela, C.A. Banco Universal</option>
                                <option value="Bancrecer, S.A. Banco Microfinanciero"> Bancrecer, S.A. Banco Microfinanciero</option>
                                <option value="Mi Banco Banco Microfinanciero C.A."> Mi Banco Banco Microfinanciero C.A.</option>
                                <option value="Banco Activo, C.A. Banco Universal"> Banco Activo, C.A. Banco Universal</option>
                                <option value="Bancamiga Banco Microfinanciero C.A."> Bancamiga Banco Microfinanciero C.A.</option>
                                <option value="Banco Internacional de Desarrollo, C.A. Banco Universal"> Banco Internacional de Desarrollo, C.A. Banco Universal</option>
                                <option value="Banplus Banco Universal, C.A."> Banplus Banco Universal, C.A.</option>
                                <option value="Banco Bicentenario Banco Universal C.A."> Banco Bicentenario Banco Universal C.A.</option>
                                <option value="Banco Espirito Santo, S.A. Sucursal Venezuela B.U."> Banco Espirito Santo, S.A. Sucursal Venezuela B.U.</option>
                                <option value="Banco de la Fuerza Armada Nacional Bolivariana, B.U."> Banco de la Fuerza Armada Nacional Bolivariana, B.U.</option>
                                <option value="Citibank N.A."> Citibank N.A.</option>
                                <option value="Banco Nacional de Crédito, C.A. Banco Universal"> Banco Nacional de Crédito, C.A. Banco Universal</option>
                                <option value="Instituto Municipal de Crédito Popular"> Instituto Municipal de Crédito Popular</option>
                              </select>
                              <label>Banco Admitido</label>
                            </div>


                            <center>

                             <input type="button" onclick="validar();" name="aceptar" value="siguiente" class="btn btn-primary green darken-2 btn-small">
                             <button type="reset" name="limpiar" class="btn waves-effect waves-light red darken-2 white-text btn-small"> limpiar </button><br><br><br>
                           </center>

                         </form>
                       </div>

                     </div>

                     <div class="col s12 m1">
                     </div>

                   </div>

                   <center>
                     <a href="?url=operativo&opcion=operativo" class="btn waves-effect waves-light blue darken-4 white-text  btn-small">Regresar</a>
                   </center>

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
