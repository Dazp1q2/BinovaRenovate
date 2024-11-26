<?php
class BaseDeDatos {
    private $servidor = 'localhost';
    private $nombre_base_de_datos = 'binovarv';
    private $usuario = 'root';
    private $contrasena = '';
    public $conexion;

    public function getConexion(){
        $this->conexion = null;
        try{
            $this->conexion = new PDO("mysql:host=" . $this->servidor . ";dbname=" . $this->nombre_base_de_datos, $this->usuario, $this->contrasena);
            $this->conexion->exec("set names utf8");
        }catch(PDOException $excepcion){
            echo "Error de conexión: " . $excepcion->getMessage();
        }
        return $this->conexion;
    }
}
?>