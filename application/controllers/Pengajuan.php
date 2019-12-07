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
        $data['user'] = $this->db->get_where('msuserstandar', ['EMAIL' =>
        $this->session->userdata('email')])->row_array();

        $roleId = $data['user']['ROLE_ID'];
        $data['role'] = $this->db->get_where('msrev', array('ID' => $roleId))->row_array();

        $data['detail'] = $this->mPengajuan->getDetail($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/side_menu');
        $this->load->view('pengajuan/detail');
        $this->load->view('templates/footer');
    }

    public function pengajuan_usulan()
    {
        $data['user'] = $this->db->get_where('msuserstandar', ['EMAIL' =>
        $this->session->userdata('email')])->row_array();

        $roleId = $data['user']['ROLE_ID'];
        $userId = $data['user']['ID'];
        $data['role'] = $this->db->get_where('msrev', array('ID' => $roleId))->row_array();

        $data['jnstandar'] = $this->mPengajuan->getJenisStandar();
        $data['kmteknis'] = $this->mPengajuan->getKomiteTeknis();
        $data['jnperumusan'] = $this->mPengajuan->getJenisPerumusan();
        $data['jlperumusan'] = $this->mPengajuan->getJalurPerumusan();
        $data['gkonseptor'] = $this->mPengajuan->getKonseptor();
        $data['detailuser'] = $this->mPengajuan->getDataUser($userId);


        $this->load->view('templates/header', $data);
        $this->load->view('templates/side_menu');
        $this->load->view('pengajuan/pengajuan_usulan');
        $this->load->view('templates/footer');
    }

    public function edit_usulan($id)
    {
        $data['user'] = $this->db->get_where('msuserstandar', ['EMAIL' =>
        $this->session->userdata('email')])->row_array();

        $roleId = $data['user']['ROLE_ID'];
        $data['role'] = $this->db->get_where('msrev', array('ID' => $roleId))->row_array();

        $data['usulan'] = $this->mPengajuan->getUsulanDraftDetail($id);
        $data['jnstandar'] = $this->mPengajuan->getJenisStandar();
        $data['kmteknis'] = $this->mPengajuan->getKomiteTeknis();
        $data['jnperumusan'] = $this->mPengajuan->getJenisPerumusan();
        $data['jlperumusan'] = $this->mPengajuan->getJalurPerumusan();
        $data['gkonseptor'] = $this->mPengajuan->getKonseptor();
        $data['konsutama'] = $this->mPengajuan->getDKonseptorUtama($id);
        $data['dkonseptor'] = $this->mPengajuan->getDKonseptor($id);
        $data['dberkepentingan'] = $this->mPengajuan->getDBerkepentingan($id);
        $data['dmanfaat'] = $this->mPengajuan->getDManfaat($id);
        $data['dregulasi'] = $this->mPengajuan->getDRegulasi($id);
        $data['dsni'] = $this->mPengajuan->getDSNI($id);
        $data['dnonsni'] = $this->mPengajuan->getDNonSNI($id);
        $data['dbibliografi'] = $this->mPengajuan->getDBibliografi($id);
        $data['dlpk'] = $this->mPengajuan->getDLpk($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/side_menu');
        $this->load->view('pengajuan/edit_usulan', $data);
        $this->load->view('templates/footer');
    }

    public function hapus_usulan($id)
    {
        $this->db->trans_begin();

        $this->db->query('DELETE FROM msusulan WHERE ID=' . $id);
        $this->db->query('DELETE FROM d_konseptor WHERE ID_USULAN=' . $id);
        $this->db->query('DELETE FROM d_konseptor_utama WHERE ID_USULAN=' . $id);
        $this->db->query('DELETE FROM d_pihak_berkepentingan WHERE ID_USULAN=' . $id);
        $this->db->query('DELETE FROM d_manfaat WHERE ID_USULAN=' . $id);
        $this->db->query('DELETE FROM d_regulasi WHERE ID_USULAN=' . $id);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            redirect('pengajuan/usulan_baru');
        }
    }

    public function save()
    {
        $user = $this->db->get_where('msuserstandar', ['EMAIL' =>
        $this->session->userdata('email')])->row_array();

        $userId = $user['ID'];

        $time = time();

        //Upload dokumen detail penelitian
        $configddp['file_name']          = 'detail_penelitian_' . $time;
        $configddp['upload_path']          = './assets/dokumen/detail_penelitian/';
        $configddp['allowed_types']        = 'pdf';
        $configddp['overwrite']        = TRUE;

        $this->upload->initialize($configddp);

        if ($this->upload->do_upload('dok_detail_penelitian')) {
            $dokdp = $this->upload->data('file_name');
        } else {
            $dokdp = '';
        }

        //Upload dokumen bukti pendukung
        $configlop['file_name']          = 'lampiran_organisasi_pendukung_' . $time;
        $configlop['upload_path']          = './assets/dokumen/lampiran_organisasi/';
        $configlop['allowed_types']        = 'pdf';
        $configlop['overwrite']        = TRUE;

        $this->upload->initialize($configlop);

        if ($this->upload->do_upload('dok_org_pendukung')) {
            $doklop = $this->upload->data('file_name');
        } else {
            $doklop = '';
        }

        //Upload Surat Pengajuan 
        $configsrp['file_name']          = 'surat_pengajuan_' . $time;
        $configsrp['upload_path']          = './assets/dokumen/surat_pengajuan/';
        $configsrp['allowed_types']        = 'pdf';
        $configsrp['overwrite']        = TRUE;

        $this->upload->initialize($configsrp);

        if ($this->upload->do_upload('surat_pengajuan')) {
            $doksrp = $this->upload->data('file_name');
        } else {
            $doksrp = '';
        }

        //Upload Outline
        $configsrp['file_name']          = 'outline_' . $time;
        $configsrp['upload_path']          = './assets/dokumen/outline/';
        $configsrp['allowed_types']        = 'pdf';
        $configsrp['overwrite']        = TRUE;

        $this->upload->initialize($configsrp);

        if ($this->upload->do_upload('outline')) {
            $dokout = $this->upload->data('file_name');
        } else {
            $dokout = '';
        }

        //tahapan standar
        $jenisstandar = $this->input->post('jenis_standar');
        if ($jenisstandar == 48) {
            $tahapan = 103;
        } else {
            $tahapan = 110;
        }

        $data = [
            'JENIS_STANDAR' => $this->input->post('jenis_standar'),
            'KOMITE_TEKNIS' => $this->input->post('komite_teknis'),
            'JUDUL' => htmlspecialchars($this->input->post('judul', true)),
            'RUANG_LINGKUP' => htmlspecialchars($this->input->post('ruang_lingkup', true)),
            'DETAIL_PENELITIAN' => htmlspecialchars($this->input->post('detail_penelitian', true)),
            'DOK_DETAIL_PENELITIAN' => $dokdp,
            'TUJUAN_PERUMUSAN' => htmlspecialchars($this->input->post('tujuan_perumusan', true)),
            'ORG_PENDUKUNG' => $this->input->post('org_pendukung'),
            'DOK_ORG_PENDUKUNG' => $doklop,
            'SURAT_PENGAJUAN' => $doksrp,
            'OUTLINE' => $dokout,
            'EVALUASI' => htmlspecialchars($this->input->post('evaluasi', true)),
            'STATUS' => 99,
            'PROSES_USULAN' => $tahapan,
            'USER_INPUT' => $userId,
            'TGL_INPUT' => date('Y-m-d h:i:s')
        ];

        $post = $this->input->post();



        if ($this->db->insert('msusulan', $data)) {
            $dataId = $this->db->insert_id();

            $data = ['ID_USULAN' => $dataId];
            $this->db->insert('d_perbaikan', $data);

            $post = $this->input->post();



            // insert data konseptor utama
            $data_kons_utama = [
                'ID_USULAN' => $dataId,
                'NAMA' => htmlspecialchars($this->input->post('nama_konseptor', true)),
                'ALAMAT' => htmlspecialchars($this->input->post('alamat_konseptor', true)),
                'EMAIL' => htmlspecialchars($this->input->post('email_konseptor', true)),
                'TELEPON' => htmlspecialchars($this->input->post('telepon_konseptor', true))
            ];
            $this->db->insert('d_konseptor_utama', $data_kons_utama);

            $kon = array();
            foreach ($post['konseptor'] as $ks) {
                $kon['ID_USULAN'] = $dataId;
                $kon['NAMA'] = $ks['nama'];
                $kon['INSTANSI'] = $ks['instansi'];
                $this->db->insert('d_konseptor', $kon);
            }

            $phb = array();
            foreach ($post['pihak'] as $pb) {
                $phb['ID_USULAN'] = $dataId;
                $phb['NAMA'] = $pb['nama'];
                $this->db->insert('d_pihak_berkepentingan', $phb);
            }

            $mnf = array();
            foreach ($post['manfaat'] as $mf) {
                $mnf['ID_USULAN'] = $dataId;
                $mnf['ISI'] = $mf['isi'];
                $this->db->insert('d_manfaat', $mnf);
            }

            $reg = array();
            foreach ($post['regulasi'] as $rg) {
                $reg['ID_USULAN'] = $dataId;
                $reg['NAMA'] = $rg['nama'];
                $this->db->insert('d_regulasi', $reg);
            }

            $sni = array();
            if ($post['acuansni']) {
                foreach ($post['acuansni'] as $pb) {
                    $sni['ID_USULAN'] = $dataId;
                    $sni['NAMA'] = $pb['nama'];
                    var_dump($sni);
                    $this->db->insert('d_acuan_sni', $sni);
                }
            }


            $nsni = array();
            if ($post['acuannonsni']) {
                foreach ($post['acuannonsni'] as $ann) {
                    $nsni['ID_USULAN'] = $dataId;
                    $nsni['NAMA'] = $ann['nama'];
                    var_dump($nsni);
                    $this->db->insert('d_acuan_nonsni', $nsni);
                }
            }

            $bib = array();
            if ($post['bibliografi']) {
                foreach ($post['bibliografi'] as $bb) {
                    $bib['ID_USULAN'] = $dataId;
                    $bib['NAMA'] = $bb['nama'];
                    var_dump($bib);
                    $this->db->insert('d_bibliografi', $bib);
                }
            }

            $lpk = array();
            if ($post['lpk']) {
                foreach ($post['lpk'] as $lp) {
                    $lpk['ID_USULAN'] = $dataId;
                    $lpk['NAMA'] = $lp['nama'];
                    var_dump($lpk);
                    $this->db->insert('d_lpk', $lpk);
                }
            }



            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Usulan telah ditambahkan!</div>');
            redirect('pengajuan/usulan_baru');
        }
    }

    public function update()
    {
        $user = $this->db->get_where('msuserstandar', ['EMAIL' =>
        $this->session->userdata('email')])->row_array();

        $time = time();

        //Upload dokumen detail penelitian
        $configddp['file_name']          = 'detail_penelitian_' . $time;
        $configddp['upload_path']          = './assets/dokumen/detail_penelitian/';
        $configddp['allowed_types']        = 'pdf';
        $configddp['overwrite']        = TRUE;

        $this->upload->initialize($configddp);

        if ($this->upload->do_upload('dok_detail_penelitian')) {
            $dokdp = $this->upload->data('file_name');
        } else {
            $dokdp = $this->input->post('dok_det_lama');
        }

        //Upload dokumen bukti pendukung
        $configlop['file_name']          = 'lampiran_organisasi_pendukung_' . $time;
        $configlop['upload_path']          = './assets/dokumen/lampiran_organisasi/';
        $configlop['allowed_types']        = 'pdf';
        $configlop['overwrite']        = TRUE;

        $this->upload->initialize($configlop);

        if ($this->upload->do_upload('dok_org_pendukung')) {
            $doklop = $this->upload->data('file_name');
        } else {
            $doklop = $this->input->post('dok_org_lama');
        }

        //Upload Surat Pengajuan 
        $configsrp['file_name']          = 'surat_pengajuan_' . $time;
        $configsrp['upload_path']          = './assets/dokumen/surat_pengajuan/';
        $configsrp['allowed_types']        = 'pdf';
        $configsrp['overwrite']        = TRUE;

        $this->upload->initialize($configsrp);

        if ($this->upload->do_upload('surat_pengajuan')) {
            $doksrp = $this->upload->data('file_name');
        } else {
            $doksrp = $this->input->post('dok_srp_lama');
        }

        //Upload Outline
        $configsrp['file_name']          = 'outline_' . $time;
        $configsrp['upload_path']          = './assets/dokumen/outline/';
        $configsrp['allowed_types']        = 'pdf';
        $configsrp['overwrite']        = TRUE;

        $this->upload->initialize($configsrp);

        if ($this->upload->do_upload('outline')) {
            $dokout = $this->upload->data('file_name');
        } else {
            $dokout = $this->input->post('dok_out_lama');
        }

        //tahapan standar
        $jenisstandar = $this->input->post('jenis_standar');
        if ($jenisstandar == 48) {
            $tahapan = 103;
        } else {
            $tahapan = 110;
        }

        $data = [
            'JENIS_STANDAR' => $this->input->post('jenis_standar'),
            'KOMITE_TEKNIS' => $this->input->post('komite_teknis'),
            'JUDUL' => htmlspecialchars($this->input->post('judul', true)),
            'RUANG_LINGKUP' => htmlspecialchars($this->input->post('ruang_lingkup', true)),
            'DETAIL_PENELITIAN' => htmlspecialchars($this->input->post('detail_penelitian', true)),
            'DOK_DETAIL_PENELITIAN' => $dokdp,
            'TUJUAN_PERUMUSAN' => htmlspecialchars($this->input->post('tujuan_perumusan', true)),
            'ORG_PENDUKUNG' => $this->input->post('org_pendukung'),
            'DOK_ORG_PENDUKUNG' => $doklop,
            'SURAT_PENGAJUAN' => $doksrp,
            'OUTLINE' => $dokout,
            'STATUS' => 99,
            'TAHAPAN' => $tahapan
        ];

        $post = $this->input->post();
        $id = $post['id'];

        $this->db->where('ID', $id);
        if ($this->db->update('msusulan', $data)) {
            $this->db->delete('d_konseptor', array('ID_USULAN' => $post['id']));
            $this->db->delete('d_manfaat', array('ID_USULAN' => $post['id']));
            $this->db->delete('d_pihak_berkepentingan', array('ID_USULAN' => $post['id']));
            $this->db->delete('d_regulasi', array('ID_USULAN' => $post['id']));
            $this->db->delete('d_acuan_sni', array('ID_USULAN' => $post['id']));
            $this->db->delete('d_acuan_nonsni', array('ID_USULAN' => $post['id']));
            $this->db->delete('d_bibliografi', array('ID_USULAN' => $post['id']));
            $this->db->delete('d_lpk', array('ID_USULAN' => $post['id']));

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

            $phb = array();
            foreach ($post['pihak'] as $pb) {
                $phb['ID_USULAN'] = $post['id'];
                $phb['NAMA'] = $pb['nama'];
                $this->db->insert('d_pihak_berkepentingan', $phb);
            }

            // $kon = array();
            // foreach ($post['konseptor'] as $ks) {
            //     $kon['ID_USULAN'] = $post['id'];
            //     $kon['NIK'] = $ks['nik'];
            //     $kon['INSTANSI'] = $ks['instansi'];
            //     $this->db->insert('d_konseptor', $kon);
            // }

            $mnf = array();
            foreach ($post['manfaat'] as $mf) {
                $mnf['ID_USULAN'] = $post['id'];
                $mnf['ISI'] = $mf['isi'];
                $this->db->insert('d_manfaat', $mnf);
            }

            $reg = array();
            foreach ($post['regulasi'] as $rg) {
                $reg['ID_USULAN'] = $post['id'];
                $reg['NAMA'] = $rg['nama'];
                $this->db->insert('d_regulasi', $reg);
            }

            $sni = array();
            if ($post['acuansni']) {
                foreach ($post['acuansni'] as $pb) {
                    $sni['ID_USULAN'] = $post['id'];
                    $sni['NAMA'] = $pb['nama'];
                    var_dump($sni);
                    $this->db->insert('d_acuan_sni', $sni);
                }
            }


            $nsni = array();
            if ($post['acuannonsni']) {
                foreach ($post['acuannonsni'] as $ann) {
                    $nsni['ID_USULAN'] = $post['id'];
                    $nsni['NAMA'] = $ann['nama'];
                    var_dump($nsni);
                    $this->db->insert('d_acuan_nonsni', $nsni);
                }
            }

            $bib = array();
            if ($post['bibliografi']) {
                foreach ($post['bibliografi'] as $bb) {
                    $bib['ID_USULAN'] = $post['id'];
                    $bib['NAMA'] = $bb['nama'];
                    var_dump($bib);
                    $this->db->insert('d_bibliografi', $bib);
                }
            }

            $lpk = array();
            if ($post['lpk']) {
                foreach ($post['lpk'] as $lp) {
                    $lpk['ID_USULAN'] = $post['id'];
                    $lpk['NAMA'] = $lp['nama'];
                    var_dump($lpk);
                    $this->db->insert('d_lpk', $lpk);
                }
            }



            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Usulan telah diubah!</div>');
            redirect('pengajuan/usulan_baru');
        }
    }


    public function usulan_baru()
    {
        $detailuser = $this->lapan_api_library->call('usulan/getdetailuser', ['token' => $this->session->userdata('token'), 'id' => $this->session->userdata('id')]);
        $data['detailuser'] = $detailuser;
        if ($this->session->userdata('role_id') == 96) {
            $getusulandraft = $this->lapan_api_library->call('usulan/getusulandraft', ['token' => $this->session->userdata('token')]);
            $data['draft'] = $getusulandraft;
            $getusulandiajukan = $this->lapan_api_library->call('usulan/getusulandiajukan', ['token' => $this->session->userdata('token')]);
            $data['diajukan'] = $getusulandiajukan;
            $getusulandiatolak = $this->lapan_api_library->call('usulan/getusulanditolak', ['token' => $this->session->userdata('token')]);
            $data['ditolak'] = $getusulandiatolak;
            $getusulanditerima = $this->lapan_api_library->call('usulan/getusulanditolak', ['token' => $this->session->userdata('token')]);
            $data['diterima'] = $getusulanditerima;
        } else {
            $getusulandraft = $this->lapan_api_library->call('usulan/getusulandraftbyuser', ['token' => $this->session->userdata('token'), 'id' => $this->session->userdata('id')]);
            $data['draft'] = $getusulandraft;
            $getusulandiajukan = $this->lapan_api_library->call('usulan/getusulandiajukanbyuser', ['token' => $this->session->userdata('token'), 'id' => $this->session->userdata('id')]);
            $data['diajukan'] = $getusulandiajukan;
            $getusulanditolak = $this->lapan_api_library->call('usulan/getusulanditolakbyuser', ['token' => $this->session->userdata('token'), 'id' => $this->session->userdata('id')]);
            $data['ditolak'] = $getusulanditolak;
            $getusulanditerima = $this->lapan_api_library->call('usulan/getusulanditerimabyuser', ['token' => $this->session->userdata('token'), 'id' => $this->session->userdata('id')]);
            $data['diterima'] = $getusulanditerima;
        }
        $this->load->view('templates/header');
        $this->load->view('templates/side_menu');
        $this->load->view('pengajuan/usulan', $data);
        $this->load->view('templates/footer');
    }

    public function ajukan($id)
    {
        $this->db->set('STATUS', 100);
        $this->db->where('ID', $id);
        $this->db->update('msusulan');
        redirect('pengajuan/usulan_baru');
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
        $roleId = $this->session->userdata('role_id');

        $data['diajukan'] = $this->mPengajuan->getUsulanDiajukan();
        $data['ditolak'] = $this->mPengajuan->getUsulanDitolak();
        $data['diterima'] = $this->mPengajuan->getUsulanDiterima();

        if ($roleId == 96 or $roleId == 98) {
            $this->load->view('templates/header', $data);
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
        $data['user'] = $this->db->get_where('msuserstandar', ['EMAIL' =>
        $this->session->userdata('email')])->row_array();

        $roleId = $data['user']['ROLE_ID'];
        $data['role'] = $this->db->get_where('msrev', array('ID' => $roleId))->row_array();

        $data['usulan'] = $this->mPengajuan->getUsulanById($id);
        $data['jnstandar'] = $this->mPengajuan->getJenisStandar();
        $data['kmteknik'] = $this->mPengajuan->getKomiteTeknis();
        $data['jnperumusan'] = $this->mPengajuan->getJenisPerumusan();
        $data['jlperumusan'] = $this->mPengajuan->getJalurPerumusan();
        $data['jnadopsi'] = $this->mPengajuan->getJenisAdopsi();
        $data['mtadopsi'] = $this->mPengajuan->getMetodeAdopsi();
        $data['prusulansni'] = $this->mPengajuan->getProsesUsulanSNI();
        $data['prusulansl'] = $this->mPengajuan->getProsesUsulanSL();
        $data['psni'] = $this->mPengajuan->getPerumusanSNI();
        $data['psl'] = $this->mPengajuan->getPerumusanSL();
        $data['status'] = $this->mPengajuan->getStatus();

        $data['email'] = $this->mPengajuan->getEmailByUsulan($id);
        $data['perbaikan'] = $this->mPengajuan->getPerbaikanById($id);

        if ($roleId == 96 or $roleId == 98) {
            $this->load->view('templates/header', $data);
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

    public function save_proses()
    {
        $id = $this->input->post('id');

        //Upload dokumen kebutuhan mendesak
        $configskm['file_name']          = 'surat_kebutuhan_mendesak_' . $id;
        $configskm['upload_path']          = './assets/dokumen/kebutuhan_mendesak/';
        $configskm['allowed_types']        = 'pdf';
        $configskm['overwrite']        = TRUE;

        $this->upload->initialize($configskm);

        if ($this->upload->do_upload('dok_keb_mendesak')) {
            $dokkm = $this->upload->data('file_name');
        } else {
            $dokkm = $this->input->post('dok_skm_lama');
        }

        //Upload dokumen kesediaan pencantuman paten
        $configkpp['file_name']          = 'surat_kesediaan_pencantuman_paten_' . $id;
        $configkpp['upload_path']          = './assets/dokumen/kesediaan_paten/';
        $configkpp['allowed_types']        = 'doc|docx';
        $configkpp['overwrite']        = TRUE;

        $this->upload->initialize($configkpp);

        if ($this->upload->do_upload('dok_kesediaan_paten')) {
            $dokkpp = $this->upload->data('file_name');
        } else {
            $dokkpp = $this->input->post('dok_ksp_lama');
        }


        $data = [
            'JENIS_PERUMUSAN' => $this->input->post('jenis_perumusan'),
            'JALUR_PERUMUSAN' => $this->input->post('jalur_perumusan'),
            'KODE' => $this->input->post('kode'),
            'NO_SNI_RALAT' => htmlspecialchars($this->input->post('no_sni_ralat', true)),
            'P_SNI_RALAT' => htmlspecialchars($this->input->post('p_sni_ralat', true)),
            'NO_SNI_AMANDEMEN' => htmlspecialchars($this->input->post('no_sni_amandemen', true)),
            'P_SNI_AMANDEMEN' => htmlspecialchars($this->input->post('p_sni_amandemen', true)),
            'NO_SNI_TERJEMAH' => htmlspecialchars($this->input->post('no_sni_terjemah', true)),
            'JENIS_ADOPSI' => $this->input->post('jenis_adopsi'),
            'METODE_ADOPSI' => $this->input->post('metode_adopsi'),
            'KEB_MENDESAK' => $this->input->post('keb_mendesak'),
            'DOK_KEB_MENDESAK' => $dokkm,
            'TERKAIT_PATEN' => $this->input->post('terkait_paten'),
            'DOK_KESEDIAAN_PATEN' => $dokkpp,
            'INFORMASI_PATEN' => $this->input->post('informasi_paten'),
            'KESESUAIAN' => htmlspecialchars($this->input->post('kesesuaian', true)),
            'ULASAN' => htmlspecialchars($this->input->post('ulasan', true)),
            'STATUS' => $this->input->post('status'),
            'ALASAN_PENOLAKAN' => htmlspecialchars($this->input->post('alasan_penolakan', true)),
            'PROSES_USULAN' => $this->input->post('proses_usulan'),
            'PROSES_PERUMUSAN' => $this->input->post('proses_perumusan')
        ];


        $post = $this->input->post();

        $this->db->where('ID', $id);
        if ($this->db->update('msusulan', $data)) {

            for ($i = 1; $i <= 4; $i++) {
                //Upload dokumen SURAT PENGANTAR
                $configsp['file_name']          = 'surat_pengantar_' . $i . '_' . $id;
                $configsp['upload_path']          = './assets/dokumen/perbaikan_usulan/';
                $configsp['allowed_types']        = 'pdf';
                $configsp['overwrite']        = TRUE;

                $this->upload->initialize($configsp);
                if ($this->upload->do_upload('surat_pengantar_' . $i)) {
                    $sp[$i] = $this->upload->data('file_name');
                } else {
                    $sp[$i] = $this->input->post('sp_' . $i . '_lama');
                }

                //upload dokumen RSNI
                $configrsni['file_name']          = 'rsni_' . $i . '_' . $id;
                $configrsni['upload_path']          = './assets/dokumen/perbaikan_usulan/';
                $configrsni['allowed_types']        = 'pdf';
                $configrsni['overwrite']        = TRUE;

                $this->upload->initialize($configrsni);
                if (!empty($_FILES['rsni_' . $i]['name'])) {
                    $this->upload->do_upload('rsni_' . $i);
                    $rsni[$i] = $this->upload->data('file_name');
                } else {
                    $rsni[$i] = $this->input->post('rsni_' . $i . '_lama');
                }

                //Upload Dokumen Notulensi
                $confignotulensi['file_name']          = 'notulensi_' . $i . '_' . $id;
                $confignotulensi['upload_path']          = './assets/dokumen/perbaikan_usulan/';
                $confignotulensi['allowed_types']        = 'pdf';
                $confignotulensi['overwrite']        = TRUE;

                $this->upload->initialize($confignotulensi);
                if (!empty($_FILES['notulensi_' . $i]['name'])) {
                    $this->upload->do_upload('notulensi_' . $i);
                    $notulensi[$i] = $this->upload->data('file_name');
                } else {
                    $notulensi[$i] = $this->input->post('notulensi_' . $i . '_lama');
                }
            }

            $dataper = [
                'SURAT_PENGANTAR_1' => $sp[1],
                'SURAT_PENGANTAR_2' => $sp[2],
                'SURAT_PENGANTAR_3' => $sp[3],
                'SURAT_PENGANTAR_4' => $sp[4],
                'RSNI_1' => $rsni[1],
                'RSNI_2' => $rsni[2],
                'RSNI_3' => $rsni[3],
                'RSNI_4' => $rsni[4],
                'NOTULENSI_1' => $notulensi[1],
                'NOTULENSI_2' => $notulensi[2],
                'NOTULENSI_3' => $notulensi[3],
                'NOTULENSI_4' => $notulensi[4]
            ];
            $this->db->where('ID_USULAN', $id);
            $this->db->update('d_perbaikan', $dataper);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Usulan telah diproses!</div>');
            redirect('pengajuan/monitoring_usulan');
            die;

            $this->db->where('ID_USULAN', $id);
            $this->db->update('d_perbaikan', $dataper);


            $tables = array('d_acuan_sni', 'd_acuan_nonsni', 'd_bibliografi', 'd_lpk');
            $this->db->where('ID_USULAN', $id);
            $this->db->delete($tables);




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
        $data['user'] = $this->db->get_where('msuserstandar', ['EMAIL' =>
        $this->session->userdata('email')])->row_array();

        $roleId = $data['user']['ROLE_ID'];
        $data['role'] = $this->db->get_where('msrev', array('ID' => $roleId))->row_array();

        $data['usulan'] = $this->mPengajuan->getUsulanById($id);
        $data['perbaikan'] = $this->mPengajuan->getPerbaikanById($id);
        $data['psni'] = $this->mPengajuan->getPerumusanSNI();
        $data['psl'] = $this->mPengajuan->getPerumusanSL();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/side_menu');
        $this->load->view('pengajuan/perbaikan_usulan_rsni', $data);
        $this->load->view('templates/footer');
    }

    public function perbaikan_usulan_rsl($id)
    {
        $data['user'] = $this->db->get_where('msuserstandar', ['EMAIL' =>
        $this->session->userdata('email')])->row_array();

        $roleId = $data['user']['ROLE_ID'];
        $data['role'] = $this->db->get_where('msrev', array('ID' => $roleId))->row_array();

        $data['usulan'] = $this->mPengajuan->getUsulanById($id);
        $data['perbaikan'] = $this->mPengajuan->getPerbaikanById($id);
        $data['psni'] = $this->mPengajuan->getPerumusanSNI();
        $data['psl'] = $this->mPengajuan->getPerumusanSL();

        $this->load->view('templates/header', $data);
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

        $this->upload->initialize($config1);

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

    public function pembatalan_usulan()
    {
        $data['user'] = $this->db->get_where('msuserstandar', ['EMAIL' =>
        $this->session->userdata('email')])->row_array();

        $roleId = $data['user']['ROLE_ID'];
        $data['role'] = $this->db->get_where('msrev', array('ID' => $roleId))->row_array();

        $data['usulan'] = $this->mPengajuan->getUsulanDiajukan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/side_menu');
        $this->load->view('pengajuan/pembatalan_usulan', $data);
        $this->load->view('templates/footer');
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
                $mail->Subject = 'RSNI 1-Menunggu rapat teknis';
                $mail->isHTML(true);
                $mailContent = 'Pengajuan PNPS "' . $judul . '" telah masuk tahapan RSNI 1 dan menunggu rapat teknis.';
                $mail->Body = $mailContent;
                break;
            case "sn2mperbaikan":
                $mail->Subject = 'RSNI 2-Menunggu perbaikan';
                $mail->isHTML(true);
                $mailContent = 'Pengajuan PNPS "' . $judul . '" telah masuk tahapan RSNI 1 dan menunggu perbaikan RSNI.';
                $mail->Body = $mailContent;
                break;
            case "sn2mraptek":
                $mail->Subject = 'RSNI 2-Menunggu rapat teknis';
                $mail->isHTML(true);
                $mailContent = 'Pengajuan PNPS "' . $judul . '" telah masuk tahapan RSNI 2 dan menunggu rapat teknis.';
                $mail->Body = $mailContent;
                break;
            case "sn3mpengesahan":
                $mail->Subject = 'RSNI 3-Menunggu pengesahan';
                $mail->isHTML(true);
                $mailContent = 'Pengajuan PNPS "' . $judul . '" telah masuk tahapan RSNI 3 dan menunggu pengesahan.';
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
                $mail->Subject = 'RSNI 4-Menunggu Perbaikan';
                $mail->isHTML(true);
                $mailContent = 'Pengajuan PNPS "' . $judul . '" telah masuk tahapan RSNI 4 dan menunggu perbaikan RSNI.';
                $mail->Body = $mailContent;
                break;
            case "sn4raptek":
                $mail->Subject = 'RSNI 4-Rapat Teknis';
                $mail->isHTML(true);
                $mailContent = 'Pengajuan PNPS "' . $judul . '" telah masuk tahapan RSNI 4 dan menunggu rapat teknis.';
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
