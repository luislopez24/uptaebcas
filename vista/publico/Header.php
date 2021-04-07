
<!-- ============================================================== -->
<!--------------------------- BARRA LATERAL------------------------ -->
<!-- ============================================================== -->

<!--************************************************************************************************************************************-->

<!-- ============================================================== -->
<!-- ESTILO DEL SCROLL DE LA BARRA -->
<!-- ============================================================== -->

<?php require_once'vista/config/css/styleHeader.php'; ?>

<!-- ============================================================== -->
<!-- FIN ESTILO DEL SCROLL -->
<!-- ============================================================== -->

<!--************************************************************************************************************************************-->

<!-- ============================================================== -->
<!-- MENU DESPLEGABLE IZQUIERDO -->
<!-- ============================================================== -->

<header>

 <ul id="dropdown1" class="dropdown-content">

   <li><a href="?url=inicio&opcion=destroid">Cerrar sesión</a></li>

 </ul>

 <ul id="notification" class="dropdown-content" style="border-style: none!important;">
 
 <center style="margin-right: 10px; margin-left: 10px"><p style="color: black; height: 50px; margin-top: -10px">Tienes <b style="color: red; "><?php echo $contBuzonNotificaciones;?></b> <?php if($contBuzonNotificaciones == 1){ echo "nueva notificación";}else { echo "nuevas notificaciones";}?></p></center>
   <div class="divider"></div>

    <?php if(!empty($contBuzonNotificaciones)){?>
   <table class="highlight"  cellspacing="0" style="margin-right: 15px; border-style: none!important;">
    
    <tbody>
      
      <?php foreach($mensajesBuzonNotificacion as $msj){ if($msj['leido'] == 0){ 

        $string = $msj['mensaje'];

        $string= substr($string, 0, 18);
        $n_s = strlen($string);

        if ($n_s > 15) {
          
          $string = $string."..";

        }

        $f = $msj['fecha']; 
        $Mensajefecha = date('Y-m-d',strtotime($f));    
        $Mensajehora = date('H:i:s',strtotime($f)); 

        if ($Mensajefecha == $date) {
          
          $fr = $Mensajehora;

        }else{

            $fr = $Mensajefecha;
            
        }
        
      ?>

     <tr onClick="document.location.href='?url=notificacion&opcion=verMensajeBuzon&idMensaje=<?php echo $msj['idBuzon'];?>&direc=noti&view=1'" style="border-style: none!important;">
        <td  class="waves-effect waves-block waves-light">
         <p>
        <span <?php if($msj["foto_icono"] == 1){ echo "class='floating icon-hourglass_empty prefix' id='two'";} if($msj["foto_icono"] == 2){ echo "class='floating icon-today prefix' id='three'";} if($msj["foto_icono"] == 3){ echo "class='floating icon-settings prefix' id='four'";} ?> style="height:auto; margin-right: 10px; margin-left: 10px; margin-top: -2px; float:left;"></span>
        <p style="margin-top: -35px; color: black; font-size: 13px">
          <b><?php echo $msj['asunto'];?></b> <p style="color: black; margin-top: -46px; font-size: 13px"><?php echo $string;?></p><p style="color: red; margin-top: -46px; font-size: 13px; height: 30px!important"><?php if ($Mensajefecha == $date) { echo  "Hoy a las ".$Mensajehora; } else { echo $Mensajefecha." / ".$Mensajehora;} ?></p></p>
        </p>
        </td>   
     </tr>
     <?php } } ?>

   </tbody>
 </table>

 <?php } if($contBuzonNotificaciones==0){ ?>

  <table class="highlight"  cellspacing="0" style="margin-right: 15px;" style="border-style: none!important;">
    
    <tbody>
   
     <tr>
       
          <p style="color: black; margin-top: -2%; font-size: 13px;  margin-left: 10px;">No tiene notificaciones por leer</p></p>
        </td>   
     </tr>

   </tbody>
 </table>
<?php } ?>
    
  
 </table>
