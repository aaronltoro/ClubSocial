<?php

require 'application\libraries\phpspreadsheet\vendor\autoload.php';

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
   

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

    public function get_todos_dev($ret_type = false)
    {
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

    function exportar_alumnos($data)
    {   

    $spreadsheet = new Spreadsheet();
    $spreadsheet->setActiveSheetIndex(0);
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'Nombre Completo');
    $sheet->setCellValue('B1', 'Telefono');
    $sheet->setCellValue('C1', 'Correo');
    $sheet->setCellValue('D1', 'Ciclo');
    $sheet->setCellValue('E1', 'Curso Escolar');

    $i = 2; // La primera fila está ocupada por el encabezado

    foreach($data as $usu){
        // Establecer el valor de la celda
$sheet=$spreadsheet->getActiveSheet()->setCellValue('A'.$i,$usu['nombre']);
$sheet=$spreadsheet->getActiveSheet()->setCellValue('B'.$i,$usu['telefono']);
$sheet=$spreadsheet->getActiveSheet()->setCellValue('C'.$i,$usu['correo']);
$sheet=$spreadsheet->getActiveSheet()->setCellValue('D'.$i,$usu['id_ciclo']);
$sheet=$spreadsheet->getActiveSheet()->setCellValue('E'.$i,$usu['curso_escolar']);
$i++;
} // Establecer la fuente y el tamaño de fuente en su conjunto
$spreadsheet-> getDefaultStyle () -> getFont () -> setName ('Arial'); // Establecer la fuente como un todo
$spreadsheet-> getDefaultStyle () -> getFont () -> setSize (10); // Establecer el tamaño de fuente como un todo


// $spreadsheet-> getActiveSheet () -> getColumnDimension ('B') -> setAutoSize (true); // Ancho de celda adaptable
$spreadsheet-> getActiveSheet () -> getColumnDimension ('A') -> setAutoSize (true); // Establecer el ancho de la columna
$spreadsheet-> getActiveSheet () -> getColumnDimension ('B') -> setAutoSize (true); // Establecer ancho de columna
$spreadsheet-> getActiveSheet () -> getColumnDimension ('C') -> setAutoSize (true); // Establecer el ancho de la columna
$spreadsheet-> getActiveSheet () -> getColumnDimension ('D') -> setAutoSize (true); // Establecer ancho de columna
$spreadsheet-> getActiveSheet () -> getColumnDimension ('E') -> setAutoSize (true); // Establecer ancho de columna
$spreadsheet-> getActiveSheet () -> getStyle ('B3') -> getFont () -> setBold (true); // Establecer la fuente de la celda en negrita


$writer = new Xlsx($spreadsheet);
$writer->save('exportaciones/exportacionAlumnos.xlsx');
    }
}
