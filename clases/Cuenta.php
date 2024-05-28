<?php

namespace App;

class Cuenta extends ActiveRecord {
    protected static $tabla = "cuenta";
    protected static $columnasDB = ["id", "usuario", "clave", "pin", "perfil", "fecha", "vigencia", "usuarioid", "plataformaid"];

    public $id;
    public $usuario;
    public $clave;
    public $pin;
    public $perfil;
    public $fecha;
    public $vigencia;
    public $usuarioid;
    public $plataformaid;
    
    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->usuario = $args['usuario'] ?? '';
        $this->clave = $args['clave'] ?? '';
        $this->pin = $args['pin'] ?? null;
        $this->perfil = $args['perfil'] ?? '';
        $this->fecha = $args['fecha'] ?? '';
        $this->vigencia = $args['vigencia'] ?? '';
        $this->usuarioid = $args['usuarioid'] ?? '';
        $this->plataformaid = $args['plataformaid'] ?? '';
    }

    public function validar() {
        if(!$this->usuario){
            self::$errores[] = "El usuario es obligatorio";
        }
        if(!$this->clave){
            self::$errores[] = "La clave es obligatoria";
        }
        if(!$this->usuarioid){
            self::$errores[] = "Debes seleccionar un usuario";
        }
        if(!$this->plataformaid){
            self::$errores[] = "Debes seleccionar una plataforma";
        }
        if(!$this->fecha){
            self::$errores[] = "La fecha es obligatoria";
        }
        if(!$this->vigencia){
            self::$errores[] = "Debes seleccionar el tiempo de duración de la cuenta";
        }
        return self::$errores;
    }
}

?>