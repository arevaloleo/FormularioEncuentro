<?php

class Turno{
    private $id_turno;
    private $cod_turno;
    private $fecha_insc;
    private $cancelado;
    private $id_miembro;
private $id_fecha;
private $dni;


private $db;



    public function __construct()
    {
        $this->db = Database::connect();
    }
    function setId_turno($id_turno) { 
        $this->id_turno = $id_turno;
    }
    function getId_turno() { return $this->id_turno;; }
    function setCod_turno($cod_turno) { $this->cod_turno = $cod_turno; }
    function getCod_turno() { return $this->cod_turno; }
    function setFecha_insc($fecha_insc) { $this->fecha_insc = $fecha_insc; }
    function getFecha_insc() { return $this->fecha_insc; }
    function setHora_insc($hora_insc) { $this->hora_insc = $hora_insc; }
    function getHora_insc() { return $this->hora_insc; }
    function setCancelado($cancelado) { $this->cancelado = $cancelado; }
    function getCancelado() { return $this->cancelado; }
    function setId_miembro($id_miembro) { $this->id_miembro = $id_miembro; }
    function getId_miembro() { return $this->id_miembro; }
    function setId_fecha($id_fecha) { $this->id_fecha = $id_fecha; }
    function getId_fecha() { return $this->id_fecha; }
    function setDni($dni) { $this->dni = $dni; }
    function getDni() { return $this->dni; }

    public function setTurno(){
        $sql = "INSERT INTO turno VALUES(default,default,$this->id_fecha,$this->id_miembro,NOW(),false,'test$this->dni-$this->id_fecha.png')";
        $insert = $this->db->query($sql);
        $this->db->error;
     
       if($insert){
            return true;
        }
        else{
            return false;
        }
    }
    public function getAllTurno(){
        $sql = "SELECT * FROM turno";
        $turnos = $this->db->query($sql);
        return $turnos;

    }
    public function getTurnoFech(){
        $sql = "SELECT * FROM turno WHERE id_fecha = $this->id_fecha";
        $turnoFecha = $this->db->query($sql);
        $this->db->close();
        return $turnoFecha;
    }
  /*   public function getTurnoFechaMiemb(){
        $sql = "SELECT * FR"
    } */


    public function getOneTurnoMiembro(){
        $sql = "SELECT * FROM turno WHERE id_miembro = $this->id_miembro AND cancelado=0";
        $turno_asist = $this->db->query($sql);
        $this->db->close();
        return $turno_asist;
    }

    public function getOneTurnoFech(){
        $sql = "SELECT * FROM turno WHERE id_miembro = $this->id_miembro AND id_fecha=$this->id_fecha AND cancelado!=1";
        $tiene_turno = $this->db->query($sql);
        if($tiene_turno && $tiene_turno->num_rows>0){
            return false;
        }
        else{
            return true;
        }
    }

    public function getTurnoFechAsist(){
        $sql = "SELECT t.*,a.*,f.* FROM turno t JOIN asistente a ON t.id_miembro=a.id_asist
        JOIN fecha f ON t.id_fecha=f.id_fecha
        WHERE t.id_fecha=$this->id_fecha AND t.cancelado=0";
        $turno_asist = $this->db->query($sql);
        $this->db->close();
        return $turno_asist;
    }

    
    public function getOneTurnoMiembroIdFech(){
        $sql = "SELECT * FROM turno WHERE id_miembro = $this->id_miembro AND id_fecha =$this->id_fecha 
        ORDER BY cod_turno desc LIMIT 1";
        $turno_asist = $this->db->query($sql);
        $this->db->close();
        return $turno_asist->fetch_object();
    }

    public function getThreeTurnoMiembro(){
        $sql = "SELECT t.id_turno, t.cod_turno, t.id_miembro, t.fecha_ins, t.cancelado,t.img,f.id_fecha,f.fecha, f.hora FROM turno t JOIN fecha f ON t.id_fecha=f.id_fecha 
        WHERE id_miembro = $this->id_miembro AND cancelado!= true
            ORDER BY cod_turno desc LIMIT 3";
        $turno_asist = $this->db->query($sql);
        $this->db->close();
        return $turno_asist;
    }

    public function getCantidadTurnoFecha(){
        $sql = "SELECT * FROM turno WHERE id_fecha = $this->id_fecha";
        $asist = $this->db->query($sql);
        if($asist->num_rows < 59) {
            return true;
        }
        else {
            return false;
        }
    }

    public function getExistCodTurno(){
        $sql = "SELECT * FROM turno WHERE cod_turno='$this->cod_turno'";
        $exist = $this->db->query($sql);
        if($exist->num_rows!=0){
            return $exist->fetch_object();
        }
        else {
            return false;
        }
    }

    public function cancelarTurno(){
        $sql = "UPDATE turno SET cancelado=$this->cancelado WHERE id_turno= $this->id_turno && cod_turno = '$this->cod_turno'";
        $actualizo = $this->db->query($sql);
        return $actualizo;
    }



    

}