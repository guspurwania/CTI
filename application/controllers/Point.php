<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Point extends CI_Controller {

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('user_id'))) {
            redirect(base_url('auth/login'));
        }

        if($this->session->userdata('group_id') == 1)
        {
            show_404();
        }

        $this->load->library(array('form_validation'));
        $this->load->helper(array('url','language', 'form'));

        $this->load->model(['Students', 'Programs', 'Users', 'Parents', 'ParentCategories', 'Transfers']);
    }

	public function index()
	{
		if (empty($this->session->userdata('user_id'))) {
            redirect(base_url('auth/login'));
        }

		$data['session'] = $this->session->all_userdata();
		$data['url'] = $this->uri->segment(1);
		
		$data['user'] = Users::find($data['session']['user_id']);
		$data['transfers'] = Transfers::where('user_id', $data['session']['user_id'])->where('status', 1)->sum('total_transfer');

		$this->twig->display('point', $data);
	}
}
