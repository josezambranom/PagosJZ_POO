<?php

namespace App;

class ActiveRecord {
    // DB
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = "";

    protected static $columna = "";

    // Errores
    protected static $errores = [];

    // Definir conexion DB
    public static function setDB($database) {
        self::$db = $database;
    }

    public function guardar() {
        $respuesta = false;
        if (!is_null($this->id)) {
            // Actualizando un registro
            $respuesta = $this->actualizar();
        } else {
            // Creando un registro
            $respuesta = $this->crear();
        }
        return $respuesta;
    }

    public function crear() {
        // Sanitizar datos
        $atributos = $this->sanitizarDatos();

        // Insertar en DB
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES ('";  
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";

        $result = self::$db->query($query);

        if($result) {
            return true;
        } else {
            return false;
        }
    }

    public function actualizar() {
        // Sanitizar datos
        $atributos = $this->sanitizarDatos();

        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 ";

        $result = self::$db->query($query);
        
        if($result) {
            return true;
        } else {
            return false;
        }
    }

    public function eliminar() {
        // Eliminar la propiedad
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        if($resultado) {
            // Elminar archivo
            $this->eliminarImagen();
            return true;
        } else {
            return false;
        }

    }

     // Identificar y unir los atributos de la DB
     public function atributos() {
        $atributos = [];
        foreach(static::$columnasDB as $columna) {
            if($columna === 'id') continue; // Se usa para ignorar id
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    // Sanitizar datos para evitar el insert de codigo malicioso
    public function sanitizarDatos() {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value){
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    // Subida de archivos
    public function setImagen($imagen) {
        // Eliminar la imagen previa
        if(!is_null($this->id)) {
            $this->eliminarImagen();
        }

        // Asignar al atributo de imagen el nombre de la imagen
        if($imagen) {
            $this->imagen = $imagen;
        }
    }

    // Eliminar archivos
    public function eliminarImagen() {
        // Comprobar si existe el archivo
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }

    // Validación de errores
    public static function getErrores() {
        return static::$errores;
    }

    public function validar() {
        static::$errores = [];
        return static::$errores;
    }

    // Lista todas las propiedades
    public static function all() {
        $query = "SELECT * FROM " . static::$tabla; // static se usa para hacer referencia a una clase heredada
        $result = self::consultarSQL($query);
        return $result;
    }

    public static function allorder() {
        $query = "SELECT * FROM " . static::$tabla . " ORDER BY " . static::$columna . ' ASC'; // static se usa para hacer referencia a una clase heredada
        $result = self::consultarSQL($query);
        return $result;
    }

    // Obtiene un determinado numero de registros
    public static function get($cantidad) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad; // static se usa para hacer referencia a una clase heredada
        $result = self::consultarSQL($query);
        return $result;
    }

    // Busca un registro por su id
    public static function find($id) {
        $query = "SELECT * FROM " . static::$tabla . " where id = {$id}";
        $result = self::consultarSQL($query);
        return array_shift($result);
    }

    public static function consultarSQL($query) {
        // Consultar la DB
        $resultado = self::$db->query($query);
        // Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }
        // Liberar memoria
        $resultado->free();
        // Retornar resultados
        return $array;
    }

    // Se crea un objeto para seguir los principios de active record
    protected static function crearObjeto($registro) {
        $objeto = new static; // Se refiere a la clase heredada
        foreach($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    // Sincronizar el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args = []) {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
    
}

?>