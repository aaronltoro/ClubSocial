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

        //Filtro para traer solo los campos que tengan eliminado a 0
        $this->db->where('eliminado', 0);

        //Retorna la practica de la base de datos que tenga ese id
        $query = $this->db->get('practicas');

        return $query->result_array();
    }

    public function deletear($id)
    {
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
            ->setCellValue('A1', 'Séneca')
            ->setCellValue('B1', 'Observaciones')
            ->setCellValue('C1', 'Curso Escolar')
            ->setCellValue('D1', 'Ciclo')
            ->setCellValue('E1', 'Fecha Incorporación')
            ->setCellValue('F1', 'Alumnado Nombre Completo')
            ->setCellValue('G1', 'Teléfono Alumno')
            ->setCellValue('H1', 'Correo Alumno')
            ->setCellValue('I1', 'Empresa')
            ->setCellValue('J1', 'Empresa CIF(DNI si es autónomo)')
            ->setCellValue('K1', 'Dirección Empresa')
            ->setCellValue('L1', 'Persona Contacto Nombre Completo')
            ->setCellValue('M1', 'Correo/Teléfono Persona Contacto')
            ->setCellValue('N1', 'Representante Legal Nombre Completo')
            ->setCellValue('O1', 'Representante Legal DNI')
            ->setCellValue('P1', 'Tutor Laboral Nombre Completo')
            ->setCellValue('Q1', 'Tutor Laboral DNI')
            ->setCellValue('R1', 'Correo/Teléfono Tutor Laboral')
            ->setCellValue('S1', 'Tutor Docente Nombre Completo')
            ->setCellValue('T1', 'Correo/Teléfono Tutor Docente')
            ->setCellValue('U1', 'Dirección realización prácticas');

        //Datos
        foreach ($data as $dt) {
            $spreadsheet->getActiveSheet()->insertNewRowBefore($current_row + 1, 1);

            $nombre_tutor_laboral = '';
            $dni_tutor_laboral = '';
            $correotlf_tutor_laboral = '';
            $nombre_representante_legal = '';
            $dni_representante_legal = '';
            $nombre_persona_contacto = '';
            $correotlf_persona_contacto = '';

            if($dt['empleado'][0]['id_tipo'] == 'Tutor Laboral'){
                $nombre_tutor_laboral = $dt['empleado'][0]['nombre'];
                $dni_tutor_laboral = $dt['empleado'][0]['dni'];
                $correotlf_tutor_laboral = $dt['empleado'][0]['correo'].' / '.$dt['empleado'][0]['telefono'];
            } elseif ($dt['empleado'][0]['id_tipo'] == 'Representante Empresa'){
                $nombre_representante_legal = $dt['empleado'][0]['nombre'];
                $dni_representante_legal = $dt['empleado'][0]['dni'];
            } elseif ($dt['empleado'][0]['id_tipo'] == 'Persona Contacto'){
                $nombre_persona_contacto = $dt['empleado'][0]['nombre'];
                $correotlf_persona_contacto = $dt['empleado'][0]['correo'].' / '.$dt['empleado'][0]['telefono'];
            }

            $spreadsheet->getActiveSheet()
                ->setCellValue('A' . $current_row, $dt['practica']['seneca'])
                ->setCellValue('B' . $current_row, '')
                ->setCellValue('C' . $current_row, $dt['alumno'][0]['curso_escolar'])
                ->setCellValue('D' . $current_row, $dt['alumno'][0]['id_ciclo'])
                ->setCellValue('E' . $current_row, $dt['practica']['fecha_incorporacion'])
                ->setCellValue('F' . $current_row, $dt['alumno'][0]['nombre'])
                ->setCellValue('G' . $current_row, $dt['alumno'][0]['telefono'])
                ->setCellValue('H' . $current_row, $dt['alumno'][0]['correo'])
                ->setCellValue('I' . $current_row, $dt['empresa'][0]['nombre'])
                ->setCellValue('J' . $current_row, $dt['empresa'][0]['cif'])
                ->setCellValue('K' . $current_row, $dt['empresa'][0]['principal'])
                ->setCellValue('L' . $current_row, $nombre_persona_contacto)
                ->setCellValue('M' . $current_row, $correotlf_persona_contacto)
                ->setCellValue('N' . $current_row, $nombre_representante_legal)
                ->setCellValue('O' . $current_row, $dni_representante_legal)
                ->setCellValue('P' . $current_row, $nombre_tutor_laboral)
                ->setCellValue('Q' . $current_row, $dni_tutor_laboral)
                ->setCellValue('R' . $current_row, $correotlf_tutor_laboral)
                ->setCellValue('S' . $current_row, $dt['tutor'][0]['nombre'])
                ->setCellValue('T' . $current_row, $dt['tutor'][0]['correo'].' / '.$dt['tutor'][0]['telefono'])
                ->setCellValue('U' . $current_row, $dt['practica']['sede']);

            $current_row++;
        }

        //Styles
        $spreadsheet->getActiveSheet()->getStyle('A1:U1')->getFont()->setBold(true); // Establecer la fuente de la celda en negrita
        $spreadsheet->getActiveSheet()->getStyle('A1:U1')->getFont()->getColor()->setARGB('FFFFFF'); // Color de letra
        $spreadsheet->getActiveSheet()->getStyle('A1:U1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('000000'); // Color de fondo de celda

        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true); // Establecer ancho de columna
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true); // Establecer ancho de columna
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true); // Establecer ancho de columna
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true); // Establecer ancho de columna
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true); // Establecer ancho de columna
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true); // Establecer ancho de columna
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true); // Establecer ancho de columna
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true); // Establecer ancho de columna
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true); // Establecer ancho de columna
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true); // Establecer ancho de columna
        $spreadsheet->getActiveSheet()->getColumnDimension('K')->setAutoSize(true); // Establecer ancho de columna
        $spreadsheet->getActiveSheet()->getColumnDimension('L')->setAutoSize(true); // Establecer ancho de columna
        $spreadsheet->getActiveSheet()->getColumnDimension('M')->setAutoSize(true); // Establecer ancho de columna
        $spreadsheet->getActiveSheet()->getColumnDimension('N')->setAutoSize(true); // Establecer ancho de columna
        $spreadsheet->getActiveSheet()->getColumnDimension('O')->setAutoSize(true); // Establecer ancho de columna
        $spreadsheet->getActiveSheet()->getColumnDimension('P')->setAutoSize(true); // Establecer ancho de columna
        $spreadsheet->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true); // Establecer ancho de columna
        $spreadsheet->getActiveSheet()->getColumnDimension('R')->setAutoSize(true); // Establecer ancho de columna
        $spreadsheet->getActiveSheet()->getColumnDimension('S')->setAutoSize(true); // Establecer ancho de columna
        $spreadsheet->getActiveSheet()->getColumnDimension('T')->setAutoSize(true); // Establecer ancho de columna
        $spreadsheet->getActiveSheet()->getColumnDimension('U')->setAutoSize(true); // Establecer ancho de columna

        return $spreadsheet;
    }
}
