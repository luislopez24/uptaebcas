<?php

  require_once 'BD/conexion.php';
 
  class Bitacora extends BD {
  
   private $id_usuario_sistema;
   private $fecha;
   private $hora;
   private $accion;
   private $ip_address;
   private $conex;
 
   // Inicio del constructor
   public function __construct(){
    
    $this->conex = parent::__construct(); 
   }
   
   public function Add(){

    $strSql = 'INSERT INTO bitacora(id_usuario_sistema,
                                    fecha,
                                    hora,
                                    accion,
                                    ip_address)
                           VALUES (:id_usuario_sistema,
                                   :fecha,
                                   :hora,
                                   :accion,
                                   :ip_address)'; 

               $respuestaArreglo = '';  
                try {

                  $strExec = BD::prepare($strSql);  
                  $strExec->bindParam(':id_usuario_sistema',$this->id_usuario_sistema);
                  $strExec->bindParam(':fecha',$this->fecha);
                  $strExec->bindParam(':hora',$this->hora);
                  $strExec->bindParam(':accion',$this->accion);
                  $strExec->bindParam(':ip_address',$this->ip_address);

                  $strExec->execute(); 
                  $respuestaArreglo = $strExec->fetchAll(); 
                  $respuestaArreglo += ['estatus' => true];
                 
                 return $respuestaArreglo ;

                } catch (PDOException $e) { 
                  $errorReturn = ['estatus' => false];
                  $errorReturn += ['info' => "error sql:{$e}"];

                  return $errorReturn;
                }

          }//Fin

           public function consultarBitacora(){
              $strSql = "SELECT * FROM bitacora 
                             LEFT JOIN usuario 
                                    ON bitacora.id_usuario_sistema = usuario.id_usuario 
                             LEFT JOIN roles 
                                    ON roles.idRol = usuario.tipo_rol
                              ORDER BY id_bitacora DESC ";
              $respuestaArreglo = '';
              try {
                $strExec = BD::prepare($strSql);
                $strExec->execute();
                 $strExec ->setFetchMode(PDO::FETCH_ASSOC);
                $respuestaArreglo = $strExec->fetchAll(PDO::FETCH_ASSOC); //retornamos todos los datos de la ejecucion
              return $respuestaArreglo;
              } catch (PDOException $e) { //si hay un error en la instruccion sql entramos en el catch
                $errorReturn += ['info' => "error sql:{$e}"];
                return $errorReturn; //retornamos el contenido de esa variable
              }// fin del catch
          }// fin del metodo consultar

          public function consultarBitacoraPorFecha($fechai , $fechaf){
              $strSql = "SELECT * FROM bitacora 
                             LEFT JOIN usuario 
                                    ON bitacora.id_usuario_sistema = usuario.id_usuario 
                             LEFT JOIN roles 
                                    ON roles.idRol = usuario.tipo_rol
                                 WHERE fecha BETWEEN '$fechai' AND '$fechaf'
                              ORDER BY id_bitacora DESC ";
              $respuestaArreglo = '';
              try {
                $strExec = BD::prepare($strSql);
                $strExec->execute();
                 $strExec ->setFetchMode(PDO::FETCH_ASSOC);
                $respuestaArreglo = $strExec->fetchAll(PDO::FETCH_ASSOC); //retornamos todos los datos de la ejecucion
              return $respuestaArreglo;
              } catch (PDOException $e) { //si hay un error en la instruccion sql entramos en el catch
                $errorReturn += ['info' => "error sql:{$e}"];
                return $errorReturn; //retornamos el contenido de esa variable
              }// fin del catch
          }// fin del metodo consultar

           public function consultarBitacoraIndividual($id){
              $strSql = "SELECT * FROM bitacora 
                             LEFT JOIN usuario 
                                    ON bitacora.id_usuario_sistema = usuario.id_usuario 
                             LEFT JOIN roles 
                                    ON roles.idRol = usuario.tipo_rol
                                 WHERE bitacora.id_bitacora = $id
                              ORDER BY id_bitacora DESC 
                              ";
              $respuestaArreglo = '';
              try {
                $strExec = BD::prepare($strSql);
                $strExec->execute();
                 $strExec ->setFetchMode(PDO::FETCH_ASSOC);
                $respuestaArreglo = $strExec->fetchAll(PDO::FETCH_ASSOC); //retornamos todos los datos de la ejecucion
              return $respuestaArreglo;
              } catch (PDOException $e) { //si hay un error en la instruccion sql entramos en el catch
                $errorReturn += ['info' => "error sql:{$e}"];
                return $errorReturn; //retornamos el contenido de esa variable
              }// fin del catch
          }// fin del metodo consultar

      public function eliminarRegistro($id){ // metodo eliminar

        $strSql="DELETE FROM bitacora WHERE id_bitacora='$id'"; // creamos la setencia sql
        $strExec = BD::prepare($strSql);
        $strExec->execute();
       
        }

    /* 
<!-- ============================================================== -->
<!--                        METODOS SETTER                          -->
<!-- ============================================================== -->
*/  

  public function setId_usuario($id_usuario){
  $this->id_usuario_sistema=$id_usuario;}

  public function setHora($hora){
  $this->hora=$hora;}     

  public function setFecha($fecha){
  $this->fecha=$fecha;}

  public function setAccion($accion){
  $this->accion=$accion;}    

  public function setIp($ip){
  $this->ip_address=$ip;}  

/* 
<!-- ============================================================== -->
<!--                        METODOS GETTER                          -->
<!-- ============================================================== -->
*/ 

   public function getId_usuario(){
   return $this->id_usuario_sistema;}

   public function getHora(){
   return $this->hora;}

   public function getFecha(){
   return $this->fecha;}

   public function getAccion(){
   return $this->accion;}

   public function getIp(){
   return $this->ip_address;}

}


    