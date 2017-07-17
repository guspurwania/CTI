<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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

        $this->load->library(array('form_validation'));
        $this->load->helper(array('url','language', 'form'));

        $this->load->model(['Students', 'Programs', 'Users', 'Parents', 'ParentCategories']);
    }

	public function index()
	{
		if (empty($this->session->userdata('user_id'))) {
            redirect(base_url('auth/login'));
        }

		$data['session'] = $this->session->all_userdata();
		$data['url'] = $this->uri->segment(1);
		$data['masterlink'] = 0;
		$data['partnerlink'] = 0;
		$data['students'] = 0;

		if($data['session']['group_id'] == 1)
		{
			$data['user'] = Users::find($data['session']['user_id']);
			$data['masterlink'] = Users::where('group_id', 2)->count();
			$data['partnerlink'] = Users::where('group_id', 3)->count();
			$data['students'] = Students::count();
		}
		elseif($data['session']['group_id'] == 2)
		{
			$data['user'] = Users::find($data['session']['user_id']);
			$data['partnerlink'] = Users::where('group_id', 3)->where('user_id', $data['session']['user_id'])->get();
			foreach ($data['partnerlink'] as $value) {
				$data['students'] += Students::where('user_id', $value->id)->count();
			}
			$data['students'] += Students::where('user_id', $data['session']['user_id'])->count();
		}
		elseif($data['session']['group_id'] == 3)
		{
			$data['user'] = Users::find($data['session']['user_id']);
			$data['students'] = Students::where('user_id', $data['session']['user_id'])->count();
		}

		$this->twig->display('dashboard', $data);
	}
}
