<?php
 if (isset($c) && $c == 'true') {
 	?>
 	<script type="text/javascript">
 		swal("¡Bien!", "Esta cédula está disponible", "success");
 	</script>
 	<?php 
 }?>

 <?php
 if(!empty($_GET['act'])){
 	?>
 	<script type="text/javascript">
 		swal("¡Excelente!", 
 			"El usuario a sido actualizado", 
 			"success");
 		</script>
 		<?php 
 }

 if(!empty($_GET['registroBeneficiario'])){
 	?>
 	<script type="text/javascript">
 		swal("¡Excelente!", 
 			"El beneficiario ha sido registrado correctamente", 
 			"success");
 		</script>
 		<?php 
 }

  if(!empty($_GET['registroLogin'])){
 	?>
 	<script type="text/javascript">
 		swal("¡Excelente!", 
 			"Su registro se ha completado correctamente", 
 			"success");
 		</script>
 		<?php 
 }
 
 


 if(!empty($_GET['ciUser'])){
  ?>
  <script type="text/javascript">
    swal("¡Oppss..!", 
      "Por favor, digite su cédula para continuar", 
      "error");
    </script>
    <?php
 }

 if(!empty($_GET['clasnull'])){
  ?>
  <script type="text/javascript">
    swal("¡Oppss..!", 
      "El campo clasificacion no puede esta vacio", 
      "error");
    </script>
    <?php
 }

 if(!empty($_GET['mensajeEnviado'])){
  ?>
  <script type="text/javascript">
    swal("¡Excelente!", 
      "Su mensaje ha sido enviado con éxito", 
      "success");
    </script>
    <?php
 }

 if(!empty($_GET['preguntasRest'])){
  ?>
  <script type="text/javascript">
    swal("¡Excelente!", 
      "Preguntas de seguridad restauradas", 
      "success");
    </script>
    <?php
 }


if(!empty($_GET['userSinQuest'])){
  ?>
  <script type="text/javascript">
    swal("¡Oppss..!", 
      "Lo siento, no tiene preguntas de seguridad registradas. Por favor comunicarse con el departamento para poder ayudarle", 
      "error");
    </script>
    <?php
 }


 if(!empty($_GET['contraRest'])){
  ?>
  <script type="text/javascript">
    swal("¡Excelente!", 
      "La contraseña a sido restaurada", 
      "success");
    </script>
    <?php
 }

 if(!empty($_GET['actPass'])){
  ?>
  <script type="text/javascript">
    swal("¡Excelente!", 
      "Su contraseña a sido restaurada con éxito", 
      "success");
    </script>
    <?php
 }

 if(!empty($_GET['ciUserNo'])){
  ?>
  <script type="text/javascript">
    swal("¡Oppss..!", 
      "Esta cédula no existe en nuestro sistema", 
      "error");
    </script>
    <?php
 }

 if(!empty($_GET['actRol'])){
  ?>
  <script type="text/javascript">
    swal("¡Excelente!", 
      "El rol ha sido actualizado", 
      "success");
    </script>
    <?php
 }

 if(!empty($_GET['datosComprobar'])){
  ?>
  <script type="text/javascript">
    swal("¡Oppss..!", 
      "Uno de estos datos son incorrectos", 
      "error");
    </script>
    <?php
 }

 if(!empty($_GET['registroUsuario'])){
  ?>
  <script type="text/javascript">
    swal("¡Excelente!", 
      "El usuario ha sido registrado", 
      "success");
    </script>
    <?php
 }

