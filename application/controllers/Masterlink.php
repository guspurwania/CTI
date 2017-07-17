<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Masterlink extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        error_reporting(0);
        if (empty($this->session->userdata('user_id'))) {
            redirect(base_url('auth/login'));
        }
        if($this->session->userdata('group_id') != 1)
        {
            show_404();
        }

        $this->load->library(array('ion_auth','form_validation','email'));
        $this->load->helper(array('url','language', 'form'));

        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $email_config = array(
            'protocol' => 'SMTP',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_port' => 587,
            'smtp_user' => 'training.ctigroup@gmail.com', // change it to yours
            'smtp_pass' => 'ctigroup', // change it to yours
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->email->initialize($email_config);

        $this->lang->load('ion_auth');
        $this->lang->load('auth');

        $this->load->model(['Users', 'Groups', 'Students', 'Programs']);
    }

    public function index()
    {
    	$data['session'] = $this->session->all_userdata();
    	$data['users'] = Users::where('group_id', 2)->get();
    	$data['url'] = $this->uri->segment(1);
    	$this->twig->display('masterlink/index', $data);
    }

    public function create()
    {
    	$data['session'] = $this->session->all_userdata();
    	$data['url'] = $this->uri->segment(1);
    	$this->twig->display('masterlink/create', $data);
    }

    public function store()
    {
    	$data['session'] = $this->session->all_userdata();
    	$data['url'] = $this->uri->segment(1);

    	$tables = $this->config->item('tables','ion_auth');
        $identity_column = $this->config->item('identity','ion_auth');
        $this->data['identity_column'] = $identity_column;

    	$this->form_validation->set_rules('full_name', $this->lang->line('create_user_validation_fname_label'), 'required');
    	$this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
    	$this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'trim|required');
        $this->form_validation->set_rules('identity',$this->lang->line('create_user_validation_identity_label'),'required|is_unique['.$tables['users'].'.'.$identity_column.']');
        $this->form_validation->set_rules('bank_name', 'Nama Bank', 'trim|required');
        $this->form_validation->set_rules('account_number', 'No Rekening', 'trim|required');
        $this->form_validation->set_rules('account_name', 'No Rekening Atas Nama', 'trim|required');
        $this->form_validation->set_rules('address', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('sub_district', 'Kecamatan', 'trim|required');
        $this->form_validation->set_rules('district', 'Kabupaten', 'trim|required');
        $this->form_validation->set_rules('province', 'Provinsi', 'trim|required');
        $this->form_validation->set_rules('job', 'Pekerjaan', 'trim|required');
        $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

        if ($this->form_validation->run() == true)
        {
            $email    = strtolower($this->input->post('email'));
            $identity = ($identity_column==='email') ? $email : $this->input->post('identity');
            $password = $this->input->post('password');

            $config = array(
	            'upload_path'   => './assets/images',
	            'allowed_types' => 'jpg|gif|png',
	            'max_size' => 2048
	        );

	        $this->load->library('upload', $config);
	        $this->upload->initialize($config);

	        if($this->upload->do_upload('photo')) {
	        	$this->upload->data();
	        	$photo = $this->upload->file_name;
	        }

	        if($this->upload->do_upload('ktp')) {
	        	$this->upload->data();
	        	$ktp = $this->upload->file_name;
	        }

	        if($this->upload->do_upload('kk')) {
	        	$this->upload->data();
	        	$kk = $this->upload->file_name;
	        }

            if($data['session']['group_id'] == 1)
            {
                $active = $this->input->post('active');
            }
            else
            {
                $active = 0;
            }

            $additional_data = array(
                'full_name' => $this->input->post('full_name'),
                'phone'  => $this->input->post('phone'),
                'account_number'    => $this->input->post('account_number'),
                'account_name'      => $this->input->post('account_name'),
                'bank_name' => $this->input->post('bank_name'),
                'address'      => $this->input->post('address'),
                'sub_district'      => $this->input->post('sub_district'),
                'district'      => $this->input->post('district'),
                'province'      => $this->input->post('province'),
                'job'      => $this->input->post('job'),
                'photo'      => $photo,
                'ktp'      => $ktp,
                'kk'      => $kk,
                'group_id' => 2,
                'point' => 0,
                'user_id' => 0,
                'active' => $active,
                'status' => $active
            );
        }

        if ($this->form_validation->run() == true && $this->ion_auth->register($identity, $password, $email, $additional_data))
        {
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("masterlink", 'refresh');
        }
        else
        {
            $data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
            $this->twig->display('masterlink/create', $data);
        }
    }

    public function show($id)
    {
        $data['session'] = $this->session->all_userdata();
        $data['user'] = Users::find($id);
        $data['partnerlink'] = Users::where('group_id', 3)->where('user_id', $id)->get();
        
        $users = array();
        $i = 0;
        foreach ($data['partnerlink'] as $value) {
            $users[$i] = $value->id;
            $i++;
        }
        $users[$i] = $id;
        $data['students'] = Students::with(['program', 'user'])->whereIn('user_id', $users)->get();

        $data['url'] = $this->uri->segment(1);
        $this->twig->display('masterlink/show', $data);
    }

    public function edit($id)
    {
    	$data['session'] = $this->session->all_userdata();
    	$data['user'] = Users::find($id);
    	$data['url'] = $this->uri->segment(1);
    	$this->twig->display('masterlink/edit', $data);
    }

    public function update($id)
    {
        $data['session'] = $this->session->all_userdata();
        $data['user'] = Users::find($id);
        $data['url'] = $this->uri->segment(1);

        $upload_path = './assets/images';
        $config = array(
            'upload_path'   => './assets/images',
            'allowed_types' => 'jpg|gif|png',
            'max_size' => 2048
        );
        $this->load->library('upload', $config);

        $this->form_validation->set_rules('full_name', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        if($this->input->post('password') != '')
        {
	        $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
	        $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');
	    }
        $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'trim|required');
        $this->form_validation->set_rules('account_number', 'No Rekening', 'trim|required');
        $this->form_validation->set_rules('bank_name', 'Nama Bank', 'trim|required');
        $this->form_validation->set_rules('account_name', 'No Rekening Atas Nama', 'trim|required');
        $this->form_validation->set_rules('address', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('sub_district', 'Kecamatan', 'trim|required');
        $this->form_validation->set_rules('district', 'Kabupaten', 'trim|required');
        $this->form_validation->set_rules('province', 'Provinsi', 'trim|required');
        $this->form_validation->set_rules('job', 'Pekerjaan', 'trim|required');

        if ($this->form_validation->run() == false)
        {
            $data['message'] = validation_errors();
            $this->twig->display('masterlink/edit', $data);
        }
        else
        {
            $user = Users::find($id);
            $user->full_name = $this->input->post('full_name');
            $user->email = $this->input->post('email');
            $user->username = $this->input->post('username');
            if($this->input->post('password') != '')
        	{
            	$user->password   = $this->ion_auth->hash_password($this->input->post('password'), '');
            }
            $user->phone = $this->input->post('phone');
            $user->account_number = $this->input->post('account_number');
            $user->account_name = $this->input->post('account_name');
            $user->bank_name = $this->input->post('bank_name');
            $user->address = $this->input->post('address');
            $user->sub_district = $this->input->post('sub_district');
            $user->district = $this->input->post('district');
            $user->province = $this->input->post('province');
            $user->job = $this->input->post('job');
            if($data['session']['group_id'] == 1)
            {
                $user->active = $this->input->post('active');
                $user->status = $this->input->post('active');

                if($this->input->post('active') == 1)
                {
                    $message = $this->load->view('email/approve.php', $data, true);

                    $this->email->set_newline("\r\n");

                    $this->email->from('training.ctigroup@gmail.com', 'CTI Training');
                    $this->email->to($user->email);

                    $this->email->subject('Akun Berhasil Diaktifkan');
                    $this->email->message($message);
                    $this->email->send();
                }
            }
            if ($_FILES['photo']['name'] != '')
            {
                if (!empty($user->photo))
                {
                    unlink($upload_path.'/'.$user->photo);
                }

                $this->upload->initialize($config);
                if($this->upload->do_upload('photo')) {
                    $this->upload->data();
                    $user->photo = $this->upload->file_name;
                }
            }
            if ($_FILES['ktp']['name'] != '')
            {
                if (!empty($user->ktp))
                {
                    unlink($upload_path.'/'.$user->ktp);
                }

                $this->upload->initialize($config);
                if($this->upload->do_upload('ktp')) {
                    $this->upload->data();
                    $user->ktp = $this->upload->file_name;
                }
            }
            if ($_FILES['kk']['name'] != '')
            {
                if (!empty($user->kk))
                {
                    unlink($upload_path.'/'.$user->kk);
                }

                $this->upload->initialize($config);
                if($this->upload->do_upload('kk')) {
                    $this->upload->data();
                    $user->kk = $this->upload->file_name;
                }
            }
            $user->save();
            redirect('masterlink');
        }
    }

    public function delete($id)
    {
        $user = Users::find($id);
        $upload_path = './assets/images';
        if (!empty($user->photo))
        {
            unlink($upload_path.'/'.$user->photo);
        }
        if (!empty($user->ktp))
        {
            unlink($upload_path.'/'.$user->ktp);
        }
        if (!empty($user->kk))
        {
            unlink($upload_path.'/'.$user->kk);
        }

        $user->delete();
        redirect('masterlink');
    }

    public function set_status()
    {
        $user = Users::find($this->input->post('id'));
        $user->status = $this->input->post('status');
        $user->active = $this->input->post('status');
        $user->save();

        if($this->input->post('status') == 1)
        {
            $message = $this->load->view('email/approve.php', $data, true);

            $this->email->set_newline("\r\n");

            $this->email->from('training.ctigroup@gmail.com', 'CTI Training');
            $this->email->to($user->email);

            $this->email->subject('Akun Berhasil Diaktifkan');
            $this->email->message($message);
            $this->email->send();
        }

        redirect('masterlink');
    }

}