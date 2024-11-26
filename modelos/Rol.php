<?php
class Rol {
    private $conexion;
    private $nombre_tabla = "rol";

    public $id_rol;
    public $nombre_rol;

    public function __construct($db){
        $this->conexion = $db;
    }

    public function leer(){
        $query = "SELECT * FROM " . $this->nombre_tabla;
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function leerUnico(){
        $query = "SELECT * FROM " . $this->nombre_tabla . " WHERE id_rol = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $this->id_rol);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $this->nombre_rol = $row['nombre_rol'];
        } else {
            // Manejar el caso en el que no se encuentre el rol
            $this->id_rol = null;
            $this->nombre_rol = null;
        }
    }
}
?>