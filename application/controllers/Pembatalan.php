<?php
defined('BASEPATH') or exit('No direct scripts access allowed');

class Pembatalan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }
        $this->load->library('upload');
        $this->load->model('Pembatalan_model', 'mPembatalan');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('msuserstandar', ['EMAIL' =>
        $this->session->userdata('email')])->row_array();

        $roleId = $data['user']['ROLE_ID'];
        $data['role'] = $this->db->get_where('msrev', array('ID' => $roleId))->row_array();

        $data['ditolak'] = $this->mPembatalan->getUsulanDitolak();

        if ($roleId == 96 or $roleId == 98) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/side_menu');
            $this->load->view('pembatalan/pembatalan_usulan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/side_menu');
            $this->load->view('403.html');
            $this->load->view('templates/footer');
        }
    }

    public function add()
    {
        $data['user'] = $this->db->get_where('msuserstandar', ['EMAIL' =>
        $this->session->userdata('email')])->row_array();

        $roleId = $data['user']['ROLE_ID'];
        $data['role'] = $this->db->get_where('msrev', array('ID' => $roleId))->row_array();

        $data['usulan'] = $this->mPembatalan->getUsulan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/side_menu');
        $this->load->view('pembatalan/add', $data);
        $this->load->view('templates/footer');
    }

    public function save()
    {
        $idusulan = $this->input->post('id_usulan');

        $d = date('d');
        $m = date('m');
        $Y = date('Y');
        $tgl = $d . '-' . $m . '-' . $Y;

        //Upload dokumen surat resmi pembatalan
        $config1['file_name']          = 'surat_pembatalan_' . $idusulan . '_' . $tgl;
        $config1['upload_path']          = './assets/dokumen/surat_pembatalan/';
        $config1['allowed_types']        = 'pdf';
        $config1['overwrite']        = TRUE;

        $this->upload->initialize($config1);

        if ($this->upload->do_upload('dok_pembatalan')) {
            $dokpembatalan = $this->upload->data('file_name');
        } else {
            $dokpembatalan = '';
        }

        $data = [
            'STATUS' => 101,
            'ALASAN_PENOLAKAN' => $this->input->post('alasan'),
            'DOK_PEMBATALAN' => $dokpembatalan
        ];

        $this->db->where('ID', $idusulan);
        $this->db->update('msusulan', $data);
        redirect('pembatalan');
    }

    private function _send_email($type)
    {
        require 'assets/PHPMailer/PHPMailerAutoload.php';


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
        $mail->addAddress('budidummy3228@gmail.com');
        // Menambahkan beberapa penerima
        //$mail->addAddress('penerima2@contoh.com');
        //$mail->addAddress('penerima3@contoh.com');

        // Menambahkan cc atau bcc 
        //$mail->addCC('cc@contoh.com');
        //$mail->addBCC('bcc@contoh.com');


        if ($type == 'verdok') {
            // Subjek email
            $mail->Subject = 'Verifikasi Dokumen';

            // Mengatur format email ke HTML
            $mail->isHTML(true);

            // Konten/isi email
            $mailContent = 'Pengajuan Standar telah dalam proses verifikasi dokumen';

            $mail->Body = $mailContent;
            // Menambahakn lampiran
            //$mail->addAttachment('berita/'.$file);
            //$mail->addAttachment('lmp/file2.png', 'nama-baru-file2.png'); //atur nama baru

        }

        if ($type == 'versub') {
            // Subjek email
            $mail->Subject = 'Verifikasi Substansi';

            // Mengatur format email ke HTML
            $mail->isHTML(true);

            // Konten/isi email
            $mailContent = 'Pengajuan Standar telah dalam proses verifikasi substansi';

            $mail->Body = $mailContent;
            // Menambahakn lampiran
            //$mail->addAttachment('berita/'.$file);
            //$mail->addAttachment('lmp/file2.png', 'nama-baru-file2.png'); //atur nama baru

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
