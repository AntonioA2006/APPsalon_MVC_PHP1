<?php

namespace Model;

use PDO;

class Usuario extends ActiveRecord{

    //bd


    protected static $tabla = 'usuarios';

    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'password', 'telefono', 'admin', 'confirmado', 'token'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args = []) {

        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->admin = $args['admin'] ?? '0' ;
        $this->confirmado = $args['confirmado'] ?? '0' ;
        $this->token = $args['token'] ?? '';
        
    }
    
            //mensajes de validacion

        public function validarNuevaCuenta(){

            if (!$this->nombre) {
                self::$alertas['error'][] = 'el nombre del cliente Es Obligatorio';
            }
            if (!$this->apellido) {
                self::$alertas['error'][] = 'el apellido del cliente Es Obligatorio';
            }
            if (!$this->email) {
                self::$alertas['error'][] = 'el email del cliente Es Obligatorio';
            }
            if (!$this->password) {
                self::$alertas['error'][] = 'el password del cliente Es Obligatorio';
            }
            if (strlen($this->password) < 6) {
                self::$alertas['error'][] = 'el password no es valido';
            }

            return self::$alertas;
        }
        public function validarLogin(){
            if (!$this->email) {
               self::$alertas['error'][] = 'el email Obligatorio';
            }
            if (!$this->password) {
               self::$alertas['error'][] = 'el password Obligatorio';
            }
            return self::$alertas;
        }
        public function validarEmail(){
            if (!$this->email) {
                self::$alertas['error'][] = 'el email Obligatorio';
             }
             return self::$alertas;
        }
        public function validarPassword(){
            if (!$this->password ) {
                self::$alertas['error'][] = 'El Password Es Obligatorio';  
            }
            if (strlen($this->password) < 6) {
                self::$alertas['error'][] = 'El Password Es Debe Tener mas de 6 Caracteres'; 
            }
            return self::$alertas;
        }
//revisa si el ususairo ya existe
        public function existeUsuario(){
            $query = " SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1 ";

            $resultado = self::$db->query($query);

            if ($resultado->num_rows) {

               self::$alertas['error'][] = 'el usuario ya existe';

            }
            return $resultado;

        }
    public function hashPassoword(){
            $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }
    public function createToken(){
        $this->token = uniqid();
    }
    public function comprobarPasswordAndVerificado($password){
        $resultado = password_verify($password , $this->password);

        if ($resultado || !$this->confirmado) {
            self::$alertas ['error'][] = 'unvalible password or your account is not confirmate';
        }else {
            return true;
        }
    }
}