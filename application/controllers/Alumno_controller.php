<?php
defined('BASEPATH') or exit('No direct script access allowed');

use \PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\SpreadSheet;

class Alumno_controller extends CI_Controller
{

	var $err;
	var $filt = array();

	public function index()
	{
		$this->load->view('Alumno_view.php');
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
				//Llamo al modelo y lo que me devuelve lo seteo en la variable $this->alumno que se enviará a la view resultado
				$this->load->model('Alumno_model', 'Alumno_model', true);
				$this->alumno = $this->Alumno_model->get_todos();

				//Solo intercambia los id por nombre cuando exista al menos 1 empleado
				if (sizeof($this->alumno) > 0) {
					foreach ($this->alumno as $key => $alumno) {
						//Función que intercambia el id_ciclo por su nombre
						$this->load->model('Ciclo_model', 'Ciclo_model', true);
						$n_ciclo = $this->Ciclo_model->get_id($alumno['id_ciclo']);
						$this->alumno[$key]['id_ciclo'] = $n_ciclo[0]['nombre_corto'];
					}
				}

				$this->load->view('Resultado_alumno');
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
					$this->load->model('Alumno_model', 'Alumno_model', true);
					$this->alumno = $this->Alumno_model->get_todos();

					//Solo intercambia los id por nombre cuando exista al menos 1 empleado
					if (sizeof($this->alumno) > 0) {
						foreach ($this->alumno as $key => $alumno) {
							//Función que intercambia el id_ciclo por su nombre
							$this->load->model('Ciclo_model', 'Ciclo_model', true);
							$n_ciclo = $this->Ciclo_model->get_id($alumno['id_ciclo']);
							$this->alumno[$key]['id_ciclo'] = $n_ciclo[0]['nombre_corto'];
						}
					}

					$this->load->view('Resultado_alumno');
					break;
				}

				//Si la variable de errores es false significa que no hay errores y por lo tanto llamo al modelo y lo que me devuelve lo seteo en la variable $this->alumno que se enviará a la view resultado
				if (!$is_err) {
					$this->load->model('Alumno_model', 'Alumno_model', true);
					$this->alumno = $this->Alumno_model->get_nombre($res['filtro']);

					//Solo intercambia los id por nombre cuando exista al menos 1 empleado
					if (sizeof($this->alumno) > 0) {
						foreach ($this->alumno as $key => $alumno) {
							//Función que intercambia el id_ciclo por su nombre
							$this->load->model('Ciclo_model', 'Ciclo_model', true);
							$n_ciclo = $this->Ciclo_model->get_id($alumno['id_ciclo']);
							$this->alumno[$key]['id_ciclo'] = $n_ciclo[0]['nombre_corto'];
						}
					}

					$this->load->view('Resultado_alumno');
				} else {
					//Importante! Doy valor a la variable $this->err que se va a pasar a la view en caso de error
					$this->err = 'El filtro solicitado no existe';
					$this->load->view('Error_alumno');
				}
				break;
			case 'ci':
				//Si el campo filtro no está vacío recorro todos los datos de la tabla y si encuentra alguno con el mismo cif que pasó el usuario significa que existe
				if ($res['filtro'] != '') {
					//Solo intercambia los id por nombre cuando exista al menos 1 alumno
					if (sizeof($compare) > 0) {
						foreach ($compare as $key => $alumno) {
							//Función que intercambia el id_ciclo por su nombre
							$this->load->model('Ciclo_model', 'Ciclo_model', true);
							$n_ciclo = $this->Ciclo_model->get_id($alumno['id_ciclo']);
							$compare[$key]['id_ciclo'] = $n_ciclo[0]['nombre_corto'];
						}
					}

					foreach ($compare as $comp) {
						if (str_contains($comp['id_ciclo'], $res['filtro'])) {
							$is_err = false;
						}
					}
				} else {
					//Si el campo filtro está vacío $is_err valdrá false y los traerá todos de la base de datos, luego detiene la ejecución
					$is_err = false;
					$this->load->model('Alumno_model', 'Alumno_model', true);
					$this->alumno = $this->Alumno_model->get_todos();

					//Solo intercambia los id por nombre cuando exista al menos 1 empleado
					if (sizeof($this->alumno) > 0) {
						foreach ($this->alumno as $key => $alumno) {
							//Función que intercambia el id_ciclo por su nombre
							$this->load->model('Ciclo_model', 'Ciclo_model', true);
							$n_ciclo = $this->Ciclo_model->get_id($alumno['id_ciclo']);
							$this->alumno[$key]['id_ciclo'] = $n_ciclo[0]['nombre_corto'];
						}
					}

					$this->load->view('Resultado_alumno');
					break;
				}

