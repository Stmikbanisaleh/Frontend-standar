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
		$data['user'] = $this->session->userdata('email');
		$data['role'] = $this->session->userdata('role_id');
		$jumlah = $this->lapan_api_library->call('usulan/jumlahusulan', ['token' => $this->session->userdata('token')]);
		$data['jumlahUsulan'] = $jumlah[0]['jumlah'];
		$jumlahsni = $this->lapan_api_library->call('usulan/jumlahsni', ['token' => $this->session->userdata('token')]);
		$data['jumlahSNI'] =  $jumlahsni[0]['jumlah'];
		$jumlahsl = $this->lapan_api_library->call('usulan/jumlahsl', ['token' => $this->session->userdata('token')]);
		$data['jumlahSL'] = $jumlahsl[0]['jumlah'];
		$jumlahpnps = $this->lapan_api_library->call('usulan/jumlahpnps', ['token' => $this->session->userdata('token')]);
		$data['jumlahPNPS'] = $jumlahpnps[0]['jumlah'];
		$getrumusansni = $this->lapan_api_library->call('usulan/getrumusansni', ['token' => $this->session->userdata('token')]);
		$data['rsni'] = $getrumusansni;
		$getrumusansl = $this->lapan_api_library->call('usulan/getrumusansl', ['token' => $this->session->userdata('token')]);
		$data['rsl'] = $getrumusansl;
		$getsni = $this->lapan_api_library->call('usulan/getsni', ['token' => $this->session->userdata('token')]);
		$data['daftarsni'] = $getsni[0];
		$getsl = $this->lapan_api_library->call('usulan/getsl', ['token' => $this->session->userdata('token')]);
		$data['daftarsl'] = $getsl[0];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/side_menu');
		$this->load->view('dashboard');
		$this->load->view('templates/footer');
	}
}
