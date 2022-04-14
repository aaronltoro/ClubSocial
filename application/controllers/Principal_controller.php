<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Principal_controller extends CI_Controller
{

    public function index()
    {
        $this->load->view('Principal_view.php');
    }

    public function ir_empresa_view()
    {
        $this->load->view('Empresa_view.php');
    }

    public function ir_empleado_view()
    {
        $this->load->view('Empleado_view.php');
    }

    public function ir_alumno_view()
    {
        $this->load->view('Alumno_view.php');
    }
    
    public function ir_tutor_centro_view()
    {
        $this->load->view('Tutor_centro_view.php');
    }
}