if(!empty($_GET['recordatorio'])){
  ?>
  <script type="text/javascript">
    swal("¡Excelente!", 
      "Se le ha notificado a todos los usuarios deudores, su operativo por pagar pendiente", 
      "success");
    </script>
    <?php
 }

 if(!empty($_GET['question'])){
  ?>
  <script type="text/javascript">
    swal("¡Excelente!", 
      "Las preguntas de seguridad han sido registradas", 
      "success");
    </script>
    <?php
 }

 if(!empty($_GET['fotoact'])){
  ?>
  <script type="text/javascript">
    swal("¡Excelente!", 
      "Su foto ha sido actualizada", 
      "success");
    </script>
    <?php
 }

 if(!empty($_GET['actPermisos'])){
  ?>
  <script type="text/javascript">
    swal("¡Excelente!", 
      "Los permisos han sido actualizados", 
      "success");
    </script>
    <?php
 }
   
 if(!empty($_GET['deleteU'])){
     ?>
     <script type="text/javascript">
      swal("¡Excelente!", 
       "El usuario ha sido eliminado", 
       "success");
     </script>
     <?php
 }

  if(!empty($_GET['deleteRol'])){
     ?>
     <script type="text/javascript">
      swal("¡Excelente!", 
       "El rol ha sido eliminado", 
       "success");
     </script>
     <?php
 }

  if(!empty($_GET['correcto_rol'])){
     ?>
     <script type="text/javascript">
      swal("¡Excelente!", 
       "El rol ha sido registrado correctamente", 
       "success");
     </script>
     <?php
 }

 if(!empty($_GET['error_rol'])){
     ?>
     <script type="text/javascript">
      swal("¡Oppss..!", 
       "Este rol ya se encuentra registrado", 
       "error");
     </script>
     <?php
 }

   ?>

   <?php
 if(!empty($_GET['error'])){
    ?>
    <script type="text/javascript">
      swal("¡Oppss..!", 
        "Este usuario ya se encuentra registrado", 
        "error");
      </script>
      <?php
 }

 if(!empty($_GET['contra']) && $_GET['contra'] == 1){
    ?>
    <script type="text/javascript">
      swal("¡Oppss..!", 
        "La contraseña antigua no coincide", 
        "error");
      </script>
      <?php
 }

 if(!empty($_GET['contra']) && $_GET['contra'] == 2){
    ?>
    <script type="text/javascript">
      swal("¡Oppss..!", 
        "Las contraseñas no coinciden", 
        "error");
      </script>
      <?php
 }

 if(!empty($_GET['contra']) && $_GET['contra'] == 3){
    ?>
    <script type="text/javascript">
      swal("¡Oppss..!", 
        "Su contraseña no puede volver a ser su misma cédula", 
        "error");
      </script>
      <?php
 }

 if(!empty($_GET['contra']) && $_GET['contra'] == 'bien'){
    ?>
    <script type="text/javascript">
      swal("¡Excelente!", 
        "La contraseña ha sido actualizada", 
        "success");
      </script>
      <?php
 }

 if(!empty($_GET['c'])){
      ?>
      <script type="text/javascript">
        swal("¡Bien!", 
          "Esta cédula se encuentra disponible", 
          "success");
        </script>
        <?php
 }
 ?>

 <?php
 if (!empty($disponible_operativo)){
 ?>
   <script type="text/javascript">
   swal("¡Bien!", "Este nombre de operativo está disponible", "success");
   </script> 
 <?php 
 }?>

 <?php
 if (!empty($actDesarchivar)){
 ?>
   <script type="text/javascript">
   swal("¡Excelente!", "Mensajes desarchivados", "success");
   </script> 
 <?php 
 }?>

 <?php
 if (!empty($usuarioBloqueado)){
 ?>
   <script type="text/javascript">
   swal("¡Oppss..!", "Este usuario se encuentra actualmente bloqueado, por favor consultar con su departamento", "error");
   </script> 
 <?php 
 }?>


 <?php
 if (!empty($deleteMessaje)){
 ?>
   <script type="text/javascript">
   swal("¡Excelente!", "Sus mensajes han sido eliminados con éxito", "success");
   </script> 
 <?php 
 }?>


  <?php
 if (!empty($actArchivar)){
 ?>
   <script type="text/javascript">
   swal("¡Excelente!", "Mensaje archivado", "success");
   </script> 
 <?php 
 }?>

   <?php
 if (!empty($faltaDatos)){
 ?>
   <script type="text/javascript">
   swal("¡Lo siento!", "Por favor, ingrese el dato faltante", "error");
   </script> 
 <?php 
 }?>

 <?php
    if(!empty($_GET['error_clasificacion']) && $_GET['error_clasificacion']=='no') {
      ?>
      <script type="text/javascript">
        swal("¡Excelente!", 
          "Se agregó una nueva clasificación", 
          "success");
        </script>
        <?php
  }

      if(!empty($_GET['error_clasificacion']) && $_GET['error_clasificacion']=='si') {
      ?>
      <script type="text/javascript">
        swal("¡Oppss..!", 
          "Esta clasificación ya se encuentra registrada", 
          "error");
        </script>
        <?php
      }

      if(!empty($_GET['delete_clasificacion'])){
        ?>
        <script type="text/javascript">
          swal("¡Excelente!", 
            "La clasificación ha sido eliminada", 
            "success");
          </script>
          <?php
        }



      if(!empty($_GET['deleteOperativo'])){
        ?>
        <script type="text/javascript">
          swal("¡Excelente!", 
            "El operativo ha sido eliminado", 
            "success");
          </script>
          <?php
        }

        if(!empty($_GET['act_clasificacion'])){
          ?>
          <script type="text/javascript">
            swal("¡Excelente!", 
              "Se actualizó la clasificación", 
              "success");
            </script>
            <?php
          }

          ?>
    
     <?php
    if(!empty($_GET['paso_1'])){
      ?>
      <script type="text/javascript">
        swal("¡Paso 1 completado!", 
          "Ahora a llenar el nuevo operativo", 
          "success");
        </script>
        <?php
      }

      if(!empty($_GET['registroCatalogo']) && $_GET['registroCatalogo']=='true') {
      ?>
      <script type="text/javascript">
        swal("¡Excelente!", 
          "Se ha añadido un nuevo catalogo", 
          "success");
        </script>
        <?php
      }

      if(!empty($_GET['registroCatalogo']) && $_GET['registroCatalogo']=='false') {
      ?>
      <script type="text/javascript">
        swal("¡Oppss..!", 
          "Este catalogo ya se encuentra registrado", 
          "error");
        </script>
        <?php
      }

      if(!empty($_GET['actCatalogo'])){
        ?>
        <script type="text/javascript">
          swal("¡Excelente!", 
            "El catalogo se ha actualizado correctamente", 
            "success");
          </script>
          <?php
        }

        if(!empty($_GET['deleteCatalogo'])){
        ?>
        <script type="text/javascript">
          swal("¡Excelente!", 
            "El catalogo ha sido eliminado correctamente", 
            "success");
          </script>
          <?php
        }


      if(!empty($_GET['deleteBitacora'])){
        ?>
        <script type="text/javascript">
          swal("¡Excelente!", 
            "El registro seleccionado ha sido eliminado correctamente", 
            "success");
          </script>
          <?php
        } 

        if(!empty($_GET['deletefalseBitacora'])){
        ?>
        <script type="text/javascript">
          swal("¡Oppss..!", 
            "No se ha seleccionado ningún registro", 
            "error");
          </script>
          <?php
        } 

 if(!empty($_GET['registro'])){
      ?>
      <script type="text/javascript">
        swal("¡Excelente!", 
          "El producto se ha registrado correctamente, ahora cliquee en 'Registrar' si desea culminar con el registro del operativo ", 
          "success");
        </script>
        <?php
      }

      if(!empty($_GET['act_producto'])){
        ?>
        <script type="text/javascript">
          swal("¡Excelente!", 
            "El producto se ha actualizado correctamente", 
            "success");
          </script>
          <?php
        }

        if(!empty($_GET['delete'])){
          ?>
          <script type="text/javascript">
            swal("¡Excelente!", 
              "El producto se ha sido eliminado por completo", 
              "success");
            </script>
            <?php
          }

          if(!empty($_GET['on'])){
            ?>
            <script type="text/javascript">
              swal("¡Excelente!", 
                "El producto se ha añadido al operativo", 
                "success");
              </script>
              <?php
            }

            if(!empty($_GET['cant'])){
              ?>
              <script type="text/javascript">
                swal("¡Excelente!", 
                  "Se ha añadido la cantidad del producto, ahora cliquee en 'Registrar' si desea culminar con el registro del operativo", 
                  "success");
                </script>
                <?php
              }

              if(!empty($_GET['registroDiversidad']) && $_GET['registroDiversidad'] == 'true'){
            ?>
            <script type="text/javascript">
              swal("¡Excelente!", 
                "La diversidad ha sido registrada con éxito", 
                "success");
              </script>
              <?php
            }

            if(!empty($_GET['registroDiversidad']) && $_GET['registroDiversidad'] == 'false'){
            ?>
            <script type="text/javascript">
              swal("¡Oppss..!", 
                "Esta diversidad ya se encuentra registrada", 
                "error");
              </script>
              <?php
            }

   if(!empty($_GET['registroOperativo'])){
          ?>
          <script type="text/javascript">
            swal("¡Excelente!", 
              "Has terminado con el registro del operativo", 
            "success");
          </script>
          <?php
        }

          if(!empty($_GET['registroPago'])){
          ?>
          <script type="text/javascript">
            swal("¡Excelente!", 
              "Registro de pago sastifactorio", 
            "success");
          </script>
          <?php
        }

        if(!empty($_GET['actOperativo'])){
          ?>
          <script type="text/javascript">
            swal("¡Excelente!", 
              "El operativo ha sido actualizado", 
            "success");
          </script>
          <?php
        }

 if(!empty($_GET['ref'])){
          ?>
          <script type="text/javascript">
            swal("¡Bien!", 
              "Número de referencia aceptada", 
              "success");
            </script>
            <?php
          }

       if(!empty($_GET['errorRef'])){
          ?>
          <script type="text/javascript">
            swal("¡Uppss..!", 
              "Esta referencia ya se encuentra registrada", 
              "error");
            </script>
            <?php
          }

    if(!empty($_GET['actPago'])){
        ?>
        <script type="text/javascript">
          swal("¡Excelente!", 
            "Se ha actualizado el pago del operativo", 
            "success");
          </script>
          <?php
        }

    if(isset($vali) && $vali == 'menor'){
      ?>
      <script type="text/javascript">
        swal("¡Oppss..!", 
          "La fecha ingresada no puede ser menor a la fecha inicial del operativo", 
          "error");
        </script>
        <?php
      }

      if(isset($vali) && $vali == 'mayor'){
        ?>
        <script type="text/javascript">
          swal("¡Oppss..!", 
            "La fecha ingresada no puede ser mayor a la fecha final del operativo", 
            "error");
          </script>
          <?php
        }

        if(!empty($_GET['registro'])){
      ?>
      <script type="text/javascript">
        swal("¡Excelente!", 
          "Se ha registrado el pago del operativo", 
          "success");
        </script>
        <?php
      }

