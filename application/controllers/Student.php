<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        error_reporting(0);
        if (empty($this->session->userdata('user_id'))) {
            redirect(base_url('auth/login'));
        }

        $this->load->library(array('form_validation','email'));
        $this->load->helper(array('url','language', 'form'));

        $this->load->model(['Students', 'Programs', 'Users', 'Parents', 'ParentCategories', 'Settings']);
    }

    public function index()
    {
    	$data['session'] = $this->session->all_userdata();
    	if($data['session']['group_id'] == 1)
    	{
    		$data['students'] = Students::with(['program', 'user'])->get();
    	}
    	elseif($data['session']['group_id'] == 2)
    	{
    		$users = array();
    		$user = $this->db->query('SELECT id FROM users WHERE user_id = '. $data['session']['user_id'])->result();
    		$i = 0;
    		foreach ($user as $value) {
    			$users[$i] = $value->id;
    			$i++;
    		}
    		$users[$i] = $data['session']['user_id'];
    		$data['students'] = Students::with(['program', 'user'])->whereIn('user_id', $users)->get();
    	}
    	elseif ($data['session']['group_id'] == 3) {
    		$data['students'] = Students::with(['program', 'user'])->where('user_id', $data['session']['user_id'])->get();
    	}
    	$data['url'] = $this->uri->segment(1);
    	$this->twig->display('students/index', $data);
    }

    public function create()
    {
        if ($this->session->userdata('group_id') == 1) {
            show_404();
        }
    	$data['session'] = $this->session->all_userdata();
    	$data['url'] = $this->uri->segment(1);
    	$data['programs'] = Programs::all();
    	$this->twig->display('students/create', $data);
    }

    public function store()
    {
        if ($this->session->userdata('group_id') == 1) {
            show_404();
        }
    	$data['session'] = $this->session->all_userdata();
    	$data['url'] = $this->uri->segment(1);
    	$data['programs'] = Programs::all();

    	$this->form_validation->set_rules('name', 'Nama Lengkap', 'required');
    	$this->form_validation->set_rules('place_of_birth', 'Tempat Lahir', 'required');
    	$this->form_validation->set_rules('date_of_birth', 'Tanggal Lahir', 'required');
    	$this->form_validation->set_rules('gender', 'Jenis Kelamin', 'required');
    	$this->form_validation->set_rules('program_id', 'Program Studi', 'required');
    	$this->form_validation->set_rules('religion', 'Agama', 'required');
    	$this->form_validation->set_rules('nik', 'NIK', 'required');
    	$this->form_validation->set_rules('nisn', 'NISN', 'required');
    	$this->form_validation->set_rules('nationality', 'Kewarganegaraan', 'required');
    	$this->form_validation->set_rules('street', 'Alamat', 'required');
    	$this->form_validation->set_rules('sub_district', 'Kecamatan', 'required');
    	$this->form_validation->set_rules('district', 'Kabupaten', 'required');
    	$this->form_validation->set_rules('province', 'Provinsi', 'required');
    	$this->form_validation->set_rules('type_of_stay', 'Jenis Tempat Tinggal', 'required');
    	$this->form_validation->set_rules('transportation', 'Transportasi', 'required');
    	$this->form_validation->set_rules('phone', 'Nomor Telepon', 'required');
    	$this->form_validation->set_rules('email', 'Email', 'required');

    	if ($this->form_validation->run() == true)
        {
        	$student = new Students();
        	$student->name = $this->input->post('name');
        	$student->place_of_birth = $this->input->post('place_of_birth');
        	$date_of_birth = date_create($this->input->post('date_of_birth'));
        	$student->date_of_birth = date_format($date_of_birth, "Y-m-d");
        	$student->gender = $this->input->post('gender');
        	$student->program_id = $this->input->post('program_id');
        	$student->religion = $this->input->post('religion');
        	$student->nik = $this->input->post('nik');
        	$student->nisn = $this->input->post('nisn');
        	$student->npwp = $this->input->post('npwp');
        	$student->nationality = $this->input->post('nationality');
        	$student->street = $this->input->post('street');
        	$student->village = $this->input->post('village');
        	$student->rt = $this->input->post('rt');
        	$student->rw = $this->input->post('rw');
        	$student->sub_district = $this->input->post('sub_district');
        	$student->district = $this->input->post('district');
        	$student->province = $this->input->post('province');
        	$student->type_of_stay = $this->input->post('type_of_stay');
        	$student->transportation = $this->input->post('transportation');
        	$student->phone = $this->input->post('phone');
        	$student->email = $this->input->post('email');
        	$student->status = 0;
        	$student->user_id = $data['session']['user_id'];
        	$student->save();

            $data['additional_data'] = array(
                'full_name' => $this->input->post('name'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'address' => $this->input->post('street')
            );

            $message = $this->load->view('email/register_student.php', $data, true);

            $this->email->set_newline("\r\n");

            $this->email->from('training.ctigroup@gmail.com', 'CTI Training');
            $this->email->to([$data['session']['email'], 'training.ctigroup@gmail.com']);

            $this->email->subject('Registrasi Berhasil');
            $this->email->message($message);
            $this->email->send();

        	redirect("students", 'refresh');
        }
        else
        {
        	$data['message'] = validation_errors();
            $this->twig->display('students/create', $data);
        }
    }

    public function show($id)
    {
    	$data['session'] = $this->session->all_userdata();
    	$data['student'] = Students::with('parents')->find($id);
    	$data['parent_categories'] = ParentCategories::all();
    	foreach ($data['parent_categories'] as $value) {
    		$data['students'][$value->id] = Parents::where('student_id', $id)->where('parent_category_id', $value->id)->get();
    	}
    	$data['url'] = $this->uri->segment(1);
    	$data['programs'] = Programs::all();
    	$this->twig->display('students/show', $data);
    }

    public function edit($id)
    {
    	$data['session'] = $this->session->all_userdata();
    	$data['student'] = Students::find($id);
    	$data['url'] = $this->uri->segment(1);
    	$data['programs'] = Programs::all();
    	$this->twig->display('students/edit', $data);
    }

    public function update($id)
    {
    	$data['session'] = $this->session->all_userdata();
    	$data['student'] = Students::find($id);
    	$data['url'] = $this->uri->segment(1);
    	$data['programs'] = Programs::all();

    	$this->form_validation->set_rules('name', 'Nama Lengkap', 'required');
    	$this->form_validation->set_rules('place_of_birth', 'Tempat Lahir', 'required');
    	$this->form_validation->set_rules('date_of_birth', 'Tanggal Lahir', 'required');
    	$this->form_validation->set_rules('gender', 'Jenis Kelamin', 'required');
    	$this->form_validation->set_rules('program_id', 'Program Studi', 'required');
    	$this->form_validation->set_rules('religion', 'Agama', 'required');
    	$this->form_validation->set_rules('nik', 'NIK', 'required');
    	$this->form_validation->set_rules('nisn', 'NISN', 'required');
    	$this->form_validation->set_rules('nationality', 'Kewarganegaraan', 'required');
    	$this->form_validation->set_rules('street', 'Alamat', 'required');
    	$this->form_validation->set_rules('sub_district', 'Kecamatan', 'required');
    	$this->form_validation->set_rules('district', 'Kabupaten', 'required');
    	$this->form_validation->set_rules('province', 'Provinsi', 'required');
    	$this->form_validation->set_rules('type_of_stay', 'Jenis Tempat Tinggal', 'required');
    	$this->form_validation->set_rules('transportation', 'Transportasi', 'required');
    	$this->form_validation->set_rules('phone', 'Nomor Telepon', 'required');
    	$this->form_validation->set_rules('email', 'Email', 'required');

    	if ($this->form_validation->run() == true)
        {
        	$student = Students::find($id);
        	$student->name = $this->input->post('name');
        	$student->place_of_birth = $this->input->post('place_of_birth');
        	$date_of_birth = date_create($this->input->post('date_of_birth'));
        	$student->date_of_birth = date_format($date_of_birth, "Y-m-d");
        	$student->gender = $this->input->post('gender');
        	$student->program_id = $this->input->post('program_id');
        	$student->religion = $this->input->post('religion');
        	$student->nik = $this->input->post('nik');
        	$student->nisn = $this->input->post('nisn');
        	$student->npwp = $this->input->post('npwp');
        	$student->nationality = $this->input->post('nationality');
        	$student->street = $this->input->post('street');
        	$student->village = $this->input->post('village');
        	$student->rt = $this->input->post('rt');
        	$student->rw = $this->input->post('rw');
        	$student->sub_district = $this->input->post('sub_district');
        	$student->district = $this->input->post('district');
        	$student->province = $this->input->post('province');
        	$student->type_of_stay = $this->input->post('type_of_stay');
        	$student->transportation = $this->input->post('transportation');
        	$student->phone = $this->input->post('phone');
        	$student->email = $this->input->post('email');
        	$student->save();

        	redirect("students", 'refresh');
        }
        else
        {
        	$data['message'] = validation_errors();
            $this->twig->display('students/edit', $data);
        }
    }

    public function delete($id)
    {
    	$student = Students::find($id);
        $student->delete();
        redirect('students');
    }

    public function set_status()
    {
        $student = Students::find($this->input->post('id'));
        if($student->status != $this->input->post('status'))
        {
            $student->status = $this->input->post('status');
            $student->save();

            //HME
            $setting1 = Settings::find(1);

            //ME
            $setting3 = Settings::find(2);

            //ME to HME
            $setting2 = Settings::find(3);

            if($this->input->post('status') == 1)
            {
                $user = Users::find($student->user_id);

                if($user->user_id != 0)
                {
                    $user->point = $user->point + $setting3['point'];
                    $user->save();

                    $parent = Users::find($user->user_id);
                    $parent->point = $parent->point + $setting2['point'];
                    $parent->save();
                }
                else
                {
                    $user->point = $user->point + $setting1['point'];
                    $user->save();
                }
            }
            else
            {
                $user = Users::find($student->user_id);

                if($user->user_id != 0)
                {
                    $user->point = $user->point - $setting3['point'];
                    $user->save();

                    $parent = Users::find($user->user_id);
                    $parent->point = $parent->point - $setting2['point'];
                    $parent->save();
                }
                else
                {
                    $user->point = $user->point - $setting1['point'];
                    $user->save();
                }
            }
        }

        redirect('students');
    }

}