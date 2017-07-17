<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Family extends CI_Controller {

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

    public function store()
    {
        $data['session'] = $this->session->all_userdata();
        $data['url'] = $this->uri->segment(1);
        
        $this->form_validation->set_rules('nik', 'NIK', 'required');
        $this->form_validation->set_rules('name', 'Nama lengkap', 'required');
        $this->form_validation->set_rules('date_of_birth', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('education', 'Pendidikan', 'required');
        $this->form_validation->set_rules('job', 'Pekerjaan', 'required');
        $this->form_validation->set_rules('income', 'Penghasilan', 'required');
        
        if ($this->form_validation->run() == true)
        {
            $parent = new Parents();
            $parent->nik = $this->input->post('nik');
            $parent->name = $this->input->post('name');
            $date_of_birth = date_create($this->input->post('date_of_birth'));
            $parent->date_of_birth = date_format($date_of_birth, "Y-m-d");
            $parent->education = $this->input->post('education');
            $parent->job = $this->input->post('job');
            $parent->income = $this->input->post('income');
            $parent->parent_category_id = $this->input->post('parent_category_id');
            $parent->student_id = $this->input->post('student_id');
            $parent->save();
            redirect("students/show/".$this->input->post('student_id'), 'refresh');
        }
        else
        {
            $data['message'] = validation_errors();
            $this->twig->display('students/show', $data);
        }
    }

    public function update()
    {
        $data['session'] = $this->session->all_userdata();
        $data['url'] = $this->uri->segment(1);
        
        $this->form_validation->set_rules('nik', 'NIK', 'required');
        $this->form_validation->set_rules('name', 'Nama lengkap', 'required');
        $this->form_validation->set_rules('date_of_birth', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('education', 'Pendidikan', 'required');
        $this->form_validation->set_rules('job', 'Pekerjaan', 'required');
        $this->form_validation->set_rules('income', 'Penghasilan', 'required');
        
        if ($this->form_validation->run() == true)
        {
            $parent = Parents::find($this->input->post('id'));
            $parent->nik = $this->input->post('nik');
            $parent->name = $this->input->post('name');
            $date_of_birth = date_create($this->input->post('date_of_birth'));
            $parent->date_of_birth = date_format($date_of_birth, "Y-m-d");
            $parent->education = $this->input->post('education');
            $parent->job = $this->input->post('job');
            $parent->income = $this->input->post('income');
            $parent->save();
            redirect("students/show/".$this->input->post('student_id'), 'refresh');
        }
        else
        {
            $data['message'] = validation_errors();
            $this->twig->display('students/show', $data);
        }
    }

}