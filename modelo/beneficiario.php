
<!-- ============================================================== -->
<!--                         MODELO BENEFICIARIO                    -->
<!-- ============================================================== -->

<?php

require_once 'BD/conexion.php';

class beneficiario extends BD {

 private $id_usu;
 private $id_ope;
 private $referencia;
 private $banco;
 private $fecha_pago ;
 private $id_usuario_;
 private $id_operativo_;
 private $fecha_entrega;
 private $estatud;

 private $conex;

     // Inicio del constructor
 public function __construct(){
  $this->conex = parent::__construct(); 
}

/* 
<!-- ============================================================== -->
<!--                           CRUD                                 -->
<!-- ============================================================== -->
*/

    public function Registrar(){

    $strSql = 'INSERT INTO operativo_usuario(id_usuario_,
                                             id_operativo_,
                                             referencia, 
                                             banco,
                                             fecha_pago, 
                                             estatud)
                                    VALUES (:id_usuario_,
                                            :id_operativo_,
                                            :referencia, 
                                            :banco, 
                                            :fecha_pago,
                                            :estatud)'; 

               $respuestaArreglo = '';  
                try {

                  $strExec = BD::prepare($strSql);  
                  $strExec->bindParam(':id_usuario_',$this->id_usuario_);
                  $strExec->bindParam(':id_operativo_',$this->id_operativo_);
                  $strExec->bindParam(':referencia',$this->referencia);
                  $strExec->bindParam(':banco',$this->banco);
                  $strExec->bindParam(':fecha_pago',$this->fecha_pago);
                  $strExec->bindParam(':estatud',$this->estatud);

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

    public function modificar($operativo){ 

         $strSql = "UPDATE operativo_usuario 
                       SET referencia = :referencia, 
                                banco = :banco, 
                           fecha_pago = :fecha_pago 
                     WHERE id_operativo_usuario = '$operativo'";

          $respuestaArreglo = '';  
              
              try {

                  $strExec=BD::prepare($strSql);  
                  $strExec->bindParam(':referencia',$this->referencia);
                  $strExec->bindParam(':banco',$this->banco);
                  $strExec->bindParam(':fecha_pago',$this->fecha_pago);

                $strExec->execute(); 
              
                $respuestaArreglo = $strExec->fetchAll(); 
                return $respuestaArreglo;
              
              } 

                catch (PDOException $e) { 
                $errorReturn = ['estatus' => false];
                $errorReturn += ['info' => "error sql:{$e}"];

                return $errorReturn;
            }

          }//Fin

    public function consultar_pagos(){
             
              $id_u = $_SESSION['id_ussuario'];
               
              $strSql="SELECT * FROM operativo_usuario  
                           LEFT JOIN usuario 
                                  ON operativo_usuario.id_usuario_ = usuario.id_usuario
                           LEFT JOIN operativo
                                  ON operativo_usuario.id_operativo_ = operativo.id_operativo
                               WHERE id_usuario_ = '$id_u'";

              $respuestaArreglo = '';
           
           try {
           
                $strExec = BD::prepare($strSql);
                $strExec->execute();
                $strExec ->setFetchMode(PDO::FETCH_ASSOC);
                $respuestaArreglo = $strExec->fetchAll(PDO::FETCH_ASSOC); 
                
              return $respuestaArreglo;
              
              } catch (PDOException $e) {

                $errorReturn = ['estatus' => false];
                $errorReturn += ['info' => "error sql:{$e}"];

                return $errorReturn; 

              }

          }//Fin

    public function modificar_estatud($id){  

         $strSql = "UPDATE operativo_usuario 
                       SET fecha_entrega=:fecha_entrega,
                           estatud=:estatud
                      WHERE id_operativo_usuario = '$id'";
          $respuestaArreglo = '';  
              
              try {

                $strExec=BD::prepare($strSql);  
                $strExec->bindParam(':fecha_entrega',$this->fecha_entrega);
                $strExec->bindParam(':estatud',$this->estatud);
                $strExec->execute(); 
              
                $respuestaArreglo = $strExec->fetchAll(); 
                return $respuestaArreglo;
              
              } 

                catch (PDOException $e) { 
                $errorReturn = ['estatus' => false];
                $errorReturn += ['info' => "error sql:{$e}"];

                return $errorReturn;
            }

          }//Fin   
        
    public function consultar($id){

              $strSql ="SELECT *FROM operativo_usuario  
                           LEFT JOIN usuario 
                                  ON operativo_usuario.id_usuario_ = usuario.id_usuario
                           LEFT JOIN operativo
                                  ON operativo_usuario.id_operativo_ = operativo.id_operativo
                               WHERE id_operativo_ = '$id'";

              $respuestaArreglo = '';
              try {
               
                $strExec = BD::prepare($strSql);
                $strExec->execute();
                $strExec ->setFetchMode(PDO::FETCH_ASSOC);
                $respuestaArreglo = $strExec->fetchAll(PDO::FETCH_ASSOC); 

              return $respuestaArreglo;
              
              } catch (PDOException $e) { 

                $errorReturn = ['estatus' => false];
                $errorReturn += ['info' => "error sql:{$e}"];

                return $errorReturn; 
              }

    }//Fin

    public function consultar_filtrado5($id, $dependencia, $depend2){
        $strSql = "SELECT * from usuario
                       LEFT JOIN operativo_usuario
                              ON operativo_usuario.id_usuario_ = usuario.id_usuario
                             AND operativo_usuario.id_operativo_ ='$id'
                           WHERE operativo_usuario.id_operativo_ IS NULL
                             AND dependencia = '$dependencia' 
                             AND area = '$depend2'";

            $respuestaArreglo = '';
            
            try {
                  
                  $strExec = BD::prepare($strSql);
                  $strExec->execute();
                  $respuestaArreglo = $strExec->fetchAll(PDO::FETCH_ASSOC); 
                  $strExec->execute(); 
                    
            } catch (PDOException $e) { 

              $errorReturn = ['estatus' => "false"];
              $errorReturn += ['info' => "error sql:{$e}"];

              return $errorReturn; 
            }

            return $respuestaArreglo;
        }//Fin
       
    public function consultar_fil($id, $dependencia){
        $strSql = "SELECT * from usuario
                       LEFT JOIN operativo_usuario
                              ON operativo_usuario.id_usuario_ = usuario.id_usuario
                             AND operativo_usuario.id_operativo_ = '$id'
                           WHERE operativo_usuario.id_operativo_ IS NULL
                             AND dependencia = '$dependencia'
                             AND usuario.tipo_rol != '3'";
            $respuestaArreglo = '';
             
              try {
                  
                  $strExec = BD::prepare($strSql);
                      $strExec->execute();
                      $respuestaArreglo = $strExec->fetchAll(PDO::FETCH_ASSOC); 
                      $strExec->execute(); 
                    
            } catch (PDOException $e) { 
              $errorReturn = ['estatus' => "false"];
              $errorReturn += ['info' => "error sql:{$e}"];

              return $errorReturn; 
            }

            return $respuestaArreglo;

        }//Fin

        public function consultarMoroso($id){
        $strSql = "SELECT * from usuario
                       LEFT JOIN operativo_usuario
                              ON operativo_usuario.id_usuario_ = usuario.id_usuario
                             AND operativo_usuario.id_operativo_ ='$id'
                           WHERE operativo_usuario.id_operativo_ IS NULL
                             AND usuario.tipo_rol != '1' 
                             AND usuario.tipo_rol != '2'
                             AND usuario.tipo_rol != '3'";
            $respuestaArreglo = '';
                
             
              try {
                  
                  $strExec = BD::prepare($strSql);
                      $strExec->execute();
                      $respuestaArreglo = $strExec->fetchAll(PDO::FETCH_ASSOC); 
                      $strExec->execute(); 
                      
          
            } catch (PDOException $e) {
              $errorReturn = ['estatus' => "false"];
              $errorReturn += ['info' => "error sql:{$e}"];

              return $errorReturn; 
            }

            return $respuestaArreglo;

        }//fin

      public function operativos_por_pagar(){

              $id = $_SESSION["id_ussuario"];

              $strSql = "SELECT * FROM operativo
                             LEFT JOIN operativo_usuario
                                    ON operativo.id_operativo = operativo_usuario.id_operativo_
                                   AND operativo_usuario.id_usuario_ = '$id'
                                 WHERE operativo_usuario.id_operativo_ is null
                                   AND operativo.estado = 'on'";

              $respuestaArreglo = '';
              try {

                $strExec = BD::prepare($strSql);
                $strExec->execute();
                $strExec ->setFetchMode(PDO::FETCH_ASSOC);
                $respuestaArreglo = $strExec->fetchAll(PDO::FETCH_ASSOC); 

              return $respuestaArreglo;

              } catch (PDOException $e) {
                $errorReturn += ['info' => "error sql:{$e}"];

                return $errorReturn;
              }

          }//fin

       
          public function consultar_filtrado($id, $dependencia,$depend2){

               $strSql="SELECT *FROM operativo_usuario  
                          RIGHT JOIN usuario 
                                  ON usuario.id_usuario = operativo_usuario.id_usuario_
                               WHERE operativo_usuario.id_operativo_ = '$id' 
                                 AND usuario.dependencia ='$dependencia'
                                 AND usuario.area='$depend2'
                                 ";

              $respuestaArreglo = '';
              try {
                $strExec = BD::prepare($strSql);
                $strExec->execute();
                 $strExec ->setFetchMode(PDO::FETCH_ASSOC);
                $respuestaArreglo = $strExec->fetchAll(PDO::FETCH_ASSOC); 

                return $respuestaArreglo;
              
              } catch (PDOException $e) { 
                $errorReturn = ['estatus' => false];
                $errorReturn += ['info' => "error sql:{$e}"];

                return $errorReturn; 
              }

          }//Fin

          public function consultar_ver($id, $dependencia){

               $strSql="SELECT *FROM operativo_usuario  
                          RIGHT JOIN usuario 
                                  ON usuario.id_usuario = operativo_usuario.id_usuario_
                               WHERE operativo_usuario.id_operativo_ = '$id' 
                                 AND usuario.dependencia ='$dependencia'";

              $respuestaArreglo = '';
              try {
             
                $strExec = BD::prepare($strSql);
                $strExec->execute();
                $strExec ->setFetchMode(PDO::FETCH_ASSOC);
                $respuestaArreglo = $strExec->fetchAll(PDO::FETCH_ASSOC);

              return $respuestaArreglo;
              
              } catch (PDOException $e) { 
                $errorReturn = ['estatus' => false];
                $errorReturn += ['info' => "error sql:{$e}"];

                return $errorReturn;

              }

          }// fin

          public function consultarOperativo_Usuario($id){

               $strSql="SELECT *FROM operativo_usuario  
                          RIGHT JOIN usuario 
                                  ON usuario.id_usuario = operativo_usuario.id_usuario_
                               WHERE operativo_usuario.id_operativo_ = '$id'";

              $respuestaArreglo = '';
              try {
                $strExec = BD::prepare($strSql);
                $strExec->execute();
                 $strExec ->setFetchMode(PDO::FETCH_ASSOC);
                $respuestaArreglo = $strExec->fetchAll(PDO::FETCH_ASSOC); 

              return $respuestaArreglo;
              
              } catch (PDOException $e) { 
                $errorReturn = ['estatus' => false];
                $errorReturn += ['info' => "error sql:{$e}"];

                return $errorReturn;
              }

          }// fin

          public function consultar_entregado(){

              $strSql="SELECT * FROM operativo_usuario";

              $respuestaArreglo = '';
              try {
               
                $strExec = BD::prepare($strSql);
                $strExec->execute();
                $strExec ->setFetchMode(PDO::FETCH_ASSOC);
                $respuestaArreglo = $strExec->fetchAll(PDO::FETCH_ASSOC); 
                $respuestaArreglo = ['estatus' => true];
                
                return $respuestaArreglo;
              
              } catch (PDOException $e) { 
                $errorReturn = ['estatus' => false];
                $errorReturn += ['info' => "error sql:{$e}"];
                return $errorReturn;

              }

          }// fin



      public function Buscar($id){
      $strSql = "SELECT * FROM operativo_usuario 
                     LEFT JOIN operativo 
                            ON operativo_usuario.id_operativo_ = operativo.id_operativo 
                         WHERE id_operativo_usuario='".$id."'";
      $respuestaArreglo = '';
          
       
        try {
            
            $strExec = BD::prepare($strSql);
            $strExec->execute();
            $respuestaArreglo = $strExec->fetchAll(PDO::FETCH_ASSOC); 
            $strExec->execute(); 
    
      } catch (PDOException $e) {

        $errorReturn = ['estatus' => "false"];
        $errorReturn += ['info' => "error sql:{$e}"];

        return $errorReturn;

      }

      return $respuestaArreglo;

     }// fin 


     public function Buscar_ref($ref){
     
      $strSql = "SELECT * FROM operativo_usuario WHERE referencia ='$ref'";
      $respuestaArreglo = '';

          try {
           
            $strExec =  BD::prepare($strSql);
            $strExec->execute();
            $strExec ->setFetchMode(PDO::FETCH_ASSOC);
            $respuestaArreglo = $strExec->fetchAll(PDO::FETCH_ASSOC); 
            $respuestaArreglo += ['estatus' => "true"];
          
            return $respuestaArreglo;

          } catch (PDOException $e) { 

            $errorReturn = ['estatus' => "false"];
            $errorReturn += ['info' => "error sql:{$e}"];

            return $errorReturn;
          }

      }// fin 

    public function Buscar_person($id_u){

        $strSql = "SELECT *FROM operativo_usuario WHERE id_usuario_ ='$id_u'";
        $respuestaArreglo = '';

        try {
            $strExec =  BD::prepare($strSql);
            $strExec->execute();
            $strExec ->setFetchMode(PDO::FETCH_ASSOC);
            $respuestaArreglo = $strExec->fetchAll(PDO::FETCH_ASSOC); //retornamos todos los datos de la ejecucion
            $respuestaArreglo += ['estatus' => "true"];
          
            return $respuestaArreglo;
          
          } catch (PDOException $e) { 

            $errorReturn = ['estatus' => "false"];
            $errorReturn += ['info' => "error sql:{$e}"];
            
            return $errorReturn;
          }

       }// fin

    
/* 
<!-- ============================================================== -->
<!--                        METODOS SETTER                          -->
<!-- ============================================================== -->
*/  

  public function setid_usu($id){
  $this->id_usu=$id;}

  public function setid_ope($id){
  $this->id_ope=$id;}
   
  public function setreferencia($ref){
  $this->referencia=$ref;}
              
  public function setfecha_pago($fecha){
  $this->fecha_pago=$fecha;}

  public function setbanco($ban){
   $this->banco=$ban;}

  public function setid_usuario_($id_usuario){
  $this->id_usuario_ = $id_usuario;}
              
  public function setid_operativo_($id_operativo){
  $this->id_operativo_ = $id_operativo;}

  public function setestatud($tatu){
  $this->estatud = $tatu;}

  public function setFechaE($date){
  $this->fecha_entrega = $date;}
              
/* 
<!-- ============================================================== -->
<!--                        METODOS GETTER                          -->
<!-- ============================================================== -->
*/ 

   public function getid_usu(){
   return $this->id_usu;}

   public function getid_ope(){
   return $this->id_ope;}
   
   public function getreferencia(){
   return $this->referencia;}
              
   public function getid_usuario_(){
   return $this->id_usuario_;}

   public function getfecha_pago(){
   return $this->fecha_pago;}

   public function getid_operativo_(){
   return $this->id_operativo_;}
             
   public function getestatud(){
   return $this->estatud;}
             
   public function getbanco(){
   return $this->banco;}

   public function getFechaE(){
   return $this->fecha_entrega;}


}