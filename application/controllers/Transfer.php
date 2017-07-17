<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transfer extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (empty($this->session->userdata('user_id'))) {
            redirect(base_url('auth/login'));
        }

        $this->load->library(array('ion_auth','form_validation','email'));
        $this->load->helper(array('url','language', 'form'));

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

        $this->load->model(['Users', 'Groups', 'Transfers']);
	}

	public function index()
	{
		$data['session'] = $this->session->all_userdata();
		$data['user'] = Users::find($data['session']['user_id']);

    	if($data['session']['group_id'] == 1)
    	{
    		$data['transfers'] = Transfers::with(['user'])->get();
    	}
    	else
    	{
    		$data['transfers'] = Transfers::where('user_id', $data['session']['user_id'])->get();
    	}

    	$data['url'] = $this->uri->segment(1);
    	$this->twig->display('transfer/index', $data);
	}

	public function store()
	{
		if(empty($this->input->post('total_transfer')))
		{
			show_404();
		}
		else
		{
			$data['session'] = $this->session->all_userdata();
			if($data['session']['group_id'] == 1)
    		{
    			show_404();
    		}
	    	$data['url'] = $this->uri->segment(1);
	    	$data['user'] = Users::find($data['session']['user_id']);

	    	if($data['user']['point'] > $this->input->post('total_transfer'))
	    	{
	    		$count = Transfers::where('user_id', $data['session']['user_id'])->where('status', 0)->count();
	    		if($count > 0)
	    		{
	    			if($data['session']['group_id'] == 1)
			    	{
			    		$data['transfers'] = Transfers::with(['user'])->get();
			    	}
			    	elseif($data['session']['group_id'] == 2)
			    	{
			    		$data['transfers'] = Transfers::where('user_id', $data['session']['user_id'])->get();
			    	}
			    	$data['message'] = 'Anda tidak dapat melakukan penarikan lagi, Mohon menunggu sampai proses transfer selesai!';
		            $this->twig->display('transfer/index', $data);
	    		}	
	    		else
	    		{
			    	$transfer = new Transfers();
			    	$transfer->user_id = $data['session']['user_id'];
			    	$transfer->point_before = $data['user']['point'];
			    	$transfer->total_transfer = $this->input->post('total_transfer');
			    	$transfer->point_after = $data['user']['point'] - $this->input->post('total_transfer');
			    	$transfer->status = 0;
			    	$transfer->save();

			    	$data['additional_data'] = array(
			    		'total_transfer' => $this->input->post('total_transfer')
			    	);

			    	$message = $this->load->view('email/request_transfer.php', $data, true);

		            $this->email->set_newline("\r\n");

		            $this->email->from('training.ctigroup@gmail.com', 'CTI Training');
		            $this->email->to(['guspurwania@gmail.com','training.ctigroup@gmail.com']);

		            $this->email->subject('Transfer Request');
		            $this->email->message($message);
		            $this->email->send();

			    	redirect('transfer');
			    }
		    }
		    else
		    {
		    	if($data['session']['group_id'] == 1)
		    	{
		    		$data['transfers'] = Transfers::with(['user'])->get();
		    	}
		    	elseif($data['session']['group_id'] == 2)
		    	{
		    		$data['transfers'] = Transfers::where('user_id', $data['session']['user_id'])->get();
		    	}
		    	$data['message'] = 'Point anda belum cukup untuk melakukan transfer';
	            $this->twig->display('transfer/index', $data);
		    }
		}
	}

	public function set_status()
    {
    	$data['session'] = $this->session->all_userdata();
		if($data['session']['group_id'] != 1)
		{
			show_404();
		}
        $transfer = Transfers::find($this->input->post('id'));
        $config = array(
            'upload_path'   => './assets/images',
            'allowed_types' => 'jpg|gif|png',
            'max_size' => 2048
        );

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if($_FILES['note']['name'] != '')
        {
	        if($this->upload->do_upload('note')) {
	        	$this->upload->data();
	        	$note = $this->upload->file_name;
	        }

	        if (!empty($transfer->note))
            {
                unlink($upload_path.'/'.$transfer->note);
            }
	    }

	    $transfer->note = $note;

        if($transfer['status'] != $this->input->post('status'))
        {
        	$transfer->status = $this->input->post('status');
	    	$transfer->save();
	    	
	        if($this->input->post('status') == 1)
	        {
	        	$user = Users::find($transfer['user_id']);
	        	$user->point = $user->point - $transfer['total_transfer'];
	        	$user->save();

	        	$data['transfer'] = Transfers::find($this->input->post('id'));
	        	$message = $this->load->view('email/receive_transfer.php', $data, true);

	            $this->email->set_newline("\r\n");

	            $this->email->from('training.ctigroup@gmail.com', 'CTI Training');
	            $this->email->to($user->email);

	            $this->email->subject('Dana Berhasil di Transfer');
	            $this->email->message($message);
	            $this->email->send();
	        }
	    }

        redirect('transfer');
    }

	public function delete($id)
	{
		$data['session'] = $this->session->all_userdata();
		if($data['session']['group_id'] != 1)
		{
			show_404();
		}
		$transfer = Transfers::find($id);
		if (!empty($transfer->note))
        {
            unlink($upload_path.'/'.$transfer->note);
        }
		$transfer->delete();
        redirect('transfer');
	}

}