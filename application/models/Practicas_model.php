<?php

require 'application/libraries/phpspreadsheet/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Practicas_Model extends CI_Model
{

    public function insertar($data)
    {
        //Inserta una practica en la base de datos con los valores del array
        $this->db->insert('practicas', $data);
    }

    public function get_todos($ret_type = false)
    {
        //Filtro para traer solo los campos que tengan eliminado a 0
        $this->db->where('eliminado', 0);

        //Retorna todas las practicas de la base de datos si la variable ret_type está a true devuelve un objeto sino un array
        $query = $this->db->get('practicas');

        if ($ret_type) {
            return $query->result();
        } else {
            return $query->result_array();
        }
    }

    public function get_alumno($nombre)
    {
        $this->db->select('practicas.id,id_alumno,id_empresa,sede,id_empleado,id_tutor_centro,seneca,fecha_incorporacion,practicas.eliminado')
            ->from('practicas')
            ->join('alumno', 'practicas.id_alumno = alumno.id')
            ->like('alumno.nombre', $nombre, 'both')
            ->where('practicas.eliminado', 0);

        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_empleado($nombre)
    {
        $this->db->select('practicas.id,id_alumno,practicas.id_empresa,sede,id_empleado,id_tutor_centro,seneca,fecha_incorporacion,practicas.eliminado')
            ->from('practicas')
            ->join('empleado', 'practicas.id_empleado = empleado.id')
            ->like('empleado.nombre', $nombre, 'both')
            ->where('practicas.eliminado', 0);

        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_empresa($nombre)
    {
        $this->db->select('practicas.id,id_alumno,id_empresa,sede,id_empleado,id_tutor_centro,seneca,fecha_incorporacion,practicas.eliminado')
            ->from('practicas')
            ->join('empresa', 'practicas.id_empresa = empresa.id')
            ->like('empresa.nombre', $nombre, 'both')
            ->where('practicas.eliminado', 0);

        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_tutor($nombre)
    {
        $this->db->select('practicas.id,id_alumno,id_empresa,sede,id_empleado,id_tutor_centro,seneca,fecha_incorporacion,practicas.eliminado')
            ->from('practicas')
            ->join('tutor_centro', 'practicas.id_tutor_centro = tutor_centro.id')
            ->like('tutor_centro.nombre', $nombre, 'both')
            ->where('practicas.eliminado', 0);

        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_id($id)
    {
        //Filtro
        $this->db->where('id', $id);

        //Retorna la practica de la base de datos que tenga ese id
        $query = $this->db->get('practicas');

        return $query->result_array();
    }

    
  public function get_seneca($seneca)
  {
    //Filtro
    $this->db->where('seneca', $seneca);


    //Retorna la practica de la base de datos que tenga ese id
    $query = $this->db->get('practicas');

    return $query->result_array();
  }

    public function deletear($id)
    {
        // $this->db->delete('empleado', array('id' => $id));

        $this->db->where('id', $id);

        $this->db->set('eliminado', 1);

        return $this->db->update('practicas');
    }

    function updatear($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->set('id_alumno', $data['id_alumno']);
        $this->db->set('id_empresa', $data['id_empresa']);
        $this->db->set('sede', $data['sede']);
        $this->db->set('id_empleado', $data['id_empleado']);
        $this->db->set('id_tutor_centro', $data['id_tutor']);
        $this->db->set('seneca', $data['seneca']);
        $this->db->set('fecha_incorporacion', $data['fecha_incorporacion']);

        return $this->db->update('practicas');
    }

    public function create_spreadsheet($data, $start_row)
    {
        $current_row = $start_row;

        //Declaro nuevo spreadsheet
        $spreadsheet = new Spreadsheet();

        //Header
        $spreadsheet->getActiveSheet()
            ->setCellValue('B2', 'Alumno')
            ->setCellValue('C2', 'Empresa')
            ->setCellValue('D2', 'Sede')
            ->setCellValue('E2', 'Empleado')
            ->setCellValue('F2', 'Tutor Centro')
            ->setCellValue('G2', 'Séneca')
            ->setCellValue('H2', 'Fecha Incorporación');

        //Datos
        foreach ($data as $dt) {
            $spreadsheet->getActiveSheet()->insertNewRowBefore($current_row + 1, 1);

            $spreadsheet->getActiveSheet()
                ->setCellValue('B' . $current_row, $dt['id_alumno'])
                ->setCellValue('C' . $current_row, $dt['id_empresa'])
                ->setCellValue('D' . $current_row, $dt['sede'])
                ->setCellValue('E' . $current_row, $dt['id_empleado'])
                ->setCellValue('F' . $current_row, $dt['id_tutor_centro'])
                ->setCellValue('G' . $current_row, $dt['seneca'])
                ->setCellValue('H' . $current_row, $dt['fecha_incorporacion']);

            $current_row++;
        }

        //Styles
        $spreadsheet->getActiveSheet()->getStyle('B2:H2')->getFont()->setBold(true); // Establecer la fuente de la celda en negrita
        $spreadsheet->getActiveSheet()->getStyle('B2:H2')->getFont()->getColor()->setARGB('FFFFFF'); // Color de letra
        $spreadsheet->getActiveSheet()->getStyle('B2:H2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('000000'); // Color de fondo de celda

        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true); // Establecer ancho de columna
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true); // Establecer ancho de columna
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true); // Establecer ancho de columna
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true); // Establecer ancho de columna
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true); // Establecer ancho de columna
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true); // Establecer ancho de columna
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true); // Establecer ancho de columna

        return $spreadsheet;
    }
}
