                                      
<!-- ============================================================== -->
<!--                         MODELO DIVERSIDAD                      -->
<!-- ============================================================== -->

<?php

require_once 'BD/conexion.php';

class Diversidad extends BD{

 private $nombre_diversidad;
 private $marca;
 private $contenido;
 private $descripcion;
 private $id_catalogo;
 private $id_operativo_nuevo;
 private $id_diversidad_operativo;
 private $cantidad_por_persona;

 public $conex;

 // Inicio del constructor
 public function __construct(){
    $this->conex = parent::__construct();
 }

/* 
<!-- ============================================================== -->
<!--                           CRUD                                 -->
<!-- ============================================================== -->
*/

// Create 
   public function Registrar(){
         
             $strSql = 'INSERT INTO diversidad (id_catalogo, 
                                                nombre_diversidad,
                                                marca,
                                                contenido,
                                                descripcion) 
                                        VALUES (:id_catalogo, 
                                                :nombre_diversidad,
                                                :marca,
                                                :contenido,
                                                :descripcion)'; 
             $respuestaArreglo = '';  
             try {
           
              $strExec = BD::prepare($strSql);  
              $strExec->bindParam(':id_catalogo', $this->id_catalogo);
              $strExec->bindParam(':nombre_diversidad', $this->nombre_diversidad);
              $strExec->bindParam(':marca', $this->marca);
              $strExec->bindParam(':contenido', $this->contenido);
              $strExec->bindParam(':descripcion', $this->descripcion);
              $strExec->execute(); 
           
            $respuestaArreglo = $strExec->fetchAll(); 
            $respuestaArreglo += ['estatus' => true];
           
            return $respuestaArreglo;
          
          } catch (PDOException $e) { 
            $errorReturn = ['estatus' => false];
            $errorReturn += ['info' => "error sql:{$e}"];

            return $errorReturn; 
          }

  }//Fin 

  public function buscarDiversidades($id){
           
            $strSql = "SELECT * FROM diversidad 
                               WHERE id_catalogo = $id";
           
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

  }// Fin 
  
  public function modificarDiversidad($id){   

          $strSql = "UPDATE diversidad 
                        SET nombre_diversidad = :nombre_diversidad, 
                                        marca = :marca,
                                    contenido = :contenido,
                                  descripcion = :descripcion
                          WHERE id_diversidad ='$id'";
          $respuestaArreglo = '';  
          
          try {

            $strExec = BD::prepare($strSql); 
            $strExec->bindValue(':nombre_diversidad', $this->nombre_diversidad);
            $strExec->bindValue(':marca', $this->marca);
            $strExec->bindValue(':contenido', $this->contenido);
            $strExec->bindValue(':descripcion', $this->descripcion);

            $strExec->execute(); 
            
                $respuestaArreglo = $strExec->fetchAll(); 
                $respuestaArreglo = ['estatus' => true];
                return $respuestaArreglo;
                
              } 

                catch (PDOException $e) { 
                  $errorReturn = ['estatus' => false];
                  $errorReturn += ['info' => "error sql:{$e}"];
                return $errorReturn; 
              }
              
        }//Fin

/* 
<!-- ============================================================== -->
<!--                       TABLA PUENTE                             -->
<!-- ============================================================== -->
*/

