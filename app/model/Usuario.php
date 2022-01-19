<?php
class Usuario extends EntidadBase
{
  private $id;
  private $nombre;
  private $apellidos;
  private $contrasena;
  private $dni;
  private $nfamiliares;
  private $cuota;
  private $presidente;
  private $autorizado;

  public function __construct($adapter)
  {
    $table = "usuarios";
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

  public function getNombre()
  {
    return $this->nombre;
  }

  public function setNombre($nombre)
  {
    $this->nombre = $nombre;
  }

  public function getApellidos()
  {
    return $this->apellido;
  }

  public function setApellidos($apellido)
  {
    $this->apellido = $apellido;
  }

  public function getContrasena()
  {
    return $this->contrasena;
  }

  public function setContrasena($contrasena)
  {
    $this->contrasena = $contrasena;
  }

  public function getDni()
  {
    return $this->dni;
  }

  public function setDni($dni)
  {
    $this->dni = $dni;
  }

  public function getNfamiliares()
  {
    return $this->nfamiliares;
  }

  public function setNfamiliares($nfamiliares)
  {
    $this->nfamiliares = $nfamiliares;
  }

  public function getCuota() {
    return $this->cuota;
  }

  public function setCuota($cuota) {
    $this->cuota = $cuota;
  }

  public function getPresidente() {
    return $this->presidente;
  }

  public function setPresidente($presidente) {
    $this->presidente = $presidente;
  }

  public function getAutorizado() {
    return $this->autorizado;
  }

  public function setAutorizado($autorizado) {
    $this->autorizado = $autorizado;
  }

  public function getAdmin() {
    return $this->admin;
  }

  public function setAdmin($admin) {
    $this->autorizado = $admin;
  }

  public function save()
  {
    $query = "INSERT INTO usuarios (id,nombre,apellidos,contrasena,dni,nfamiliares,cuota,presidente,autorizado,admin)
                VALUES(NULL,
                       '" . $this->nombre . "',
                       '" . $this->apellidos . "',
                       '" . $this->contrasena . "',
                       '" . $this->dni . "',
                       '" . $this->nfamiliares . "',
                       '" . $this->cuota . "',
                       '" . $this->presidente . "',
                       '" . $this->autorizado . "',
                       '" . $this->admin . "');";
    $save = $this->db()->query($query);
    //$this->db()->error;
    return $save;
  }
}