				//Si la variable de errores es false significa que no hay errores y por lo tanto llamo al modelo y lo que me devuelve lo seteo en la variable $this->alumno que se enviará a la view resultado
				if (!$is_err) {
					$this->load->model('Alumno_model', 'Alumno_model', true);
					$ciclo = $this->Alumno_model->get_ciclo($res['filtro']);

					//Devuelve todos los alumnos que tengan los id del array anterior de $ciclo
					foreach ($ciclo as $cl) {
						$this->alumno = $this->Alumno_model->get_ciclo_alu($cl['id']);
					}

					//Solo intercambia los id por nombre cuando exista al menos 1 empleado
					if (sizeof($this->alumno) > 0) {
						foreach ($this->alumno as $key => $alumno) {
							//Función que intercambia el id_ciclo por su nombre
							$this->load->model('Ciclo_model', 'Ciclo_model', true);
							$n_ciclo = $this->Ciclo_model->get_id($alumno['id_ciclo']);
							$this->alumno[$key]['id_ciclo'] = $n_ciclo[0]['nombre_corto'];
						}
					}

					$this->load->view('Resultado_alumno');
				} else {
					//Importante! Doy valor a la variable $this->err que se va a pasar a la view en caso de error
					$this->err = 'El filtro solicitado no existe';
					$this->load->view('Error_alumno');
				}
				break;
			case 'cu':
				//Si el campo filtro no está vacío recorro todos los datos de la tabla y si encuentra alguno con el mismo cif que pasó el usuario significa que existe
				if ($res['filtro'] != '') {
					foreach ($compare as $comp) {
						if (str_contains($comp['curso_escolar'], $res['filtro'])) {
							$is_err = false;
						}
					}
				} else {
					//Si el campo filtro está vacío $is_err valdrá false y los traerá todos de la base de datos, luego detiene la ejecución
					$is_err = false;
					$this->load->model('Alumno_model', 'Alumno_model', true);
					$this->alumno = $this->Alumno_model->get_todos();

					//Solo intercambia los id por nombre cuando exista al menos 1 empleado
					if (sizeof($this->alumno) > 0) {
						foreach ($this->alumno as $key => $alumno) {
							//Función que intercambia el id_ciclo por su nombre
							$this->load->model('Ciclo_model', 'Ciclo_model', true);
							$n_ciclo = $this->Ciclo_model->get_id($alumno['id_ciclo']);
							$this->alumno[$key]['id_ciclo'] = $n_ciclo[0]['nombre_corto'];
						}
					}

					$this->load->view('Resultado_alumno');
					break;
				}

