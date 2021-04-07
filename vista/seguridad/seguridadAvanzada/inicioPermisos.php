<!DOCTYPE html>
<html>

<!-- ============================================================== -->
<!--               IMPORTACION DE CABECERA PRINCIPAL                -->
<!-- ============================================================== -->
<?php require_once 'vista/publico/Head.php';?>
<script type="text/javascript" src="vista/config/js/catalogo/validar_catalogo.js"></script>

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

strong { font-weight: 700; }
.error-box, .info {
  padding: 0.833em 0.833em 0.833em 3em; /* 10/12 36/12 */
  margin-bottom: 0.833em; /* 20/12 */
  border-radius: 15px;
}

hr {
  border: 1px dashed #C0C0C0;
  height: 0;
  width: 100%;
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
       <div class="col-s12-m6">   

        <div class="card"style="margin-left: 20px; margin-right: 20px">
         <div class="row">
          <div class="col s12 m12">
            <div class="white-text card-panel green darken-2">
              <center><span class="card-title"><h6>Asignar Permisos al "<?php foreach($datos as $roles){ echo $roles['nombreRol']; } ?>" <?php foreach ($datosUsuario as $data) { echo $data['nombre']." ".$data['apellido']; }?></h6></span></center>
            </div>
          </div>
        </div>

        <!--DIV solamente para centrar-->
        <div style="margin-left: 20px; margin-right: 20px"> 

          <form action="?url=seguridad&opcion=actualizarPermisoUsuario&idRol=<?php $idRol; ?>" name="as" id="as" method="POST">
            <?php foreach ($modulos as $modals): ?>

              <table border="1">

                <thead>
                  <tr>
                   <th align='left'>

                     <p> 
                      <img src='<?php echo $modals['icono']; ?>' width='50' height='50' align="left"><h6 style="margin-top: 30px; margin-left: 60px">
                        Catalogo <strong><?php echo $modals['nombreModulo'];?></strong>
                      </h6> 
                    </p>
                  </th>

                  <th></th>
                </tr>

              </thead>
            </table>

            <table>

              <?php foreach ($permisos as $passtrue){ if ($passtrue['idModulo'] == $modals['idModulo']) { ?>
                <thead>
                  <tr>
                    <th></th>
                    <th ><center><label>

                      <input type="hidden" name="idUser" value="<?php echo $idUser;?>">
                      <input type="hidden" name="idRol" value="<?php echo $idRol;?>">

                      <input type="checkbox" name="idPermisos[]" value="<?php echo $passtrue['idPermiso'];?>" <?php foreach ($perUsuario as $key){ if ($key['idPermiso'] == $passtrue['idPermiso']) {
                        echo 'checked';
                      }} ?> /> 
                      <span> </span>
                    </label></center></th>
                    <th><img src='<?php echo $passtrue['icono']; ?>' width='30' height='30' align="left"><h6 style="margin-left: 50px; margin-top: 5px">
                      <?php echo $passtrue['nombrePermiso'] ?></th>
                      <th></th>
                      <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                    </tr>
                  </thead>

                <?php }} 

                ?>
 
              </table> 

            <?php endforeach; ?>

            <BR>
            <center>
              <input type="button" onclick="actualizarPermisos();" value="GUARDAR CAMBIOS" class="btn btn-primary yellow darken-3 btn-small">

            </form>
          </center><BR>
        </div>     

      </div>

      <center>
        <a href="?url=seguridad&opcion=consultarUsuarios&id=<?php echo $idRol; ?>" class="btn waves-effect waves-light blue darken-4 white-text btn-small">Regresar</a>
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

<!-------------------------------- SCRIPTS -------------------------------------->

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
</script>

<script type="text/javascript">

 $(document).ready(function(){

  $('input#input_text, input#nom').characterCounter();
})

</script>
<script src="vista/config/js/searchMenu.js"></script>


</body>
</html>