if(!empty($_GET['entregado'])){
      ?>
      <script type="text/javascript">
        swal("¡Excelente!", 
          "El operativo ha sido entregado al beneficiario", 
          "success");
        </script>
        <?php
      }

      if(!empty($_GET['quitado'])){
        ?>
        <script type="text/javascript">
          swal("¡Excelente!", 
            "El operativo se le ha quitado al beneficiario", 
            "success");
          </script>
          <?php
        }
        ?>
        <?php
        if(!empty($_GET['act'])){
          ?>
          <script type="text/javascript">
            swal("¡Excelente!", 
              "El usuario ha sido actualizado", 
              "success");
            </script>
            <?php
          }

        if (!empty($_GET['mensaje'])) {
      ?>

      <script type="text/javascript">
        swal("¡Bienvenid@!", "<?php echo $_SESSION['nombre'];?>", "success");
      </script>
      
      <?php 
    }

    if(!empty($_GET['actpubli'])){
      ?>
      <script type="text/javascript">
        swal("¡Excelente!", 
          "El operativo ha sido publicado", 
          "success");
        </script>
        <?php
      }

     if(!empty($_GET['cedulaExiste']) && $_GET['cedulaExiste'] == 'false'){
      ?>
      <script type="text/javascript">
        swal("¡Error!", 
          "El dato es incorrecto", 
          "error");
        </script>
        <?php
      }

      if(!empty($cedulaExiste)){
      ?>
      <script type="text/javascript">
        swal("¡Excelente!", 
          "Completa ahora los siguientes campos <?php echo $datosUsuario['nombre']; ?>", 
          "success");        </script>
        <?php
      }