//Funcion para no terminar el registro del operativo hasta que se le añada un producto
    public function contador_seleccionado($id_o){

            $strSql = "SELECT COUNT(id_operativo_nuevo) as contador, id_diversidad_operativo
                         FROM operativo_diversidad
                        WHERE id_operativo_nuevo = '$id_o'";

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

    public function buscar_diversidad_carrito($id_o){
           
            $strSql = "SELECT * FROM operativo 
                          INNER JOIN operativo_diversidad
                                  ON id_operativo = operativo_diversidad.id_operativo_nuevo
                               WHERE id_operativo = $id_o";
           
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

  //Consultar diversidades a añadir en el carrito 
    public function consultar_carrito($id, $id_o){
  
            $strSql = "SELECT * FROM diversidad
                           LEFT JOIN operativo_diversidad
                                  ON diversidad.id_diversidad = operativo_diversidad.id_diversidad_operativo
                                 AND operativo_diversidad.id_operativo_nuevo = '$id_o'
                               WHERE diversidad.id_catalogo = '$id'";
           
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

    public function consultar($id){
            
              $strSql = "SELECT * FROM diversidad
                            INNER JOIN catalogo
                                    ON diversidad.id_catalogo = catalogo.id_catalogo
                                 WHERE diversidad.id_catalogo = '$id'";
        $respuestaArreglo = '';
      
        try {
      
          $strExec = BD::prepare($strSql);
          $strExec->execute();
          $strExec ->setFetchMode(PDO::FETCH_ASSOC);
          $respuestaArreglo = $strExec->fetchAll(PDO::FETCH_ASSOC); 
      
         }catch (PDOException $e) { 
      
                $errorReturn += ['info' => "error sql:{$e}"];
                return $errorReturn; 
          }

  }//Fin
 
  //Añadir producto a la tabla puente
  public function addDiversidad_carro(){
         
             $strSql = 'INSERT INTO operativo_diversidad (id_operativo_nuevo, 
                                                id_diversidad_operativo) 
                                        VALUES (:id_operativo_nuevo, 
                                                :id_diversidad_operativo)'; 
             $respuestaArreglo = '';  
             try {
           
              $strExec = BD::prepare($strSql);  
              $strExec->bindParam(':id_operativo_nuevo', $this->id_operativo_nuevo);
              $strExec->bindParam(':id_diversidad_operativo', $this->id_diversidad_operativo);
              $strExec->execute(); 
           
            $respuestaArreglo = $strExec->fetchAll(); 
            $respuestaArreglo += ['estatus' => 'true'];
           
            return $respuestaArreglo;
          
          } catch (PDOException $e) { 
            $errorReturn = ['estatus' => 'false'];
            $errorReturn += ['info' => "error sql:{$e}"];

            return $errorReturn; 
          }

  }//Fin 


  //Eliminar producto de la tabla puente
  public function deleteProducto_carro($id, $id_o){ 

        $strSql = "DELETE FROM operativo_diversidad WHERE id_diversidad_operativo = '$id' AND id_operativo_nuevo = '$id_o'";
        $strExec = BD::prepare($strSql);
        $strExec->execute();
       
  }//Fin

  public function modificarCantidad($id){

         $strSql = "UPDATE operativo_diversidad 
                       SET cantidad_por_persona = :cantidad_por_persona 
                     WHERE id_operativo_diversidad = '$id'";
          $respuestaArreglo = '';  
              
              try {

                $strExec = BD::prepare($strSql); 
                $strExec->bindValue(':cantidad_por_persona', $this->cantidad_por_persona);
                
                $strExec->execute(); 
              
                $respuestaArreglo = $strExec->fetchAll(); 
                $respuestaArreglo = ['estatus' => true];

                return $respuestaArreglo;
              
              } 

                catch (PDOException $e) { 
                $errorReturn = ['estatus' => false];
                $errorReturn += ['info' => "error sql:{$e}"];

                return $errorReturn; 
            }

      }//fin 

/* 
<!-- ============================================================== -->
<!--                 TABLA OPERATIVO DIVERSIDAD                     -->
<!-- ============================================================== -->
*/   
    public function consultar_solo($id){
  
              $strSql = "SELECT * FROM diversidad WHERE id_diversidad ='$id'";
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

    // Metodo eliminar
    public function eliminar($diversidad){ 

        $strSql="DELETE FROM diversidad WHERE id_diversidad = '$diversidad'"; 
        $strExec = BD::prepare($strSql);
        $strExec->execute();
        
      }
      
      public function consultar_puro($id, $id_o){
        
        $strSql = "SELECT * FROM diversidad 
                       LEFT JOIN operativo_diversidad
                              ON diversidad.id_diversidad = operativo_diversidad.id_diversidad_operativo 
                             AND operativo_diversidad.id_operativo_nuevo = '$id_o'
                           WHERE id_diversidad ='$id'";
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

          }//Fin

      //PARA EL CARRITO
    
    public function Buscar_diversidad_($nom){
      $strSql = "SELECT *FROM diversidad WHERE nombre_diversidad ='$nom'";
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
        return $errorReturn; ; 
      }

  }//Fin

  public function nombre_existente($nomb){
    $strSql = "SELECT *FROM diversidad WHERE nombre_diversidad ='$nomb'";
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
                return $errorReturn; ; 
              }

          }//Fin

/* 
<!-- ============================================================== -->
<!--                        METODOS SETTER                          -->
<!-- ============================================================== -->
*/   

    public function setid_operativo_nuevo($id_o){
    $this->id_operativo_nuevo=$id_o;}

    public function setnombre_diversidad($nom){
    $this->nombre_diversidad=$nom;}

    public function setmarca($marc){
    $this->marca=$marc;}

    public function setcontenido($cont){
    $this->contenido=$cont;}

    public function setdescripcion($descrip){
    $this->descripcion=$descrip;}

    public function setid_catalogo($id){
    $this->id_catalogo=$id;}

    public function setid_diversidad_operativo($producto){
    $this->id_diversidad_operativo=$producto;}

    public function setcantidad_por_persona($cantidad){
    $this->cantidad_por_persona=$cantidad;}

/* 
<!-- ============================================================== -->
<!--                        METODOS GETTER                          -->
<!-- ============================================================== -->
*/  

    public function getConex(){
    return $this->conex;}

    public function getnombre_diversidad(){
    return $this->nombre_diversidad;}
    
    public function getmarca(){
    return $this->marca;}
    
    public function getcontenido(){
    return $this->contenido;}
    
    public function getdescripcion(){
    return $this->descripcion;}
    
    public function getid_catalogo(){
    return $this->id_catalogo;}

    public function getid_operativo_nuevo(){
    return $this->id_operativo_nuevo;}

    public function getid_poducto_operativo(){
    return $this->id_diversidad_operativo;}

    public function getcantidad_por_persona(){
    return $this->cantidad_por_persona;}

/* 
<!-- ============================================================== -->
<!--                 FINAL DEL MODELO DIVERSIDAD                    -->
<!-- ============================================================== -->
*/  

}


