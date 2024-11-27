<?php
require_once '../modelos/Inmueble.php';

class ControladorInmueble {
    private $conexion;
    private $inmueble;

    public function __construct($db) {
        $this->conexion = $db;
        $this->inmueble = new Inmueble($db);
    }

    public function obtenerTodosLosInmuebles() {
        return $this->inmueble->leer();
    }

    public function obtenerInmueblesRecientes($limit = 6) {
        $query = "SELECT * FROM inmuebles ORDER BY fecha_publicacion DESC LIMIT :limit";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    public function obtenerInmueblePorId($id) {
        $this->inmueble->id_inmueble = $id;
        $this->inmueble->leerUnico();
        return $this->inmueble;
    }

    public function crearInmueble($datos) {
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
        $this->inmueble->imagen_vista_previa = $datos['imagen_vista_previa'];
        return $this->inmueble->crear();
    }

    public function actualizarInmueble($datos) {
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
        $this->inmueble->imagen_vista_previa = $datos['imagen_vista_previa'];
        return $this->inmueble->actualizar();
    }

    public function buscarInmuebles($busqueda) {
        return $this->inmueble->buscar($busqueda);
    }

    public function eliminarInmueble($id) {
        $this->inmueble->id_inmueble = $id;
        return $this->inmueble->eliminar();
    }

    public function obtenerInmueblesConFiltros($busqueda, $tipo_inmueble, $ciudad, $precio_min, $precio_max, $offset, $limit) {
        $query = "SELECT * FROM inmuebles WHERE 1";
        $parametros = [];

        if (!empty($busqueda)) {
            $query .= " AND (direccion LIKE :busqueda OR ciudad LIKE :busqueda OR tipo_inmueble LIKE :busqueda)";
            $parametros[':busqueda'] = '%' . $busqueda . '%';
        }

        if (!empty($tipo_inmueble)) {
            $query .= " AND tipo_inmueble = :tipo_inmueble";
            $parametros[':tipo_inmueble'] = $tipo_inmueble;
        }

        if (!empty($ciudad)) {
            $query .= " AND ciudad = :ciudad";
            $parametros[':ciudad'] = $ciudad;
        }

        if (!empty($precio_min)) {
            $query .= " AND precio >= :precio_min";
            $parametros[':precio_min'] = $precio_min;
        }

        if (!empty($precio_max)) {
            $query .= " AND precio <= :precio_max";
            $parametros[':precio_max'] = $precio_max;
        }

        $query .= " ORDER BY fecha_publicacion DESC LIMIT :offset, :limit";
        $stmt = $this->conexion->prepare($query);

        foreach ($parametros as $key => $value) {
            if (is_int($value)) {
                $stmt->bindParam($key, $value, PDO::PARAM_INT);
            } else {
                $stmt->bindParam($key, $value, PDO::PARAM_STR);
            }
        }

        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt;
    }

    public function contarInmueblesConFiltros($busqueda, $tipo_inmueble, $ciudad, $precio_min, $precio_max) {
        $query = "SELECT COUNT(*) as total FROM inmuebles WHERE 1";
        $parametros = [];

        if (!empty($busqueda)) {
            $query .= " AND (direccion LIKE :busqueda OR ciudad LIKE :busqueda OR tipo_inmueble LIKE :busqueda)";
            $parametros[':busqueda'] = '%' . $busqueda . '%';
        }

        if (!empty($tipo_inmueble)) {
            $query .= " AND tipo_inmueble = :tipo_inmueble";
            $parametros[':tipo_inmueble'] = $tipo_inmueble;
        }

        if (!empty($ciudad)) {
            $query .= " AND ciudad = :ciudad";
            $parametros[':ciudad'] = $ciudad;
        }

        if (!empty($precio_min)) {
            $query .= " AND precio >= :precio_min";
            $parametros[':precio_min'] = $precio_min;
        }

        if (!empty($precio_max)) {
            $query .= " AND precio <= :precio_max";
            $parametros[':precio_max'] = $precio_max;
        }

        $stmt = $this->conexion->prepare($query);

        foreach ($parametros as $key => $value) {
            if (is_int($value)) {
                $stmt->bindParam($key, $value, PDO::PARAM_INT);
            } else {
                $stmt->bindParam($key, $value, PDO::PARAM_STR);
            }
        }

        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
}