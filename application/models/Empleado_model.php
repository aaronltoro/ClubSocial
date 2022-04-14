<?php

class Empleado_Model extends CI_Model
{

    public function insertar($data)
    {
        //Inserta una empleado en la base de datos con los valores del array
        $this->db->insert('empleado', $data);
    }

    public function get_todos($ret_type = false)
    {
        //Retorna todas las empleados de la base de datos si la variable ret_type está a true devuelve un objeto sino un array
        $query = $this->db->get('empleado');

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

        //Retorna la empleado de la base de datos que tenga ese id
        $query = $this->db->get('empleado');

        return $query->result_array();
    }

    public function get_nombre($nombre)
    {
        //Si $nombre coincide con un registro de la base de datos, los trae (%$nombre%)
        $this->db->like('nombre', $nombre, 'both'); 

        //Retorna la empleado de la base de datos que tenga ese nombre
        $query = $this->db->get('empleado');

        return $query->result_array();
    }

    public function get_dni($dni)
    {
        //Si $cif coincide con un registro de la base de datos, los trae (%$nombre%)
        $this->db->like('dni', $dni, 'both'); 

        //Retorna la empleado de la base de datos que tenga ese cif
        $query = $this->db->get('empleado');

        return $query->result_array();
    }

    public function deletear($id)
    {
        $this->db->delete('empleado', array('id' => $id));
    }

    function updatear($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->set('id_empresa', $data['id_empresa']);
        $this->db->set('id_tipo', $data['id_tipo']);
        $this->db->set('nombre', $data['nombre']);
        $this->db->set('dni', $data['dni']);
        $this->db->set('correo', $data['correo']);
        $this->db->set('telefono', $data['telefono']);
        
        return $this->db->update('empleado');
    }
}
