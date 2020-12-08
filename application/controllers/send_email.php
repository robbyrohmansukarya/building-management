<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Send_email extends CI_Controller {

    /**
     * Kirim email dengan SMTP Gmail.
     *
     */

    public function index(){
      echo "test email";
    }

    public function send()
    {
      // Konfigurasi email
        $config = [
               'mailtype'  => 'html',
               'charset'   => 'utf-8',
               'protocol'  => 'smtp',
               'smtp_host' => 'ssl://smtp.gmail.com',
               'smtp_user' => 'bi.andromeda2019@gmail.com',    // Ganti dengan email gmail kamu
               'smtp_pass' => 'bajurobek123',      // Password gmail kamu
               'smtp_port' => 465,
               'crlf'      => "\r\n",
               'newline'   => "\r\n"
           ];

        // Load library email dan konfigurasinya
        $this->load->library('email', $config);

        // Email dan nama pengirim
        $this->email->from('bi.andromeda2019@gmail.com', 'Andromeda');

        // Email penerima
        $this->email->to('adzi.fauziahmad@gmail.com'); // Ganti dengan email tujuan kamu

        // Lampiran email, isi dengan url/path file
        //$this->email->attach('https://masrud.com/content/images/20181215150137-codeigniter-smtp-gmail.png');

        // Subject email
        $this->email->subject('Test Notif Perbaikan');

        // Isi email
        // $this->email->message("Ini adalah contoh email CodeIgniter yang dikirim menggunakan SMTP email Google (Gmail).<br><br> Klik <strong><a href='https://masrud.com/post/kirim-email-dengan-smtp-gmail' target='_blank' rel='noopener'>disini</a></strong> untuk melihat tutorialnya.");

         $this->email->message("ini isi perbaikan");


         $this->email->send();
         
        // Tampilkan pesan sukses atau error
        // if ($this->email->send()) {
        //     echo 'Sukses! email berhasil dikirim.';
        // } else {
        //     echo 'Error! email tidak dapat dikirim.';
        // }
    }
}