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

        //Retorna la empresa de la base de datos que tenga ese id
        $query = $this->db->get('empresa');

        return $query->result_array();
    }

    public function get_nombre($nombre)
    {
        //Si nombre contiene un % significa que el usuario quiere buscar por ejemplo los nombres que empiecen por Slo%
        if (strpos($nombre, "%")) {
            $this->db->like('nombre', $nombre);
        } else {
            //Si no contiene un % el usuario busca un nombre completo
            $this->db->where('nombre', $nombre);
        }

        //Retorna la empresa de la base de datos que tenga ese nombre
        $query = $this->db->get('empresa');

        return $query->result_array();
    }

    public function get_cif($cif)
    {
        //Si $cif contiene un % significa que el usuario quiere buscar por ejemplo los cifs que empiecen por 668%
        if (strpos($cif, "%")) {
            $this->db->like('cif', $cif);
        } else {
            //Si no contiene un % el usuario busca un cif completo
            $this->db->where('cif', $cif);
        }

        //Retorna la empresa de la base de datos que tenga ese cif
        $query = $this->db->get('empresa');

        return $query->result_array();
    }

    public function deletear($id)
    {
        $this->db->delete('empresa', array('id' => $id));
    }

    function updatear($id, $data)
    {
        $this->db->where('id', $id);

        $this->db->set('nombre', $data['nombre']);
        $this->db->set('cif', $data['cif']);
        $this->db->set('direcciones', $data['direcciones']);

        return $this->db->update('empresa');
    }
}
