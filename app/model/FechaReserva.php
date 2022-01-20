<?php
class FechaReserva extends EntidadBase
{
  private $id;
  private $id_instalacion;
  private $fecha;

  public function __construct($adapter)
  {
    $table = "fechareserva";
    parent::__construct($table, $adapter);
  }

  public function getId()
  {
    return $this->id;
  }

  public function setId($id)
  {
    $this->id = $id;
  }

  public function getId_instalacion()
  {
    return $this->id_instalacion;
  }

  public function setId_instalacion($id_instalacion)
  {
    $this->id_instalacion = $id_instalacion;
  }

  public function getFecha()
  {
    return $this->fecha;
  }

  public function setFecha($fecha)
  {
    $this->fecha = $fecha;
  }

  public function save()
  {
    $query = "INSERT INTO fechareserva (id,id_instalacion,fecha)
                VALUES(NULL,
                       '" . $this->id_instalacion . "',
                       '" . $this->fecha . "');";
    $save = $this->db()->query($query);
    //$this->db()->error;
    return $save;
  }
}