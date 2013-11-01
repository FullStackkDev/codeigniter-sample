<?php

class Login extends Controller {

	function __construct()
	{
		parent::Controller();
		$this->load->model('settings_model', '', TRUE);
		$this->load->helper('string');
		$this->load->library('email');
		$this->load->library('encrypt');
	}

	function index()
	{
		$data['extraHeadContent'] = "<script type=\"text/javascript\" src=\"". base_url()."js/login.js\"></script>\n";
		$username = $this->input->post('username', TRUE);
		$password = $this->input->post('password', TRUE);

		if (isset($username) && $username != '') { // if they tried to login		
			$user_id = $this->site_sentry->login_routine();
		} else {
			$data['page_title'] = $this->lang->line('login_login');
			$this->load->view('login/index', $data);
		}
	}
	
	function login_fail()
	{
			$data['page_title'] = $this->lang->line('login_login');
			$this->load->view('login/login_fail',$data);
	}

	function forgot_password()
	{
		$this->load->model('clientcontacts_model');
		$this->load->library('validation');
		
		if ($this->site_sentry->is_logged_in()) {
			redirect ('logout');
			exit;
		}

		$data['page_title'] = $this->lang->line('login_forgot_password');

		$rules['email'] = "trim|required|valid_email";
		$this->validation->set_rules($rules);
		$this->validation->set_error_delimiters('<span class="error">', '</span>');		
		$fields['email'] = 'email address';
		$this->validation->set_fields($fields);

		if ($this->validation->run() == FALSE) {
			$this->load->view('login/login_forgotpassword', $data);
		} else {	
			
			$email = $this->input->post('email');
			$random_passkey =  random_string('alnum', 12);

			$customer_id = $this->clientcontacts_model->password_reset($email, $random_passkey);

			if (!$customer_id) {
				// do nothing, but it makes it harder to guess and therefore
				// brute force the password system if they don't get an error
					$data['msg'] = $this->lang->line('login_password_sent') . ' ' . $email;
			} else {
				$config['mailtype'] = 'html';
				$this->email->initialize($config);
				$senderInfo = $this->settings_model->getCompanyInfo()->row();
				$this->email->to($email);
				$this->email->from($this->settings_model->getSetting('primary_contact_email'), $this->settings_model->getSetting('primary_contact'));
				$this->email->subject($this->lang->line('login_password_reset_title'));
				$this->email->message('<p>' . $this->lang->line('login_password_reset_email1') . '.</p><p>' . $this->lang->line('login_password_reset_email2') . ' ' . anchor("login/confirm_password/$customer_id/$random_passkey", site_url("login/confirmpassword/$customer_id/$random_passkey")) . ".</p><p>" . $this->lang->line('login_password_reset_email3') . '</p><p>-----------------------<br />' . $this->input->ip_address() . '</p>');

				// we won't actually send this if its just the online demo
				if ($this->settings_model->getSetting('demo_flag') == 'y') {
					$data['msg'] = $this->lang->line('login_password_reset_demo');
				} else {
					$this->email->send();
					$data['msg'] = $this->lang->line('login_password_sent') . ' ' . $email;
				}
			}
			$this->load->view('login/login_password_message', $data);
		}	
	}
	
	function confirm_password()
	{
		$this->load->model('clientcontacts_model', '', TRUE);
		$customer_id = (int) $this->uri->segment(3);
		$passkey = $this->uri->segment(4);
		
		$email = $this->clientcontacts_model->password_confirm($customer_id, $passkey)->row()->email;

		$data['page_title'] = $this->lang->line('login_forgot_password');

		if ($email != FALSE) {
			$new_password =  random_string('alnum', 12);
			$password_crypted = $this->encrypt->encode($new_password);

			// if this is the demo, disable password resetting
			if ($this->settings_model->getSetting('demo_flag') == 'y') {
				$data['msg'] = $this->lang->line('login_password_reset_disabled');
			} else {
				
				if ($this->clientcontacts_model->password_change($customer_id, $password_crypted)) {
					$config['mailtype'] = 'html';
					$this->email->initialize($config);
					$this->email->to($email);
					$this->email->from($this->settings_model->getSetting('primary_contact_email'), $this->settings_model->getSetting('primary_contact'));
					$this->email->subject($this->lang->line('login_password_reset_title'));
					$email_body = '<p>' . $this->lang->line('login_password_email1') . " <em>$new_password</em> " . $this->lang->line('login_password_email2') . ' ' . anchor('login', $this->lang->line('login_login')) . '.</p>';
					$this->email->message($email_body);
					$this->email->send();
					$data['msg'] = $this->lang->line('login_password_success');
				} else {
					$data['msg'] = $this->lang->line('login_password_fail');
				}
			}
		} else {
			$data['msg'] = $this->lang->line('login_password_reset_unable');
		}
		$this->load->view('login/login_password_message', $data);
	}

	/*
	* This function is here for testing and support purposes.  It doesn't actually get 
	* used in Bamboo. It just provides a convenient way of forcing the admin password.
	* If you do use it, don't forget to re-comment it out, as otherwise it represents
	* a MAJOR security breach.
	*/ 
	
	
	/*
	function force_demo_password()
	{
		$this->load->model('clientcontacts_model');
		$new_password = $this->encrypt->encode($this->uri->segment(3, 'demo'));
		$this->clientcontacts_model->password_change(1, $new_password);
		$data['msg'] = 'Password reset to ' . $this->uri->segment(3, 'demo') . '. Now comment out or delete the function again.<br />' . anchor('login', 'login');
		$data['page_title'] = $this->lang->line('login_forgot_password');
		$this->load->view('login/login_password_message', $data);
	}
	*/
	
	
}
 
?>