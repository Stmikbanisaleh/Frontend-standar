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
    }

    public function index()
    {
        // $data['ditolak'] = $this->mPembatalan->getUsulanDitolak();
        $ditolak = $this->lapan_api_library->call('usulan/getusulanditolak', ['token' => $this->session->userdata('token')]);
        $data['ditolak'] = $ditolak;
        if ($this->session->userdata('role_id') == 96 or $this->session->userdata('role_id') == 98) {
            $this->load->view('templates/header');
            $this->load->view('templates/side_menu');
            $this->load->view('pembatalan/pembatalan_usulan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->load->view('templates/header');
            $this->load->view('templates/side_menu');
            $this->load->view('403.html');
            $this->load->view('templates/footer');
        }
    }

    public function add()
    {
        $usulan = $this->lapan_api_library->call('usulan/getusulandiajukan', ['token' => $this->session->userdata('token')]);
        $data['usulan'] = $usulan;

        $this->load->view('templates/header');
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

        // Upload dokumen surat resmi pembatalan
        $filename = 'surat_pembatalan_' . $idusulan . '_' . $tgl;
        $config1['upload_path']          = './assets/dokumen/surat_pembatalan/';
        $config1['allowed_types']        = 'pdf';
        $config1['overwrite']        = TRUE;

        // $this->upload->initialize($config1);

        // if ($this->upload->do_upload('dok_pembatalan')) {
        //     $dokpembatalan = $this->upload->data('file_name');
        // } else {
        //     $dokpembatalan = '';
        // }
        if(!empty($_FILES['dok_pembatalan']['tmp_name']) && file_exists($_FILES['dok_pembatalan']['tmp_name'])) {
            $dokdp = 'surat_pembatalan_' . $idusulan.'_'.$tgl.'.pdf';
            $file_tmp = $_FILES['dok_pembatalan']['tmp_name'];
			$data = file_get_contents($file_tmp);
			$dokpembatalan64 = base64_encode($data);
        }else {
            $dokdp ='';
        }

        $data = [
            'status' => 101,
            'id' => $idusulan,
            'alasan_penolakan' => $this->input->post('alasan'),
            'dok_pembatalan' => $dokdp,
            'dok_pembatalan64' => $dokpembatalan64,
            'token' => $this->session->userdata('token')
        ];
        $insert = $this->lapan_api_library->call('usulan/savepembatalan',$data);
        if($insert['status'] ==200){
            redirect('pembatalan');
        } else {
            print_r('Gagal Uplaod');
        }
    
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
