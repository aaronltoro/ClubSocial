<?php

require 'application/libraries/phpspreadsheet/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Empleado_Model extends CI_Model
{

    public function insertar($data)
    {
        //Inserta una empleado en la base de datos con los valores del array
        $this->db->insert('empleado', $data);
    }

    public function get_todos($ret_type = false)
    {
        //Filtro para traer solo los campos que tengan eliminado a 0
        $this->db->where('eliminado', 0);

        //Ordeno por nombre ascendente
        $this->db->order_by('nombre', 'ASC');

        //Retorna todas las empleados de la base de datos si la variable ret_type está a true devuelve un objeto sino un array
        $query = $this->db->get('empleado');

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

        //Filtro para traer solo los campos que tengan eliminado a 0
        $this->db->where('eliminado', 0);

        //Retorna la empleado de la base de datos que tenga ese nombre
        $query = $this->db->get('empleado');

        return $query->result_array();
    }

    public function get_dni($dni)
    {
        //Si $cif coincide con un registro de la base de datos, los trae (%$nombre%)
        $this->db->like('dni', $dni, 'both');

        //Filtro para traer solo los campos que tengan eliminado a 0
        $this->db->where('eliminado', 0);

        //Retorna la empleado de la base de datos que tenga ese cif
        $query = $this->db->get('empleado');

        return $query->result_array();
    }

    public function deletear($id)
    {
        // $this->db->delete('empleado', array('id' => $id));

        $this->db->where('id', $id);

        $this->db->set('eliminado', 1);

        return $this->db->update('empleado');
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

    public function create_spreadsheet($data, $start_row)
    {
        $current_row = $start_row;

        //Declaro nuevo spreadsheet
        $spreadsheet = new Spreadsheet();

        //Header
        $spreadsheet->getActiveSheet()
            ->setCellValue('B2', 'Nombre Completo')
            ->setCellValue('C2', 'DNI')
            ->setCellValue('D2', 'Telefono')
            ->setCellValue('E2', 'Correo')
            ->setCellValue('F2', 'Empresa')
            ->setCellValue('G2', 'Tipo');

        //Datos
        foreach ($data as $dt) {
            $spreadsheet->getActiveSheet()->insertNewRowBefore($current_row + 1, 1);

            $spreadsheet->getActiveSheet()
                ->setCellValue('B' . $current_row, $dt['nombre'])
                ->setCellValue('C' . $current_row, $dt['dni'].' ')
                ->setCellValue('D' . $current_row, $dt['telefono'])
                ->setCellValue('E' . $current_row, $dt['correo'])
                ->setCellValue('F' . $current_row, $dt['id_empresa'])
                ->setCellValue('G' . $current_row, $dt['id_tipo']);

            $current_row++;
        }

        //Styles
        $spreadsheet->getActiveSheet()->getStyle('B2:G2')->getFont()->setBold(true); // Establecer la fuente de la celda en negrita
        $spreadsheet->getActiveSheet()->getStyle('B2:G2')->getFont()->getColor()->setARGB('000000'); // Color de letra
        $spreadsheet->getActiveSheet()->getStyle('B2:G2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('34A853'); // Color de fondo de celda

        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true); // Establecer ancho de columna
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true); // Establecer ancho de columna
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true); // Establecer ancho de columna
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true); // Establecer ancho de columna
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true); // Establecer ancho de columna
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true); // Establecer ancho de columna

        return $spreadsheet;
    }
}
