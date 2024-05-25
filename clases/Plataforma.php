<?php

namespace App;

class Plataforma extends ActiveRecord {
    protected static $tabla = "plataforma";
    protected static $columnasDB = ["id", "imagen", "plataforma", "precio", "estado", "usuarioid"];
    protected static $columna = "plataforma";

    public $id;
    public $imagen;
    public $plataforma;
    public $precio;
    public $estado;
    public $usuarioid;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->imagen = $args['imagen'] ?? '';
        $this->plataforma = $args['plataforma'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->estado = $args['estado'] ?? '1';
        $this->usuarioid = $args['usuarioid'] ?? '';
    }

    public function validar() {
        if(!$this->plataforma) {
            self::$errores[] = "Debes añadir una plataforma";
        }
        if(!$this->precio) {
            self::$errores[] = "Debes añadir un precio";
        }
        if(!$this->imagen){
            self::$errores[] = "La imagen de la plataforma es obligatoria";
        }
        if(!$this->usuarioid){
            self::$errores[] = "Debes seleccionar un usuario";
        }
        return self::$errores;
    }
}