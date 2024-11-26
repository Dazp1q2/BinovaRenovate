<?php
class Inmueble {
    private $conexion;
    private $nombre_tabla = "inmuebles";

    public $id_inmueble;
    public $id_usuario;
    public $direccion;
    public $ciudad;
    public $tipo_inmueble;
    public $precio;
    public $amoblado;
    public $servicios;
    public $area;
    public $areas_comunes;
    public $parqueadero;
    public $descripcion;
    public $seguridad;
    public $estado;
    public $caracteristicas_locales;

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
        $query = "SELECT * FROM " . $this->nombre_tabla . " WHERE id_inmueble = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $this->id_inmueble);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $this->id_usuario = $row['id_usuario'];
            $this->direccion = $row['direccion'];
            $this->ciudad = $row['ciudad'];
            $this->tipo_inmueble = $row['tipo_inmueble'];
            $this->precio = $row['precio'];
            $this->amoblado = $row['amoblado'];
            $this->servicios = $row['servicios'];
            $this->area = $row['area'];
            $this->areas_comunes = $row['areas_comunes'];
            $this->parqueadero = $row['parqueadero'];
            $this->descripcion = $row['descripcion'];
            $this->seguridad = $row['seguridad'];
            $this->estado = $row['estado'];
            $this->caracteristicas_locales = $row['caracteristicas_locales'];
        } else {
            // Manejar el caso en el que no se encuentre el inmueble
            $this->id_inmueble = null;
            $this->id_usuario = null;
            $this->direccion = null;
            $this->ciudad = null;
            $this->tipo_inmueble = null;
            $this->precio = null;
            $this->amoblado = null;
            $this->servicios = null;
            $this->area = null;
            $this->areas_comunes = null;
            $this->parqueadero = null;
            $this->descripcion = null;
            $this->seguridad = null;
            $this->estado = null;
            $this->caracteristicas_locales = null;
        }
    }

    public function buscar($busqueda){
        $query = "SELECT * FROM " . $this->nombre_tabla . " WHERE 
                  direccion LIKE :busqueda OR 
                  ciudad LIKE :busqueda OR 
                  tipo_inmueble LIKE :busqueda OR 
                  descripcion LIKE :busqueda";
        $stmt = $this->conexion->prepare($query);
        $busqueda = "%" . htmlspecialchars(strip_tags($busqueda)) . "%";
        $stmt->bindParam(":busqueda", $busqueda);
        $stmt->execute();
        return $stmt;
    }

    public function crear(){
        $query = "INSERT INTO " . $this->nombre_tabla . " SET 
                  id_usuario=:id_usuario, 
                  direccion=:direccion, 
                  ciudad=:ciudad, 
                  tipo_inmueble=:tipo_inmueble, 
                  precio=:precio, 
                  amoblado=:amoblado, 
                  servicios=:servicios, 
                  area=:area, 
                  areas_comunes=:areas_comunes, 
                  parqueadero=:parqueadero, 
                  descripcion=:descripcion, 
                  seguridad=:seguridad, 
                  estado=:estado, 
                  caracteristicas_locales=:caracteristicas_locales";
        $stmt = $this->conexion->prepare($query);
        $this->id_usuario=htmlspecialchars(strip_tags($this->id_usuario));
        $this->direccion=htmlspecialchars(strip_tags($this->direccion));
        $this->ciudad=htmlspecialchars(strip_tags($this->ciudad));
        $this->tipo_inmueble=htmlspecialchars(strip_tags($this->tipo_inmueble));
        $this->precio=htmlspecialchars(strip_tags($this->precio));
        $this->amoblado=htmlspecialchars(strip_tags($this->amoblado));
        $this->servicios=htmlspecialchars(strip_tags($this->servicios));
        $this->area=htmlspecialchars(strip_tags($this->area));
        $this->areas_comunes=htmlspecialchars(strip_tags($this->areas_comunes));
        $this->parqueadero=htmlspecialchars(strip_tags($this->parqueadero));
        $this->descripcion=htmlspecialchars(strip_tags($this->descripcion));
        $this->seguridad=htmlspecialchars(strip_tags($this->seguridad));
        $this->estado=htmlspecialchars(strip_tags($this->estado));
        $this->caracteristicas_locales=htmlspecialchars(strip_tags($this->caracteristicas_locales));
        $stmt->bindParam(":id_usuario", $this->id_usuario);
        $stmt->bindParam(":direccion", $this->direccion);
        $stmt->bindParam(":ciudad", $this->ciudad);
        $stmt->bindParam(":tipo_inmueble", $this->tipo_inmueble);
        $stmt->bindParam(":precio", $this->precio);
        $stmt->bindParam(":amoblado", $this->amoblado);
        $stmt->bindParam(":servicios", $this->servicios);
        $stmt->bindParam(":area", $this->area);
        $stmt->bindParam(":areas_comunes", $this->areas_comunes);
        $stmt->bindParam(":parqueadero", $this->parqueadero);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":seguridad", $this->seguridad);
        $stmt->bindParam(":estado", $this->estado);
        $stmt->bindParam(":caracteristicas_locales", $this->caracteristicas_locales);
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
                  id_usuario=:id_usuario, 
                  direccion=:direccion, 
                  ciudad=:ciudad, 
                  tipo_inmueble=:tipo_inmueble, 
                  precio=:precio, 
                  amoblado=:amoblado, 
                  servicios=:servicios, 
                  area=:area, 
                  areas_comunes=:areas_comunes, 
                  parqueadero=:parqueadero, 
                  descripcion=:descripcion, 
                  seguridad=:seguridad, 
                  estado=:estado, 
                  caracteristicas_locales=:caracteristicas_locales 
                  WHERE id_inmueble=:id_inmueble";
        $stmt = $this->conexion->prepare($query);
        $this->id_usuario=htmlspecialchars(strip_tags($this->id_usuario));
        $this->direccion=htmlspecialchars(strip_tags($this->direccion));
        $this->ciudad=htmlspecialchars(strip_tags($this->ciudad));
        $this->tipo_inmueble=htmlspecialchars(strip_tags($this->tipo_inmueble));
        $this->precio=htmlspecialchars(strip_tags($this->precio));
        $this->amoblado=htmlspecialchars(strip_tags($this->amoblado));
        $this->servicios=htmlspecialchars(strip_tags($this->servicios));
        $this->area=htmlspecialchars(strip_tags($this->area));
        $this->areas_comunes=htmlspecialchars(strip_tags($this->areas_comunes));
        $this->parqueadero=htmlspecialchars(strip_tags($this->parqueadero));
        $this->descripcion=htmlspecialchars(strip_tags($this->descripcion));
        $this->seguridad=htmlspecialchars(strip_tags($this->seguridad));
        $this->estado=htmlspecialchars(strip_tags($this->estado));
        $this->caracteristicas_locales=htmlspecialchars(strip_tags($this->caracteristicas_locales));
        $this->id_inmueble=htmlspecialchars(strip_tags($this->id_inmueble));
        $stmt->bindParam(":id_usuario", $this->id_usuario);
        $stmt->bindParam(":direccion", $this->direccion);
        $stmt->bindParam(":ciudad", $this->ciudad);
        $stmt->bindParam(":tipo_inmueble", $this->tipo_inmueble);
        $stmt->bindParam(":precio", $this->precio);
        $stmt->bindParam(":amoblado", $this->amoblado);
        $stmt->bindParam(":servicios", $this->servicios);
        $stmt->bindParam(":area", $this->area);
        $stmt->bindParam(":areas_comunes", $this->areas_comunes);
        $stmt->bindParam(":parqueadero", $this->parqueadero);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":seguridad", $this->seguridad);
        $stmt->bindParam(":estado", $this->estado);
        $stmt->bindParam(":caracteristicas_locales", $this->caracteristicas_locales);
        $stmt->bindParam(":id_inmueble", $this->id_inmueble);
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function eliminar(){
        $query = "DELETE FROM " . $this->nombre_tabla . " WHERE id_inmueble = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(1, $this->id_inmueble);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
}
?>