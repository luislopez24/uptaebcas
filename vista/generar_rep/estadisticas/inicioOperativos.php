<!DOCTYPE html>
<html>

<head>

  <!-- ============================================================== -->
  <!--               IMPORTACION DE CABECERA PRINCIPAL                -->
  <!-- ============================================================== -->
   <script src='vista/config/libreria/jspdf/dist/jspdf.debug.js' type='text/javascript'></script>
   <script type="text/javascript" src="vista/config/libreria/jspdf/examples/js/basic.js"></script>

  <?php require_once 'vista/publico/Head.php'; 
  ?>
  <script type="text/javascript" src="vista/config/js/alertas.js"></script>
  <script type="text/javascript" src="vista/config/js/validacion_act_usu.js"></script>
  
  
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
          <center><span class="card-title"><h7>Operativos realizados</h7></span></center>
        </div>
      </div>
      <br>
      <div class="col s1 m1"></div>
      <div class="col s10 m10">
       <div class="card horizontal">
        <div style="width: 20%; margin-left: 3%">

          <form>
            <br>
            <label>Año</label>

            <select id="year" name="year">
             <option disabled selected>Seleccione el año</option>
             <option value="<?php echo $dateA;?>"><?php echo $dateA;?></option>

             <?php $a = $dateA;   

             $datos=array( 

               0=>$a-1,
               1=>$a-2,
               2=>$a-3,
               3=>$a-4,
               4=>$a-5);

             foreach($datos as $a){
               ?>

               <option value="<?php echo $a;?>"><?php echo $a;?></option>
             <?php } ?>

           </select>
         
          <center>
          <a href="?url=reporte&opcion=inicioEstadisticas" class="btn waves-effect waves-light blue darken-4 white-text btn-small">Regresar</a>
        </center>

      </div>
      <div class="card-stacked">
        <div class="card-content">
         <center>

           <div class="col s12 m12">
            <div class="box box-primary">
             <div class="box-header with-border">
              # Operativos realizados 
            </div>

            

            <div class="box-body">

              <div class="chart" id="cas">
                <canvas id="grafico" name="grafico" style="width: auto; height:230px">asdsadasdad</canvas>
              </div>

            </div>

            <div id="ver" name="ver"></div>

          </div>  
        </center>

      </div>
      <div class="card-action">
        <center>
          <a data-position="bottom" data-tooltip="Exportar a PDF" class="tooltipped" id="pdf" name="pdf" href="#">PDF</a> 
          </form>
        </center>
      </div>
    </div>
  </div>
</div>
<center>
  
</center>


</div>     
</div>
</div>
</div>

<br>    

</section>

</main>

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

<script src="vista/config/js/Chart.min.js"></script>
<script src="vista/config/js/Chart.bundle.min.js"></script>


<script>

  $(document).ready(function(){

    $('#year').change(function(){
      recargarLista();
    });

  })

  function recargarLista(){
    var year =  $('#year').val(),
    estadistica = 'operativo',

  //"nombre del parámetro POST":valor (el cual es el objeto guardado en las variables de arriba)
  datos = {"year":year, "estadistica":estadistica};

  $.ajax({
    url:"controlador/estadisticaControlador.php",
    type: "POST",
    data: datos
  }).done(function(respuesta){
    if (respuesta.estado === "ok") {
      console.log(JSON.stringify(respuesta));

      var enero = respuesta.enero,
        febrero = respuesta.febrero,
          marzo = respuesta.marzo,
          abril = respuesta.abril,
           mayo = respuesta.mayo,
          junio = respuesta.junio,
          julio = respuesta.julio,
         agosto = respuesta.agosto,
     septiembre = respuesta.septiembre,
        octubre = respuesta.octubre,
      noviembre = respuesta.noviembre,
      diciembre = respuesta.diciembre;

      var ctx = document.getElementById("grafico").getContext('2d');
  var grafico = new Chart(ctx, {
    type: 'bar',
    data: {
                         labels: ["Enero",
                                  "Febrero",
                                  "Marzo",
                                  "Abril",
                                  "Mayo",
                                  "Junio",
                                  "Julio",
                                  "Agosto",
                                  "Septiembre",
                                  "Octubrte",
                                  "Noviembre",
                                  "Diciembre"],
        datasets: [{
            label: '# Operativos realizados en los 12 meses del año ' + year,
                           data: [enero,
                                  febrero,
                                  marzo,
                                  abril,
                                  mayo,
                                  junio,
                                  julio,
                                  agosto,
                                  septiembre,
                                  octubre,
                                  noviembre,
                                  diciembre],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});

    }
  });


  
}

</script>

<script type="text/javascript">
    
    $('#pdf').click(function(e){

        e.preventDefault();
        var name = prompt('¿Que nombre desea colocarle a su archivo?');
        if (name == null) { name = 'Operativos realizados CAS'; }

        
        var reportPageHeight = $('#reportPage').innerHeight();
        var reportPageWidth = $('#reportPage').innerWidth();
        var pdf = new jsPDF("1", "pt", "a4");

        pdf.setFontSize(16);
        pdf.text(218, 50, 'Reporte Estadístico');

        var canvasEl = document.querySelectorAll("canvas");


        canvasEl.forEach(function(canvas, index){
        canvas.getContext('2d').fillRect(0, 0, 0*(index+1), 0*(index+1));
          
      
        pdf.addImage(canvas.toDataURL("image/png", 2), 'JPEG', 55, 70, canvas.reportPageWidth, canvas.reportPageHeight);
        
          if (index == canvasEl.length-1) {
            pdf.save(name + ".pdf");
          } else {
            pdf.addPage();
          }
        })

    });

  </script>

</body>
</html>

