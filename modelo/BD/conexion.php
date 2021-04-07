<?php

class BD extends PDO {
    public $tipo_de_base = 'mysql';
    public $host='localhost';
    public $bd= 'uptaebcas';
    public $password='';
    public $user='root';
    public $port=5432;
    public $repconexion ;
    public $errorconexion ;
    public $conexion ;

       public function __construct(){
        
        try {

          $this->conexion= parent::__construct("{$this->tipo_de_base}:dbname={$this->bd};host={$this->host};charset=utf8", $this->user, $this->password);//ejecutamos la conexion
          $this->repconexion = true;
          $this->errorconexion="";
        } catch (PDOException $e) {
           $this->errorconexion = "error en:".$e; 
                        }// fin del catch
          }// fin del método constructor
      
      public function getrRepConexion(){
        return  $this->repconexion; }
      
      public function getErrorConexion() { //metodo que nos devuelve el mensaje de error si no llega a darse la conexion
              return $this->errorconexion;
          }
}// fin de la clase 

?>
