<?php

namespace App;

class Usuario extends ActiveRecord {
    protected static $tabla = "usuario";
    protected static $columnasDB = ["id", "email", "clave", "tipousuario", "confirmado", "token", "personaid"];

    public $id;
    public $email;
    public $clave;
    public $tipousuario;
    public $confirmado;
    public $token;
    public $personaid;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->clave = $args['clave'] ?? '';
        $this->tipousuario = $args['tipousuario'] ?? "";
        $this->confirmado = $args['confirmado'] ?? "0";
        $this->token = $args['token'] ?? '';
        $this->personaid = $args['personaid'] ?? "";
    }

    public function validar() {
        if(!$this->email){
            self::$errores[] = "El Email es obligatorio";
        }
        if(!$this->clave){
            self::$errores[] = "La clave es obligatoria (Mínimo 8 carácteres)";
        }
        return self::$errores;
    }
}