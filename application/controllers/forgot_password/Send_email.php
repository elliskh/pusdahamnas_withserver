<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Send_email extends MY_Controller {

    /**
     * Kirim email dengan SMTP Gmail.
     *
     */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_model', 'auth'); 
	}
     
    public function index()
    {
        method('post');
        $email    = $this->security->xss_clean(post('email'));
        $check_email    = $this->auth->checkEmail($email);
      // Konfigurasi email
        $configx = [
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1',//'utf-8',
            'protocol'  => 'sendmail',//'smtp',
            'smtp_host' => 'smtp.gmail.com',//'ssl://smtp.gmail.com',
            'smtp_user' => 'noreplay.pusdahamnas@gmail.com',  // Email gmail
            'smtp_pass'   => 'f0rgotm4ilku',  // Password gmail
            //'smtp_crypto' => 'ssl',
            'smtp_port'   => 25,//587,//465,
            //'crlf'    => "\r\n",
            'newline' => "\r\n",
            'validate' => FALSE, 
            'wordwrap' => TRUE      
        ];   
    $this->load->library('email');  
        $confing =array(
            'protocol'=>'smtp',
            'smtp_host'=>"smtp.gmail.com",
            'smtp_port'=>465,
            'smtp_user'=>"noreplay.pusdahamnas@gmail.com",
            'smtp_pass'=>"f0rgotm4ilku",
            'smtp_crypto'=>'ssl',              
            'mailtype'=>'html'  
        );
        /*$config['protocol']    = 'smtp';
        $config['smtp_host']    = '';//'ssl://smtp.gmail.com';
        $config['smtp_port']    = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = 'noreplay.pusdahamnas@gmail.com';
        $config['smtp_pass']    = 'f0rgotm4ilku';
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'text'; // or html
        $config['validation'] = TRUE; // bool whether to validate email or not 
         */
        // Load library email dan konfigurasinya
        //$this->load->library('email', $config);
    $this->email->initialize($confing);
    $this->email->set_newline("\r\n");

        // Email dan nama pengirim
        $this->email->from('noreplay.pusdahamnas@gmail.com', 'pusdahamnas.komnasham.go.id');
        $this->email->to($email);
        // Lampiran email, isi dengan url/path file
        //$this->email->attach('');//https://images.pexels.com/photos/169573/pexels-photo-169573.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940');
        $this->email->subject('Lupa kata sandi | pusdahamnas.komnasham.go.id');
        $this->email->message("Ini adalah kata sandi anda : 234561");

        // Tampilkan pesan sukses atau error
        if ($this->email->send()) {
           // echo 'Sukses! email berhasil dikirim.';
           echo "<script>alert('Silahkan cek email, Password terbaru sudah kami kirim')</script>";
		   //$this->session->set_flashdata('success_messages', 'Silahkan cek email, Password terbaru sudah kami kirim');
           redirect(base_url('home/login'));
        }elseif ($check_email == 0) {  
		   $this->session->set_flashdata('error_messages', 'Email tidak terdaftar!');
           redirect(base_url('home/forgot'));
		} else {
           // echo 'Error! email tidak dapat dikirim.';
		   $this->session->set_flashdata('error_messages', 'Email tidak terkirim!');
           redirect(base_url('home/forgot'));
        }
    }
    
 
   function reset_password3()
    {     
        
        $servers = array(
            array("smtp.gmail.com", 465),
            array("smtp.gmail.com", 587),
        );

        foreach ($servers as $server) {// cek port
            list($server, $port) = $server;
            ///echo "<h1>Attempting connect to <tt>$server:$port</tt></h1>\n";
            flush();
            $socket = fsockopen($server, $port, $errno, $errstr, 10);
            if(!$socket) {
              echo "<p>ERROR: $server:$portsmtp - $errstr ($errno)</p>\n";
            } else {
            //  echo "<p>SUCCESS: $server:$port - ok</p>\n";
            }
            flush();
        }
        include "classes/class.phpmailer.php";
       // include "classes/class.smtp.php";
        /*$mail = new PHPMailer(); 
        $mail->IsSMTP();
        $mail->SMTPSecure = 'ssl'; 
        $mail->Host = "smtp.gmail.com"; //host masing2 provider email
        $mail->SMTPDebug = 2;
        $mail->Port = 587;//465;
        $mail->SMTPAuth = true;
        $mail->Username = "noreplay.pusdahamnas@gmail.com"; //user email
        $mail->Password = "f0rgotm4ilku"; //password email 
        $mail->SetFrom("noreplay@komnasham.go.id","Nama pengirim"); //set email pengirim
        $mail->Subject = "Testing"; //subyek email        
        $mail->AddAddress("andiek.mail@gmail.com","nama email tujuan");  //tujuan email
        $mail->MsgHTML("Testing...");*/
        
        /*$mail = new PHPMailer(); // create a new object
        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
        //$mail->SMTPAuth = true; // authentication enabled        
$mail->SMTPAuth = false;
$mail->SMTPAutoTLS = false; 
        $mail->SMTPSecure = 'HPMailer::ENCRYPTION_STARTTLS'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587; // or 587
        $mail->IsHTML(true);
        $mail->Username = "noreplay.pusdahamnas@gmail.com";
        $mail->Password = "f0rgotm4ilku";
        $mail->SetFrom("noreplay.pusdahamnas@gmail.com");
        $mail->Subject = "Test";
        $mail->Body = "hello";
        $mail->AddAddress("andiek.mail@gmail.com");*/
$mail = new PHPMailer();

    $mail->isSMTP();// Set mailer to use SMTP
    $mail->CharSet = "utf-8";// set charset to utf8
    $mail->SMTPAuth = true;// Enable SMTP authentication
    $mail->SMTPSecure = 'ssl';// Enable TLS encryption, `ssl` also accepted
  
    $mail->Host = "smtp.gmail.com:$port";// Specify main and backup SMTP servers
    $mail->Port = $port;// TCP port to connect to
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail->isHTML(true);// Set email format to HTML

    $mail->Username = 'noreplay.pusdahamnas@gmail.com';// SMTP username
    $mail->Password = 'f0rgotm4ilku';// SMTP password

    $mail->setFrom('pusdahamnas@gmail.com', 'Test');//Your application NAME and EMAIL
    $mail->Subject = 'Test';//Message subject
    $mail->MsgHTML('HTML code');// Message body
    $mail->addAddress('andiek.mail@gmail.com', 'User Name');// Target email
$mail->WordWrap = 50;                                 // set word wrap to 50 characters

$mail->Body    = "This is the HTML message body <b>in bold!</b>";
$mail->AltBody = "This is the body in plain text for non-HTML mail clients";


   /// $mail->send(); 
        
         if(!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
         } else {
            echo "Message has been sent";
         }

} 
    
   function reset_password2()
    { 
        method('post');
        $email    = $this->security->xss_clean(post('email'));
        $check_email    = $this->auth->checkEmail($email);
      // Konfigurasi email
        $configx = [
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1',//'utf-8',
            'protocol'  => 'sendmail',//'smtp',
            'smtp_host' => 'smtp.gmail.com',//'ssl://smtp.gmail.com',
            'smtp_user' => 'noreplay.pusdahamnas@gmail.com',  // Email gmail
            'smtp_pass'   => 'f0rgotm4ilku',  // Password gmail
            //'smtp_crypto' => 'ssl',
            'smtp_port'   => 25,//587,//465,
            //'crlf'    => "\r\n",
            'newline' => "\r\n",
            'validate' => FALSE, 
            'wordwrap' => TRUE      
        ];   
    $this->load->library('email');  
        $confing =array(
            'protocol'   => 'sendmail',//'smtp',
            'charset'    => 'utf-8',
            'smtp_host'  =>"smtp.gmail.com",
            'smtp_port'  =>465,
            'smtp_user'  =>"noreplay.pusdahamnas@gmail.com",
            'smtp_pass'  =>"f0rgotm4ilku",
            'smtp_crypto'=>'ssl',              
            'mailtype'   =>'html'  
        );
        /*$config['protocol']    = 'smtp';
        $config['smtp_host']    = '';//'ssl://smtp.gmail.com';
        $config['smtp_port']    = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = 'noreplay.pusdahamnas@gmail.com';
        $config['smtp_pass']    = 'f0rgotm4ilku';
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'text'; // or html
        $config['validation'] = TRUE; // bool whether to validate email or not 
         */
        // Load library email dan konfigurasinya
        //$this->load->library('email', $config);
    $this->email->initialize($confing);
    $this->email->set_newline("\r\n");

        // Email dan nama pengirim
        $this->email->from('noreplay.pusdahamnas@gmail.com', 'pusdahamnas.komnasham.go.id');
        $this->email->to($email);
        // Lampiran email, isi dengan url/path file
        //$this->email->attach('');//https://images.pexels.com/photos/169573/pexels-photo-169573.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940');
        $this->email->subject('Lupa kata sandi | pusdahamnas.komnasham.go.id');
        $this->email->message("Ini adalah kata sandi anda : 234561");

        // Tampilkan pesan sukses atau error
        if ($this->email->send()) {
           // echo 'Sukses! email berhasil dikirim.';
           echo "<script>alert('Silahkan cek email, Password terbaru sudah kami kirim')</script>";
		   //$this->session->set_flashdata('success_messages', 'Silahkan cek email, Password terbaru sudah kami kirim');
           redirect(base_url('home/login'));
        }elseif ($check_email == 0) {  
		   $this->session->set_flashdata('error_messages', 'Email tidak terdaftar!');
           redirect(base_url('home/forgot'));
		} else {
           // echo 'Error! email tidak dapat dikirim.';
		   $this->session->set_flashdata('error_messages', 'Email tidak terkirim!');
           redirect(base_url('home/forgot'));
        }
        
    }    
    
   function request_password()
    {   
        method('post');
        $email    = $this->security->xss_clean(post('email'));
        $username = $this->security->xss_clean(post('username'));
        $check_email    = $this->auth->checkEmail($email);
        if ($check_email == 0) {  
		   $this->session->set_flashdata('error_messages', 'Email tidak terdaftar!');
           redirect(base_url('home/forgot'));
		}
                $url = base_url().'v1/api/auth/sendemail';
                //$url = base_url().'v1/api/auth/sendemailpassword';

				$postData = array(
					'apikey' => '$2y$12$WI/TFDjRzOd/wzZkRbm8ZOyjNFfjmfzStPBhCGIGxwkqQh.nNW.k6',
					'email' => $email,
					'username' => $username,
				);
		
				$ch = curl_init($url);
		
				// Set konfigurasi cURL untuk POST
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
		
				// Lakukan permintaan POST
				$response = curl_exec($ch);

           $code = '';
		   $data = json_decode($response, true);
			//	var_dump($data['results']);
			//	var_dump($data['results']['verification_code']);
              $code = encrypt($data['results']['verification_code']);

          $update2 = $this->db->where('email', $email)
                       ->update('users', ['code_request_password' => $code]);
 
        redirect(base_url('home/reset_password'));   
   }   
   
   function reset_passwordx()
    {   
        method('post');
 
		$view = [
            'title' => "Form Ganti Password",
            'content' => 'auth/verifikasi_password',
            'js' => 'auth/verifikasi_password_js',
        ];
        //$this->session->set_flashdata('success_messages', '');
        $this->template->display_front($view);      
   }   
    
    function resetpassword()
    {
        method('post');
        $email    = $this->security->xss_clean(post('email'));
        $username = $this->security->xss_clean(post('username'));
        
        $check_email    = $this->auth->checkEmail($email);


        // -------------------------------------------------
        // Check Form Validation
        // -------------------------------------------------
        if( $this->form_validation->run() == FALSE){
            // Set JSON data
            $data = array(
                'message'   => 'error',
                'data'      => '<strong>Error Validation!</strong><br />'.validation_errors().'',
            ); die(json_encode($data));
        }
        
        $checkmember        = $this->model_member->get_member_by('login',$username);
        if( !$checkmember || empty($checkmember) ){
            // Set JSON data
            $data = array(
                'message'   => 'error',
                'data'      => '<strong>Error Validation!</strong><br />Wrong username or not exist',
            ); die(json_encode($data));
        }
        
        if( trim($email) != $checkmember->email ){
            // Set JSON data
            $data = array(
                'message'   => 'error',
                'data'      => '<strong>Error Validation!</strong><br />Email is not match or empty',
            ); die(json_encode($data));
        }
        
        if( $checkmember->status != 1 ){
            // Set JSON data
            $data = array(
                'message'   => 'error',
                'data'      => '<strong>Member Status!</strong><br />Member is not active or freeze status',
            ); die(json_encode($data));
        }
        
        // Begin Reset New Password of Member
        $this->db->trans_begin();
        
        $newpass            = hbp_generate_rand_string(6);
        $datapass           = new stdClass();
        $datapass->newpass  = $newpass;
        $datapass->email    = $checkmember->email;
        $datapass->username = $checkmember->username;
        
        $trans_reset_pass   = FALSE;
        $datapassmember     = array(
            'password'      => md5($newpass),
            'datemodified'  => date('Y-m-d H:i:s')
        );
        $updatepassmember   = $this->model_member->update_data($checkmember->id, $datapassmember);
        if( !$updatepassmember ){
            // Set JSON data
            $data = array(
                'message'   => 'error',
                'data'      => '<strong>Reset Process!</strong><br />Reset password is not success',
            ); die(json_encode($data));
        }
        $trans_reset_pass   = TRUE;

        if( $trans_reset_pass ){
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
            }else{
                $this->db->trans_commit();               
                $this->hbp_email->send_email_reset_password($datapass);
                
                // Set JSON data
                $data = array(
                    'message'   => 'success',
                    'data'      => '<strong>Success!</strong><br />Please check email to get new password',
                ); die(json_encode($data));
            }
        }else{
            $this->db->trans_rollback();
            // Set JSON data
            $data = array(
                'message'   => 'error',
                'data'      => '<strong>Reset Process!</strong><br />Reset password is not success',
            ); die(json_encode($data));
        }
    }
    
}