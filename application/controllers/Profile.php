<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('user_id'))) {
            redirect(base_url('auth/login'));
        }

        $this->load->library(array('ion_auth','form_validation'));
        $this->load->helper(array('url','language', 'form'));

        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('ion_auth');
        $this->lang->load('auth');

        $this->load->model(['Users', 'Groups']);
    }

    public function index()
    {
    	$data['session'] = $this->session->all_userdata();
    	$data['user'] = Users::find($data['session']['user_id']);
    	$this->twig->display('profile', $data);
    }

    public function update_account()
    {
        $data['session'] = $this->session->all_userdata();

        $this->form_validation->set_rules('full_name', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('phone', 'Nomor Telepon', 'required');
        $this->form_validation->set_rules('account_number', 'No Rekening', 'required');
        $this->form_validation->set_rules('account_name', 'Pemilik Rekening', 'required');
        $this->form_validation->set_rules('bank_name', 'Nama Bank', 'required');
        $this->form_validation->set_rules('address', 'Alamat', 'required');
        $this->form_validation->set_rules('sub_district', 'Kecamatan', 'required');
        $this->form_validation->set_rules('district', 'Kabupaten', 'required');
        $this->form_validation->set_rules('province', 'Provinsi', 'required');
        $this->form_validation->set_rules('job', 'Pekerjaan', 'required');

        $user = Users::find($data['session']['user_id']);

        if ($this->form_validation->run() == true)
        {
            $user->full_name = $this->input->post('full_name');
            $user->email = $this->input->post('email');
            $user->phone = $this->input->post('phone');
            $user->account_number = $this->input->post('account_number');
            $user->account_name = $this->input->post('account_name');
            $user->bank_name = $this->input->post('bank_name');
            $user->address = $this->input->post('address');
            $user->sub_district = $this->input->post('sub_district');
            $user->district = $this->input->post('district');
            $user->province = $this->input->post('province');
            $user->job = $this->input->post('job');
            $user->save();

            $data['user'] = $user;
            $data['success'] = "Profile anda berhasil di Update";
            $this->session->set_userdata('full_name', $this->input->post('full_name'));
            $data['session']['full_name'] = $this->input->post('full_name');
        }
        else
        {
            $data['user'] = $user;
            $data['message'] = validation_errors();
        }
        $this->twig->display('profile', $data);
    }

    public function update_file()
    {
        error_reporting(0);
        $data['session'] = $this->session->all_userdata();

        $upload_path = './assets/images';
        $config = array(
            'upload_path' => $upload_path,
            'allowed_types' => 'jpg|gif|png|jpeg',
            'max_size' => 2048
        );
        $this->load->library('upload', $config);

        $user = Users::find($data['session']['user_id']);

        if($_FILES['photo']['name'] != '' || $_FILES['ktp']['name'] != '' || $_FILES['kk']['name'] != '')
        {
            $this->upload->initialize($config);
            if ($_FILES['photo']['name'] != ''){
                if ($user->photo != '' || !empty($user->photo))
                {
                    unlink($upload_path.'/'.$user->photo);
                }

                if($this->upload->do_upload('photo')) {

                    $this->upload->data();
                    $user->photo = $this->upload->file_name;
                    $this->session->set_userdata('photo', $this->upload->file_name);
                    $data['session']['photo'] = $this->upload->file_name;
                }
            }

            if ($_FILES['ktp']['name'] != ''){
                if ($user->ktp != '' || !empty($user->ktp))
                {
                    unlink($upload_path.'/'.$user->ktp);
                }

                if($this->upload->do_upload('ktp')) {
                    $this->upload->data();
                    $user->ktp = $this->upload->file_name;
                }
            }

            if ($_FILES['kk']['name'] != ''){
                if ($user->kk != '' || !empty($user->kk))
                {
                    unlink($upload_path.'/'.$user->kk);
                }

                if($this->upload->do_upload('kk')) {
                    $this->upload->data();
                    $user->kk = $this->upload->file_name;
                }
            }
            $user->save();
            $data['success'] = "Profile anda berhasil di Update";
            $data['user'] = $user;
        }
        else
        {
            $data['user'] = $user;
            $data['message'] = 'Belum ada file yang dipilih';
        }
        $this->twig->display('profile', $data);
    }

    public function update_password()
    {
        $data['session'] = $this->session->all_userdata();
        
        $this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
        $this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');
        $this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');

        $user = Users::find($data['session']['user_id']);
        $data['user'] = $user;

        if ($this->form_validation->run() == false)
        {
            $data['status'] = FALSE;
            $data['message'] = validation_errors();
            $this->twig->display('profile', $data);
        }
        else
        {
            $identity = $data['user']['email'];
            $change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

            if ($change)
            {
                $data['status'] = TRUE;
                $data['success'] = $this->ion_auth->messages();
                $this->twig->display('profile', $data);
            }
            else
            {
                $data['status'] = FALSE;
                $data['message'] = "Kata Sandi tidak dapat dirubah";
                $this->twig->display('profile', $data);
            }
        }
    }
}