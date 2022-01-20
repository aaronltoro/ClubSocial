<?php
class Reserva extends EntidadBase{
    private $id;
    private $id_fecha;
    private $h9;
    private $h10;
    private $h11;
    private $h12;
    private $h13;
    private $h14;
    private $h15;
    private $h16;
    private $h17;
    private $h18;
    private $h19;
    private $h20;
    private $h21;
    private $h22;
    
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
    
    public function getId_fecha() {
        return $this->id_fecha;
    }

    public function setId_fecha($id_fecha) {
        $this->id_fecha = $id_fecha;
    }

    public function getH9() {
        return $this->h9;
    }

    public function setH9($h9) {
        $this->h9 = $h9;
    }

    public function getH10() {
        return $this->h10;
    }

    public function setH10($h10) {
        $this->h10 = $h10;
    }

    public function getH11() {
        return $this->h11;
    }

    public function setH11($h11) {
        $this->h11 = $h11;
    }

    public function getH12() {
        return $this->h12;
    }

    public function setH12($h12) {
        $this->h12 = $h12;
    }

    public function getH13() {
        return $this->h13;
    }

    public function setH13($h13) {
        $this->h13 = $h13;
    }

    public function getH14() {
        return $this->h14;
    }

    public function setH14($h14) {
        $this->h14 = $h14;
    }

    public function getH15() {
        return $this->h15;
    }

    public function setH15($h15) {
        $this->h15 = $h15;
    }

    public function getH16() {
        return $this->h16;
    }

    public function setH16($h16) {
        $this->h16 = $h16;
    }

    public function getH17() {
        return $this->h17;
    }

    public function setH17($h17) {
        $this->h17 = $h17;
    }

    public function getH18() {
        return $this->h18;
    }

    public function setH18($h18) {
        $this->h18 = $h18;
    }

    public function getH19() {
        return $this->h19;
    }

    public function setH19($h19) {
        $this->h19 = $h19;
    }

    public function getH20() {
        return $this->h20;
    }

    public function setH20($h20) {
        $this->h20 = $h20;
    }

    public function getH21() {
        return $this->h21;
    }

    public function setH21($h21) {
        $this->h21 = $h21;
    }

    public function getH22() {
        return $this->h22;
    }

    public function setH22($h22) {
        $this->h22 = $h22;
    }

    public function save(){
        $query="INSERT INTO horareserva (id,id_fecha,h9,h10,h11,h12,h13,h14,h15,h16,h17,h18,h19,h20,h21,h22)
                VALUES(NULL,
                       '".$this->id_fecha."',
                       '".$this->h9."',
                       '".$this->h10."',
                       '".$this->h11."',
                       '".$this->h12."',
                       '".$this->h13."',
                       '".$this->h14."',
                       '".$this->h15."',
                       '".$this->h16."',
                       '".$this->h17."',
                       '".$this->h18."',
                       '".$this->h19."',
                       '".$this->h20."',
                       '".$this->h21."',
                       '".$this->h22."'
                    );";
        $save=$this->db()->query($query);
        //$this->db()->error;
        return $save;
    }

}
?>