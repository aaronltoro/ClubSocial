<?php

class Tipo_empleado_Model extends CI_Model
{

    

    public function get_todos($ret_type = false)
    {
        //Retorna todas las tipo_empleados de la base de datos si la variable ret_type está a true devuelve un objeto sino un array
        $query = $this->db->get('tipo_empleado');

        if ($ret_type) {
            return $query->result();
        } else {
            return $query->result_array();
        }
    }

    public function get_nombre($nombre)
    {
        //Si $nombre coincide con un registro de la base de datos, los trae (%$nombre%)
        $this->db->like('nombre', $nombre, 'both'); 

        //Retorna la tipo_empleado de la base de datos que tenga ese nombre
        $query = $this->db->get('tipo_empleado');

        return $query->result_array();
    }

    public function get_cif($cif)
    {
        //Si $cif coincide con un registro de la base de datos, los trae (%$nombre%)
        $this->db->like('cif', $cif, 'both'); 

        //Retorna la tipo_empleado de la base de datos que tenga ese cif
        $query = $this->db->get('tipo_empleado');

        return $query->result_array();
    }

}
