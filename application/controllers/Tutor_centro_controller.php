<?php
defined('BASEPATH') or exit('No direct script access allowed');

use \PhpOffice\PhpSpreadsheet\IOFactory;

class Tutor_centro_controller extends CI_Controller
{

  var $err;
  var $filt = array();

  public function index()
  {
    $this->load->view('Tutor_centro_view.php');
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
        //Llamo al modelo y lo que me devuelve lo seteo en la variable $this->tutor_centro que se enviará a la view resultado
        $this->load->model('Tutor_centro_model', 'Tutor_centro_model', true);
        $this->tutor_centro = $this->Tutor_centro_model->get_todos();
        $this->load->view('Resultado_tutor_centro');
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
          $this->load->model('Tutor_centro_model', 'Tutor_centro_model', true);
          $this->tutor_centro = $this->Tutor_centro_model->get_todos();
          $this->load->view('Resultado_tutor_centro');
          break;
        }

        //Si la variable de errores es false significa que no hay errores y por lo tanto llamo al modelo y lo que me devuelve lo seteo en la variable $this->tutor_centro que se enviará a la view resultado
        if (!$is_err) {
          $this->load->model('Tutor_centro_model', 'Tutor_centro_model', true);
          $this->tutor_centro = $this->Tutor_centro_model->get_nombre($res['filtro']);
          $this->load->view('Resultado_tutor_centro');
        } else {
          //Importante! Doy valor a la variable $this->err que se va a pasar a la view en caso de error
          $this->err = 'El filtro solicitado no existe';
          $this->load->view('Error_tutor_Centro');
        }
        break;
        case 'a':
         //Si el campo filtro no está vacío recorro todos los datos de la tabla y si encuentra alguno con el mismo nombre que pasó el usuario significa que existe
        if ($res['filtro'] != '') {

          //Cambiamos el valor del filtro Strings a los valores de la BBDD Integer para poder realizar la comparacion con el compare
          if(str_contains($res['filtro'],"S")){
            $res['filtro']=1;
          }else if(str_contains($res['filtro'],"N")){
            $res['filtro']=0;
          }



          foreach ($compare as $comp) {
            if (str_contains($comp['activo'], $res['filtro'])) {
              $is_err = false;
            }
          }
        } else {
          //Si el campo filtro está vacío $is_err valdrá false y los traerá todos de la base de datos, luego detiene la ejecución
          $is_err = false;
          $this->load->model('Tutor_centro_model', 'Tutor_centro_model', true);
          $this->tutor_centro = $this->Tutor_centro_model->get_todos();
          $this->load->view('Resultado_tutor_centro');
          break;
        }

        //Si la variable de errores es false significa que no hay errores y por lo tanto llamo al modelo y lo que me devuelve lo seteo en la variable $this->tutor_centro que se enviará a la view resultado
        if (!$is_err) {
          $this->load->model('Tutor_centro_model', 'Tutor_centro_model', true);
          $this->tutor_centro = $this->Tutor_centro_model->get_activo($res['filtro']);
          $this->load->view('Resultado_tutor_centro');
        } else {
          //Importante! Doy valor a la variable $this->err que se va a pasar a la view en caso de error
          $this->err = 'El filtro solicitado no existe';
          $this->load->view('Error_tutor_Centro');
        }
           
          
          break;
    }
  }

  public function add_tutor_centro()
  {
    //Recojo los parametros enviados por ajax y los meto en un array
    $res = array(
      'nombre' => $this->input->post('nombre'),
      'telefono' => $this->input->post('telefono'),
      'correo' => $this->input->post('correo'),
      'activo' => $this->input->post('activo')
    );

    //Llamo al modelo y añado la nueva tutor_centro, después vuelvo a cargar la tabla con todos los campos
    $this->load->model('Tutor_centro_model', 'Tutor_centro_model', true);
    $this->Tutor_centro_model->insertar($res);
    $this->tabla_ini();
  }

  public function modify_tutor_centro()
  {
    //Recojo los parametros enviados por ajax y los meto en un array
    $res = array(
      'nombre' => $this->input->post('nombre'),
      'telefono' => $this->input->post('telefono'),
      'correo' => $this->input->post('correo'),
      'activo' => $this->input->post('activo')
    );

    //Llamo al modelo y modifico al tutor_centro seleccionada, después vuelvo a cargar la tabla con todos los campos
    $this->load->model('Tutor_centro_model', 'Tutor_centro_model', true);
    $this->Tutor_centro_model->updatear($this->input->post('id'), $res);
    $this->tabla_ini();
  }

  public function delete_tutor_centro()
  {
    //Llamo al modelo y borro la tutor_centro seleccionada, después vuelvo a cargar la tabla con todos los campos
    $this->load->model('Tutor_centro_model', 'Tutor_centro_model', true);
    $this->Tutor_centro_model->deletear($this->input->post('id'));
    $this->tabla_ini();
  }

  public function tabla_ini()
  {
    //Función que carga la tabla completa al iniciar la página
    $this->load->model('Tutor_centro_model', 'Tutor_centro_model', true);
    $this->tutor_centro = $this->Tutor_centro_model->get_todos();
    $this->load->view('Resultado_tutor_Centro');
  }

  private function compare()
  {
    //Función que devuelve todos los datos de la tabla tutor_centro
    $this->load->model('Tutor_centro_model', 'Tutor_centro_model', true);
    return $this->Tutor_centro_model->get_todos();
  }

  public function load_insert()
  {
    $this->load->view('Insert_tutor_centro');
  }

  public function load_modify()
  {
    //Función que carga la tutor_centro con el id que tiene la fila que ha pulsado el usuario
    $this->load->model('Tutor_centro_model', 'Tutor_centro_model', true);
    $this->tutor_centro = $this->Tutor_centro_model->get_id($this->input->post('id'));

    $this->load->view('Update_tutor_centro');
  }

  public function export_excel()
  {
    $this->load->model('Tutor_centro_model', 'Tutor_centro_model', true);
    //Llamada a modelo que devuelve todos los datos de la tabla
    $data = $this->Tutor_centro_model->get_todos();

    //CAMBIO EL VALOR DE 0 O 1 DE LA COLUMNA ACTIVO POR SÍ O NO
    foreach ($data as $key => $dt) {
      $data[$key]['activo'] = ($dt['activo'] == 1) ? 'Sí' : 'No';
    }

    //Nombre del archivo que se va a descargar
    $nombre = 'Excel_Tutores.xlsx';

    //Funcion del modelo que crea el excel
    $spreadsheet = $this->Tutor_centro_model->create_spreadsheet($data, 3);

    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type
    header('Content-Disposition: attachment;filename="' . $nombre . '"'); //tell browser what's the file name
    header('Cache-Control: max-age=0'); //no cache*/

    $writer->save('php://output');
  }
}
