<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Practicas_controller extends CI_Controller
{

    var $err;
    var $filt = array();
    var $alumno = array();
    var $empresa = array();
    var $empleado = array();
    var $tutor = array();

    public function search_filters()
    {

        //Recojo los parametros enviados por ajax y los meto en un array
        $res = array(
            'tipo' => $this->input->post('filter_by'),
            'filtro' => $this->input->post('filter')
        );

        //Variable que contiene todos los datos de la tabla (SOLO PARA COMPARAR)
        $compare = $this->compare();

        //Variable que comprueba si hay algún error en el filtro
        $is_err = true;

        switch ($res['tipo']) {
            case '-1':
                //Llamo al modelo y lo que me devuelve lo seteo en la variable $this->prac que se enviará a la view resultado
                $this->load->model('Practicas_model', 'Practicas_model', true);
                $this->prac = $this->Practicas_model->get_todos();

                //Solo intercambia los id por nombre cuando exista al menos 1 Practica
                if (sizeof($this->prac) > 0) {
                    foreach ($this->prac as $key => $prac) {

                        //Función que intercambia el id_alumno por su nombre
                        $this->load->model('Alumno_model', 'Alumno_model', true);
                        $n_alumno = $this->Alumno_model->get_id($prac['id_alumno']);
                        $this->prac[$key]['id_alumno'] = $n_alumno[0]['nombre'];

                        //Función que intercambia el id_empresa por su nombre
                        $this->load->model('Empresa_model', 'Empresa_model', true);
                        $n_empresa = $this->Empresa_model->get_id($prac['id_empresa']);
                        $this->prac[$key]['id_empresa'] = $n_empresa[0]['nombre'];

                        //Función que intercambia el id_empleado por su nombre
                        $this->load->model('Empleado_model', 'Empleado_model', true);
                        $n_empleado = $this->Empleado_model->get_id($prac['id_empleado']);
                        $this->prac[$key]['id_empleado'] = $n_empleado[0]['nombre'];

                        //Función que intercambia el id_tutor_centro por su nombre
                        $this->load->model('Tutor_centro_model', 'Tutor_centro_model', true);
                        $n_tutor_centro = $this->Tutor_centro_model->get_id($prac['id_tutor_centro']);
                        $this->prac[$key]['id_tutor_centro'] = $n_tutor_centro[0]['nombre'];
                    }
                }

                $this->load->view('Resultado_Practicas');
                break;
            case 'a':
                // //Si el campo filtro no está vacío recorro todos los datos de la tabla y si encuentra alguno con el mismo nombre que pasó el usuario significa que existe
                // if ($res['filtro'] != '') {
                //     foreach ($compare as $comp) {
                //         if (str_contains($comp['nombre'], $res['filtro'])) {
                //             $is_err = false;
                //         }
                //     }
                // } else {
                //     //Si el campo filtro está vacío $is_err valdrá false y los traerá todos de la base de datos, luego detiene la ejecución
                //     $is_err = false;
                //     $this->load->model('Empleado_model', 'Empleado_model', true);
                //     $this->emp = $this->Empleado_model->get_todos();

                //     //Solo intercambia los id por nombre cuando exista al menos 1 empleado
                //     if (sizeof($this->emp) > 0) {
                //         foreach ($this->emp as $key => $emp) {
                //             //Función que intercambia el id_empresa por su nombre
                //             $this->load->model('Empresa_model', 'Empresa_model', true);
                //             $n_empresa = $this->Empresa_model->get_id($emp['id_empresa']);
                //             $this->emp[$key]['id_empresa'] = $n_empresa[0]['nombre'];

                //             //Función que intercambia el id_tipo por su nombre
                //             $this->load->model('Tipo_empleado_model', 'Tipo_empleado_model', true);
                //             $n_tipo = $this->Tipo_empleado_model->get_id($emp['id_tipo']);
                //             $this->emp[$key]['id_tipo'] = $n_tipo[0]['nombre'];
                //         }
                //     }

                //     $this->load->view('Resultado_Empleado');
                //     break;
                // }

                // //Si la variable de errores es false significa que no hay errores y por lo tanto llamo al modelo y lo que me devuelve lo seteo en la variable $this->emp que se enviará a la view resultado
                // if (!$is_err) {
                //     $this->load->model('Empleado_model', 'Empleado_model', true);
                //     $this->emp = $this->Empleado_model->get_nombre($res['filtro']);

                //     //Solo intercambia los id por nombre cuando exista al menos 1 empleado
                //     if (sizeof($this->emp) > 0) {
                //         foreach ($this->emp as $key => $emp) {
                //             //Función que intercambia el id_empresa por su nombre
                //             $this->load->model('Empresa_model', 'Empresa_model', true);
                //             $n_empresa = $this->Empresa_model->get_id($emp['id_empresa']);
                //             $this->emp[$key]['id_empresa'] = $n_empresa[0]['nombre'];

                //             //Función que intercambia el id_tipo por su nombre
                //             $this->load->model('Tipo_empleado_model', 'Tipo_empleado_model', true);
                //             $n_tipo = $this->Tipo_empleado_model->get_id($emp['id_tipo']);
                //             $this->emp[$key]['id_tipo'] = $n_tipo[0]['nombre'];
                //         }
                //     }

                //     $this->load->view('Resultado_Empleado');
                // } else {
                //     //Importante! Doy valor a la variable $this->err que se va a pasar a la view en caso de error
                //     $this->err = 'El filtro solicitado no existe';
                //     $this->load->view('Error_Empleado');
                // }
                break;
            case 'e':

                break;
            case 'empl':

                break;
            case 't':

                break;
        }
    }

    public function add_practicas()
    {
        //Recojo los parametros enviados por ajax y los meto en un array
        $res = array(
            'id_alumno' => $this->input->post('idAlumno'),
            'id_empresa' => $this->input->post('idEmpresa'),
            'sede' => $this->input->post('sede'),
            'id_empleado' => $this->input->post('idEmpleado'),
            'id_tutor_centro' => $this->input->post('idTutor'),
            'seneca' => $this->input->post('activo'),
            'fecha_incorporacion' => $this->input->post('fecha_incorporacion')
        );

        //Llamo al modelo y añado la nueva Practica, después vuelvo a cargar la tabla con todos los campos
        $this->load->model('Practicas_model', 'Practicas_model', true);
        $this->Practicas_model->insertar($res);
        $this->tabla_ini();
    }

    public function modify_practicas()
    {
        //Recojo los parametros enviados por ajax y los meto en un array
        $res = array(
            'id_alumno' => $this->input->post('idAlumno'),
            'id_empresa' => $this->input->post('idEmpresa'),
            'sede' => $this->input->post('sede'),
            'id_empleado' => $this->input->post('idEmpleado'),
            'id_tutor' => $this->input->post('idTutor'),
            'seneca' => $this->input->post('activo'),
            'fecha_incorporacion' => $this->input->post('fecha_incorporacion')
        );

        //Llamo al modelo y modifico la Practica seleccionada, después vuelvo a cargar la tabla con todos los campos
        $this->load->model('Practicas_model', 'Practicas_model', true);
        $this->Practicas_model->updatear($this->input->post('id'), $res);
        $this->tabla_ini();
    }


    public function delete_practicas()
    {
        //Llamo al modelo y borro la Practica seleccionada, después vuelvo a cargar la tabla con todos los campos
        $this->load->model('Practicas_model', 'Practicas_model', true);
        $this->Practicas_model->deletear($this->input->post('id'));
        $this->tabla_ini();
    }

    public function tabla_ini()
    {
        //Función que carga la tabla completa al iniciar la página
        $this->load->model('Practicas_model', 'Practicas_model', true);
        $this->prac = $this->Practicas_model->get_todos();

        //Solo intercambia los id por nombre cuando exista al menos 1 Practica
        if (sizeof($this->prac) > 0) {
            foreach ($this->prac as $key => $prac) {

                //Función que intercambia el id_alumno por su nombre
                $this->load->model('Alumno_model', 'Alumno_model', true);
                $n_alumno = $this->Alumno_model->get_id($prac['id_alumno']);
                $this->prac[$key]['id_alumno'] = $n_alumno[0]['nombre'];

                //Función que intercambia el id_empresa por su nombre
                $this->load->model('Empresa_model', 'Empresa_model', true);
                $n_empresa = $this->Empresa_model->get_id($prac['id_empresa']);
                $this->prac[$key]['id_empresa'] = $n_empresa[0]['nombre'];

                //Función que intercambia el id_empleado por su nombre
                $this->load->model('Empleado_model', 'Empleado_model', true);
                $n_empleado = $this->Empleado_model->get_id($prac['id_empleado']);
                $this->prac[$key]['id_empleado'] = $n_empleado[0]['nombre'];

                //Función que intercambia el id_tutor_centro por su nombre
                $this->load->model('Tutor_centro_model', 'Tutor_centro_model', true);
                $n_tutor_centro = $this->Tutor_centro_model->get_id($prac['id_tutor_centro']);
                $this->prac[$key]['id_tutor_centro'] = $n_tutor_centro[0]['nombre'];
            }
        }

        $this->load->view('Resultado_practicas');
    }

    private function compare()
    {
        //Función que devuelve todos los datos de la tabla Practicas
        $this->load->model('Practicas_model', 'Practicas_model', true);
        return $this->Practicas_model->get_todos();
    }

    public function load_insert()
    {
        //Función que devuelve todos los datos de la tabla Empresa
        $this->load->model('Empresa_model', 'Empresa_model', true);
        $this->empresa = $this->Empresa_model->get_todos();
        //Función que devuelve todos los datos de la tabla Alumno
        $this->load->model('Alumno_model', 'Alumno_model', true);
        $this->alumno = $this->Alumno_model->get_todos();
        //Función que devuelve todos los datos de la tabla Empleado
        $this->load->model('Empleado_model', 'Empleado_model', true);
        $this->empleado = $this->Empleado_model->get_todos();
        //Función que devuelve todos los datos de la tabla Tutor_centro
        $this->load->model('Tutor_centro_model', 'Tutor_centro_model', true);
        $this->tutor = $this->Tutor_centro_model->get_todos();

        $this->load->view('Insert_practicas');
    }

    public function load_modify()
    {
        //Función que devuelve todos los datos de la tabla Empresa
        $this->load->model('Empresa_model', 'Empresa_model', true);
        $this->empresa = $this->Empresa_model->get_todos();
        //Función que devuelve todos los datos de la tabla Alumno
        $this->load->model('Alumno_model', 'Alumno_model', true);
        $this->alumno = $this->Alumno_model->get_todos();
        //Función que devuelve todos los datos de la tabla Empleado
        $this->load->model('Empleado_model', 'Empleado_model', true);
        $this->empleado = $this->Empleado_model->get_todos();
        //Función que devuelve todos los datos de la tabla Tutor_centro
        $this->load->model('Tutor_centro_model', 'Tutor_centro_model', true);
        $this->tutor = $this->Tutor_centro_model->get_todos();

        //Función que carga la practica con el id que tiene la fila que ha pulsado el usuario
        $this->load->model('Practicas_model', 'Practicas_model', true);
        $this->prac = $this->Practicas_model->get_id($this->input->post('id'));

        $this->load->view('Update_practicas');
    }
}