</ul>

 <ul id="message" class="dropdown-content">
 
 <center style="margin-right: 10px; margin-left: 10px;"><p style="color: black; height: 50px; margin-top: -10px">Tienes <b style="color: red; "><?php echo $contBuzonMsj;?></b> <?php if($contBuzonMsj == 1){ echo "nuevo mensaje";}else { echo "nuevos mensajes";}?></p></center>
   <div class="divider"></div>

   <?php if(!empty($contBuzonMsj)){?>
   <table class="highlight"  cellspacing="0" style="margin-right: 15px;">
    
    <tbody>
      
      <?php foreach($mensajesBuzon as $msj){ if($msj['leido'] == 0){ 

        $string = $msj['mensaje'];

        $string= substr($string, 0, 18);
        $n_s = strlen($string);

        if ($n_s > 15) {
          
          $string = $string."..";

        }

        $f = $msj['fecha']; 
        $Mensajefecha = date('Y-m-d',strtotime($f));    
        $Mensajehora = date('H:i:s',strtotime($f)); 

        if ($Mensajefecha == $date) {
          
          $fr = $Mensajehora;

        }else{

            $fr = $Mensajefecha;
            
        }
        
      ?>

     <tr onClick="document.location.href='?url=notificacion&opcion=verMensajeBuzon&idMensaje=<?php echo $msj['idBuzon'];?>&direc=imbox&view=1'">
        <td  class="waves-effect waves-block waves-light">
        <p>
        <img class="circle izquierda" src="<?php echo $msj['foto']; $status = 'Enabled'; ?>" style="width: 35px; height: 35px; margin-right: 10px; margin-left: 10px; margin-top: -2px"><p style="margin-top: -35px; color: black; font-size: 13px">
          <b><?php echo $msj['nombre']." ".$msj['apellido']; ?></b> <p style="color: black; margin-top: -46px; font-size: 13px"><?php echo $string;?></p><p style="color: red; margin-top: -46px; font-size: 13px; height: 30px!important"><?php if ($Mensajefecha == $date) { echo  "Hoy a las ".$Mensajehora; } else { echo $Mensajefecha." / ".$Mensajehora;} ?></p></p>
        </p>
        </td>   
     </tr>
     <?php } } ?>

   </tbody>
 </table>
 <?php } if($contBuzonMsj==0){ ?>

  <table class="highlight"  cellspacing="0" style="margin-right: 15px;">
    
    <tbody>
   
     <tr>
       
          <p style="color: black; margin-top: -2%; font-size: 13px;  margin-left: 10px;">No tiene mensajes por leer</p></p>
        </td>   
     </tr>

   </tbody>
 </table>
<?php } ?>

</ul>

<nav>               

 <div class="nav-wrapper blue darken-4">

  <ul class="brand-logo">
    <li><a href="?url=inicio&opcion=index" style="margin-left: 10px;"><font face="cookie" size="7" color="white"><?php if(isset($_GET['mensaje'])){?> Bienvenid@ <?php }else{echo 'Cas';} ?> <?php  ?></font></a>
    </li>
  </ul>

  <!--ICONO A PULSAR EN EL MOBIL PARA DESPLEGAR EL MENÚ-->
  <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="icon-menu prefix"></i></a>

  <!--DESAPARECE AL REDUCIR EL TAMAÑO DE LAS PANTALLAS-->
  <ul class="right hide-on-med-and-down">  

    <?php if($_GET["url"] != "notificacion"){ ?>
    <li><a class="dropdown-trigger" href="#!" data-target="notification"><i class="icon-chat_bubble prefix" style="font-size: 20px"></i></a></li>
    <li><span class="red floating Blink" id="not"style="height:auto; margin-top: 14px; margin-left: -28px; float:right;"><?php if(!empty($contBuzonNotificaciones)) { echo $contBuzonNotificaciones;} ?></span></li>
    <li><a class="dropdown-trigger" href="#!" data-target="message"><i class="icon-markunread prefix" style="font-size: 20px"></i></a></li>
    <li><span class="red floating <?php if(!empty($contBuzonMsj)) { ?>Blink <?php }?> " id="not"style="height:auto; margin-top: 14px; margin-left: -28px; float:right;"><?php if(!empty($contBuzonMsj)) { echo $contBuzonMsj;} ?></span></li>
    <?php } ?>
    
    <!--SE LLAMA AL CONTENIDO DEL DROPDOWN-->
    <li><a class="dropdown-trigger" href="#!" data-target="dropdown1"><i class="icon-more_vert prefix"></i></a></li>
  </ul>
</div>

</nav>



<!-- ============================================================== -->
<!-- FIN MENU DESPLEGABLE -->
<!-- ============================================================== -->

