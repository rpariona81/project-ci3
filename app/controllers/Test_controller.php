<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_Controller extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

    private $data = array();

	public function index()
	{
		$this->load->library('session');
		session_start();
		$_SESSION['usuario'] = 'Ronald';
		$_SESSION['email'] = 'developer@example.com';
		$this->data['session'] = $this->session->userdata();
		print_r(json_encode($this->data));
	}

	public function view_users()
	{
		//$this->load->view('welcome_message');
        //$this->load->model('User_model');
        //$this->data = User_Model::all();

		$this->load->library('UsersLib');
		$this->data = $this->userslib->getUsers();
        print_r(json_encode($this->data));


	}

	public function view_roles()
	{
		//$this->load->view('welcome_message');
        $this->load->model('Role_model');
        $this->data = Role_Model::all();
        print_r(json_encode($this->data));
	}

	public function view_menus()
	{
		//$this->load->view('welcome_message');
        $this->load->model('Menu_model');
        $this->data = Menu_Model::all();
        print_r(json_encode($this->data));
	}


}
