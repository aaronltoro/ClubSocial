<?php

class Tutor_centro_model extends CI_Model
{

  public function insertar($data)
  {
    //Inserta un tutor en la base de datos con los valores del array
    $this->db->insert('tutor_centro', $data);
  }

  public function get_todos($ret_type = false)
  {
    //Filtro para traer solo los campos que tengan eliminado a 0
    $this->db->where('eliminado', 0);

    //Retorna todas las tutores de la base de datos si la variable ret_type está a true devuelve un objeto sino un array
    $query = $this->db->get('tutor_centro');

    if ($ret_type) {
      return $query->result();
    } else {
      return $query->result_array();
    }
  }

  public function get_id($id)
  {
    //Filtro
    $this->db->where('id', $id);

    //Filtro para traer solo los campos que tengan eliminado a 0
    $this->db->where('eliminado', 0);

    //Retorna el tutor de la base de datos que tenga ese id
    $query = $this->db->get('tutor_centro');

    return $query->result_array();
  }

  public function get_nombre($nombre)
  {
    //Si $nombre coincide con un registro de la base de datos, los trae (%$nombre%)
    $this->db->like('nombre', $nombre, 'both');

    //Filtro para traer solo los campos que tengan eliminado a 0
    $this->db->where('eliminado', 0);

    //Retorna el tutor de la base de datos que tenga ese nombre
    $query = $this->db->get('tutor_centro');

    return $query->result_array();
  }

  public function deletear($id)
  {
    // $this->db->delete('tutor_centro', array('id' => $id));

    $this->db->where('id', $id);

    $this->db->set('eliminado', 1);

    return $this->db->update('tutor_centro');
  }

  function updatear($id, $data)
  {
    $this->db->where('id', $id);

    $this->db->set('nombre', $data['nombre']);
    $this->db->set('telefono', $data['telefono']);
    $this->db->set('correo', $data['correo']);

    return $this->db->update('tutor_centro');
  }
}