if(!empty($pasoFinal)){
      ?>
      <script type="text/javascript">
        swal("¡Excelente!", 
          "Ingresa ahora tu nueva contraseña <?php echo $nombre; ?>", 
          "success");
        </script>
        <?php
      }

      if(!empty($_GET['ocul'])){
        ?>
        <script type="text/javascript">
          swal("¡Excelente!", 
            "El operativo ha sido ocultado", 
            "success");
          </script>
          <?php
        }

        if(!empty($_GET['renova'])){
          ?>
          <script type="text/javascript">
            swal("¡Excelente!", 
              "Has renovado el operativo, ahora puedes publicarlo", 
              "success");
            </script>
            <?php
          }

  if(!empty($_GET['errorci'])){
          ?>
          <script type="text/javascript">
            swal("¡Oppss..!", 
              "Este usuario ya se encuentra registrado", 
              "error");
            </script>
            <?php
          }

  if(!empty($_GET['errornom'])){
          ?>
          <script type="text/javascript">
            swal("¡Oppss..!", 
              "Este operativo ya se encuentra registrado", 
              "error");
            </script>
            <?php
          }

    if (isset($login)) {

      ?>

      <script type="text/javascript">
        swal("¡Error!", "Cédula y/o contraseña invalida", "error");
      </script>

      <?php

    }

    if (isset($archivarFalso)) {

      ?>

      <script type="text/javascript">
        swal("¡Oppss..!", "Lo siento, no se ha seleccionado ningún mensaje para archivar", "error");
      </script>

      <?php

    }

    if (isset($desarchivarFalso)) {

      ?>

      <script type="text/javascript">
        swal("¡Oppss..!", "Lo siento, no se ha seleccionado ningún mensaje para desarchivar", "error");
      </script>

      <?php

    }


    if (isset($eliminarFalso)) {

          ?>

          <script type="text/javascript">
            swal("¡Oppss..!", "Lo siento, no se ha seleccionado nada para eliminar", "error");
          </script>

          <?php

        }

    if (!empty($captcha) and $captcha == 'vacio') {

      ?>

      <script type="text/javascript">
        swal("¡Error!", "Por favor, solucione el captcha", "error");
      </script>

      <?php

    }

     if (!empty($captcha) and $captcha == 'incorrecto') {

      ?>

      <script type="text/javascript">
        swal("¡Error!", "El captcha es incorrecto", "error");
      </script>

      <?php

    }


     if(!empty($_GET['nomail'])){
          ?>
          <script type="text/javascript">
            swal("¡Oppss..!", 
              "Lo siento no se pudo enviar el correo, intenta chequear tu conexion a internet", 
              "error");
            </script>
            <?php
          }

     if(!empty($_GET['errorConexion'])){
          ?>
          <script type="text/javascript">
            swal("¡Oppss..!", 
              "Lo siento no se pudo ocultar este operativo, por favor intenta chequear tu conexion a internet", 
              "error");
            </script>
            <?php
          }

     if(!empty($_GET['errorConex'])){
          ?>
          <script type="text/javascript">
            swal("¡Oppss..!", 
              "Lo siento no se pudo activar este operativo, por favor intenta chequear tu conexion a internet", 
              "error");
            </script>
            <?php
          }
      
     if(!empty($_GET['simail'])){
          ?>
          <script type="text/javascript">
            swal("¡Excelente!", 
              "Tu correo fue enviado con exito!, en breve te contactaremos", 
              "success");
            </script>
            <?php
          }


?>
         