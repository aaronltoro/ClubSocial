<?php

class Alumno_Model extends CI_Model
{

    public function insertar($data)
    {
        //Inserta una alumno en la base de datos con los valores del array
        $this->db->insert('alumno', $data);
    }

    public function get_todos($ret_type = false)
    {
        //Filtro para traer solo los campos que tengan eliminado a 0
        $this->db->where('eliminado', 0);

        //Ordeno por nombre ascendente
        $this->db->order_by('nombre', 'ASC');

        //Retorna todas las alumnos de la base de datos si la variable ret_type está a true devuelve un objeto sino un array
        $query = $this->db->get('alumno');

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

        //Retorna la alumno de la base de datos que tenga ese id
        $query = $this->db->get('alumno');

        return $query->result_array();
    }

    public function get_nombre($nombre)
    {
        //Si $nombre coincide con un registro de la base de datos, los trae ($nombre%)
        $this->db->like('nombre', $nombre, 'both');

        //Filtro para traer solo los campos que tengan eliminado a 0
        $this->db->where('eliminado', 0);

        //Retorna la alumno de la base de datos que tenga ese nombre
        $query = $this->db->get('alumno');

        return $query->result_array();
    }

    public function get_ciclo($ciclo)
    {
        //Si $ciclo coincide con un registro de la base de datos, los trae (%$nombre%)
        $this->db->like('nombre_corto', $ciclo, 'both');

        //Retorna la alumno de la base de datos que tenga ese cif
        $query = $this->db->get('ciclos');

        return $query->result_array();
    }

    public function get_ciclo_alu($ciclo)
    {
        //Si $ciclo coincide con un registro de la base de datos, los trae (%$nombre%)
        $this->db->where('id_ciclo', $ciclo);

        //Filtro para traer solo los campos que tengan eliminado a 0
        $this->db->where('eliminado', 0);

        //Retorna la alumno de la base de datos que tenga ese cif
        $query = $this->db->get('alumno');

        return $query->result_array();
    }

    public function get_curso($curso)
    {
        //Si $ciclo coincide con un registro de la base de datos, los trae (%$nombre%)
        $this->db->like('curso_escolar', $curso, 'both');

        //Filtro para traer solo los campos que tengan eliminado a 0
        $this->db->where('eliminado', 0);

        //Retorna la alumno de la base de datos que tenga ese cif
        $query = $this->db->get('alumno');

        return $query->result_array();
    }

    public function deletear($id)
    {
        // $this->db->delete('alumno', array('id' => $id));

        $this->db->where('id', $id);

        $this->db->set('eliminado', 1);

        return $this->db->update('alumno');
    }

    function updatear($id, $data)
    {
        $this->db->where('id', $id);

        $this->db->set('nombre', $data['nombre']);
        $this->db->set('telefono', $data['telefono']);
        $this->db->set('correo', $data['correo']);
        $this->db->set('id_ciclo', $data['id_ciclo']);
        $this->db->set('curso_escolar', $data['curso_escolar']);

        return $this->db->update('alumno');
    }
}
