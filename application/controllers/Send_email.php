<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Send_email extends MY_Controller {

    /**
     * Kirim email dengan SMTP Gmail.
     *
     */
    public function index()
    {
      // Konfigurasi email
        $config = [
            'mailtype'  => 'text',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'smtp.googlemail.com',
            'smtp_user' => 'noreplay.pusdahamnas@gmail.com',  // Email gmail
            'smtp_pass'   => 'f0rgotm4ilku',  // Password gmail
            //'smtp_crypto' => 'ssl',
            'smtp_port'   => 465,
            //'crlf'    => "\r\n",
            'newline' => "\r\n"
        ];

        // Load library email dan konfigurasinya
        $this->load->library('email', $config);
        // Email dan nama pengirim
        $this->email->from('noreplay.pusdahamnas@gmail.com', 'pusdahamnas.komnasham.go.id');
        // Email penerima
        //$to_email = $this->input->post('email');
        $this->email->to('andiek.mail@gmail.com'); // Ganti dengan email tujuan
        // Lampiran email, isi dengan url/path file
        //$this->email->attach('');//https://images.pexels.com/photos/169573/pexels-photo-169573.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940');
        // Subject email
        $this->email->subject('Lupa kata sandi | pusdahamnas.komnasham.go.id');

        // Isi email 
        $this->email->message("Ini adalah kata sandi anda : 335324");

        // Tampilkan pesan sukses atau error
        if ($this->email->send()) {
            echo 'Sukses! email berhasil dikirim.';
        } else {
            echo 'Error! email tidak dapat dikirim.';
        }
    }
}