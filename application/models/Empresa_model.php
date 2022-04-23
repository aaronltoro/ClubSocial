<?php

class Empresa_Model extends CI_Model
{

    public function insertar($data)
    {
        //Inserta una empresa en la base de datos con los valores del array
        $this->db->insert('empresa', $data);
    }

    public function get_todos($ret_type = false)
    {
        //Filtro para traer solo los campos que tengan eliminado a 0
        $this->db->where('eliminado', 0);

        //Retorna todas las empresas de la base de datos si la variable ret_type está a true devuelve un objeto sino un array
        $query = $this->db->get('empresa');

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

        //Retorna la empresa de la base de datos que tenga ese id
        $query = $this->db->get('empresa');

        return $query->result_array();
    }

    public function get_nombre($nombre)
    {
        //Si $nombre coincide con un registro de la base de datos, los trae (%$nombre%)
        $this->db->like('nombre', $nombre, 'both');

        //Filtro para traer solo los campos que tengan eliminado a 0
        $this->db->where('eliminado', 0);

        //Retorna la empresa de la base de datos que tenga ese nombre
        $query = $this->db->get('empresa');

        return $query->result_array();
    }

    public function get_cif($cif)
    {
        //Si $cif coincide con un registro de la base de datos, los trae (%$nombre%)
        $this->db->like('cif', $cif, 'both');

        //Filtro para traer solo los campos que tengan eliminado a 0
        $this->db->where('eliminado', 0);

        //Retorna la empresa de la base de datos que tenga ese cif
        $query = $this->db->get('empresa');

        return $query->result_array();
    }

    public function deletear($id)
    {
        // $this->db->delete('empresa', array('id' => $id));

        $this->db->where('id', $id);

        $this->db->set('eliminado', 1);

        return $this->db->update('empresa');
    }

    function updatear($id, $data)
    {
        $this->db->where('id', $id);

        $this->db->set('nombre', $data['nombre']);
        $this->db->set('cif', $data['cif']);
        $this->db->set('direcciones', $data['direcciones']);

        return $this->db->update('empresa');
    }

    function update_principal($id, $data)
    {
        $this->db->where('id', $id);

        $this->db->set('principal', $data);

        return $this->db->update('empresa');
    }
}
