<?php 
   class Reset extends CI_Controller { 

      function __construct() { 
         parent::__construct(); 
          //load helper form
         $this->load->helper('form'); 
//   $this->load->library('email');
  $this->load->library('session');         
      } 

      public function index() { 

         $this->load->helper('form'); 
         $this->load->view('reset'); 

      } 

      public function send_mail() { 
       $this->db->select('*');
       $this->db->where('nip', $this->input->post('NIP'));
       $this->db->where('email', $this->input->post('email'));
       $this->db->limit(1);

       $query = $this->db->get('m_dosen');
       if($query->num_rows() == 1)
       {
         $from_email = "admin@yayasanppi.net"; 
         $to_email = $this->input->post('email'); 

         $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://mail.yayasanppi.net',
                'smtp_port' => 465,
                'smtp_user' => $from_email,
                'smtp_pass' => 'pabuaranasd254',
                'mailtype'  => 'html', 
            'charset'=>'utf-8',
            'priority' => '1'
         );

            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");   

         $this->email->from($from_email, 'Yayasanppi.net'); 
         $this->email->to($to_email);
         $this->email->subject('Reset Password'); 
         $message = $this->load->view('template/mail','',TRUE);
         $this->email->message($message); 

         //Send mail 
         if($this->email->send()){
             $this->db->query("UPDATE m_dosen SET password = 'bcd3b68e258723a50ef344817412e1c9' WHERE nip = ".$this->input->post('NIP'));
                $this->session->set_flashdata("notif","Berhasil, Silahkan cek Inbox Email anda"); 
                $this->load->view('reset'); 
                
         }else {
                $this->session->set_flashdata("notif","Gagal Mengirim Email"); 
                $this->load->view('reset'); 
         }
        }else{
            $this->session->set_flashdata("notif","Gagal, Data yang anda masukan mungkin tidak benar"); 
            $this->load->view('reset'); 
        }
      }
} 