<?php
require_once '../modelos/Inmueble.php';

class ControladorInmueble {
    private $conexion;
    private $inmueble;

    public function __construct($db){
        $this->conexion = $db;
        $this->inmueble = new Inmueble($db);
    }

    public function obtenerTodosLosInmuebles(){
        return $this->inmueble->leer();
    }

    public function obtenerInmueblePorId($id){
        $this->inmueble->id_inmueble = $id;
        $this->inmueble->leerUnico();
        return $this->inmueble;
    }

    public function crearInmueble($datos){
        $this->inmueble->id_usuario = $datos['id_usuario'];
        $this->inmueble->direccion = $datos['direccion'];
        $this->inmueble->ciudad = $datos['ciudad'];
        $this->inmueble->tipo_inmueble = $datos['tipo_inmueble'];
        $this->inmueble->precio = $datos['precio'];
        $this->inmueble->amoblado = $datos['amoblado'];
        $this->inmueble->servicios = $datos['servicios'];
        $this->inmueble->area = $datos['area'];
        $this->inmueble->areas_comunes = $datos['areas_comunes'];
        $this->inmueble->parqueadero = $datos['parqueadero'];
        $this->inmueble->descripcion = $datos['descripcion'];
        $this->inmueble->seguridad = $datos['seguridad'];
        $this->inmueble->estado = $datos['estado'];
        $this->inmueble->caracteristicas_locales = $datos['caracteristicas_locales'];
        return $this->inmueble->crear();
    }

    public function actualizarInmueble($datos){
        $this->inmueble->id_inmueble = $datos['id_inmueble'];
        $this->inmueble->id_usuario = $datos['id_usuario'];
        $this->inmueble->direccion = $datos['direccion'];
        $this->inmueble->ciudad = $datos['ciudad'];
        $this->inmueble->tipo_inmueble = $datos['tipo_inmueble'];
        $this->inmueble->precio = $datos['precio'];
        $this->inmueble->amoblado = $datos['amoblado'];
        $this->inmueble->servicios = $datos['servicios'];
        $this->inmueble->area = $datos['area'];
        $this->inmueble->areas_comunes = $datos['areas_comunes'];
        $this->inmueble->parqueadero = $datos['parqueadero'];
        $this->inmueble->descripcion = $datos['descripcion'];
        $this->inmueble->seguridad = $datos['seguridad'];
        $this->inmueble->estado = $datos['estado'];
        $this->inmueble->caracteristicas_locales = $datos['caracteristicas_locales'];
        return $this->inmueble->actualizar();
    }

    public function buscarInmuebles($busqueda){
        return $this->inmueble->buscar($busqueda);
    }

    public function eliminarInmueble($id){
        $this->inmueble->id_inmueble = $id;
        return $this->inmueble->eliminar();
    }
}
?>