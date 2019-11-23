<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('email')) {
			redirect('auth');
		}
	}

	public function index()
	{
		$data['user'] = $this->db->get_where('msuserstandar', ['EMAIL' =>
		$this->session->userdata('email')])->row_array();

		$roleId = $data['user']['ROLE_ID'];
		$userId = $data['user']['ID'];
		$data['role'] = $this->db->get_where('msrev', array('ID' => $roleId))->row_array();

		$this->load->model('Dashboard_model', 'dashboard');
		$data['jumlahUsulan'] = $this->dashboard->JumlahUsulan();
		$data['jumlahSNI'] = $this->dashboard->JumlahSNI();
		$data['jumlahSL'] = $this->dashboard->JumlahSL();
		$data['jumlahPNPS'] = $this->dashboard->JumlahPNPS();
		$data['rsni'] = $this->dashboard->getRumusanSNI();
		$data['rsl'] = $this->dashboard->getRumusanSL();
		$data['daftarsni'] = $this->dashboard->getSNI();
		$data['daftarsl'] = $this->dashboard->getSL();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/side_menu');
		$this->load->view('dashboard');
		$this->load->view('templates/footer');
	}
}
