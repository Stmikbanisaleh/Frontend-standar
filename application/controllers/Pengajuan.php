<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengajuan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }
        $this->load->library('upload');
        $this->load->model('Pengajuan_model', 'mPengajuan');
    }

    public function index()
    {
        $data['user'] = $this->session->userdata('email');
		$data['role'] = $this->session->userdata('role_id');

        $data['draft'] = $this->lapan_api_library->call('usulan/getusulandraft', ['token' => $this->session->userdata('token')]);

        $this->load->view('templates/header');
        $this->load->view('templates/side_menu');
        $this->load->view('pengajuan/usulan', $data);
        $this->load->view('templates/footer');
    }

    public function detail($id)
    {
        $data = $this->lapan_api_library->call('usulan/getdetail', ['token' => $this->session->userdata('token'),'id' => $id]);
        $data['detail'] = $data[0];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/side_menu');
        $this->load->view('pengajuan/detail');
        $this->load->view('templates/footer');
    }

    public function pengajuan_usulan()
    {
        $jenisstandar = $this->lapan_api_library->call('usulan/jenisstandar', ['token' => $this->session->userdata('token')]);
        $data['jnstandar'] = $jenisstandar;
        $komiteteknis = $this->lapan_api_library->call('usulan/komiteteknis', ['token' => $this->session->userdata('token')]);
        $data['kmteknis'] = $komiteteknis;
        $jenisperumusan = $this->lapan_api_library->call('usulan/jenisperumusan', ['token' => $this->session->userdata('token')]);
        $data['jnperumusan'] = $jenisperumusan;
        $jalurrumusan = $this->lapan_api_library->call('usulan/jalurperumusan', ['token' => $this->session->userdata('token')]);
        $data['jlperumusan'] = $jalurrumusan;
        $konseptor = $this->lapan_api_library->call('usulan/konseptor', ['token' => $this->session->userdata('token')]);
        $data['gkonseptor'] = $konseptor;
        // print_r($this->session->userdata('id'));exit;
        $detailuser = $this->lapan_api_library->call('users/getuserdetail', ['token' => $this->session->userdata('token'), 'id' => $this->session->userdata('user_id')]);
        $data['detailuser'] = $detailuser[0];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/side_menu');
        $this->load->view('pengajuan/pengajuan_usulan');
        $this->load->view('templates/footer');
    }

    public function edit_usulan($id)
    {
        $data['usulan'] = $this->lapan_api_library->call('usulan/getusulandraftdetail', ['token' => $this->session->userdata('token'), 'id' => $id]);
        if(count($data['usulan']) > 0){
            $data['usulan'] = $data['usulan'][0];
        }

        $data['jnstandar'] = $this->lapan_api_library->call('usulan/jenisstandar', ['token' => $this->session->userdata('token')]);

        $data['kmteknis'] = $this->lapan_api_library->call('usulan/komiteteknis', ['token' => $this->session->userdata('token')]);

        $data['jnperumusan'] = $this->lapan_api_library->call('usulan/jenisperumusan', ['token' => $this->session->userdata('token')]);

        $data['jlperumusan'] = $this->lapan_api_library->call('usulan/jalurperumusan', ['token' => $this->session->userdata('token')]);

        $data['gkonseptor'] = $this->lapan_api_library->call('usulan/konseptor', ['token' => $this->session->userdata('token')]);

        $data['konsutama'] = $this->lapan_api_library->call('usulan/getdkonseptorutama', ['token' => $this->session->userdata('token'), 'id' => $id]);
        if(count($data['konsutama']) > 0){
            $data['konsutama'] = $data['konsutama'][0];
        }

        $data['dkonseptor'] = $this->lapan_api_library->call('usulan/getdkonseptor', ['token' => $this->session->userdata('token'), 'id' => $id]);

        $data['dberkepentingan'] = $this->lapan_api_library->call('usulan/getdberkepentingan', ['token' => $this->session->userdata('token'), 'id' => $id]);
        // print_r($data['dberkepentingan']);exit;
        $data['dmanfaat'] = $this->lapan_api_library->call('usulan/getdmanfaat', ['token' => $this->session->userdata('token'), 'id' => $id]);

        $data['dregulasi'] = $this->lapan_api_library->call('usulan/getdregulasi', ['token' => $this->session->userdata('token'), 'id' => $id]);

        $data['dsni'] = $this->lapan_api_library->call('usulan/getdsni', ['token' => $this->session->userdata('token'), 'id' => $id]);

        $data['dnonsni'] = $this->lapan_api_library->call('usulan/getdnonsni', ['token' => $this->session->userdata('token'), 'id' => $id]);
        // print_r($data['dnonsni']);exit;

        $data['dbibliografi'] = $this->lapan_api_library->call('usulan/getdbibliografi', ['token' => $this->session->userdata('token'), 'id' => $id]);

        $data['dlpk'] = $this->lapan_api_library->call('usulan/getdlpk', ['token' => $this->session->userdata('token'), 'id' => $id]);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/side_menu');
        $this->load->view('pengajuan/edit_usulan', $data);
        $this->load->view('templates/footer');
    }

    public function hapus_usulan($id)
    {
        $hapususulan = $this->lapan_api_library->call('usulan/hapususulan', ['token' => $this->session->userdata('token'),'id' => $id]);
        // print_r($hapususulan);exit;
        $hapususulan = $this->lapan_api_library->call('usulan/hapusdmanfaat', ['token' => $this->session->userdata('token'),'id' => $id]);
        $hapususulan = $this->lapan_api_library->call('usulan/hapusdkepentingan', ['token' => $this->session->userdata('token'),'id' => $id]);
        $hapususulan = $this->lapan_api_library->call('usulan/hapusdkonseptor', ['token' => $this->session->userdata('token'),'id' => $id]);
        $hapususulan = $this->lapan_api_library->call('usulan/hapusdkonseptorutama', ['token' => $this->session->userdata('token'),'id' => $id]);
        $hapususulan = $this->lapan_api_library->call('usulan/hapusdkregulasi', ['token' => $this->session->userdata('token'),'id' => $id]);

        if($hapususulan['status'] == 200) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Usulan telah dihapus!</div>');
            redirect('pengajuan/usulan_baru');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Usulan gagal dihapus!</div>');
            redirect('pengajuan/usulan_baru');
        }
    }

    public function save()
    {

        $userId = $this->session->userdata('user_id');
        $time = time();

        //Upload dokumen detail penelitian
        $configddp['file_name']          = 'detail_penelitian_' . $time;
        $configddp['upload_path']          = './assets/dokumen/detail_penelitian/';
        $configddp['allowed_types']        = 'pdf';
        $configddp['overwrite']        = TRUE;
        if(!empty($_FILES['dok_detail_penelitian']['tmp_name']) && file_exists($_FILES['dok_detail_penelitian']['tmp_name'])) {
            $dokdp = 'detail_penelitian_' . $time.'.pdf';
            $file_tmp = $_FILES['dok_detail_penelitian']['tmp_name'];
			$data = file_get_contents($file_tmp);
			$dok_detail_penelitian_base64 = base64_encode($data);
        }else {
            $dokdp ='';
        }
        // $this->upload->initialize($configddp);
        // print_r($dokdp);exit;
        // if ($this->upload->do_upload('dok_detail_penelitian')) {
        //     $dokdp = $this->upload->data('file_name');
        // } else {
        //     $dokdp = '';
        // }
        //Upload dokumen bukti pendukung
        $configlop['file_name']          = 'lampiran_organisasi_pendukung_' . $time;
        $configlop['upload_path']          = './assets/dokumen/lampiran_organisasi/';
        $configlop['allowed_types']        = 'pdf';
        $configlop['overwrite']        = TRUE;
        if(!empty($_FILES['dok_org_pendukung']['tmp_name']) && file_exists($_FILES['dok_org_pendukung']['tmp_name'])) {
            $doklop = 'lampiran_organisasi_pendukung_' . $time.'.pdf';
            $file_tmp = $_FILES['dok_org_pendukung']['tmp_name'];
			$data = file_get_contents($file_tmp);
			$dok_org_pendukung_base64 = base64_encode($data);
        }else {
            $doklop ='';
            $dok_org_pendukung_base64 = null;
        }
        // $this->upload->initialize($configlop);

        // if ($this->upload->do_upload('dok_org_pendukung')) {
        //     $doklop = $this->upload->data('file_name');
        // } else {
        //     $doklop = '';
        // }

        //Upload Surat Pengajuan 
        $configsrp['file_name']          = 'surat_pengajuan_' . $time;
        $configsrp['upload_path']          = './assets/dokumen/surat_pengajuan/';
        $configsrp['allowed_types']        = 'pdf';
        $configsrp['overwrite']        = TRUE;

        if(!empty($_FILES['surat_pengajuan']['tmp_name']) && file_exists($_FILES['surat_pengajuan']['tmp_name'])) {
            $doksrp = 'surat_pengajuan_' . $time.'.pdf';
            $file_tmp = $_FILES['surat_pengajuan']['tmp_name'];
			$data = file_get_contents($file_tmp);
			$surat_pengajuan_base64 = base64_encode($data);
        }else {
            $doksrp ='';
            $surat_pengajuan_base64 = null;
        }

        // $this->upload->initialize($configsrp);

        // if ($this->upload->do_upload('surat_pengajuan')) {
        //     $doksrp = $this->upload->data('file_name');
        // } else {
        //     $doksrp = '';
        // }

        //Upload Outline
        $configsrp['file_name']          = 'outline_' . $time;
        $configsrp['upload_path']          = './assets/dokumen/outline/';
        $configsrp['allowed_types']        = 'pdf';
        $configsrp['overwrite']        = TRUE;
        
        if(!empty($_FILES['outline']['tmp_name']) && file_exists($_FILES['outline']['tmp_name'])) {
            $dokout = 'outline_' . $time.'.pdf';
            $file_tmp = $_FILES['outline']['tmp_name'];
			$data = file_get_contents($file_tmp);
			$outline_base64 = base64_encode($data);
        }else {
            $dokout ='';
            $outline_base64= null;
        }

        // $this->upload->initialize($configsrp);

        // if ($this->upload->do_upload('outline')) {
        //     $dokout = $this->upload->data('file_name');
        // } else {
        //     $dokout = '';
        // }

        //tahapan standar
        $jenisstandar = $this->input->post('jenis_standar');
        if ($jenisstandar == 48) {
            $tahapan = 103;
        } else {
            $tahapan = 110;
        }

        $data = [
            'jenis_standar' => $this->input->post('jenis_standar'),
            'komite_teknis' => $this->input->post('komite_teknis'),
            'judul' => $this->input->post('judul'),
            'ruang_lingkup' => htmlspecialchars($this->input->post('ruang_lingkup', true)),
            'detail_penelitian' => htmlspecialchars($this->input->post('detail_penelitian', true)),
            'dok_detail_penelitian' => $dokdp,
            'dok_detail_penelitian_64' => $dok_detail_penelitian_base64,
            'tujuan_perumusan' => htmlspecialchars($this->input->post('tujuan_perumusan', true)),
            'org_pendukung' => $this->input->post('org_pendukung'),
            'dok_org_pendukung' => $doklop,
            'dok_org_pendukung_64'=> $dok_org_pendukung_base64,
            'surat_pengajuan' => $doksrp,
            'surat_pengajuan_64' => $surat_pengajuan_base64,
            'outline' => $dokout,
            'outline_64' => $outline_base64,
            'evaluasi' => htmlspecialchars($this->input->post('evaluasi', true)),
            'status' => 99,
            'proses_usulan' => $tahapan,
            'user_input' => $userId,
            'tgl_input' => date('Y-m-d h:i:s'),
            'token' => $this->session->userdata('token'),
        ];

        $post = $this->input->post();
        $insert = $this->lapan_api_library->call('usulan/addusulan', $data);
        if ($insert['status'] == 200) {
            $data = ['token' =>$this->session->userdata('token'),'id_usulan' => $insert['id']];
            $insert_perbaikan = $this->lapan_api_library->call('usulan/addperbaikan', $data);
            if($insert_perbaikan['status'] == 200){
            $post = $this->input->post();
            $data_kons_utama = [
                'id_usulan' => $insert['id'],
                'nama' => htmlspecialchars($this->input->post('nama_konseptor', true)),
                'alamat' => htmlspecialchars($this->input->post('alamat_konseptor', true)),
                'email' => htmlspecialchars($this->input->post('email_konseptor', true)),
                'telepon' => htmlspecialchars($this->input->post('telepon_konseptor', true)),
                'token' => $this->session->userdata('token')
            ];
            //  $this->db->insert('d_konseptor_utama', $data_kons_utama);
            $insert_konseptor = $this->lapan_api_library->call('usulan/addkonseptorutama', $data_kons_utama);

            if($insert_konseptor['status'] == 200){
                $kon = array();
                foreach ($post['konseptor'] as $ks) {
                    $kon['id_usulan'] = $insert['id'];
                    $kon['nama'] = $ks['nama'];
                    $kon['instansi'] = $ks['instansi'];
                    $kon['token'] = $this->session->userdata('token');
                    $insert_d_konseptor = $this->lapan_api_library->call('usulan/add_d_konseptor', $kon);
                }
            }

            if($insert_konseptor['status'] == 200){
                $phb = array();
                foreach ($post['pihak'] as $pb) {
                    $phb['id_usulan'] = $insert['id'];
                    $phb['nama'] = $pb['nama'];
                    $phb['token'] = $this->session->userdata('token');
                    $insert_d_kepentingan = $this->lapan_api_library->call('usulan/add_d_kepentingan', $phb);
                    // $this->db->insert('d_pihak_berkepentingan', $phb);
                }
            } 
            
            if($insert_konseptor['status'] == 200){
                $mnf = array();
                foreach ($post['manfaat'] as $mf) {
                    $mnf['id_usulan'] = $insert['id'];
                    $mnf['isi'] = $mf['isi'];
                    $mnf['token'] = $this->session->userdata('token');
                    $insert_d_manfaat = $this->lapan_api_library->call('usulan/add_d_manfaat', $mnf);
                }
            }

            if($insert_konseptor['status'] == 200){
                $reg = array();
                foreach ($post['regulasi'] as $rg) {
                    $reg['id_usulan'] = $insert['id'];
                    $reg['nama'] = $rg['nama'];
                    $reg['token'] = $this->session->userdata('token');

                    $insert_d_regulasi = $this->lapan_api_library->call('usulan/add_d_regulasi', $reg);
                }
            }

            if($insert_konseptor['status'] == 200){
                $sni = array();
                if ($post['acuansni']) {
                    foreach ($post['acuansni'] as $pb) {
                        $sni['id_usulan'] = $insert['id'];
                        $sni['nama'] = $pb['nama'];
                        $sni['token'] =  $this->session->userdata('token');
                        $insert_d_acuansni = $this->lapan_api_library->call('usulan/add_d_acuansni', $sni);
                    }
                 }
            } 

            if($insert_konseptor['status'] == 200){
                $nsni = array();
                if ($post['acuannonsni']) {
                    foreach ($post['acuannonsni'] as $ann) {
                        $nsni['id_usulan'] = $insert['id'];
                        $nsni['nama'] = $ann['nama'];
                        $nsni['token'] =  $this->session->userdata('token');
                        $insert_d_acuannonsni = $this->lapan_api_library->call('usulan/add_d_acuannonsni', $nsni);
                    }
                }
            } 

            if($insert_konseptor['status'] == 200){
                $bib = array();
                if ($post['bibliografi']) {
                    foreach ($post['bibliografi'] as $bb) {
                        $bib['id_usulan'] = $insert['id'];
                        $bib['nama'] = $bb['nama'];
                        $bib['token'] =  $this->session->userdata('token');
                        $insert_d_bibliografi = $this->lapan_api_library->call('usulan/add_d_bibliografi', $bib);
                    }
                }
            } 

            if($insert_konseptor['status'] == 200){
                $lpk = array();
                if ($post['lpk']) {
                    foreach ($post['lpk'] as $lp) {
                        $lpk['id_usulan'] = $insert['id'];
                        $lpk['nama'] = $lp['nama'];
                        $lpk['token'] =  $this->session->userdata('token');
                        $insert_d_lpk = $this->lapan_api_library->call('usulan/add_d_lpk', $lpk);
                    }
                }
            } 

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Usulan telah ditambahkan!</div>');
            redirect('pengajuan/usulan_baru');
            }
        }
    }

    public function update()
    {
        $userId = $this->session->userdata('user_id');
        // print_r(json_encode($this->input->post()));exit;
        $post = $this->input->post();
        $id = $post['id'];
        $time = time();
        // print_r($post);exit;
        //Upload dokumen detail penelitian
        $configddp['file_name']          = 'detail_penelitian_' . $time;
        // $configddp['upload_path']          = './assets/dokumen/detail_penelitian/';
        $configddp['allowed_types']        = 'pdf';
        $configddp['overwrite']        = TRUE;

        $this->upload->initialize($configddp);

        // if ($this->upload->do_upload('dok_detail_penelitian')) {
        //     $dokdp = $this->upload->data('file_name');
        // } else {
        //     $dokdp = $this->input->post('dok_det_lama');
        // }

        if(!empty($_FILES['dok_detail_penelitian']['tmp_name']) && file_exists($_FILES['dok_detail_penelitian']['tmp_name'])) {
            $dokdp = 'detail_penelitian_' . $time.'.pdf';
            $file_tmp = $_FILES['dok_detail_penelitian']['tmp_name'];
            $data = file_get_contents($file_tmp);
            $dok_detail_penelitian_base64 = base64_encode($data);
        }else {
            $dokdp = $post['dok_det_lama'];
            // $file_tmp = $_FILES['dok_det_lama']['tmp_name'];
            // $data = file_get_contents($file_tmp);
            $dok_detail_penelitian_base64 = null;
        }

        //Upload dokumen bukti pendukung
        $configlop['file_name']          = 'lampiran_organisasi_pendukung_' . $time;
        // $configlop['upload_path']          = './assets/dokumen/lampiran_organisasi/';
        $configlop['allowed_types']        = 'pdf';
        $configlop['overwrite']        = TRUE;

        $this->upload->initialize($configlop);

        // if ($this->upload->do_upload('dok_org_pendukung')) {
        //     $doklop = $this->upload->data('file_name');
        // } else {
        //     $doklop = $this->input->post('dok_org_lama');
        // }

        if(!empty($_FILES['dok_org_pendukung']['tmp_name']) && file_exists($_FILES['dok_org_pendukung']['tmp_name'])) {
            $doklop = 'lampiran_organisasi_pendukung_' . $time.'.pdf';
            $file_tmp = $_FILES['dok_org_pendukung']['tmp_name'];
            $data = file_get_contents($file_tmp);
            $dok_org_pendukung_base64 = base64_encode($data);
        }else {
            $doklop = $post['dok_org_lama'];
            // $file_tmp = $_FILES['dok_org_lama']['tmp_name'];
            // $data = file_get_contents($file_tmp);
            $dok_org_pendukung_base64 = null;
        }

        //Upload Surat Pengajuan 
        $configsrp['file_name']          = 'surat_pengajuan_' . $time;
        $configsrp['upload_path']          = './assets/dokumen/surat_pengajuan/';
        $configsrp['allowed_types']        = 'pdf';
        $configsrp['overwrite']        = TRUE;

        $this->upload->initialize($configsrp);

        // if ($this->upload->do_upload('surat_pengajuan')) {
        //     $doksrp = $this->upload->data('file_name');
        // } else {
        //     $doksrp = $this->input->post('dok_srp_lama');
        // }

        if(!empty($_FILES['surat_pengajuan']['tmp_name']) && file_exists($_FILES['surat_pengajuan']['tmp_name'])) {
            $doksrp = 'surat_pengajuan_' . $time.'.pdf';
            $file_tmp = $_FILES['surat_pengajuan']['tmp_name'];
            $data = file_get_contents($file_tmp);
            $surat_pengajuan_base64 = base64_encode($data);
        }else {
            $doksrp =  $post['dok_srp_lama'];
            // $file_tmp = $_FILES['dok_srp_lama']['tmp_name'];
            // $data = file_get_contents($file_tmp);
            $surat_pengajuan_base64 = null;
        }

        //Upload Outline
        $configsrp['file_name']          = 'outline_' . $time;
        // $configsrp['upload_path']          = './assets/dokumen/outline/';
        $configsrp['allowed_types']        = 'pdf';
        $configsrp['overwrite']        = TRUE;

        $this->upload->initialize($configsrp);

        // if ($this->upload->do_upload('outline')) {
        //     $dokout = $this->upload->data('file_name');
        // } else {
        //     $dokout = $this->input->post('dok_out_lama');
        // }

        if(!empty($_FILES['outline']['tmp_name']) && file_exists($_FILES['outline']['tmp_name'])) {
            $dokout = 'outline_' . $time.'.pdf';
            $file_tmp = $_FILES['outline']['tmp_name'];
            $data = file_get_contents($file_tmp);
            $outline_base64 = base64_encode($data);
        }else {
            $dokout = $post['dok_out_lama'];
            // $file_tmp = $_FILES['dok_out_lama']['tmp_name'];
            // $data = file_get_contents($file_tmp);
            $outline_base64 = null;
        }

        //tahapan standar
        $jenisstandar = $this->input->post('jenis_standar');
        if ($jenisstandar == 48) {
            $tahapan = 103;
        } else {
            $tahapan = 110;
        }

        // $data = [
        //     'JENIS_STANDAR' => $this->input->post('jenis_standar'),
        //     'KOMITE_TEKNIS' => $this->input->post('komite_teknis'),
        //     'JUDUL' => htmlspecialchars($this->input->post('judul', true)),
        //     'RUANG_LINGKUP' => htmlspecialchars($this->input->post('ruang_lingkup', true)),
        //     'DETAIL_PENELITIAN' => htmlspecialchars($this->input->post('detail_penelitian', true)),
        //     'DOK_DETAIL_PENELITIAN' => $dokdp,
        //     'TUJUAN_PERUMUSAN' => htmlspecialchars($this->input->post('tujuan_perumusan', true)),
        //     'ORG_PENDUKUNG' => $this->input->post('org_pendukung'),
        //     'DOK_ORG_PENDUKUNG' => $doklop,
        //     'SURAT_PENGAJUAN' => $doksrp,
        //     'OUTLINE' => $dokout,
        //     'STATUS' => 99,
        //     'TAHAPAN' => $tahapan
        // ];

        $data = [
            'jenis_standar' => $this->input->post('jenis_standar'),
            'komite_teknis' => $this->input->post('komite_teknis'),
            'judul' => $this->input->post('judul'),
            'ruang_lingkup' => htmlspecialchars($this->input->post('ruang_lingkup', true)),
            'detail_penelitian' => htmlspecialchars($this->input->post('detail_penelitian', true)),
            'dok_detail_penelitian' => $dokdp,
            'dok_detail_penelitian_64' => $dok_detail_penelitian_base64,
            'tujuan_perumusan' => htmlspecialchars($this->input->post('tujuan_perumusan', true)),
            'org_pendukung' => $this->input->post('org_pendukung'),
            'dok_org_pendukung' => $doklop,
            'dok_org_pendukung_64'=> $dok_org_pendukung_base64,
            'surat_pengajuan' => $doksrp,
            'surat_pengajuan_64' => $surat_pengajuan_base64,
            'outline' => $dokout,
            'outline_64' => $outline_base64,
            'evaluasi' => htmlspecialchars($this->input->post('evaluasi', true)),
            'status' => 99,
            'proses_usulan' => $tahapan,
            'user_input' => $userId,
            'tgl_input' => date('Y-m-d h:i:s'),
            'token' => $this->session->userdata('token'),
            'id' => $id
        ];

      

        // $this->db->where('ID', $id);

        $update = $this->lapan_api_library->call('usulan/updateusulan', $data);
        // print_r($update);exit;
        // print_r(json_encode($update['status']));exit;
        // if ($this->db->update('msusulan', $data)) {
        if ($update['status'] == 200) {
            // $this->db->delete('d_konseptor', array('ID_USULAN' => $post['id']));
            // $this->db->delete('d_manfaat', array('ID_USULAN' => $post['id']));
            // $this->db->delete('d_pihak_berkepentingan', array('ID_USULAN' => $post['id']));
            // $this->db->delete('d_regulasi', array('ID_USULAN' => $post['id']));
            // $this->db->delete('d_acuan_sni', array('ID_USULAN' => $post['id']));
            // $this->db->delete('d_acuan_nonsni', array('ID_USULAN' => $post['id']));
            // $this->db->delete('d_bibliografi', array('ID_USULAN' => $post['id']));
            // $this->db->delete('d_lpk', array('ID_USULAN' => $post['id']));

            $res = $this->lapan_api_library->call('usulan/hapusdkonseptor', ['id' => $post['id'], 'token' => $this->session->userdata('token')]);
            $this->lapan_api_library->call('usulan/hapusdmanfaat', ['id' => $post['id'], 'token' => $this->session->userdata('token')]);
            $this->lapan_api_library->call('usulan/hapusdkepentingan', ['id' => $post['id'], 'token' => $this->session->userdata('token')]);
            $this->lapan_api_library->call('usulan/hapusdkregulasi', ['id' => $post['id'], 'token' => $this->session->userdata('token')]);
            $this->lapan_api_library->call('usulan/hapusacuansni', ['id' => $post['id'], 'token' => $this->session->userdata('token')]);
            $this->lapan_api_library->call('usulan/hapusacuannonsni', ['id' => $post['id'], 'token' => $this->session->userdata('token')]);
            $this->lapan_api_library->call('usulan/hapusdbibliografi', ['id' => $post['id'], 'token' => $this->session->userdata('token')]);
            $this->lapan_api_library->call('usulan/hapusdlpk', ['id' => $post['id'], 'token' => $this->session->userdata('token')]);

            //untuk dapatkan nik konseptor utama
            $nik = $post['konseptor'][1]['nik'];

            // insert data konseptor utama
            // $data_kons_utama = [
            //     'ID_USULAN' => $post['id'],
            //     'NIK' => $nik,
            //     'NAMA' => htmlspecialchars($this->input->post('nama_konseptor', true)),
            //     'ALAMAT' => htmlspecialchars($this->input->post('alamat_konseptor', true)),
            //     'EMAIL' => htmlspecialchars($this->input->post('email_konseptor', true)),
            //     'TELEPON' => htmlspecialchars($this->input->post('telepon_konseptor', true))
            // ];
            // $this->db->insert('d_konseptor_utama', $data_kons_utama);

            // $phb = array();
            // foreach ($post['pihak'] as $pb) {
            //     $phb['ID_USULAN'] = $post['id'];
            //     $phb['NAMA'] = $pb['nama'];
            //     $this->db->insert('d_pihak_berkepentingan', $phb);
            // }

            $phb = array();
            foreach ($post['pihak'] as $pb) {
                $phb['id_usulan'] = $post['id'];
                $phb['nama'] = $pb['nama'];
                $phb['token'] = $this->session->userdata('token');
                $insert_d_kepentingan = $this->lapan_api_library->call('usulan/add_d_kepentingan', $phb);
                // $this->db->insert('d_pihak_berkepentingan', $phb);
            }

            // $kon = array();
            // foreach ($post['konseptor'] as $ks) {
            //     $kon['ID_USULAN'] = $post['id'];
            //     $kon['NIK'] = $ks['nik'];
            //     $kon['INSTANSI'] = $ks['instansi'];
            //     $this->db->insert('d_konseptor', $kon);
            // }

            // $mnf = array();
            // foreach ($post['manfaat'] as $mf) {
            //     $mnf['ID_USULAN'] = $post['id'];
            //     $mnf['ISI'] = $mf['isi'];
            //     $this->db->insert('d_manfaat', $mnf);
            // }

            $mnf = array();
            foreach ($post['manfaat'] as $mf) {
                $mnf['id_usulan'] = $post['id'];
                $mnf['isi'] = $mf['isi'];
                $mnf['token'] = $this->session->userdata('token');
                $insert_d_manfaat = $this->lapan_api_library->call('usulan/add_d_manfaat', $mnf);
            }

            // $reg = array();
            // foreach ($post['regulasi'] as $rg) {
            //     $reg['ID_USULAN'] = $post['id'];
            //     $reg['NAMA'] = $rg['nama'];
            //     $this->db->insert('d_regulasi', $reg);
            // }

            $reg = array();
            foreach ($post['regulasi'] as $rg) {
                $reg['id_usulan'] = $post['id'];
                $reg['nama'] = $rg['nama'];
                $reg['token'] = $this->session->userdata('token');

                $insert_d_regulasi = $this->lapan_api_library->call('usulan/add_d_regulasi', $reg);
            }

            // $sni = array();
            // if ($post['acuansni']) {
            //     foreach ($post['acuansni'] as $pb) {
            //         $sni['ID_USULAN'] = $post['id'];
            //         $sni['NAMA'] = $pb['nama'];
            //         var_dump($sni);
            //         $this->db->insert('d_acuan_sni', $sni);
            //     }
            // }

            $sni = array();
            if ($post['acuansni']) {
                foreach ($post['acuansni'] as $pb) {
                    $sni['id_usulan'] = $post['id'];
                    $sni['nama'] = $pb['nama'];
                    $sni['token'] =  $this->session->userdata('token');
                    $insert_d_acuansni = $this->lapan_api_library->call('usulan/add_d_acuansni', $sni);
                }
             }


            // $nsni = array();
            // if ($post['acuannonsni']) {
            //     foreach ($post['acuannonsni'] as $ann) {
            //         $nsni['ID_USULAN'] = $post['id'];
            //         $nsni['NAMA'] = $ann['nama'];
            //         var_dump($nsni);
            //         $this->db->insert('d_acuan_nonsni', $nsni);
            //     }
            // }

            $nsni = array();
            if ($post['acuannonsni']) {
                foreach ($post['acuannonsni'] as $ann) {
                    $nsni['id_usulan'] = $post['id'];
                    $nsni['nama'] = $ann['nama'];
                    $nsni['token'] =  $this->session->userdata('token');
                    $insert_d_acuannonsni = $this->lapan_api_library->call('usulan/add_d_acuannonsni', $nsni);
                }
            }

            // $bib = array();
            // if ($post['bibliografi']) {
            //     foreach ($post['bibliografi'] as $bb) {
            //         $bib['ID_USULAN'] = $post['id'];
            //         $bib['NAMA'] = $bb['nama'];
            //         var_dump($bib);
            //         $this->db->insert('d_bibliografi', $bib);
            //     }
            // }

            $bib = array();
            if ($post['bibliografi']) {
                foreach ($post['bibliografi'] as $bb) {
                    $bib['id_usulan'] = $post['id'];
                    $bib['nama'] = $bb['nama'];
                    $bib['token'] =  $this->session->userdata('token');
                    $insert_d_bibliografi = $this->lapan_api_library->call('usulan/add_d_bibliografi', $bib);
                }
            }

            // $lpk = array();
            // if ($post['lpk']) {
            //     foreach ($post['lpk'] as $lp) {
            //         $lpk['ID_USULAN'] = $post['id'];
            //         $lpk['NAMA'] = $lp['nama'];
            //         var_dump($lpk);
            //         $this->db->insert('d_lpk', $lpk);
            //     }
            // }

            $lpk = array();
                if ($post['lpk']) {
                    foreach ($post['lpk'] as $lp) {
                        $lpk['id_usulan'] = $post['id'];
                        $lpk['nama'] = $lp['nama'];
                        $lpk['token'] =  $this->session->userdata('token');
                        $insert_d_lpk = $this->lapan_api_library->call('usulan/add_d_lpk', $lpk);
                    }
                }



            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Usulan telah diubah!</div>');
            redirect('pengajuan/usulan_baru');
        }
    }


    public function usulan_baru()
    {
        $detailuser = $this->lapan_api_library->call('usulan/getdetailuser', ['token' => $this->session->userdata('token'), 'id' => $this->session->userdata('user_id')]);
        $data['detailuser'] = $detailuser;
        if ($this->session->userdata('role_id') == 96) {
            $getusulandraft = $this->lapan_api_library->call('usulan/getusulandraft', ['token' => $this->session->userdata('token')]);
            $data['draft'] = $getusulandraft;
            $getusulandiajukan = $this->lapan_api_library->call('usulan/getusulandiajukan', ['token' => $this->session->userdata('token')]);
            $data['diajukan'] = $getusulandiajukan;
            $getusulandiatolak = $this->lapan_api_library->call('usulan/getusulanditolak', ['token' => $this->session->userdata('token')]);
            $data['ditolak'] = $getusulandiatolak;
            $getusulanditerima = $this->lapan_api_library->call('usulan/getusulanditerima', ['token' => $this->session->userdata('token')]);
            $data['diterima'] = $getusulanditerima;
        } else {
            $getusulandraft = $this->lapan_api_library->call('usulan/getusulandraftbyuser', ['token' => $this->session->userdata('token'), 'id' => $this->session->userdata('user_id')]);
            $data['draft'] = $getusulandraft;
            $getusulandiajukan = $this->lapan_api_library->call('usulan/getusulandiajukanbyuser', ['token' => $this->session->userdata('token'), 'id' => $this->session->userdata('user_id')]);
            $data['diajukan'] = $getusulandiajukan;
            $getusulanditolak = $this->lapan_api_library->call('usulan/getusulanditolakbyuser', ['token' => $this->session->userdata('token'), 'id' => $this->session->userdata('user_id')]);
            $data['ditolak'] = $getusulanditolak;
            $getusulanditerima = $this->lapan_api_library->call('usulan/getusulanditerimabyuser', ['token' => $this->session->userdata('token'), 'id' => $this->session->userdata('user_id')]);
            $data['diterima'] = $getusulanditerima;
        }
        $this->load->view('templates/header');
        $this->load->view('templates/side_menu');
        $this->load->view('pengajuan/usulan', $data);
        $this->load->view('templates/footer');
    }

    public function ajukan($id)
    {
        $ajukan = $this->lapan_api_library->call('usulan/ajukan', ['token' => $this->session->userdata('token'), 'id' => $id]);
        if($ajukan['status'] == 200){
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Usulan telah diajukan!</div>');
            redirect('pengajuan/usulan_baru');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Usulan gagal diajukan!</div>');
            redirect('pengajuan/usulan_baru');
        }
    }

    function reload_konseptor($id = '')
    {
        if ($id != '') {
            $ID = $id;
        }
        $idkonseptor = $this->input->post('id_konseptor');

        $this->load->model('Pengajuan_model', 'mPengajuan');
        $detail = $this->mPengajuan->getDetailKonseptor($idkonseptor);

        $results = array('header' => $detail);

        echo json_encode($results);
    }

    function reload_instansi($id = '')
    {
        if ($id != '') {
            $ID = $id;
        }

        $idkonseptor = $this->input->post('idkon');

        $this->load->model('Pengajuan_model', 'mPengajuan');
        $detail = $this->mPengajuan->getInstansiKonseptor($idkonseptor);

        $results = array('header' => $detail);

        echo json_encode($results);
    }

    //User Sekretariat
    public function monitoring_usulan()
    {
        
        $getusulandiajukan = $this->lapan_api_library->call('usulan/getusulandiajukan', ['token' => $this->session->userdata('token')]);
            $data['diajukan'] = $getusulandiajukan;
            $getusulandiatolak = $this->lapan_api_library->call('usulan/getusulanditolak', ['token' => $this->session->userdata('token')]);
            $data['ditolak'] = $getusulandiatolak;
            $getusulanditerima = $this->lapan_api_library->call('usulan/getusulanditerima', ['token' => $this->session->userdata('token')]);
            $data['diterima'] = $getusulanditerima;

        if ($this->session->userdata('role_id') == 96 or $this->session->userdata('role_id') == 98) {
            $this->load->view('templates/header');
            $this->load->view('templates/side_menu');
            $this->load->view('pengajuan/monitoring_usulan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/side_menu');
            $this->load->view('403.html');
            $this->load->view('templates/footer');
        }
    }

    public function proses_usulan($id)
    {
        $usulan = $this->lapan_api_library->call('usulan/getusulanbyid', ['token' => $this->session->userdata('token'), 'id' => $id]);
        $data['usulan'] = $usulan[0];
        $perbaikan = $this->lapan_api_library->call('usulan/getperbaikanbyid', ['token' => $this->session->userdata('token'), 'id' => $id]);
        $data['perbaikan'] = $perbaikan[0];
        $psni = $this->lapan_api_library->call('usulan/getperumusansni', ['token' => $this->session->userdata('token')]);
        $data['psni'] = $psni;
        $psi = $this->lapan_api_library->call('usulan/getperumusansl',['token' => $this->session->userdata('token')]);
        $data['psl'] = $psi;
        $jenisstandar = $this->lapan_api_library->call('usulan/jenisstandar', ['token' => $this->session->userdata('token')]);
        $data['jnstandar'] = $jenisstandar;
        $komiteteknis = $this->lapan_api_library->call('usulan/komiteteknis', ['token' => $this->session->userdata('token')]);
        $data['kmteknik'] = $komiteteknis;
        $jenisperumusan = $this->lapan_api_library->call('usulan/jenisperumusan', ['token' => $this->session->userdata('token')]);
        $data['jnperumusan'] = $jenisperumusan;
        $jalurrumusan = $this->lapan_api_library->call('usulan/jalurperumusan', ['token' => $this->session->userdata('token')]);
        $data['jlperumusan'] = $jalurrumusan;
        $konseptor = $this->lapan_api_library->call('usulan/konseptor', ['token' => $this->session->userdata('token')]);
        $data['gkonseptor'] = $konseptor;
        $gpusni = $this->lapan_api_library->call('usulan/getprosesusulansni', ['token' => $this->session->userdata('token')]);
        $data['prusulansni'] = $gpusni;
        $gpusl = $this->lapan_api_library->call('usulan/getprosesusulansl', ['token' => $this->session->userdata('token')]);
        $data['prusulansl'] = $gpusl;
        $jenisadopsi = $this->lapan_api_library->call('usulan/getjenisadopsi', ['token' => $this->session->userdata('token')]);
        $data['jnadopsi'] = $jenisadopsi;
        $metodeadopsi = $this->lapan_api_library->call('usulan/getmetodeadopsi', ['token' => $this->session->userdata('token')]);
        $data['mtadopsi'] = $metodeadopsi;
        $status = $this->lapan_api_library->call('usulan/getstatus', ['token' => $this->session->userdata('token')]);
        $data['status'] = $status;
        $email['email'] = $this->session->userdata('email');
        $data['email'] = $email;

        if ($this->session->userdata('role_id') == 96 or $this->session->userdata('role_id') == 98) {
            $this->load->view('templates/header');
            $this->load->view('templates/side_menu');
            $this->load->view('pengajuan/proses_usulan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/side_menu');
            $this->load->view('403.html');
            $this->load->view('templates/footer');
        }
    }
    //save proses usulan
    public function save_proses()
    {
        $id = $this->input->post('id');
        //Upload dokumen kebutuhan mendesak
        // $configskm['file_name']          = 'surat_kebutuhan_mendesak_' . $id;
        // $configskm['upload_path']          = './assets/dokumen/kebutuhan_mendesak/';
        // $configskm['allowed_types']        = 'pdf';
        // $configskm['overwrite']        = TRUE;

        if(!empty($_FILES['dok_keb_mendesak']['tmp_name']) && file_exists($_FILES['dok_keb_mendesak']['tmp_name'])) {
            $dok_keb_mendesak = 'surat_kebutuhan_mendesak_' . $id.'.pdf';
            $file_tmp = $_FILES['dok_keb_mendesak']['tmp_name'];
			$data = file_get_contents($file_tmp);
			$dok_keb_mendesak64 = base64_encode($data);
        }else {
            $dok_keb_mendesak = null;
            $dok_keb_mendesak64 = null;
        }

        if(!empty($_FILES['dok_kesediaan_paten']['tmp_name']) && file_exists($_FILES['dok_kesediaan_paten']['tmp_name'])) {
            $dokkpp = 'surat_kesediaan_pencantuman_paten_' . $id.'.pdf';
            $file_tmp = $_FILES['dok_kesediaan_paten']['tmp_name'];
			$data = file_get_contents($file_tmp);
			$dokkpp64 = base64_encode($data);
        }else {
            $dokkpp64 = null;
            $dokkpp = null;
        }
        // $this->upload->initialize($configskm);

        // if ($this->upload->do_upload('dok_keb_mendesak')) {
        //     $dokkm = $this->upload->data('file_name');
        // } else {
        //     $dokkm = $this->input->post('dok_skm_lama');
        // }

        //Upload dokumen kesediaan pencantuman paten
        // $configkpp['file_name']          = 'surat_kesediaan_pencantuman_paten_' . $id;
        // $configkpp['upload_path']          = './assets/dokumen/kesediaan_paten/';
        // $configkpp['allowed_types']        = 'doc|docx';
        // $configkpp['overwrite']        = TRUE;

        // $this->upload->initialize($configkpp);

        // if ($this->upload->do_upload('dok_kesediaan_paten')) {
        //     $dokkpp = $this->upload->data('file_name');
        // } else {
        //     $dokkpp = $this->input->post('dok_ksp_lama');
        // }
        $data = [
            'jenis_perumusan' => $this->input->post('jenis_perumusan'),
            'jalur_perumusan' => $this->input->post('jalur_perumusan'),
            'kode' => $this->input->post('kode'),
            'no_sni_ralat' => htmlspecialchars($this->input->post('no_sni_ralat', true)),
            'p_sni_ralat' => htmlspecialchars($this->input->post('p_sni_ralat', true)),
            'no_sni_amademen' => htmlspecialchars($this->input->post('no_sni_amandemen', true)),
            'p_sni_amademen' => htmlspecialchars($this->input->post('p_sni_amandemen', true)),
            'no_sni_terjemah' => htmlspecialchars($this->input->post('no_sni_terjemah', true)),
            'jenis_adopsi' => $this->input->post('jenis_adopsi'),
            'metode_adopsi' => $this->input->post('metode_adopsi'),
            'keb_mendesak' => $this->input->post('keb_mendesak'),
            'dok_keb_mendesak' => $dok_keb_mendesak,
            'dok_keb_mendesak64' => $dok_keb_mendesak64,
            'terkait_paten' => $this->input->post('terkait_paten'),
            'dok_kesediaan_paten' => $dokkpp,
            'dok_kesediaan_paten64' => $dokkpp64,
            'informasi_paten' => $this->input->post('informasi_paten'),
            'kesesuaian' => htmlspecialchars($this->input->post('kesesuaian', true)),
            'ulasan' => $this->input->post('ulasan', true),
            'status' => $this->input->post('status'),
            'alasan_penolakan' => htmlspecialchars($this->input->post('alasan_penolakan', true)),
            'proses_usulan' => $this->input->post('proses_usulan'),
            'proses_perumusan' => $this->input->post('proses_perumusan'),
            'token' => $this->session->userdata('token'),
            'id' => $id
        ];
        $update = $this->lapan_api_library->call('usulan/saveprosesusulan',$data);
        if ($update) {
            for ($i = 1; $i <= 4; $i++) {
                if(!empty($_FILES['surat_pengantar_' . $i]['tmp_name']) && file_exists($_FILES['surat_pengantar_' . $i]['tmp_name'])) {
                    $sp[$i] = 'surat_pengantar_' . $i . '_' . $id.'.pdf';
                    $file_tmp = $_FILES['surat_pengantar_' . $i]['tmp_name'];
                    $data = file_get_contents($file_tmp);
                    $sp64[$i] = base64_encode($data);
                }else {
                    $sp[$i] = null;
                    $sp64[$i] = null;
                }
                if(!empty($_FILES['rsni_' . $i]['tmp_name']) && file_exists($_FILES['rsni_' . $i]['tmp_name'])) {
                    $rsni[$i] = 'rsni_' . $i . '_' . $id.'.pdf';
                    $file_tmp = $_FILES['rsni_' . $i]['tmp_name'];
                    $data = file_get_contents($file_tmp);
                    $rsni64[$i] = base64_encode($data);
                }else {
                    $rsni[$i] = null;
                    $rsni64[$i] = null;
                }
                if(!empty($_FILES['notulensi_' . $i]['tmp_name']) && file_exists($_FILES['notulensi_' . $i]['tmp_name'])) {
                    $notulensi[$i] = 'notulensi_' . $i . '_' . $id.'.pdf';
                    $file_tmp = $_FILES['notulensi_' . $i]['tmp_name'];
                    $data = file_get_contents($file_tmp);
                    $notulensi64[$i] = base64_encode($data);
                }else {
                    $notulensi[$i] = null;
                    $notulensi64[$i] = null;
                }
            }

            $dataper = [
                'surat_pengantar_1' => $sp[1],
                'surat_pengantar_164' => $sp64[1],
                'surat_pengantar_2' => $sp[2],
                'surat_pengantar_264' => $sp64[2],
                'surat_pengantar_3' => $sp[3],
                'surat_pengantar_364' => $sp64[3],
                'surat_pengantar_4' => $sp[4],
                'surat_pengantar_464' => $sp64[4],
                'rsni_1' => $rsni[1],
                'rsni_164' => $rsni64[1],
                'rsni_2' => $rsni[2],
                'rsni_264' => $rsni64[2],
                'rsni_3' => $rsni[3],
                'rsni_364' => $rsni64[3],
                'rsni_4' => $rsni[4],
                'rsni_464' => $rsni64[4],
                'notulensi_1' => $notulensi[1],
                'notulensi_164' => $notulensi64[1],
                'notulensi_264' => $notulensi64[2],
                'notulensi_364' => $notulensi64[3],
                'notulensi_464' => $notulensi64[4],
                'notulensi_2' => $notulensi[2],
                'notulensi_3' => $notulensi[3],
                'notulensi_4' => $notulensi[4],
                'token' => $this->session->userdata('token'),
                'id' => $id,
            ];
            $update = $this->lapan_api_library->call('usulan/update_d_perbaikan',$dataper);
            // print_r($update);exit;
            if($update['status'] == 200 ){
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Usulan telah diproses!</div>');
                redirect('pengajuan/monitoring_usulan');
            }else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Usulan gagal diproses!</div>');
                redirect('pengajuan/monitoring_usulan');
            }
            // $this->db->where('ID_USULAN', $id);
            // $this->db->update('d_perbaikan', $dataper);
            // $tables = ['d_acuan_sni' => 'd_acuan_sni', 'd_acuan_nonsni' => 'd_acuan_nonsni', 'd_bibliografi' => 
            // 'd_bibliografi', 'd_lpk' => 'd_lpk','token' => $this->session->userdata('token'),'id' => $id];
            // $delete = $this->lapan_api_library->call('usulan/delete_d_perbaikan', $tables);
            // if($delete['status'] != 200){
            //     $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            //     Usulan D Perbaikan gagal diproses!</div>');
            //     redirect('pengajuan/monitoring_usulan');
            // }
            // $this->db->where('ID_USULAN', $id);
            // $this->db->delete($tables);
            //Notifikasi email berdasarkan proses usulan
            $prosesusulan = $this->input->post('proses_usulan');
            $prosesusulansebelumnya = $this->input->post('proses_usulan_sebelumnya');
            //cek apakah ada perubahan status proses usulan,jika ada perubahan maka akan kirim notif email
            if ($prosesusulan != $prosesusulansebelumnya) {
                switch ($prosesusulan) {
                    case "104":
                        $this->_send_email('snverdok');
                        break;
                    case "105":
                        $this->_send_email('snversub');
                        break;
                    case "106":
                        $this->_send_email('snpengesahan');
                        break;
                    case "107":
                        $this->_send_email('snpengajuan');
                        break;
                    case "108":
                        $this->_send_email('snpublikasi');
                        break;
                    case "109":
                        $this->_send_email('snpengesahanpnps');
                        break;
                    case "111":
                        $this->_send_email('slverdok');
                        break;
                    case "112":
                        $this->_send_email('slversub');
                        break;
                    case "113":
                        $this->_send_email('slperumusan');
                        break;
                    case "114":
                        $this->_send_email('slpengajuan');
                        break;
                }
            }
            //Notifikasi email berdasarkan tahapan proses perumusan
            $prosesperumusan = $this->input->post('proses_perumusan');
            $prosesperumusansebelumnya = $this->input->post('proses_perumusan_sebelumnya');
            //cek apakah ada perubahan status proses perumusan,jika ada perubahan maka akan kirim notif email
            if ($prosesperumusan != $prosesperumusansebelumnya) {
                switch ($prosesperumusan) {
                    case "80":
                        $this->_send_email('sn1mraptek');;
                        break;
                    case "81":
                        $this->_send_email('sn2mperbaikan');;
                        break;
                    case "82":
                        $this->_send_email('sn2mraptek');;
                        break;
                    case "83":
                        $this->_send_email('sn3mpengesahan');;
                        break;
                    case "84":
                        $this->_send_email('jpproses');;
                        break;
                    case "85":
                        $this->_send_email('jpmpengesahan');;
                        break;
                    case "86":
                        $this->_send_email('sn4mperbaikan');;
                        break;
                    case "87":
                        $this->_send_email('sn4raptek');;
                        break;
                    case "88":
                        $this->_send_email('rasni');;
                        break;
                    case "89":
                        $this->_send_email('sni');;
                        break;
                    case "90":
                        $this->_send_email('sl1raptek');;
                        break;
                    case "91":
                        $this->_send_email('sl2mperbaikan');;
                        break;
                    case "92":
                        $this->_send_email('sl2raptek');;
                        break;
                    case "93":
                        $this->_send_email('sl3mpengesahan');;
                        break;
                    case "94":
                        $this->_send_email('psl');;
                        break;
                    case "95":
                        $this->_send_email('sl');;
                        break;
                }
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Usulan telah diproses!</div>');
            redirect('pengajuan/monitoring_usulan');
        }
    }

    public function perbaikan_usulan_rsni($id)
    {
        $usulan = $this->lapan_api_library->call('usulan/getusulanbyid', ['token' => $this->session->userdata('token'), 'id' => $id]);
        $data['usulan'] = $usulan[0];
        $perbaikan = $this->lapan_api_library->call('usulan/getperbaikanbyid', ['token' => $this->session->userdata('token'), 'id' => $id]);
        $data['perbaikan'] = $perbaikan[0];
        $psni = $this->lapan_api_library->call('usulan/getperumusansni', ['token' => $this->session->userdata('token')]);
        $data['psni'] = $psni[0];
        $psi = $this->lapan_api_library->call('usulan/getperumusansl',['token' => $this->session->userdata('token')]);
        $data['psl'] = $psi[0];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/side_menu');
        $this->load->view('pengajuan/perbaikan_usulan_rsni', $data);
        $this->load->view('templates/footer');
    }

    public function perbaikan_usulan_rsl($id)
    {
        // $data['usulan'] = $this->mPengajuan->getUsulanById($id);
        // $data['perbaikan'] = $this->mPengajuan->getPerbaikanById($id);
        // $data['psni'] = $this->mPengajuan->getPerumusanSNI();
        // $data['psl'] = $this->mPengajuan->getPerumusanSL();
        $usulan = $this->lapan_api_library->call('usulan/getusulanbyid', ['token' => $this->session->userdata('token'), 'id' => $id]);
        $data['usulan'] = $usulan[0];
        $perbaikan = $this->lapan_api_library->call('usulan/getperbaikanbyid', ['token' => $this->session->userdata('token'), 'id' => $id]);
        $data['perbaikan'] = $perbaikan[0];
        $psni = $this->lapan_api_library->call('usulan/getperumusansni', ['token' => $this->session->userdata('token')]);
        $data['psni'] = $psni[0];
        $psi = $this->lapan_api_library->call('usulan/getperumusansl',['token' => $this->session->userdata('token')]);
        $data['psl'] = $psi[0];
        $this->load->view('templates/header');
        $this->load->view('templates/side_menu');
        $this->load->view('pengajuan/perbaikan_usulan_rsl', $data);
        $this->load->view('templates/footer');
    }

    public function save_perbaikan()
    {
        $id = $this->input->post('id');

        $d = date('d');
        $m = date('m');
        $Y = date('Y');
        $tgl = $d . '-' . $m . '-' . $Y;

        //Upload dokumen perbaikan tahap 1
        $config1['file_name']          = 'dok_perbaikan_tahap1_' . $id . '_' . $tgl;
        $config1['upload_path']          = './assets/dokumen/perbaikan_usulan/';
        $config1['allowed_types']        = 'pdf|doc|docx';
        $config1['overwrite']        = TRUE;

        if(!empty($_FILES['dok_detail_penelitian']['tmp_name']) && file_exists($_FILES['dok_detail_penelitian']['tmp_name'])) {
            $dokdp = 'detail_penelitian_' . $id.'.pdf';
            $file_tmp = $_FILES['dok_detail_penelitian']['tmp_name'];
			$data = file_get_contents($file_tmp);
			$dok_detail_penelitian_base64 = base64_encode($data);
        }else {
            $dokdp ='';
        }
        // $this->upload->initialize($config1);

        if ($this->upload->do_upload('dok_perbaikan_1')) {
            $dok1 = $this->upload->data('file_name');
        } else {
            $dok1 = $this->input->post('dok_1_lama');
        }

        //Upload dokumen perbaikan tahap 2
        $config2['file_name']          = 'dok_perbaikan_tahap2_' . $id . '_' . $tgl;
        $config2['upload_path']          = './assets/dokumen/perbaikan_usulan/';
        $config2['allowed_types']        = 'pdf|doc|docx';
        $config2['overwrite']        = TRUE;

        $this->upload->initialize($config2);

        if ($this->upload->do_upload('dok_perbaikan_2')) {
            $dok2 = $this->upload->data('file_name');
        } else {
            $dok2 = $this->input->post('dok_2_lama');
        }

        //Upload dokumen perbaikan tahap 2
        $config3['file_name']          = 'dok_perbaikan_tahap3_' . $id . '_' . $tgl;
        $config3['upload_path']          = './assets/dokumen/perbaikan_usulan/';
        $config3['allowed_types']        = 'pdf|doc|docx';
        $config3['overwrite']        = TRUE;

        $this->upload->initialize($config3);

        if ($this->upload->do_upload('dok_perbaikan_3')) {
            $dok3 = $this->upload->data('file_name');
        } else {
            $dok3 = $this->input->post('dok_3_lama');
        }

        //Upload dokumen perbaikan tahap 4
        $config4['file_name']          = 'dok_perbaikan_tahap4_' . $id . '_' . $tgl;
        $config4['upload_path']          = './assets/dokumen/perbaikan_usulan/';
        $config4['allowed_types']        = 'pdf|doc|docx';
        $config4['overwrite']        = TRUE;

        $this->upload->initialize($config4);

        if ($this->upload->do_upload('dok_perbaikan_4')) {
            $dok4 = $this->upload->data('file_name');
        } else {
            $dok4 = $this->input->post('dok_4_lama');
        }

        $data = [
            'DOK_PERBAIKAN_1' => $dok1,
            'DOK_PERBAIKAN_2' => $dok2,
            'DOK_PERBAIKAN_3' => $dok3,
            'DOK_PERBAIKAN_4' => $dok4
        ];

        $this->db->where('ID_USULAN', $id);
        $this->db->update('d_perbaikan', $data);

        if ($this->upload->do_upload('dok_perbaikan_1')) {
            $this->session->set_flashdata('message1', '<div class="alert alert-success" role="alert">
            Upload Dokumen perbaikan tahap 1 berhasil!</div>');
        } elseif ($this->upload->do_upload('dok_perbaikan_2')) {
            $this->session->set_flashdata('message2', '<div class="alert alert-success" role="alert">
            Upload Dokumen perbaikan tahap 2 berhasil!</div>');
        } elseif ($this->upload->do_upload('dok_perbaikan_3')) {
            $this->session->set_flashdata('message3', '<div class="alert alert-success" role="alert">
            Upload Dokumen perbaikan tahap 3 berhasil!</div>');
        } elseif ($this->upload->do_upload('dok_perbaikan_4')) {
            $this->session->set_flashdata('message4', '<div class="alert alert-success" role="alert">
            Upload Dokumen perbaikan tahap 4 berhasil!</div>');
        }
        redirect('pengajuan/usulan_baru');
    }

    private function _send_email($proses)
    {
        require 'assets/PHPMailer/PHPMailerAutoload.php';

        $judul = $this->input->post('judul');
        $email = $this->input->post('email');
        $mail = new PHPMailer;

        // Konfigurasi SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'dummyarif3228@gmail.com';
        $mail->Password = '1234dummy';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->setFrom('dummyarif3228@gmail.com');
        // Menambahkan penerima
        $mail->addAddress($email);
        // Menambahkan beberapa penerima
        //$mail->addAddress('penerima2@contoh.com');
        //$mail->addAddress('penerima3@contoh.com');

        // Menambahkan cc atau bcc 
        //$mail->addCC('cc@contoh.com');
        //$mail->addBCC('bcc@contoh.com');

        switch ($proses) {



                //Kirim Notifikasi Proses Usulan
            case "snverdok":
                $mail->Subject = 'Verifikasi Dokumen';

                // Mengatur format email ke HTML
                $mail->isHTML(true);

                // Konten/isi email
                $mailContent = 'Pengajuan PNPS "' . $judul . '" telah diproses dan sekarang sedang dalam proses verifikasi dokumen';

                $mail->Body = $mailContent;
                break;

            case "snversub":
                $mail->Subject = 'Verifikasi Substansial';
                $mail->isHTML(true);
                $mailContent = 'Pengajuan PNPS "' . $judul . '" telah telah melewati verifikasi dokumen dan sekarang sedang dalam proses verifikasi substansial';
                $mail->Body = $mailContent;
                break;

            case "snpengesahan":
                $mail->Subject = 'Menunggu Pengesahan';
                $mail->isHTML(true);
                $mailContent = 'Pengajuan PNPS "' . $judul . '" telah melewati verifikasi substansial dan sedang dalam proses menunggu pengesahan';
                $mail->Body = $mailContent;
                break;

            case "snpengajuan":
                $mail->Subject = 'Pengajuan';
                $mail->isHTML(true);
                $mailContent = 'Pengajuan PNPS "' . $judul . '" telah melewati verifikasi substansial dan sedang dalam proses menunggu pengesahan';
                $mail->Body = $mailContent;
                break;

            case "snpublikasi":
                $mail->Subject = 'Proses Publikasi PNPS';
                $mail->isHTML(true);
                $mailContent = 'Pengajuan PNPS "' . $judul . '" sedang dalam proses publikasi';
                $mail->Body = $mailContent;
                break;

            case "snpengesahanpnps":
                $mail->Subject = 'Menunggu Pengesahan PNPS';
                $mail->isHTML(true);
                $mailContent = 'Pengajuan PNPS "' . $judul . '" sedang dalam proses menunggu pengesahan PNPS';
                $mail->Body = $mailContent;
                break;

            case "slverdok":
                $mail->Subject = 'Verifikasi Dokumen';
                $mail->isHTML(true);
                $mailContent = 'Pengajuan PPSL "' . $judul . '" telah diproses dan sekarang sedang dalam proses verifikasi dokumen';
                $mail->Body = $mailContent;
                break;

            case "slversub":
                $mail->Subject = 'Verifikasi Substansial';
                $mail->isHTML(true);
                $mailContent = 'Pengajuan PPSL "' . $judul . '" telah telah melewati verifikasi dokumen dan sekarang sedang dalam proses verifikasi substansial';
                $mail->Body = $mailContent;
                break;

            case "slperumusan":
                $mail->Subject = 'Menunggu Perumusan';
                $mail->isHTML(true);
                $mailContent = 'Pengajuan PPSL "' . $judul . '" telah melewati verifikasi substansial dan sedang dalam proses menunggu perumusan';
                $mail->Body = $mailContent;
                break;

            case "slpengajuan":
                $mail->Subject = 'Pengajuan';
                $mail->isHTML(true);
                $mailContent = 'Pengajuan PPSL "' . $judul . '" sedang dalam proses pengajuan';
                $mail->Body = $mailContent;
                break;

                //Kirim Notifiakasi Proses Perumusan

            case "sn1mraptek":
                $mail->Subject = 'rsni 1-Menunggu rapat teknis';
                $mail->isHTML(true);
                $mailContent = 'Pengajuan PNPS "' . $judul . '" telah masuk tahapan rsni 1 dan menunggu rapat teknis.';
                $mail->Body = $mailContent;
                break;
            case "sn2mperbaikan":
                $mail->Subject = 'rsni 2-Menunggu perbaikan';
                $mail->isHTML(true);
                $mailContent = 'Pengajuan PNPS "' . $judul . '" telah masuk tahapan rsni 1 dan menunggu perbaikan rsni.';
                $mail->Body = $mailContent;
                break;
            case "sn2mraptek":
                $mail->Subject = 'rsni 2-Menunggu rapat teknis';
                $mail->isHTML(true);
                $mailContent = 'Pengajuan PNPS "' . $judul . '" telah masuk tahapan rsni 2 dan menunggu rapat teknis.';
                $mail->Body = $mailContent;
                break;
            case "sn3mpengesahan":
                $mail->Subject = 'rsni 3-Menunggu pengesahan';
                $mail->isHTML(true);
                $mailContent = 'Pengajuan PNPS "' . $judul . '" telah masuk tahapan rsni 3 dan menunggu pengesahan.';
                $mail->Body = $mailContent;
                break;
            case "jpproses":
                $mail->Subject = 'Proses Jajak Pendapat';
                $mail->isHTML(true);
                $mailContent = 'Pengajuan PNPS "' . $judul . '" telah masuk tahapan proses Jajak Pendapat.';
                $mail->Body = $mailContent;
                break;
            case "jpmpengesahan":
                $mail->Subject = 'JP-Menunggu pengesahan';
                $mail->isHTML(true);
                $mailContent = 'Pengajuan PNPS "' . $judul . '" telah melalui tahapan proses Jajak Pendapat dan sedang menunggu pengesahan.';
                $mail->Body = $mailContent;
                break;
            case "sn4mperbaikan":
                $mail->Subject = 'rsni 4-Menunggu Perbaikan';
                $mail->isHTML(true);
                $mailContent = 'Pengajuan PNPS "' . $judul . '" telah masuk tahapan rsni 4 dan menunggu perbaikan rsni.';
                $mail->Body = $mailContent;
                break;
            case "sn4raptek":
                $mail->Subject = 'rsni 4-Rapat Teknis';
                $mail->isHTML(true);
                $mailContent = 'Pengajuan PNPS "' . $judul . '" telah masuk tahapan rsni 4 dan menunggu rapat teknis.';
                $mail->Body = $mailContent;
                break;
            case "rasni":
                $mail->Subject = 'RASNI';
                $mail->isHTML(true);
                $mailContent = 'Pengajuan PNPS "' . $judul . '" telah masuk tahapan RASNI dan menunggu pengesahan.';
                $mail->Body = $mailContent;
                break;
            case "sni":
                $mail->Subject = 'SNI';
                $mail->isHTML(true);
                $mailContent = 'Pengajuan PNPS "' . $judul . '" telah masuk tahapan menjadi SNI.';
                $mail->Body = $mailContent;
                break;
            case "sl1raptek":
                $mail->Subject = 'RSL 1-Rapat Teknis';
                $mail->isHTML(true);
                $mailContent = 'Pengajuan PPSL "' . $judul . '" telah masuk tahapan RSL 1 dan menunggu rapat teknis.';
                $mail->Body = $mailContent;
                break;
            case "sl2mperbaikan":
                $mail->Subject = 'RSL 2-Menunggu Perbaikan';
                $mail->isHTML(true);
                $mailContent = 'Pengajuan PPSL "' . $judul . '" telah masuk tahapan RSL 2 dan menunggu perbaikan.';
                $mail->Body = $mailContent;
                break;
            case "sl2raptek":
                $mail->Subject = 'RSL 2-Rapat Teknis';
                $mail->isHTML(true);
                $mailContent = 'Pengajuan PPSL "' . $judul . '" telah masuk tahapan RSL 2 dan menunggu Rapat Teknis.';
                $mail->Body = $mailContent;
                break;
            case "sl3mpengesahan":
                $mail->Subject = 'RSL 3-Menunggu pengesahan';
                $mail->isHTML(true);
                $mailContent = 'Pengajuan PPSL "' . $judul . '" telah masuk tahapan RSL 3 dan menunggu Pengesahan.';
                $mail->Body = $mailContent;
                break;
            case "psl":
                $mail->Subject = 'Penetapan SL';
                $mail->isHTML(true);
                $mailContent = 'Pengajuan PPSL "' . $judul . '" telah masuk tahapan Penetapan SL dan sedang menunggu proses pengesahan.';
                $mail->Body = $mailContent;
                break;
            case "sl":
                $mail->Subject = 'SL';
                $mail->isHTML(true);
                $mailContent = 'Pengajuan PPSL "' . $judul . '" telah masuk tahapan menjadi SL.';
                $mail->Body = $mailContent;
                break;
        }
        // Kirim email
        if (!$mail->send()) {
            $pes = 'Pesan tidak dapat dikirim.';
            $mai = 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            $pes = 'Pesan telah terkirim';
        }
    }
}
