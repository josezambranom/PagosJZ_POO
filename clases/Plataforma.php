<?php

namespace App;

class Plataforma extends ActiveRecord {
    protected static $tabla = "plataforma";
    protected static $columnasDB = ["id", "plataforma", "precio", "estado", "usuarioid"];

    public $id;
    public $plataforma;
    public $precio;
    public $estado;
    public $usuarioid;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->plataforma = $args['plataforma'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->estado = $args['estado'] ?? '';
        $this->usuarioid = $args['usuarioid'] ?? '';
    }

    public function validar() {
        if(!$this->plataforma) {
            self::$errores[] = "Debes añadir una plataforma";
        }
        if(!$this->precio) {
            self::$errores[] = "Debes añadir un precio";
        }
        return self::$errores;
    }
}