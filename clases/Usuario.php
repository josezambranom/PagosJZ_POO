<?php

namespace App;

class Usuario extends ActiveRecord {
    protected static $tabla = "usuario";
    protected static $columnasDB = ["id", "email", "clave", "tipousuario", "personaid"];

    public $idusuario;
    public $email;
    public $clave;
    public $tipousuario;
    public $personaid;

    public function __construct($args = []) {
        $this->idusuario = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->clave = $args['clave'] ?? '';
        $this->clave = $args['tipousuario'] ?? '';
        $this->personaid = $args['personaid'] ?? '';
    }

    public function validar() {
        if(!$this->email){
            self::$errores[] = "El Email es obligatorio";
        }
        if(!$this->clave){
            self::$errores[] = "La clave es obligatoria";
        }
        return self::$errores;
    }
}