<!--************************************************************************************************************************************-->

<!-- ============================================================== -->
<!--                  INICIO DEL NAVBAR PARA LA WEB                 -->
<!-- ============================================================== -->

<!--************************************************************************************************************************************-->

<!--COLUMNA IZQUIERDA ESTATICA-->

<ul class="sidenav sidenav-fixed" id="mobile-demo">

  <div class="collection">
   <li><div class="user-view">
    <div class="background">
      <img src="vista/config/img/back.bmp" style="height: 200px; width: auto; margin-left: -80px">
    </div>
    <a href="?url=usuario&opcion=buscar_perfil&id_header=true"><img class="circle" src="<?php if(isset($_SESSION['foto'])){ echo $_SESSION['foto'];} else{ echo 'vista/config/img/user3.png';} ?>"></a>
    <a href="#"><span class="black-text name"><?php echo $_SESSION['nombre']." ".$_SESSION['apellido'];?></span></a>
    <a href="#"><span class="black-text email"><?php echo $_SESSION['correo'].$_SESSION['tcorreo'];?></span></a>
  </div>
</li>

<li class="">
  <form>
    <div class="row">
      <div class="input-field col s10">
        <input type="search" name="verga" id="verga" required style="border: 0; height: 20px; margin-left: 17px" placeholder="Search" autocomplete="off">      
      </div>
      <div class="input-field col s2"><i class="icon-search prefix" style="margin-top: -10px; position: absolute; font-size: 24px;
      "></i></div>
    </div>
  </form>

</li>

<?php require_once 'vista/config/private/permisos.php'; ?>

<div class="divider" style="margin-top: -20px;"></div>

<table id="tab" style="margin-left: 30px; font-size: 13px; display: none">

  <tbody>

    <?php if(isset($registrarUsuario)){ ?>
      <tr style="border-style: none!important;">
        <td><a href='?url=usuario&opcion=formulario_registro'>Registrar usuario</a></td>
      </tr>

    <?php } if(isset($modificarUsuario) || isset($eliminarUsuario)){ ?>
      <tr style="border-style: none!important;">
        <td><a href='?url=usuario&opcion=consultar-usuarios'>Consultar usuario</a></td>
      </tr>

    <?php } if(isset($registrarBeneficiario)){ ?>
      <tr style="border-style: none!important;">
        <td><a href='?url=usuario&opcion=formularioPersonal'>Registrar beneficiario</a></td>
      </tr>

    <?php } if(isset($modificarBeneficiario) || isset($eliminarBeneficiario)){ ?>  
      <tr style="border-style: none!important;">
        <td><a href='?url=usuario&opcion=consultarpersonal'>Consultar beneficiario</a></td>
      </tr>

    <?php } if(isset($registrarOperativo)){ ?>
      <tr style="border-style: none!important;">
        <td><a href='?url=operativo&opcion=formularioOperativo'>Registrar operativo</a></td>
      </tr>

    <?php } if(isset($modificarOperativo) || isset($eliminarOperativo) || isset($addProductosOperativo)){ ?>
      <tr style="border-style: none!important;">
        <td><a href='?url=operativo&opcion=consultarOperativos'>Consultar operativo</a></td>
      </tr>

    <?php } if(isset($publicarOperativo)){ ?>
      <tr style="border-style: none!important;">
        <td><a href='?url=operativo&opcion=inicioPublicar'>Publicar operativo</a></td>
      </tr>

    <?php } if(isset($registrarClasificacion) || isset($modificarClasificacion) || isset($eliminarClasificacion) || isset($registrarCatalogo) || isset($modificarCatalogo) || isset($eliminarCatalogo) || isset($registrarDiversidad) || isset($modificarDiversidad) || isset($eliminarDiversidad)){ ?>
      <tr style="border-style: none!important;">
        <td><a href='?url=clasificacion&opcion=administrarClasificacion&cata=false'>Gestionar clasificación</a></td>
      </tr>

    
      <?php } if(isset($generarReporte)){ ?>
      <tr style="border-style: none!important;">
        <td><a href='?url=reporte&opcion=inicioReporte'>Generar reporte</a></td>
      </tr>
    <?php } ?>

    <?php if(isset($verEstadisticas)){ ?>
      <tr style="border-style: none!important;">
        <td><a href='?url=reporte&opcion=inicioEstadisticas'>Estadisticas</a></td>
      </tr>
    <?php } ?>

    <?php if(isset($distribuirOperativo)){ ?>
      <tr style="border-style: none!important;">
        <td><a href='?url=operativo&opcion=inicioDistribucion'>Distribuir operativo</a></td>
      </tr>
    <?php } ?>

    <tr style="border-style: none!important;">
      <td><a href='?url=usuario&opcion=contacto_ayuda'>Contactar administrador</a></td>
    </tr>

    <?php if(isset($verBitacoras) || isset($eliminarBitacoras)){ ?>
      <tr style="border-style: none!important;">
        <td><a href='?url=seguridad&opcion=inicioBitacora'>Bitácora</a></td>
      </tr>

    <?php } if(isset($segAvanzada)){ ?>
      <tr style="border-style: none!important;">
        <td><a href="?url=seguridad&opcion=inicioSeguridadAvanzada">Seguridad avanzada</a></td>
      </tr>
    <?php } ?>

    <?php $rol = $_SESSION['tipo_rol']; if($rol == '3' || $rol == '2' || $rol == '1' ){  ?>

      <tr style="border-style: none!important;">
        <td><a href='vista/config/doc/Manual del Usuario.pdf' target="_blank">Descargar Manual de Usuario</a></td>
      </tr> 

    <?php } else{ ?>

      <tr style="border-style: none!important;">
        <td><a href='vista/config/doc/Manual del beneficiario.pdf' target="_blank">Descargar Manual de Beneficiario</a></td>
      </tr> 

    <?php } ?>

    <tr style="border-style: none!important;">
      <td><a href='?url=notificacion&opcion=buzon'>Buzón</a></td>
    </tr>  

    <tr style="border-style: none!important;">
      <td><a href='?url=usuario&opcion=buscar_perfil&id_header=true'>Ver perfil</a></td>
    </tr> 

    <tr style="border-style: none!important;">
      <td><a href='?url=usuario&opcion=editarPerfil'>Editar perfil</a></td>
    </tr>  

    <tr style="border-style: none!important;">
      <td><a href='?url=inicio&opcion=destroid'>Cerrar sesión</a></td>
    </tr>  

    

  </tbody>

