<?php
defined('BASEPATH') or exit('No direct script access allowed');

use \PhpOffice\PhpSpreadsheet\IOFactory;

class Empresa_controller extends CI_Controller
{

	var $err;
	var $filt = array();

	public function index()
	{
		$this->load->view('Empresa_view.php');
	}

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
				$this->load->model('Empresa_model', 'Empresa_model', true);
				$this->emp = $this->Empresa_model->get_todos();
				$this->load->view('Resultado_empresa');
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
					$this->load->model('Empresa_model', 'Empresa_model', true);
					$this->emp = $this->Empresa_model->get_todos();
					$this->load->view('Resultado_empresa');
					break;
				}

				//Si la variable de errores es false significa que no hay errores y por lo tanto llamo al modelo y lo que me devuelve lo seteo en la variable $this->emp que se enviará a la view resultado
				if (!$is_err) {
					$this->load->model('Empresa_model', 'Empresa_model', true);
					$this->emp = $this->Empresa_model->get_nombre($res['filtro']);
					$this->load->view('Resultado_empresa');
				} else {
					//Importante! Doy valor a la variable $this->err que se va a pasar a la view en caso de error
					$this->err = 'El filtro solicitado no existe';
					$this->load->view('Error_empresa');
				}
				break;
			case 'c':
				//Si el campo filtro no está vacío recorro todos los datos de la tabla y si encuentra alguno con el mismo cif que pasó el usuario significa que existe
				if ($res['filtro'] != '') {
					foreach ($compare as $comp) {
						if (str_contains($comp['cif'], $res['filtro'])) {
							$is_err = false;
						}
					}
				} else {
					//Si el campo filtro está vacío $is_err valdrá false y los traerá todos de la base de datos, luego detiene la ejecución
					$is_err = false;
					$this->load->model('Empresa_model', 'Empresa_model', true);
					$this->emp = $this->Empresa_model->get_todos();
					$this->load->view('Resultado_empresa');
					break;
				}

				//Si la variable de errores es false significa que no hay errores y por lo tanto llamo al modelo y lo que me devuelve lo seteo en la variable $this->emp que se enviará a la view resultado
				if (!$is_err) {
					$this->load->model('Empresa_model', 'Empresa_model', true);
					$this->emp = $this->Empresa_model->get_cif($res['filtro']);
					$this->load->view('Resultado_empresa');
				} else {
					//Importante! Doy valor a la variable $this->err que se va a pasar a la view en caso de error
					$this->err = 'El filtro solicitado no existe';
					$this->load->view('Error_empresa');
				}
				break;
		}
	}

	public function add_empresa()
	{
		//Recojo los parametros enviados por ajax y los meto en un array
		$res = array(
			'nombre' => $this->input->post('nombre'),
			'cif' => $this->input->post('cif')
		);

		//Introduzco todas las direcciones que haya puesto el usuario en la variable $direcciones
		$nsedes = $this->input->post('nsedes');
		$direcciones = '';
		for ($i = 0; $i < $nsedes; $i++) {
			$index = strval($i + 1);
			$direcciones .= '&direccion' . $index . '=' . $this->input->post('direccion' . $index);
		}

		//Introduzco la variable direcciones (un string con todos los valores de cada direccion que ha puesto el usuario)
		$res['direcciones'] = $direcciones;

		//Llamo al modelo y añado la nueva empresa, después vuelvo a cargar la tabla con todos los campos
		$this->load->model('Empresa_model', 'Empresa_model', true);
		$this->Empresa_model->insertar($res);
		$this->tabla_ini();
	}

	public function modify_empresa()
	{
		//Recojo los parametros enviados por ajax y los meto en un array
		$res = array(
			'nombre' => $this->input->post('nombre'),
			'cif' => $this->input->post('cif')
		);

		//Introduzco todas las direcciones que haya puesto el usuario en la variable $direcciones
		$nsedes = $this->input->post('nsedes');
		$direcciones = '';
		for ($i = 0; $i < $nsedes; $i++) {
			$index = strval($i + 1);
			$direcciones .= '&direccion' . $index . '=' . $this->input->post('direccion' . $index);
		}

		//Introduzco la variable direcciones (un string con todos los valores de cada direccion que ha puesto el usuario)
		$res['direcciones'] = $direcciones;

		//Llamo al modelo y modifico la empresa seleccionada, después vuelvo a cargar la tabla con todos los campos
		$this->load->model('Empresa_model', 'Empresa_model', true);
		$this->Empresa_model->updatear($this->input->post('id'), $res);
		$this->tabla_ini();
	}

	public function modify_sede()
	{
		//Recojo los parametros enviados por ajax y los meto en un array
		$res = array(
			'nombre' => $this->input->post('nombre'),
			'cif' => $this->input->post('cif')
		);

		//Introduzco todas las direcciones que haya puesto el usuario en la variable $direcciones
		$nsedes = $this->input->post('nsedes');
		$direcciones = '';
		for ($i = 0; $i < $nsedes; $i++) {
			$index = strval($i + 1);
			$direcciones .= '&direccion' . $index . '=' . $this->input->post('direccion' . $index);
		}

		//Introduzco la variable direcciones (un string con todos los valores de cada direccion que ha puesto el usuario)
		$res['direcciones'] = $direcciones;

		//Recojo la variable principal
		$principal = $this->input->post('principal');

		//Llamo al modelo y modifico la variable principal antes de borrar la sede
		$this->load->model('Empresa_model', 'Empresa_model', true);
		$this->Empresa_model->update_principal($this->input->post('id'), $principal);

		//Llamo al modelo y modifico la empresa seleccionada, después vuelvo a cargar la tabla con todos los campos
		$this->load->model('Empresa_model', 'Empresa_model', true);
		$this->Empresa_model->updatear($this->input->post('id'), $res);

		//Función que carga la empresa con el id que tiene la fila que ha pulsado el usuario
		$this->load->model('Empresa_model', 'Empresa_model', true);
		$this->emp = $this->Empresa_model->get_id($this->input->post('id'));
		$this->load->view('Update_empresa');
	}

	public function modify_principal()
	{
		//Recojo los parametros enviados por ajax y los meto en un array
		$principal = $this->input->post('principal');

		//Llamo al modelo y modifico la empresa seleccionada, después vuelvo a cargar la tabla con todos los campos
		$this->load->model('Empresa_model', 'Empresa_model', true);
		$this->Empresa_model->update_principal($this->input->post('id'), $principal);

		//Función que carga la empresa con el id que tiene la fila que ha pulsado el usuario
		$this->load->model('Empresa_model', 'Empresa_model', true);
		$this->emp = $this->Empresa_model->get_id($this->input->post('id'));
		$this->load->view('Update_empresa');
	}

	public function delete_empresa()
	{
		//Llamo al modelo y borro la empresa seleccionada, después vuelvo a cargar la tabla con todos los campos
		$this->load->model('Empresa_model', 'Empresa_model', true);
		$this->Empresa_model->deletear($this->input->post('id'));
		$this->tabla_ini();
	}

	public function tabla_ini()
	{
		//Función que carga la tabla completa al iniciar la página
		$this->load->model('Empresa_model', 'Empresa_model', true);
		$this->emp = $this->Empresa_model->get_todos();
		$this->load->view('Resultado_empresa');
	}

	private function compare()
	{
		//Función que devuelve todos los datos de la tabla empresa
		$this->load->model('Empresa_model', 'Empresa_model', true);
		return $this->Empresa_model->get_todos();
	}

	public function load_insert()
	{
		$this->load->view('Insert_empresa');
	}

	public function load_modify()
	{
		//Función que carga la empresa con el id que tiene la fila que ha pulsado el usuario
		$this->load->model('Empresa_model', 'Empresa_model', true);
		$this->emp = $this->Empresa_model->get_id($this->input->post('id'));

		$this->load->view('Update_empresa');
	}

	public function export_excel()
	{
		$this->load->model('Empresa_model', 'Empresa_model', true);
		//Llamada a modelo que devuelve todos los datos de la tabla
		$data = $this->Empresa_model->get_todos();

		// CAMBIO EL ID DE LA SEDE PRINCIPAL POR SU NOMBRE EN CADA UNA DE LAS EMPRESAS
		foreach ($data as $key => $dt) {
			//Separo el string direcciones en cada & y lo añado a un array de strings
			$res_direcciones = explode('&', $dt['direcciones']);

			//Vuelvo a separar cada valor del array por cada = y así obtener su valor original y meto cada uno en el array $array_direcciones (quito los vacíos)
			$count = 1;
			$array_direcciones = array();
			foreach ($res_direcciones as $rd) {
				if ($rd != '') {
					$index = strval($count);
					$valor = explode('=', $rd);
					$array_direcciones['d' . $index] = $valor[1];
					$count++;
				}
			}

			//Pinto el valor que coincida con el numero de la variable principal
			if (isset($array_direcciones['d' . $dt['principal']])) {
				$data[$key]['principal'] = $array_direcciones['d' . $dt['principal']];
			} else {
				$data[$key]['principal'] = 'No hay Sede Principal';
			}
		}

		// CAMBIO EL ID DE CADA SEDE POR SU NOMBRE EN CADA UNA DE LAS EMPRESAS
		foreach ($data as $key => $dt) {
			//Separo el string direcciones en cada & y lo añado a un array de strings
			$res_direcciones = explode('&', $dt['direcciones']);

			//Vuelvo a separar cada valor del array por cada = y así obtener su valor original y meto cada uno en el array $array_direcciones (quito los vacíos)
			$count = 1;
			$array_direcciones = array();
			foreach ($res_direcciones as $rd) {
				if ($rd != '') {
					$index = strval($count);
					$valor = explode('=', $rd);
					$array_direcciones['d' . $index] = $valor[1];
					$count++;
				}
			}

			$data[$key]['direcciones'] = '';

			//Pinto los valores
			if (count($array_direcciones) > 0) {
				foreach ($array_direcciones as $dir) {
					$data[$key]['direcciones'] .= $dir . '  |  ';
				}
			} else {
				$data[$key]['direcciones'] = 'No hay Sedes';
			}
		}

		//Nombre del archivo que se va a descargar
		$nombre = 'Excel_Empresas.xlsx';

		//Funcion del modelo que crea el excel
		$spreadsheet = $this->Empresa_model->create_spreadsheet($data, 3);

		$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type
		header('Content-Disposition: attachment;filename="' . $nombre . '"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache*/

		$writer->save('php://output');
	}
}
