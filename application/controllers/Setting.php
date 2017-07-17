<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('user_id'))) {
            redirect(base_url('auth/login'));
        }
        if($this->session->userdata('group_id') != 1)
        {
            show_404();
        }

        $this->load->library(array('form_validation'));
        $this->load->helper(array('url','language', 'form'));

        $this->load->model(['Settings']);
    }

    public function index()
    {
    	$data['session'] = $this->session->all_userdata();
    	$data['settings'] = Settings::all();
    	$data['url'] = $this->uri->segment(1);
    	$this->twig->display('settings/index', $data);
    }

    public function edit($id)
    {
    	$data['session'] = $this->session->all_userdata();
    	$data['setting'] = Settings::find($id);
    	$data['url'] = $this->uri->segment(1);
    	$this->twig->display('settings/edit', $data);
    }

    public function update($id)
    {
    	$data['session'] = $this->session->all_userdata();
    	$data['setting'] = Settings::find($id);
    	$data['url'] = $this->uri->segment(1);

        $this->form_validation->set_rules('point', 'Point', 'required');

        if ($this->form_validation->run() == false)
        {
            $data['message'] = validation_errors();
            $this->twig->display('settings/edit', $data);
        }
        else
        {
        	$setting = Settings::find($id);
        	$setting->point = $this->input->post('point');
        	$setting->save();
        	redirect('settings');
        }
    }

}