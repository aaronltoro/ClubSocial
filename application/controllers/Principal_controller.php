<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Principal_controller extends CI_Controller
{

	public function index()
	{
		$this->load->view('Principal_view.php');
	}

    public function ir_empresa_view(){
        $this->load->view('Empresa_view.php');
    }
}