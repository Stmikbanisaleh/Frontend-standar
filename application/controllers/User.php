<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('email')){
			redirect('auth');
		}
	}

	public function index() {
		$data['user'] = $this->db->get_where('msuser', ['email' =>
				$this->session->userdata('email')])->row_array();
		$roleId = $data['user']['role_id'];
		$data['role'] = $this->db->get_where('msrev', array('ID' => $roleId))->row_array();
		$data['getRole'] = $this->db->query("SELECT ID,NAMA_REV FROM msrev WHERE GOLONGAN=5 AND NAMA_REV != 'Pengembang'")->result_array();
		$this->load->model('User_model', 'usermod');
		$data['getUser'] = $this->usermod->getUserRole();
		$data['getRoleStatus'] = $this->usermod->getUserRoleAndStatus();

		$this->load->view('templates/header',$data);
		$this->load->view('templates/side_menu');
		$this->load->view('user/list',$data);
		$this->load->view('templates/footer');
	}

	public function adduser(){
		$data['user2'] = $this->db->get_where('msuser', ['email' =>
				$this->session->userdata('email')])->row_array();
		$roleId = $data['user2']['role_id'];
		$data['role'] = $this->db->get_where('msrev', array('ID' => $roleId))->row_array();
		$data['getRole'] = $this->db->query("SELECT ID,NAMA_REV FROM msrev WHERE GOLONGAN=5 AND NAMA_REV != 'Pengembang'")->result_array();
		$this->load->model('User_model', 'usermod');
		$data['getUser'] = $this->usermod->getUserRole();

		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim|is_unique[msuser.email]', [
				'is unique' => 'This email is already registered'
		]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
				'matches' => 'Password dont match!',
				'min_length' => 'Password too short!'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
		$this->form_validation->set_rules('role_id', 'Role', 'required');

		if ($this->form_validation->run($this) == false) {
				$this->load->view('templates/header',$data);
				$this->load->view('templates/side_menu');
				$this->load->view('user/list', $data);
				$this->load->view('templates/footer');
		} else {

		$datauser = [
				'name' => htmlspecialchars($this->input->post('name', true)),
				'email' => htmlspecialchars($this->input->post('email', true)),
				'image' => 'default.jpg',
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id' => $this->input->post('role_id', true),
				'is_active' => 3,
		];

		$this->db->insert('msuser', $datauser);
		
		redirect('user');
		}
		
	}
  
}