</table>

<li class="<?php if($_GET['opcion'] =='index' || $_GET['url'] =='con_operativo_inicio' || $_GET['opcion'] == 'consulta_operativo_index'){ echo 'active'; } ?>"><a href="?url=inicio&opcion=index" class="waves-effect waves-brown" id="color">Inicio</a></li>

<!-- INICIA FILTRADO -->

<ul class="collapsible collapsible-accordion">

  <?php if(isset($mUsuario)){ ?>
    <li class="bold <?php if($_GET['opcion'] =='formulario_registro'  
    || $_GET['opcion'] =='consultar-usuarios'
    || $_GET['opcion'] =='modificar_usuario'  
    || $_GET['pag'] =='usuario'
    || $_GET['tipo'] == 'usuario'
    ){ echo 'active'; }?>" id="hola"><a class="collapsible-header waves-effect waves-brown" tabindex="0" id="hola">Usuario</a>

    <div class="collapsible-body">
      <ul>

        <?php if(isset($registrarUsuario)){ ?>
          <li class="<?php if($_GET['opcion'] =='formulario_registro'){ echo 'active';}?>"><a class="waves-effect waves-brown" href="?url=usuario&opcion=formulario_registro" id="color">Registrar usuario</a></li>
        <?php } ?>

        <?php if(isset($modificarUsuario) || isset($eliminarUsuario)){ ?>
          <li class="<?php if($_GET['opcion'] =='consultar-usuarios'
          || $_GET['opcion'] =='modificar_usuario'  
          || $_GET['pag'] =='usuario'
          || $_GET['tipo'] == 'usuario'){ echo 'active';}?>"><a class="waves-effect waves-brown" href="?url=usuario&opcion=consultar-usuarios" id="color">Consultar usuario</a></li>
        <?php } ?>

      </ul>
    </div>
  </li>
  
<?php } ?>

</ul>   

