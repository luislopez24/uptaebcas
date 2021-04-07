<?php

  require_once 'BD/conexion.php';
 
  class Producto extends BD {
     
     private $nombre_clasificacion;
     
     private $conex;
     private $delete;
   
     public function __construct(){
                     
                 $this->conex = parent::__construct();
                
      }// fin del constructor

     // METODOS SETTER
     public function setnombre_clasificacion($nomb){
       $this->nombre_clasificacion=$nomb;}
              
              
     // METODOS GETTER
     public function getnombre_clasificacion(){
       return $this->nombre_clasificacion;}
              
     //  CRUD
        public function eliminar($id){ // metodo eliminar

        $strSql="DELETE FROM clasificacion WHERE id_clasificacion='$id'"; // creamos la setencia sql
        $strExec = BD::prepare($strSql);
        $strExec->execute();
       
        }
        
        public function Buscar_producto_($nomb){
              $strSql = "SELECT * FROM producto WHERE nombre_producto ='$nomb'";
              $respuestaArreglo = '';
                   try {
                $strExec =  BD::prepare($strSql);
                $strExec->execute();
              $strExec ->setFetchMode(PDO::FETCH_ASSOC);
                $respuestaArreglo = $strExec->fetchAll(PDO::FETCH_ASSOC); //retornamos todos los datos de la ejecucion
                $respuestaArreglo += ['estatus' => "true"];
              return $respuestaArreglo;
              } catch (PDOException $e) { //si hay un error en la instruccion sql entramos en el catch
                $errorReturn = ['estatus' => "false"];
                $errorReturn += ['info' => "error sql:{$e}"];
                return $errorReturn; ; //retornamos el contenido de esa variable
              }// fin del catch
          }// fin del metodo Buscar

   

        public function consultar($id){
              $strSql = "SELECT * FROM producto
                            INNER JOIN catalogo
                                    ON producto.id_catalogo = catalogo.id_catalogo
                                 WHERE producto.id_catalogo = '$id'";
              $respuestaArreglo = '';
              try {
                $strExec = BD::prepare($strSql);
                $strExec->execute();
                 $strExec ->setFetchMode(PDO::FETCH_ASSOC);
                $respuestaArreglo = $strExec->fetchAll(PDO::FETCH_ASSOC); //retornamos 


                //todos los datos de la ejecucion
                
              return $respuestaArreglo;
              
              } catch (PDOException $e) { //si hay un error en la instruccion sql entramos en el catch
                $errorReturn = ['estatus' => false];
                $errorReturn += ['info' => "error sql:{$e}"];
                return $errorReturn; //retornamos el contenido de esa variable
              }// fin del catch
          }// fin del metodo consultar

        
      
         

        //Para evitar registrar en el operativo un tipo de operativo que no tenga productos
        public function clasificacion_operativo(){
              $strSql = "SELECT id_clasificacion, 
                                nombre_clasificacion 
                           FROM clasificacion
                     INNER JOIN producto
                             ON clasificacion.id_clasificacion = producto.id_clasificacion_producto
                     INNER JOIN inventario
                             ON producto.id_clasificacion_producto = inventario.id_producto_
                       GROUP BY nombre_clasificacion,
                                id_clasificacion";
              $respuestaArreglo = '';
              try {
                $strExec = BD::prepare($strSql);
                $strExec->execute();
                 $strExec ->setFetchMode(PDO::FETCH_ASSOC);
                $respuestaArreglo = $strExec->fetchAll(PDO::FETCH_ASSOC); //retornamos 


                //todos los datos de la ejecucion
                
              return $respuestaArreglo;
              
              } catch (PDOException $e) { //si hay un error en la instruccion sql entramos en el catch
                $errorReturn = ['estatus' => false];
                $errorReturn += ['info' => "error sql:{$e}"];
                return $errorReturn; //retornamos el contenido de esa variable
              }// fin del catch
          }// fin del metodo consultar

    public function buscar($id){
      $strSql = "SELECT * from clasificacion WHERE id_clasificacion='".$id."'";
          $respuestaArreglo = '';
              
           
            try {
                
                $strExec = BD::prepare($strSql);
                    $strExec->execute();
                    $respuestaArreglo = $strExec->fetchAll(PDO::FETCH_ASSOC); //retorna
                    $strExec->execute(); 
                    
        
          } catch (PDOException $e) { //si hay un error en la instruccion sql entramos en el catch
            $errorReturn = ['estatus' => "false"];
            $errorReturn += ['info' => "error sql:{$e}"];
            return $errorReturn; ; //retornamos el contenido de esa variable
          }// fin del catch
          return $respuestaArreglo;
      }// fin del metodo Buscar

    //Para buscar un tipo de operativo de manera individual en el search
    public function buscar_clasificacion($id_tipo){
      $strSql = "SELECT * from clasificacion WHERE id_clasificacion='".$id_tipo."'";
          $respuestaArreglo = '';
              
           
            try {
                
                $strExec = BD::prepare($strSql);
                    $strExec->execute();
                    $respuestaArreglo = $strExec->fetchAll(PDO::FETCH_ASSOC); //retorna
                    $strExec->execute(); 
                    
        
          } catch (PDOException $e) { //si hay un error en la instruccion sql entramos en el catch
            $errorReturn = ['estatus' => "false"];
            $errorReturn += ['info' => "error sql:{$e}"];
            return $errorReturn; ; //retornamos el contenido de esa variable
          }// fin del catch
          return $respuestaArreglo;
      }// fin del metodo Buscar


    public function search($search){
      $strSql = "SELECT * from clasificacion WHERE nombre_clasificacion LIKE '%$search%'";
          $respuestaArreglo = '';
              
           
            try {
                
                $strExec = BD::prepare($strSql);
                    $strExec->execute();
                    $respuestaArreglo = $strExec->fetchAll(PDO::FETCH_ASSOC); //retorna
                    $strExec->execute(); 
                    
        
          } catch (PDOException $e) { //si hay un error en la instruccion sql entramos en el catch
            $errorReturn = ['estatus' => "false"];
            $errorReturn += ['info' => "error sql:{$e}"];
            return $errorReturn; ; //retornamos el contenido de esa variable
          }// fin del catch
          return $respuestaArreglo;
      }// fin del metodo Buscar

  

    //ESTE BUSCAR ES PARA MOSTRAR EL clasificacion CON TODOS SUS PRODUCTOS REGISTRADOS EN EL
    public function buscar_clasificacion_producto($id){
      $strSql = "SELECT * from clasificacion 
                    INNER JOIN producto 
                            ON clasificacion.id_clasificacion = producto.id_clasificacion_producto 
                    INNER JOIN inventario 
                            ON producto.id_producto = inventario.id_producto_
                        WHERE  id_clasificacion='".$id."'";
          $respuestaArreglo = '';
              
           
            try {
                
                $strExec = BD::prepare($strSql);
                    $strExec->execute();
                    $respuestaArreglo = $strExec->fetchAll(PDO::FETCH_ASSOC); //retorna
                    $strExec->execute(); 
                    
        
          } catch (PDOException $e) { //si hay un error en la instruccion sql entramos en el catch
            $errorReturn = ['estatus' => "false"];
            $errorReturn += ['info' => "error sql:{$e}"];
            return $errorReturn; ; //retornamos el contenido de esa variable
          }// fin del catch
          return $respuestaArreglo;
      }// fin del metodo Buscar


      public function modificar($id){

         $strSql = "UPDATE clasificacion SET nombre_clasificacion = :nombre_clasificacion WHERE id_clasificacion='$id'";
          $respuestaArreglo = '';  
              
              try {

                $strExec = BD::prepare($strSql); 
                $strExec->bindValue(':nombre_clasificacion', $this->nombre_clasificacion);
                
                $strExec->execute(); 
              
                $respuestaArreglo = $strExec->fetchAll(); //retornamos todos los datos de la ejecucion
                return $respuestaArreglo;
              
              } 

                catch (PDOException $e) { //si hay un error en la instruccion sql entramos en el catch
                $errorReturn = ['estatus' => false];
                $errorReturn += ['info' => "error sql:{$e}"];
                return $errorReturn; //retornamos el contenido de esa variable
            }
        



          }

          public function Registrar(){
            
               $strSql = 'INSERT INTO clasificacion (nombre_clasificacion) VALUES (:nombre_clasificacion)'; 
               $respuestaArreglo = '';  
                try {
                  $strExec = BD::prepare($strSql);  
                  $strExec->bindParam(':nombre_clasificacion', $this->nombre_clasificacion);
                  $strExec->execute(); 
                  $respuestaArreglo = $strExec->fetchAll(); //retornamos todos los datos de la ejecucion
                  $respuestaArreglo += ['estatus' => true];
                  return $respuestaArreglo;
                } catch (PDOException $e) { //si hay un error en la instruccion sql entramos en el catch
                  $errorReturn = ['estatus' => false];
                  $errorReturn += ['info' => "error sql:{$e}"];

                  return $errorReturn; //retornamos el contenido de esa variable
                }

          }// fin del metodo Registrar






}


    