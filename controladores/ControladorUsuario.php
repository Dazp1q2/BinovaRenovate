<?php
require_once '../modelos/Usuario.php';

class ControladorUsuario {
    private $conexion;
    private $usuario;

    public function __construct($db){
        $this->conexion = $db;
        $this->usuario = new Usuario($db);
    }

    public function obtenerTodosLosUsuarios(){
        return $this->usuario->leer();
    }

    public function obtenerUsuarioPorId($id){
        $this->usuario->id_usuario = $id;
        $this->usuario->leerUnico();
        return $this->usuario;
    }

    public function crearUsuario($datos){
        $this->usuario->nombre = $datos['nombre'];
        $this->usuario->apellidos = $datos['apellidos'];
        $this->usuario->cedula = $datos['cedula'];
        $this->usuario->correo_electronico = $datos['correo_electronico'];
        $this->usuario->telefono = $datos['telefono'];
        $this->usuario->contrasena = password_hash($datos['contrasena'], PASSWORD_BCRYPT); // Hash de la contraseña
        $this->usuario->id_rol = $datos['id_rol'];
        return $this->usuario->crear();
    }

    public function actualizarUsuario($datos){
        $this->usuario->id_usuario = $datos['id_usuario'];
        $this->usuario->nombre = $datos['nombre'];
        $this->usuario->apellidos = $datos['apellidos'];
        $this->usuario->cedula = $datos['cedula'];
        $this->usuario->correo_electronico = $datos['correo_electronico'];
        $this->usuario->telefono = $datos['telefono'];
        if (!empty($datos['contrasena'])) {
            $this->usuario->contrasena = password_hash($datos['contrasena'], PASSWORD_BCRYPT); // Hash de la contraseña
        }
        $this->usuario->id_rol = $datos['id_rol'];
        return $this->usuario->actualizar();
    }

    public function eliminarUsuario($id){
        $this->usuario->id_usuario = $id;
        return $this->usuario->eliminar();
    }
}
?>