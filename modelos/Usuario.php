<?php
class Usuario {
    private $conexion;
    private $nombre_tabla = "usuarios";

    public $id_usuario;
    public $nombre;
    public $apellidos;
    public $cedula;
    public $correo_electronico;
    public $telefono;
    public $contrasena;
    public $fecha_registro;
    public $id_rol;

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
        $query = "SELECT * FROM " . $this->nombre_tabla . " WHERE id_usuario = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $this->id_usuario);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $this->nombre = $row['nombre'];
            $this->apellidos = $row['apellidos'];
            $this->cedula = $row['cedula'];
            $this->correo_electronico = $row['correo_electronico'];
            $this->telefono = $row['telefono'];
            $this->contrasena = $row['contrasena'];
            $this->fecha_registro = $row['fecha_registro'];
            $this->id_rol = $row['id_rol'];
        } else {
            // Manejar el caso en el que no se encuentre el usuario
            $this->id_usuario = null;
            $this->nombre = null;
            $this->apellidos = null;
            $this->cedula = null;
            $this->correo_electronico = null;
            $this->telefono = null;
            $this->contrasena = null;
            $this->fecha_registro = null;
            $this->id_rol = null;
        }
    }

    public function crear(){
        $query = "INSERT INTO " . $this->nombre_tabla . " SET 
                  nombre=:nombre, 
                  apellidos=:apellidos, 
                  cedula=:cedula, 
                  correo_electronico=:correo_electronico, 
                  telefono=:telefono, 
                  contrasena=:contrasena, 
                  id_rol=:id_rol";
        $stmt = $this->conexion->prepare($query);
        $this->nombre=htmlspecialchars(strip_tags($this->nombre));
        $this->apellidos=htmlspecialchars(strip_tags($this->apellidos));
        $this->cedula=htmlspecialchars(strip_tags($this->cedula));
        $this->correo_electronico=htmlspecialchars(strip_tags($this->correo_electronico));
        $this->telefono=htmlspecialchars(strip_tags($this->telefono));
        $this->contrasena=htmlspecialchars(strip_tags($this->contrasena));
        $this->id_rol=htmlspecialchars(strip_tags($this->id_rol));
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":apellidos", $this->apellidos);
        $stmt->bindParam(":cedula", $this->cedula);
        $stmt->bindParam(":correo_electronico", $this->correo_electronico);
        $stmt->bindParam(":telefono", $this->telefono);
        $stmt->bindParam(":contrasena", $this->contrasena);
        $stmt->bindParam(":id_rol", $this->id_rol);
        try {
            if($stmt->execute()){
                return true;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return false;
    }

    public function actualizar(){
        $query = "UPDATE " . $this->nombre_tabla . " SET 
                  nombre=:nombre, 
                  apellidos=:apellidos, 
                  cedula=:cedula, 
                  correo_electronico=:correo_electronico, 
                  telefono=:telefono, 
                  contrasena=:contrasena, 
                  id_rol=:id_rol 
                  WHERE id_usuario=:id_usuario";
        $stmt = $this->conexion->prepare($query);
        $this->nombre=htmlspecialchars(strip_tags($this->nombre));
        $this->apellidos=htmlspecialchars(strip_tags($this->apellidos));
        $this->cedula=htmlspecialchars(strip_tags($this->cedula));
        $this->correo_electronico=htmlspecialchars(strip_tags($this->correo_electronico));
        $this->telefono=htmlspecialchars(strip_tags($this->telefono));
        if (!empty($this->contrasena)) {
            $this->contrasena=htmlspecialchars(strip_tags($this->contrasena));
            $stmt->bindParam(":contrasena", $this->contrasena);
        } else {
            // Si no se proporciona una nueva contraseña, mantener la existente
            $query = "UPDATE " . $this->nombre_tabla . " SET 
                      nombre=:nombre, 
                      apellidos=:apellidos, 
                      cedula=:cedula, 
                      correo_electronico=:correo_electronico, 
                      telefono=:telefono, 
                      id_rol=:id_rol 
                      WHERE id_usuario=:id_usuario";
            $stmt = $this->conexion->prepare($query);
        }
        $this->id_rol=htmlspecialchars(strip_tags($this->id_rol));
        $this->id_usuario=htmlspecialchars(strip_tags($this->id_usuario));
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":apellidos", $this->apellidos);
        $stmt->bindParam(":cedula", $this->cedula);
        $stmt->bindParam(":correo_electronico", $this->correo_electronico);
        $stmt->bindParam(":telefono", $this->telefono);
        $stmt->bindParam(":id_rol", $this->id_rol);
        $stmt->bindParam(":id_usuario", $this->id_usuario);
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function eliminar(){
        $query = "DELETE FROM " . $this->nombre_tabla . " WHERE id_usuario = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $this->id_usuario);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
}
?>