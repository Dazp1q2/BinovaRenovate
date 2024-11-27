<?php
require_once '../modelos/Usuario.php';
require_once '../modelos/Rol.php';

class ControladorUsuario {
    private $conexion;
    private $usuario;
    private $rol;

    public function __construct($db){
        $this->conexion = $db;
        $this->usuario = new Usuario($db);
        $this->rol = new Rol($db);
    }

    public function obtenerTodosLosUsuarios(){
        return $this->usuario->leer();
    }

    public function obtenerUsuarioPorId($id){
        $this->usuario->id_usuario = $id;
        $this->usuario->leerUnico();
        $this->rol->leerUnico($this->usuario->id_rol);
        $this->usuario->nombre_rol = $this->rol->nombre_rol;
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