<?php

class Fecha{
    private $id_fecha;
    private $fecha;
    private $hora;
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

function setId_fecha($id_fecha) { $this->id_fecha = $id_fecha; }
function getId_fecha() { return $this->id_fecha; }
function setFecha($fecha) { $this->fecha = $fecha; }
function getFecha() { return $this->fecha; }
function setHora($hora) { $this->hora = $hora; }
function getHora() { return $this->hora; }

public function getOneFecha(){
    $sql = "SELECT * FROM fecha WHERE fecha = '$this->fecha' AND hora = '$this->hora'";
    $fech = $this->db->query($sql);

    if($fech){
        return $fech->fetch_object();
    }
    else{
        return false;
    }
    
}

public function getOneFechaID(){
    $sql = "SELECT * FROM fecha WHERE id_fecha=$this->id_fecha";
    $fech = $this->db->query($sql);

    if($fech){
        return $fech->fetch_object();
    }
    else{
        return false;
    }
    
}

public function getCantFecha(){
    $sql = "SELECT * FROM fecha ORDER BY id_fecha desc LIMIT 2";
    $fech = $this->db->query($sql);

    if($fech){
        return $fech;
    }
    else{
        return false;
    }
    
}



}