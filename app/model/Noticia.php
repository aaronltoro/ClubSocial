<?php
class Noticia extends EntidadBase
{
  private $id;
  private $titulo;
  private $foto;
  private $descripcion;

  public function __construct($adapter)
  {
    $table = "noticia";
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

  public function getTitulo()
  {
    return $this->titulo;
  }

  public function setTitulo($titulo)
  {
    $this->titulo = $titulo;
  }

  public function getFoto()
  {
    return $this->foto;
  }

  public function setFoto($foto)
  {
    $this->foto = $foto;
  }

  public function getDescripcion()
  {
    return $this->descripcion;
  }

  public function setDescripcion($descripcion)
  {
    $this->descripcion = $descripcion;
  }

  public function save()
  {
    $query = "INSERT INTO noticia (id,titulo,foto,descripcion)
                VALUES(NULL,
                       '" . $this->titulo . "',
                       '" . $this->foto . "',
                       '" . $this->descripcion . "');";
    $save = $this->db()->query($query);
    //$this->db()->error;
    return $save;
  }
}
