<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perumusan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }
        $this->load->model('Perumusan_model', 'mPerumusan');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('msuserstandar', ['EMAIL' =>
        $this->session->userdata('email')])->row_array();

        $roleId = $data['user']['ROLE_ID'];
        $data['role'] = $this->db->get_where('msrev', array('ID' => $roleId))->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/side_menu');
        $this->load->view('perumusan/rsni');
        $this->load->view('templates/footer');
    }

    public function detail($id)
    {
        $data['detail'] = $this->lapan_api_library->call('usulan/getdetail', ['token' => $this->session->userdata('token'), 'id' => $id]);

        if(count($data['detail'])>0){
            $data['detail'] = $data['detail'][0];
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/side_menu');
        $this->load->view('perumusan/detail');
        $this->load->view('templates/footer');
    }

    public function rsni()
    {   
        // $data['rsni'] = $this->mPerumusan->getRumusanSNI();

        $data['rsni'] = $this->lapan_api_library->call('perumusan/getrumusansni', ['token' => $this->session->userdata('token')]);

        print(json_encode($data['rsni']));exit;

        

        $this->load->view('templates/header', $data);
        $this->load->view('templates/side_menu');
        $this->load->view('perumusan/sni');
        $this->load->view('templates/footer');
    }

    public function rsl()
    {
        $data['user'] = $this->db->get_where('msuserstandar', ['EMAIL' =>
        $this->session->userdata('email')])->row_array();

        $roleId = $data['user']['ROLE_ID'];
        $data['role'] = $this->db->get_where('msrev', array('ID' => $roleId))->row_array();

        $data['rsl'] = $this->mPerumusan->getRumusanSL();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/side_menu');
        $this->load->view('perumusan/sl');
        $this->load->view('templates/footer');
    }

    public function rsni1()
    {   
        $userId = $this->session->userdata('user_id');
        $roleId = $this->session->userdata('role_id');

        if ($roleId == 97) {
            $data['rsni1'] = $this->lapan_api_library->call('usulan/getprosesperumusanbyuser', ['token' => $this->session->userdata('token'), 'user_input' => $userId]);
        } else {
            $data['rsni1'] = $this->lapan_api_library->call('usulan/getprosesperumusan', ['token' => $this->session->userdata('token')]);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/side_menu');
        $this->load->view('perumusan/rsni1');
        $this->load->view('templates/footer');
    }

    public function rsni2()
    {
        $data['user'] = $this->db->get_where('msuserstandar', ['EMAIL' =>
        $this->session->userdata('email')])->row_array();

        $roleId = $data['user']['ROLE_ID'];
        $userId = $data['user']['ID'];
        $data['role'] = $this->db->get_where('msrev', array('ID' => $roleId))->row_array();

        if ($roleId == 97) {
            $data['rsni2'] = $this->mPerumusan->getProsesPerumusanByUser(82, $userId);
        } else {
            $data['rsni2'] = $this->mPerumusan->getProsesPerumusan(82);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/side_menu');
        $this->load->view('perumusan/rsni2');
        $this->load->view('templates/footer');
    }

    public function rsni3()
    {
        $data['user'] = $this->db->get_where('msuserstandar', ['EMAIL' =>
        $this->session->userdata('email')])->row_array();

        $roleId = $data['user']['ROLE_ID'];
        $userId = $data['user']['ID'];
        $data['role'] = $this->db->get_where('msrev', array('ID' => $roleId))->row_array();

        if ($roleId == 97) {
            $data['rsni3'] = $this->mPerumusan->getProsesPerumusanByUser(83, $userId);
        } else {
            $data['rsni3'] = $this->mPerumusan->getProsesPerumusan(83);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/side_menu');
        $this->load->view('perumusan/rsni3');
        $this->load->view('templates/footer');
    }

    public function jajak_pendapat()
    {
        $data['user'] = $this->db->get_where('msuserstandar', ['EMAIL' =>
        $this->session->userdata('email')])->row_array();

        $roleId = $data['user']['ROLE_ID'];
        $userId = $data['user']['ID'];
        $data['role'] = $this->db->get_where('msrev', array('ID' => $roleId))->row_array();

        if ($roleId == 97) {
            $data['jpendapat'] = $this->mPerumusan->getProsesPerumusanByUser(84, $userId);
        } else {
            $data['jpendapat'] = $this->mPerumusan->getProsesPerumusan(84);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/side_menu');
        $this->load->view('perumusan/jajakpendapat');
        $this->load->view('templates/footer');
    }

    public function jajak_pendapat_ulang()
    {
        $data['user'] = $this->db->get_where('msuserstandar', ['EMAIL' =>
        $this->session->userdata('email')])->row_array();

        $roleId = $data['user']['ROLE_ID'];
        $userId = $data['user']['ID'];
        $data['role'] = $this->db->get_where('msrev', array('ID' => $roleId))->row_array();

        if ($roleId == 97) {
            $data['jpendapatulang'] = $this->mPerumusan->getProsesPerumusanByUser(5, $userId);
        } else {
            $data['jpendapatulang'] = $this->mPerumusan->getProsesPerumusan(85);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/side_menu');
        $this->load->view('perumusan/jajakpendapatulang');
        $this->load->view('templates/footer');
    }

    public function rsl1()
    {
        $data['user'] = $this->db->get_where('msuserstandar', ['EMAIL' =>
        $this->session->userdata('email')])->row_array();

        $roleId = $data['user']['ROLE_ID'];
        $userId = $data['user']['ID'];
        $data['role'] = $this->db->get_where('msrev', array('ID' => $roleId))->row_array();

        if ($roleId == 97) {
            $data['rsl1'] = $this->mPerumusan->getProsesPerumusanByUser(90, $userId);
        } else {
            $data['rsl1'] = $this->mPerumusan->getProsesPerumusan(90);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/side_menu');
        $this->load->view('perumusan/rsl1');
        $this->load->view('templates/footer');
    }


    public function rsl2()
    {
        $data['user'] = $this->db->get_where('msuserstandar', ['EMAIL' =>
        $this->session->userdata('email')])->row_array();

        $roleId = $data['user']['ROLE_ID'];
        $userId = $data['user']['ID'];
        $data['role'] = $this->db->get_where('msrev', array('ID' => $roleId))->row_array();

        if ($roleId == 97) {
            $data['rsl2'] = $this->mPerumusan->getProsesPerumusanByUser(92, $userId);
        } else {
            $data['rsl2'] = $this->mPerumusan->getProsesPerumusan(92);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/side_menu');
        $this->load->view('perumusan/rsl2');
        $this->load->view('templates/footer');
    }

    public function rsl3()
    {
        $data['user'] = $this->db->get_where('msuserstandar', ['EMAIL' =>
        $this->session->userdata('email')])->row_array();

        $roleId = $data['user']['ROLE_ID'];
        $userId = $data['user']['ID'];
        $data['role'] = $this->db->get_where('msrev', array('ID' => $roleId))->row_array();

        if ($roleId == 97) {
            $data['rsl3'] = $this->mPerumusan->getProsesPerumusanByUser(93, $userId);
        } else {
            $data['rsl3'] = $this->mPerumusan->getProsesPerumusan(93);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/side_menu');
        $this->load->view('perumusan/rsl1');
        $this->load->view('templates/footer');
    }

    public function daftar_sni()
    {
        $data['user'] = $this->db->get_where('msuserstandar', ['EMAIL' =>
        $this->session->userdata('email')])->row_array();

        $roleId = $data['user']['ROLE_ID'];
        $userId = $data['user']['ID'];
        $data['role'] = $this->db->get_where('msrev', array('ID' => $roleId))->row_array();

        if ($roleId == 97) {
            $data['daftarsni'] = $this->mPerumusan->getProsesPerumusanByUser(89, $userId);
        } else {
            $data['daftarsni'] = $this->mPerumusan->getProsesPerumusan(89);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/side_menu');
        $this->load->view('perumusan/sni', $data);
        $this->load->view('templates/footer');
    }

    public function daftar_sl()
    {
        $data['user'] = $this->db->get_where('msuserstandar', ['EMAIL' =>
        $this->session->userdata('email')])->row_array();

        $roleId = $data['user']['ROLE_ID'];
        $userId = $data['user']['ID'];
        $data['role'] = $this->db->get_where('msrev', array('ID' => $roleId))->row_array();

        if ($roleId == 97) {
            $data['daftarsl'] = $this->mPerumusan->getProsesPerumusanByUser(95, $userId);
        } else {
            $data['daftarsl'] = $this->mPerumusan->getProsesPerumusan(95);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/side_menu');
        $this->load->view('perumusan/sl', $data);
        $this->load->view('templates/footer');
    }
}
