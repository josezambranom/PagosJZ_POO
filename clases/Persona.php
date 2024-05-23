<?php

namespace App;

class Persona extends ActiveRecord {
    protected static $tabla = "persona";
    protected static $columnasDB = ["id", "nombre", "apellido", "genero"];

    public $idpersona;
    public $nombre;
    public $apellido;
    public $genero;

    public function __construct($args = []) {
        $this->idpersona = $args["id"] ?? null;
        $this->nombre = $args["nombre"] ?? "";
        $this->apellido = $args["apellido"] ?? "";
        $this->genero = $args["genero"] ?? "";
    }

    public function validar(){
        if(!$this->nombre) {
            self::$errores[] = "El nombre es obligatorio"; 
        }
        if(!$this->apellido) {
            self::$errores[] = "El apellido es obligatorio"; 
        }
        if(!$this->genero) {
            self::$errores[] = "El género es obligatorio"; 
        }
        return self::$errores;
    }

}

?>