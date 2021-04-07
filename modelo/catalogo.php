
<!-- ============================================================== -->
<!--                         MODELO CATALOGO                        -->
<!-- ============================================================== -->

<?php
require_once 'BD/conexion.php';
 
   class catalogo extends BD{
     
     private $nombre_catalogo;
     private $presentacion;
     private $id_clasificacion;
     private $cantidad;

     public $conex;
     public function __construct(){
        $this->conex = parent::__construct();
    }// fin del constructor

// CRUD

    public function eliminar($id){ // metodo eliminar

        $strSql="DELETE FROM catalogo WHERE id_catalogo='$id'"; // creamos la setencia sql
        $strExec = BD::prepare($strSql);
        $strExec->execute();
       
        }
  
     public function consultar($id){
              $strSql = "SELECT *FROM catalogo 
                           INNER JOIN clasificacion
                                   ON catalogo.id_clasificacion = clasificacion.id_clasificacion
                                WHERE catalogo.id_clasificacion ='$id'";
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

       //Para el catalogo del carrito - operativo
 
     public function catalogoGeneral(){
             $strSql = "SELECT * FROM catalogo ORDER BY id_clasificacion ASC";
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

          public function buscarCatalogo($id){
              $strSql = "SELECT *FROM catalogo 
                                WHERE id_catalogo ='$id'";
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

      //PARA EL CARRITO
      public function consultar_($id, $id_o){
              $strSql = "SELECT *FROM clasificacion 
                            LEFT JOIN operativo_clasificacion
                                   ON clasificacion.id_clasificacion = operativo_clasificacion.id_clasificacion_operativo 
                                  AND operativo_clasificacion.id_operativo_nuevo = '$id_o'
                           INNER JOIN  inventario
                                   ON clasificacion.id_clasificacion = inventario.id_clasificacion_
                                WHERE id_clasificacion ='$id'";

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

     public function buscar($id){
             $strSql = "SELECT * FROM producto WHERE id_catalogo='$id'";
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

      public function buscar_modificar($id){
             $strSql = "SELECT * FROM catalogo WHERE id_catalogo='$id'";
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

      public function modificarCatalogo($id_catalogo){   //funcion para modificar al usuarios
      
         $strSql = "UPDATE catalogo 
                       SET nombre_catalogo = :nombre_catalogo,
                           id_clasificacion = :id_clasificacion
                     WHERE id_catalogo='$id_catalogo'";
          $respuestaArreglo = '';   
              
              try {

                $strExec = BD::prepare($strSql); 
                $strExec->bindValue(':nombre_catalogo', $this->nombre_catalogo);
                $strExec->bindValue(':id_clasificacion', $this->id_clasificacion);
                $strExec->execute(); 
              
                $respuestaArreglo = $strExec->fetchAll(); //retornamos todos los datos de la ejecucion
                $respuestaArreglo = ['estatus' => true];
                return $respuestaArreglo;
              
              } 

                catch (PDOException $e) { //si hay un error en la instruccion sql entramos en el catch
                $errorReturn = ['estatus' => false];
                $errorReturn += ['info' => "error sql:{$e}"];
                return $errorReturn; //retornamos el contenido de esa variable
            }
        
          }

        public function modificar_c($id){   //funcion para modificar al usuarios
      
        $strSql = "UPDATE clasificacion_clasificacion SET id_clasificacion=:id_clasificacion , cantidad = :cantidad  WHERE id_clasificacion='$id'";
          $respuestaArreglo = '';  
              
              try {

                $strExec = BD::prepare($strSql); 
                $strExec->bindValue(':cantidad', $this->cantidad);
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
         $strSql = 'INSERT INTO catalogo (id_clasificacion, 
                                          nombre_catalogo) 
                                  VALUES (:id_clasificacion, 
                                          :nombre_catalogo)'; 
         $respuestaArreglo = '';  
          try {
            $strExec = BD::prepare($strSql);  
            $strExec->bindParam(':id_clasificacion', $this->id_clasificacion);
            $strExec->bindParam(':nombre_catalogo', $this->nombre_catalogo);
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

        public function titulo($id){
              $strSql = "SELECT *FROM catalogo 
                                WHERE id_catalogo ='$id'";
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
    
    public function buscar_catalogo_($descri){
              $strSql = "SELECT * FROM catalogo WHERE nombre_catalogo ='$descri'";
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

  // METODOS SETTER

    public function setnombre_catalogo($descri){
      $this->nombre_catalogo=$descri;}
    public function setPresentacion($present){
      $this->presentacion=$present;}
    public function setid_clasificacion($id){
      $this->id_clasificacion=$id;
    }

    public function setCantidad($cant){
      $this->cantidad=$cant;
    }
    
// Metodos Getter

    public function getConex(){
        return $this->conex;}
   
    public function getnombre_catalogo(){
        return $this->nombre_catalogo; }
    public function getPresentacion(){
        return $this->presentacion;   }
    public function getid_clasificacion(){
        return $this->id_clasificacion;
      }

}// FIN DE LA CLASE clasificacion
