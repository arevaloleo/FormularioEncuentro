
<?php

class Asistente {
    private $id_asist;
    private $DNI;
    private $nombre;
    private $apellido;
    private $celular;
    private $fecha_nacimiento;
    private $db;
    
    public function __construct() {$this->db = Database::connect(); }
    public function setId_asist($id_asist) { $this->id_asist = $id_asist; }
    public function getId_asist() { return $this->id_asist; }
    public function setDNI($DNI) { $this->DNI = $DNI; }
    public function getDNI() { return $this->DNI; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function getNombre() { return $this->nombre; }
    public function setApellido($apellido) { $this->apellido = $apellido; }
    public function getApellido() { return $this->apellido; }
    public function setCelular($celular) { $this->celular = $celular; }
    public function getCelular() { return $this->celular; }
    public function setFecha_nacimiento($fecha_nacimiento) { $this->fecha_nacimiento = $fecha_nacimiento; }
    public function getFecha_nacimiento() { return $this->fecha_nacimiento; }

    public function setAsistente(){
        $sql = "INSERT INTO asistente VALUES(default,$this->DNI,'$this->nombre','$this->apellido',$this->celular,'$this->fecha_nacimiento',NOW())";
        $ins = $this->db->query($sql);
        $this->db->close();
        return $ins;
    }

    public function asistDNI(){
        $sql = "SELECT * FROM asistente WHERE DNI=$this->DNI";
        $asistente = $this->db->query($sql);
        if ($asistente && $asistente->num_rows!=0) {
            return $asistente->fetch_object();
        }
        else{
            return false;
        }
        
        
        
    }

    public function asistID(){
        $sql = "SELECT * FROM asistente WHERE id_asist=$this->id_asist";
        $asistente = $this->db->query($sql);
        if ($asistente && $asistente->num_rows!=0) {
            return $asistente;
        }
        else{
            return false;
        }
        
        
        
    }

    

}