				//Si la variable de errores es false significa que no hay errores y por lo tanto llamo al modelo y lo que me devuelve lo seteo en la variable $this->alumno que se enviará a la view resultado
				if (!$is_err) {
					$this->load->model('Alumno_model', 'Alumno_model', true);
					$this->alumno = $this->Alumno_model->get_curso($res['filtro']);

					//Solo intercambia los id por nombre cuando exista al menos 1 empleado
					if (sizeof($this->alumno) > 0) {
						foreach ($this->alumno as $key => $alumno) {
							//Función que intercambia el id_ciclo por su nombre
							$this->load->model('Ciclo_model', 'Ciclo_model', true);
							$n_ciclo = $this->Ciclo_model->get_id($alumno['id_ciclo']);
							$this->alumno[$key]['id_ciclo'] = $n_ciclo[0]['nombre_corto'];
						}
					}

					$this->load->view('Resultado_alumno');
				} else {
					//Importante! Doy valor a la variable $this->err que se va a pasar a la view en caso de error
					$this->err = 'El filtro solicitado no existe';
					$this->load->view('Error_alumno');
				}
				break;
		}
	}

	public function add_alumno()
	{
		//Recojo los parametros enviados por ajax y los meto en un array
		$res = array(
			'nombre' => $this->input->post('nombre'),
			'telefono' => $this->input->post('telefono'),
			'correo' => $this->input->post('correo'),
			'id_ciclo' => $this->input->post('ciclo'),
			'curso_escolar' => $this->input->post('curso')
		);

		//Llamo al modelo y añado la nueva alumno, después vuelvo a cargar la tabla con todos los campos
		$this->load->model('Alumno_model', 'Alumno_model', true);
		$this->Alumno_model->insertar($res);
		$this->tabla_ini();
	}

	public function add_ciclo()
	{
		//Recojo los parametros enviados por ajax y los meto en un array
		$res = array(
			'nombre_corto' => $this->input->post('nombreCorto'),
			'nombre_largo' => $this->input->post('nombreLargo')
		);

		//Llamo al modelo y añado la nueva alumno, después vuelvo a cargar la tabla con todos los campos
		$this->load->model('Ciclo_model', 'Ciclo_model', true);
		$this->Ciclo_model->insertar($res);
		$this->load_insert();
	}

	public function add_ciclo_modify()
	{
		//Recojo los parametros enviados por ajax y los meto en un array
		$res = array(
			'nombre_corto' => $this->input->post('nombreCorto'),
			'nombre_largo' => $this->input->post('nombreLargo')
		);

		//Llamo al modelo y añado la nueva alumno, después vuelvo a cargar la tabla con todos los campos
		$this->load->model('Ciclo_model', 'Ciclo_model', true);
		$this->Ciclo_model->insertar($res);
		$this->load_modify();
	}

	public function modify_alumno()
	{
		//Recojo los parametros enviados por ajax y los meto en un array
		$res = array(
			'nombre' => $this->input->post('nombre'),
			'telefono' => $this->input->post('telefono'),
			'correo' => $this->input->post('correo'),
			'id_ciclo' => $this->input->post('ciclo'),
			'curso_escolar' => $this->input->post('curso')
		);

		//Llamo al modelo y modifico al alumno seleccionada, después vuelvo a cargar la tabla con todos los campos
		$this->load->model('Alumno_model', 'Alumno_model', true);
		$this->Alumno_model->updatear($this->input->post('id'), $res);
		$this->tabla_ini();
	}

	public function delete_alumno()
	{
		//Llamo al modelo y borro la alumno seleccionada, después vuelvo a cargar la tabla con todos los campos
		$this->load->model('Alumno_model', 'Alumno_model', true);
		$this->Alumno_model->deletear($this->input->post('id'));
		$this->tabla_ini();
	}

	public function tabla_ini()
	{
		//Función que carga la tabla completa al iniciar la página
		$this->load->model('Alumno_model', 'Alumno_model', true);
		$this->alumno = $this->Alumno_model->get_todos();

		//Solo intercambia los id por nombre cuando exista al menos 1 empleado
		if (sizeof($this->alumno) > 0) {
			foreach ($this->alumno as $key => $alumno) {
				//Función que intercambia el id_ciclo por su nombre
				$this->load->model('Ciclo_model', 'Ciclo_model', true);
				$n_ciclo = $this->Ciclo_model->get_id($alumno['id_ciclo']);
				$this->alumno[$key]['id_ciclo'] = $n_ciclo[0]['nombre_corto'];
			}
		}

		$this->load->view('Resultado_alumno');
	}

	private function compare()
	{
		//Función que devuelve todos los datos de la tabla alumno
		$this->load->model('Alumno_model', 'Alumno_model', true);
		return $this->Alumno_model->get_todos();
	}

	public function load_insert()
	{
		$this->load->model('Ciclo_model', 'Ciclo_model', true);
		$this->ciclo = $this->Ciclo_model->get_todos();
		$this->load->view('Insert_alumno');
	}

	public function load_modify($id_alumno_ciclo = "")
	{
		//Llamamos a los ciclos para pintarlos en el select que hay en el formulario de modificar 
		$this->load->model('Ciclo_model', 'Ciclo_model', true);
		$this->ciclo = $this->Ciclo_model->get_todos();

		//Función que carga el modelo de Alumno
		$this->load->model('Alumno_model', 'Alumno_model', true);

		//Si la id que se trae esta vacia recogeremos por el post, sino por el valor de la variable id_alumno_ciclo
		if ($id_alumno_ciclo == "") {
			$this->alumno = $this->Alumno_model->get_id($this->input->post('id'));
		} else {
			$this->alumno = $this->Alumno_model->get_id($id_alumno_ciclo);
		}

		$this->load->view('Update_alumno');
	}

	public function export_excel()
	{
		$this->load->model('Alumno_model', 'Alumno_model', true);
		//Llamada a modelo que devuelve todos los datos de la tabla
		$data = $this->Alumno_model->get_todos();

		//Función que intercambia el id_ciclo por su nombre
		if (sizeof($data) > 0) {
			foreach ($data as $key => $alumno) {
				$this->load->model('Ciclo_model', 'Ciclo_model', true);
				$n_ciclo = $this->Ciclo_model->get_id($alumno['id_ciclo']);
				$data[$key]['id_ciclo'] = $n_ciclo[0]['nombre_corto'];
			}
		}

		//Nombre del archivo que se va a descargar
		$nombre = 'Excel_Alumnos.xlsx';

		//Funcion del modelo que crea el excel
		$spreadsheet = $this->Alumno_model->create_spreadsheet($data, 3);

		$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type
		header('Content-Disposition: attachment;filename="' . $nombre . '"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache*/

		$writer->save('php://output');
	}

	public function import_excel()
	{
		// Cargar clases instaladas por Composer
		require 'application\libraries\phpspreadsheet\vendor\autoload.php';

		// Ruta del archivo a importar
		$rutaArchivo = $this->input->post('ruta');
		$documento = IOFactory::load($rutaArchivo);

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
			array_push($data, [$nombre->getValue(), $telefono->getValue(), $correo->getValue(), $ciclo->getValue(), $curso_escolar->getValue()]);
		}

		//Inserto los datos a la bd
		
				
	}
}
