<!-------------------------------- SCRIPTS -------------------------------------->

<!--JQUERY QUE USA MATERIALIZE-->
<script type="text/javascript" src="vista/config/js/jquery.min.js"></script>
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

<script type="text/javascript">
    
   $(document).ready(function(){

        $('input#input_text, input#nombre_catalogo').characterCounter();
        $('input#input_text, textarea#descrip').characterCounter();

        $('input#input_text, input#descripcion').characterCounter();

        $('input#input_text, input#descrip').characterCounter();
        $('input#input_text, input#marca').characterCounter();
        $('input#input_text, input#contenido').characterCounter();
        $('input#input_text, input#descripcion').characterCounter();

        $('#entregas').change(function(){
            recargarEntregas();
        });

          $('#reporte').change(function(){
            recargarListaReporte();
        });

    })

   function recargarListaReporte(){
        $.ajax({
            type:"POST",
            url:"vista/generar_rep/cate_oficial.php",
            data:"reporte=" + $('#reporte').val(),
            success:function(r){
                
                $('#categoria').html(r);
                $('select').formSelect();

            }
        });
    }


</script>

<?php    if ( !empty($_SESSION["tipo_rol"]) && $_SESSION["tipo_rol"] == '2' ||  !empty($_SESSION["tipo_rol"]) && $_SESSION["tipo_rol"] == '1') { ?>

<script type="text/javascript">
    
   $(document).ready(function(){

        $('#tipo').change(function(){
            recargarLista();
        });

      

    })
    
    function recargarLista(){
        $.ajax({
            type:"POST",
            url:"vista/personal/cate.php",
            data:"tipo=" + $('#tipo').val(),
            success:function(r){
                
                $('#categoria').html(r);
                $('select').formSelect();

            }
        });
    }

    

</script>
<?php } ?>

<script src="vista/config/js/searchMenu.js"></script>