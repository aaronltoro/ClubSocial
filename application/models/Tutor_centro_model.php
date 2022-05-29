<?php

require 'application/libraries/phpspreadsheet/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;

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

    //Ordeno por nombre ascendente
    $this->db->order_by('nombre', 'ASC');

    //Retorna todas las tutores de la base de datos si la variable ret_type está a true devuelve un objeto sino un array
    $query = $this->db->get('tutor_centro');

    if ($ret_type) {
      return $query->result();
    } else {
      return $query->result_array();
    }
  }

  public function get_todos_dev($ret_type = false)
  {
    //Ordeno por nombre ascendente
    $this->db->order_by('nombre', 'ASC');

    //Retorna todas las tutores de la base de datos si la variable ret_type está a true devuelve un objeto sino un array
    $query = $this->db->get('tutor_centro');

    if ($ret_type) {
      return $query->result();
    } else {
      return $query->result_array();
    }
  }

  public function get_activo($activo)
  {
    //Filtro
    $this->db->where('activo', $activo);

    //Filtro para traer solo los campos que tengan eliminado a 0
    $this->db->where('eliminado', 0);

    //Retorna el tutor de la base de datos que tenga ese id
    $query = $this->db->get('tutor_centro');

    return $query->result_array();
  }

  public function get_id($id)
  {
    //Filtro
    $this->db->where('id', $id);

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
    $this->db->set('activo', $data['activo']);

    return $this->db->update('tutor_centro');
  }

  public function create_spreadsheet($data, $start_row)
    {
        $current_row = $start_row;

        //Declaro nuevo spreadsheet
        $spreadsheet = new Spreadsheet();

        //Header
        $spreadsheet->getActiveSheet()
            ->setCellValue('B2', 'Nombre Completo')
            ->setCellValue('C2', 'Telefono')
            ->setCellValue('D2', 'Correo')
            ->setCellValue('E2', 'Activo');

        //Datos
        foreach ($data as $dt) {
            $spreadsheet->getActiveSheet()->insertNewRowBefore($current_row + 1, 1);

            $spreadsheet->getActiveSheet()
                ->setCellValue('B' . $current_row, $dt['nombre'])
                ->setCellValue('C' . $current_row, $dt['telefono'].' ')
                ->setCellValue('D' . $current_row, $dt['correo'])
                ->setCellValue('E' . $current_row, $dt['activo']);

            $current_row++;
        }

        //Styles
        $spreadsheet->getActiveSheet()->getStyle('B2:E2')->getFont()->setBold(true); // Establecer la fuente de la celda en negrita
        $spreadsheet->getActiveSheet()->getStyle('B2:E2')->getFont()->getColor()->setARGB('000000'); // Color de letra
        $spreadsheet->getActiveSheet()->getStyle('B2:E2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FBBC05'); // Color de fondo de celda

        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true); // Establecer ancho de columna
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true); // Establecer ancho de columna
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true); // Establecer ancho de columna
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true); // Establecer ancho de columna

        return $spreadsheet;
    }
}
