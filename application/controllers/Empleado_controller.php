<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Empleado_controller extends CI_Controller
{

	var $err;
	var $filt = array();
	var $empresa = array();
	var $tipo_empleado = array();

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
				//Llamo al modelo y lo que me devuelve lo seteo en la variable $this->emp que se enviará a la view resultado
				$this->load->model('Empleado_model', 'Empleado_model', true);
				$this->emp = $this->Empleado_model->get_todos();
				$this->load->view('Resultado_Empleado');
				break;
			case 'n':
				//Si el campo filtro no está vacío recorro todos los datos de la tabla y si encuentra alguno con el mismo nombre que pasó el usuario significa que existe
				if ($res['filtro'] != '') {
					foreach ($compare as $comp) {
						if (str_contains($comp['nombre'], $res['filtro'])) {
							$is_err = false;
						}
					}
				} else {
					//Si el campo filtro está vacío $is_err valdrá false y los traerá todos de la base de datos, luego detiene la ejecución
					$is_err = false;
					$this->load->model('Empleado_model', 'Empleado_model', true);
					$this->emp = $this->Empleado_model->get_todos();
					$this->load->view('Resultado_Empleado');
					break;
				}

				//Si la variable de errores es false significa que no hay errores y por lo tanto llamo al modelo y lo que me devuelve lo seteo en la variable $this->emp que se enviará a la view resultado
				if (!$is_err) {
					$this->load->model('Empleado_model', 'Empleado_model', true);
					$this->emp = $this->Empleado_model->get_nombre($res['filtro']);
					$this->load->view('Resultado_Empleado');
				} else {
					//Importante! Doy valor a la variable $this->err que se va a pasar a la view en caso de error
					$this->err = 'El filtro solicitado no existe';
					$this->load->view('Error_Empleado');
				}
				break;
			case 'd':
				//Si el campo filtro no está vacío recorro todos los datos de la tabla y si encuentra alguno con el mismo cif que pasó el usuario significa que existe
				if ($res['filtro'] != '') {
					foreach ($compare as $comp) {
						if (str_contains($comp['dni'], $res['filtro'])) {
							$is_err = false;
						}
					}
				} else {
					//Si el campo filtro está vacío $is_err valdrá false y los traerá todos de la base de datos, luego detiene la ejecución
					$is_err = false;
					$this->load->model('Empleado_model', 'Empleado_model', true);
					$this->emp = $this->Empleado_model->get_todos();
					$this->load->view('Resultado_Empleado');
					break;
				}

				//Si la variable de errores es false significa que no hay errores y por lo tanto llamo al modelo y lo que me devuelve lo seteo en la variable $this->emp que se enviará a la view resultado
				if (!$is_err) {
					$this->load->model('Empleado_model', 'Empleado_model', true);
					$this->emp = $this->Empleado_model->get_dni($res['filtro']);
					$this->load->view('Resultado_Empleado');
				} else {
					//Importante! Doy valor a la variable $this->err que se va a pasar a la view en caso de error
					$this->err = 'El filtro solicitado no existe';
					$this->load->view('Error_Empleado');
				}
				break;
		}
	}

	public function add_empleado()
	{
		//Recojo los parametros enviados por ajax y los meto en un array
		$res = array(
			'id_empresa' => $this->input->post('idEmpresa'),
			'id_tipo' => $this->input->post('idTipo'),
			'nombre' => $this->input->post('nombre'),
			'dni' => $this->input->post('dni'),
			'correo' => $this->input->post('correo'),
			'telefono' => $this->input->post('telefono'),

		);

		//Llamo al modelo y añado la nueva Empleado, después vuelvo a cargar la tabla con todos los campos
		$this->load->model('Empleado_model', 'Empleado_model', true);
		$this->Empleado_model->insertar($res);
		$this->tabla_ini();
	}

	public function modify_empleado()
	{
		//Recojo los parametros enviados por ajax y los meto en un array
		$res = array(
			'nombre' => $this->input->post('nombre'),
			'id_empresa' => $this->input->post('idEmpresa'),
			'id_tipo' => $this->input->post('idTipo'),
			'dni' => $this->input->post('dni'),
			'correo' => $this->input->post('correo'),
			'telefono' => $this->input->post('telefono')

		);

		//Llamo al modelo y modifico la Empleado seleccionado, después vuelvo a cargar la tabla con todos los campos
		$this->load->model('Empleado_model', 'Empleado_model', true);
		$this->Empleado_model->updatear($this->input->post('id'), $res);
		$this->tabla_ini();
	}


	public function delete_empleado()
	{
		//Llamo al modelo y borro la Empleado seleccionada, después vuelvo a cargar la tabla con todos los campos
		$this->load->model('Empleado_model', 'Empleado_model', true);
		$this->Empleado_model->deletear($this->input->post('id'));
		$this->tabla_ini();
	}

	public function tabla_ini()
	{
		//Función que carga la tabla completa al iniciar la página
		$this->load->model('Empleado_model', 'Empleado_model', true);
		$this->emp = $this->Empleado_model->get_todos();

		//Solo intercambia los id por nombre cuando exista al menos 1 empleado
		if (sizeof($this->emp) > 0) {
			foreach ($this->emp as $key => $emp) {
				//Función que intercambia el id_empresa por su nombre
				$this->load->model('Empresa_model', 'Empresa_model', true);
				$n_empresa = $this->Empresa_model->get_id($emp['id_empresa']);
				$this->emp[$key]['id_empresa'] = $n_empresa[0]['nombre'];

				//Función que intercambia el id_tipo por su nombre
				$this->load->model('Tipo_empleado_model', 'Tipo_empleado_model', true);
				$n_tipo = $this->Tipo_empleado_model->get_id($emp['id_tipo']);
				$this->emp[$key]['id_tipo'] = $n_tipo[0]['nombre'];
			}
		}

		$this->load->view('Resultado_empleado');
	}

	private function compare()
	{
		//Función que devuelve todos los datos de la tabla Empleado
		$this->load->model('Empleado_model', 'Empleado_model', true);
		return $this->Empleado_model->get_todos();
	}

	public function load_insert()
	{
		//Función que devuelve todos los datos de la tabla Empresa
		$this->load->model('Empresa_model', 'Empresa_model', true);
		$this->empresa = $this->Empresa_model->get_todos();
		//Función que devuelve todos los datos de la tabla Tipo_empleado
		$this->load->model('Tipo_empleado_model', 'Tipo_empleado_model', true);
		$this->tipo_empleado = $this->Tipo_empleado_model->get_todos();

		$this->load->view('Insert_empleado');
	}

	public function load_modify()
	{
		//Función que devuelve todos los datos de la tabla Empresa
		$this->load->model('Empresa_model', 'Empresa_model', true);
		$this->empresa = $this->Empresa_model->get_todos();
		//Función que devuelve todos los datos de la tabla Tipo_empleado
		$this->load->model('Tipo_empleado_model', 'Tipo_empleado_model', true);
		$this->tipo_empleado = $this->Tipo_empleado_model->get_todos();

		//Función que carga la Empleado con el id que tiene la fila que ha pulsado el usuario
		$this->load->model('Empleado_model', 'Empleado_model', true);
		$this->emp = $this->Empleado_model->get_id($this->input->post('id'));

		$this->load->view('Update_empleado');
	}
}