<?php if(isset($mBeneficiario)){ ?>
  <ul class="collapsible collapsible-accordion">

    <li class="bold <?php if($_GET['opcion'] =='formularioPersonal'
    || $_GET['opcion'] =='consultarpersonal'
    || $_GET['opcion'] =='modificar_personal'
    || $_GET['pag'] =='beneficiario'
    || $_GET['opcion'] =='consultarPersonal'
    || $_GET['tipo'] == 'beneficiario'
    ){ echo 'active'; }?>" id="hola"><a class="collapsible-header waves-effect waves-brown" tabindex="0">Beneficiario</a>
    <div class="collapsible-body">
      <ul>

        <?php if(isset($registrarBeneficiario)){ ?>
          <li class="<?php if($_GET['opcion'] =='formularioPersonal'){ echo 'active';}?>"><a class="waves-effect waves-brown" href="?url=usuario&opcion=formularioPersonal" id="color">Registrar beneficiario</a></li>
        <?php } ?>

        <?php if(isset($modificarBeneficiario) || isset($eliminarBeneficiario)){ ?>  
          <li  class="<?php if($_GET['opcion'] =='consultarpersonal'
          || $_GET['opcion'] =='modificar_personal'
          || $_GET['pag'] =='beneficiario'
          || $_GET['opcion'] =='consultarPersonal'
          || $_GET['tipo'] == 'beneficiario'){ echo 'active';}?>"><a class="waves-effect waves-brown" href="?url=usuario&opcion=consultarpersonal" id="color">Consultar beneficiario</a></li>
        <?php } ?>

      </ul>
    </div>
  </li>

</ul>
<?php } 

if(isset($mOperativo)){ ?>

  <ul class="collapsible collapsible-accordion"> 

    <li class="bold <?php if($_GET['opcion'] =='operativo'
    || $_GET['opcion'] =='formularioOperativo'
    || $_GET['opcion'] =='consultarProductos'
    || $_GET['opcion'] =='carrito'
    || $_GET['opcion'] =='diversidadesCarrito'
    || $_GET['opcion'] =='registroFinal'
    || $_GET['opcion'] =='inicioPublicar'
    || $_GET['opcion'] =='consultarOperativos'
    || $_GET['opcion'] =='administrarClasificacion'
    || $_GET['opcion'] =='consultarPuro'
    || $_GET['opcion'] =='conDiversidad'
    || $_GET['opcion'] =='inicioDistribucion' 
    || $_GET['opcion'] =='distribuirBeneficiado'
    || $_GET['opcion'] == 'inicioPago' 
    || $_GET['opcion'] == 'formularioPago' 
    || $_GET['opcion'] == 'consultarPagos'  
    || $_GET['opcion'] == 'modificarPago' 
    || $_GET['dis'] == 'true'
    ){ echo 'active'; }?>" id="hola"><a class="collapsible-header waves-effect waves-brown" tabindex="0">Operativo</a>
    <div class="collapsible-body">


      <ul>

        <?php if(isset($registrarOperativo) || isset($modificarOperativo) || isset($eliminarOperativo) || isset($addProductosOperativo) || isset($publicarOperativo)){ ?>
          <li class="<?php if($_GET['opcion'] =='operativo'
          || $_GET['opcion'] =='formularioOperativo'
          || $_GET['opcion'] =='carrito'
          || $_GET['opcion'] =='diversidadesCarrito'
          || $_GET['opcion'] =='consultarOperativos'
          || $_GET['opcion'] =='inicioPublicar'
          || $_GET['opcion'] =='registroFinal'){ echo 'active';}?>"><a class="waves-effect waves-brown" href="?url=operativo&opcion=operativo" id="color">Administrar operativo</a></li>
        <?php } ?>

        <?php if(isset($registrarClasificacion) || isset($modificarClasificacion) || isset($eliminarClasificacion) || isset($registrarCatalogo) || isset($modificarCatalogo) || isset($eliminarCatalogo) || isset($registrarDiversidad) || isset($modificarDiversidad) || isset($eliminarDiversidad)){ ?>

          <li  class="<?php if($_GET['opcion'] =='administrarClasificacion'
          || $_GET['opcion'] =='consultarPuro'
          || $_GET['opcion'] =='consultarProductos'
          || $_GET['opcion'] =='conDiversidad'){ echo 'active';}?>"><a class="waves-effect waves-brown" href="?url=clasificacion&opcion=administrarClasificacion&cata=false" id="color">Gestionar clasificación</a></li>

        <?php } ?>

        <?php if(isset($distribuirOperativo)){ ?>
         <li  class="<?php if($_GET['opcion'] =='inicioDistribucion' 
         || $_GET['opcion'] =='distribuirBeneficiado'
         || $_GET['dis'] == 'true'){ echo 'active';}?>"><a class="waves-effect waves-brown" href="?url=operativo&opcion=inicioDistribucion" id="color">Distribuir operativo</a></li>

       <?php } if(isset($registrarPago)){ ?>
         <li class="<?php if($_GET['opcion'] == 'formularioPago'){ echo 'active';}?>"><a class="waves-effect waves-brown" href="?url=beneficiario&opcion=formularioPago" id="color">Registrar pago</a></li>

       <?php } if(isset($registrarPago)){ ?>
         <li class="<?php if( $_GET['opcion'] == 'consultarPagos' || $_GET['opcion'] == 'modificarPago'){ echo 'active';}?>"><a class="waves-effect waves-brown" href="?url=beneficiario&opcion=consultarPagos" id="color">Consultar pagos</a></li>
       <?php } ?>
     </ul>
   </div>

 </li>
