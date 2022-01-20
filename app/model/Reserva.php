<?php
class Reserva extends EntidadBase{
    private $id;
    private $id_usuario;
    private $r_padel1;
    private $c_padel1;
    private $r_padel2;
    private $c_padel2;
    private $r_tenis1;
    private $c_tenis1;
    private $r_tenis2;
    private $c_tenis2;
    private $r_futbol;
    private $c_futbol;
    private $r_baloncesto;
    private $c_baloncesto;
    private $r_barbacoa;
    private $c_barbacoa;
    
    public function __construct($adapter) {
        $table="reserva";
        parent::__construct($table, $adapter);
    }
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
    
    public function getId_usuario() {
        return $this->id_usuario;
    }

    public function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    public function getR_padel1() {
        return $this->r_padel1;
    }

    public function setR_padel1($r_padel1) {
        $this->r_padel1 = $r_padel1;
    }

    public function getC_padel1() {
        return $this->c_padel1;
    }

    public function setC_padel1($c_padel1) {
        $this->c_padel1 = $c_padel1;
    }

    public function getR_padel2() {
        return $this->r_padel2;
    }

    public function setR_padel2($r_padel2) {
        $this->r_padel2 = $r_padel2;
    }

    public function getC_padel2() {
        return $this->c_padel2;
    }

    public function setC_padel2($c_padel2) {
        $this->c_padel2 = $c_padel2;
    }

    public function getR_tenis1() {
        return $this->r_tenis1;
    }

    public function setR_tenis1($r_tenis1) {
        $this->r_tenis1 = $r_tenis1;
    }

    public function getC_tenis1() {
        return $this->c_tenis1;
    }

    public function setC_tenis1($c_tenis1) {
        $this->c_tenis1 = $c_tenis1;
    }

    public function getR_tenis2() {
        return $this->r_tenis2;
    }

    public function setR_tenis2($r_tenis2) {
        $this->r_tenis2 = $r_tenis2;
    }

    public function getC_tenis2() {
        return $this->c_tenis2;
    }

    public function setC_tenis2($c_tenis2) {
        $this->c_tenis2 = $c_tenis2;
    }

    public function getR_futbol() {
        return $this->r_futbol;
    }

    public function setR_futbol($r_futbol) {
        $this->r_futbol = $r_futbol;
    }

    public function getC_futbol() {
        return $this->c_futbol;
    }

    public function setC_futbol($c_futbol) {
        $this->c_futbol = $c_futbol;
    }

    public function getR_baloncesto() {
        return $this->r_baloncesto;
    }

    public function setR_baloncesto($r_baloncesto) {
        $this->r_baloncesto = $r_baloncesto;
    }

    public function getC_baloncesto() {
        return $this->c_baloncesto;
    }

    public function setC_baloncesto($c_baloncesto) {
        $this->c_baloncesto = $c_baloncesto;
    }

    public function getR_barbacoa() {
        return $this->r_barbacoa;
    }

    public function setR_barbacoa($r_barbacoa) {
        $this->r_barbacoa = $r_barbacoa;
    }

    public function getC_barbacoa() {
        return $this->c_barbacoa;
    }

    public function setC_barbacoa($c_barbacoa) {
        $this->c_barbacoa = $c_barbacoa;
    }

    public function save(){
        $query="INSERT INTO reserva (id,id_usuario,r_padel1,c_padel1,r_padel2,c_padel2,r_tenis1,c_tenis1,r_tenis2,c_tenis2,r_futbol,c_futbol,r_baloncesto,c_baloncesto,r_barbacoa,c_barbacoa)
                VALUES(NULL,
                       '".$this->id_usuario."',
                       '".$this->r_padel1."',
                       '".$this->c_padel1."',
                       '".$this->r_padel2."',
                       '".$this->c_padel2."',
                       '".$this->r_tenis1."',
                       '".$this->c_tenis1."',
                       '".$this->r_tenis2."',
                       '".$this->c_tenis2."',
                       '".$this->r_futbol."',
                       '".$this->c_futbol."',
                       '".$this->r_baloncesto."',
                       '".$this->c_baloncesto."',
                       '".$this->r_barbacoa."',
                       '".$this->c_barbacoa."'
                    );";
        $save=$this->db()->query($query);
        //$this->db()->error;
        return $save;
    }

}
?>