<?php

require 'application/libraries/phpspreadsheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use \PhpOffice\PhpSpreadsheet\IOFactory;

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

    public function get_all_cursoEscolar()
    {
        //traer la columna curso Escolar
        $this->db->select('curso_escolar');

        //Filtro para traer solo los campos que tengan eliminado a 0
        $this->db->where('eliminado', 0);

        $this->db->order_by('curso_escolar', 'ASC');
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
            ->setCellValue('E2', 'Ciclo')
            ->setCellValue('F2', 'Curso Escolar');

        //Datos
        foreach ($data as $dt) {
            $spreadsheet->getActiveSheet()->insertNewRowBefore($current_row + 1, 1);

            $spreadsheet->getActiveSheet()
                ->setCellValue('B' . $current_row, $dt['nombre'])
                ->setCellValue('C' . $current_row, $dt['telefono'] . ' ')
                ->setCellValue('D' . $current_row, $dt['correo'])
                ->setCellValue('E' . $current_row, $dt['id_ciclo'])
                ->setCellValue('F' . $current_row, $dt['curso_escolar']);

            $current_row++;
        }

        //Styles
        $spreadsheet->getActiveSheet()->getStyle('B2:F2')->getFont()->setBold(true); // Establecer la fuente de la celda en negrita
        $spreadsheet->getActiveSheet()->getStyle('B2:F2')->getFont()->getColor()->setARGB('000000'); // Color de letra
        $spreadsheet->getActiveSheet()->getStyle('B2:F2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('EA4335'); // Color de fondo de celda

        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true); // Establecer ancho de columna
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true); // Establecer ancho de columna
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true); // Establecer ancho de columna
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true); // Establecer ancho de columna
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true); // Establecer ancho de columna

        return $spreadsheet;
    }

    public function create_import_excel($data)
    {
        // Ruta del archivo a importar
        $documento = IOFactory::load($data);

        // Accedo a la primera hoja del excel
        $hojaDeProductos = $documento->getSheet(0);

        // Calcular el numero de filas del excel
        $numeroMayorDeFila = $hojaDeProductos->getHighestRow(); //Numérico

        //Inicializo el array data
        $data = array();

        // Recorremos filas; comenzamos en la fila 3 porque omitimos el encabezado
        for ($indiceFila = 3; $indiceFila <= $numeroMayorDeFila; $indiceFila++) {
            //Las columnas están en este orden
            $nombre = $hojaDeProductos->getCell('B' . $indiceFila);
            $telefono = $hojaDeProductos->getCell('C' . $indiceFila);
            $correo = $hojaDeProductos->getCell('D' . $indiceFila);
            $ciclo = $hojaDeProductos->getCell('E' . $indiceFila);
            $curso_escolar = $hojaDeProductos->getCell('F' . $indiceFila);

            //Cambio el nombre corto del ciclo por su id
            $this->load->model('Ciclo_model', 'Ciclo_model', true);
            $cicloId = $this->Ciclo_model->get_id_ciclo($ciclo->getValue());

            //Introduzco todos los valores en el array data
            array_push($data, [$nombre->getValue(), $telefono->getValue(), $correo->getValue(), $cicloId[0]['id'], $curso_escolar->getValue()]);
        }

        foreach ($data as $dt) {
            $res = array(
                'nombre' => $dt[0],
                'telefono' => $dt[1],
                'correo' =>  $dt[2],
                'id_ciclo' =>  $dt[3],
                'curso_escolar' =>  $dt[4]
            );

            //Inserto todos los valores en la base de datos
            $this->insertar($res);
        }
    }
}
