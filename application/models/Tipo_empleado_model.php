<?php

class Tipo_empleado_Model extends CI_Model
{

    public function get_todos($ret_type = false)
    {
        //Ordeno por nombre ascendente
        $this->db->order_by('nombre', 'ASC');
        
        //Retorna todas las tipo_empleados de la base de datos si la variable ret_type está a true devuelve un objeto sino un array
        $query = $this->db->get('tipo_empleado');

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

        //Retorna el empleado de la base de datos que tenga ese id
        $query = $this->db->get('tipo_empleado');

        return $query->result_array();
    }

}