</ul>

<?php } ?>

<li class="<?php if($_GET['opcion'] =='verMensajeBuzon' 
         || $_GET['opcion'] =='buzon'
         || $_GET['opcion'] =='notificacionBuzon'
         || $_GET['opcion'] =='enviadosBuzon'
         || $_GET['opcion'] =='favoritosBuzon' 
         || $_GET['opcion'] =='archivadosBuzon' 
         || $_GET['opcion'] =='actualizarDesarchivar' 
         || $_GET['opcion'] =='actualizarArchivar'
         || $_GET['opcion'] =='eliminarMsj'
         || $_GET['opcion'] =='redactar'
         || $_GET['opcion'] =='actualizarFavorito'){ echo 'active';}?>""><a href="?url=notificacion&opcion=buzon" class="waves-effect waves-brown" id="color"><span class="">Buzón  <?php $totalmsj = $contBuzonNotificaciones + $contBuzonMsj; if($_GET["url"] != "notificacion" && $totalmsj >0){ ?><span class="new badge" data-badge-caption="" style="background-color: #f5153d;border-radius: 3em;"><?php echo $totalmsj;?></span><?php } ?></span></a></li>

<div class="divider" style="margin-top: 0px"></div>

<ul class="collapsible collapsible-accordion">

  <?php if(isset($mSegurity)){ ?>
    <li class="bold <?php if($_GET['opcion'] =='inicioBitacora'
    || $_GET['opcion'] == 'consultarFechasBitacoras'
    || $_GET['opcion'] =='inicioSeguridadAvanzada'
    || $_GET['opcion'] =='inicioRoles'
    || $_GET['opcion'] =='inicioAdminUsuarios'
    || $_GET['opcion'] =='consultarUsuarios'
    || $_GET['opcion'] =='consultarPermisos'  

    ){ echo 'active'; }?>" id="hola"><a class="collapsible-header waves-effect waves-brown" tabindex="0">Seguridad</a>

    <div class="collapsible-body">
      <ul>

        <?php if(isset($verBitacoras) || isset($eliminarBitacoras)){ ?>
          <li class="<?php if($_GET['opcion'] =='inicioBitacora' || $_GET['opcion'] == 'consultarFechasBitacoras'){ echo 'active';}?>"><a class="waves-effect waves-brown" href="?url=seguridad&opcion=inicioBitacora" id="color">Bitácora</a></li>

        <?php } if(isset($segAvanzada)){ ?>
          <li  class="<?php if($_GET['opcion'] =='inicioSeguridadAvanzada'|| $_GET['opcion'] =='inicioRoles' || $_GET['opcion'] =='inicioAdminUsuarios'|| $_GET['opcion'] =='consultarUsuarios' || $_GET['opcion'] =='consultarPermisos'  ){ echo 'active';}?>"><a class="waves-effect waves-brown" href="?url=seguridad&opcion=inicioSeguridadAvanzada" id="color">Seguridad avanzada</a></li>
        <?php } ?>

      </ul>
    </div>
  </li>
<?php } ?>

</ul>

<div class="divider" style="margin-top: 0px"></div>

