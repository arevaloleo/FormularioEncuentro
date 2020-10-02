<?php
class Login{
    private $usuario;
    private $clave;
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function getUsuario(){
		return $this->usuario;
	}

	public function setUsuario($usuario){
		$this->usuario = $this->db->real_escape_string($usuario);
	}

	public function getClave(){
		return $this->clave;
	}

	public function setClave($clave){
		$this->clave = $this->db->real_escape_string($clave);
    }
    
    public function login(){
        $sql = "SELECT * FROM users WHERE usuario = '$this->usuario' AND clave = '$this->clave'";
        $log = $this->db->query($sql);
        if($log && $log->num_rows == 1){
            return true;
        }
        else {
            return false;
        }

    }

    public function logout(){
        session_start();
        session_destroy();
        return true;

    }



}