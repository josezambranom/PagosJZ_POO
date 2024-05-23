<?php

namespace App;

class Cuenta extends ActiveRecord {
    protected static $tabla = "cuenta";
    protected static $columnasDB = ["id", "usuario", "clave", "pin", "perfil", "usuarioid"];

    public $idcuenta;
    public $usuario;
    public $clave;
    public $pin;
    public $perfil;
    public $usuarioid;
    
    public function __construct($args = []) {
        $this->idcuenta = $args['id'] ?? null;
        $this->usuario = $args['usuario'] ?? '';
        $this->clave = $args['clave'] ?? '';
        $this->pin = $args['pin'] ?? '';
        $this->perfil = $args['perfil'] ?? '';
        $this->usuarioid = $args['usuarioid'] ?? '';
    }

    public function validar() {
        if(!$this->usuario){
            self::$errores[] = "El usuario es obligatorio";
        }
        if(!$this->clave){
            self::$errores[] = "La clave es obligatoria";
        }
        return self::$errores;
    }
}

?>