<ul class="collapsible collapsible-accordion">

  <?php if(isset($mReporte)){ ?>
    <li class="bold <?php if($_GET['opcion'] =='inicioReporte'  || $_GET['opcion'] =='inicioBeneficioLo'  || $_GET['opcion'] =='inicioDineroI' || $_GET['opcion'] =='inicioEstadisticas' || $_GET['opcion'] =='inicioBeneficio'|| $_GET['opcion'] =='inicioOperativos'){ echo 'active'; }?>" id="hola"><a class="collapsible-header waves-effect waves-brown" tabindex="0">Reporte</a>

      <div class="collapsible-body">
        <ul>

          <?php if(isset($verEstadisticas)){ ?>
            <li class="<?php if($_GET['opcion'] =='inicioEstadisticas' || $_GET['opcion'] =='inicioOperativos' || $_GET['opcion'] =='inicioDineroI' || $_GET['opcion'] =='inicioBeneficioLo' || $_GET['opcion'] =='inicioBeneficio'){ echo 'active';}?>"><a class="waves-effect waves-brown" href="?url=reporte&opcion=inicioEstadisticas" id="color">Estadisticas</a></li>

          <?php } if(isset($generarReporte)){ ?>
            <li  class="<?php if($_GET['opcion'] =='inicioReporte'){ echo 'active';}?>"><a class="waves-effect waves-brown" href="?url=reporte&opcion=inicioReporte" id="color">Generar reporte</a></li>
          <?php } ?>

        </ul>
      </div>
    </li>
  <?php } ?>

</ul>

<!--HASTA AQUI LLEGA LA CLASIFICACIÓN DE ROLES-->

<ul class="collapsible collapsible-accordion">

  <li class="bold <?php if($_GET['id_header'] =='true'
  || $_GET['opcion'] =='editarPerfil'
  ){ echo 'active'; } ?>" id="hola"><a class="collapsible-header waves-effect waves-brown" tabindex="0">Perfil</a>

  <div class="collapsible-body">
    <ul>

      <li class="<?php if($_GET['id_header'] =='true'){ echo 'active'; } ?>">
        <a class="waves-effect waves-brown" href="?url=usuario&opcion=buscar_perfil&id_header=true" id="color">Ver perfil</a>
      </li>

      <li class="<?php if($_GET['opcion'] =='editarPerfil'){ echo 'active'; } ?>">
        <a class="waves-effect waves-brown" href="?url=usuario&opcion=editarPerfil" id="color">Editar perfil</a>
      </li>

    </ul>
  </div>
</li>

</ul>

<div class="divider" style="margin-top: 0px"></div>

<!--MODULO DE AYUDA-->
<ul class="collapsible collapsible-accordion">

  <li>

    <li class="bold <?php if($_GET['opcion'] =='contacto_ayuda' 
    ){ echo 'active'; }?>" id="hola"><a class="collapsible-header waves-effect waves-brown" tabindex="0" id="hola">Ayuda</a> 

    <div class="collapsible-body">

     <ul>

      <li class="<?php if($_GET['opcion'] =='contacto_ayuda'){ echo 'active';}?>">
        <a class="waves-effect waves-brown" href="?url=usuario&opcion=contacto_ayuda" id="color">Contactar administrador</a>  </li>

        <li>

          <?php if($_SESSION['tipo_rol'] == '1' || $_SESSION['tipo_rol'] == '2' || $_SESSION['tipo_rol'] == '3'){
            ?>

            <a class="waves-effect waves-brown" target="_blank" href="vista/config/doc/Manual del Usuario.pdf" id="color">Descargar Manual de Usuario</a>  </li>

          <?php } else{
            ?>
            <li>
              <a class="waves-effect waves-brown" target="_blank" href="vista/config/doc/Manual del beneficiario.pdf" id="color">Descargar Manual de Beneficiario</a> </li>

            </ul>  
          </div>

        <?php } ?>

      </li>

    </ul> 

    <!--FIN MODULO AYUDA-->

    <div class="divider" style="margin-top: 0px;"></div>

    <li>

     <a class="waves-effect waves-brown" href="?url=inicio&opcion=destroid">Cerrar sesión</a>

   </li>
 </ul>
 <!--FINAL DE NAVEGACION LATERAL-->

 <!-- ============================================================== -->
 <!-- FINAL DEL NAVBAR -->
 <!-- ============================================================== -->
</header>


