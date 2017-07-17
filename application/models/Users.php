<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Eloquent\Model as Eloquent;

class Users extends Eloquent
{
	protected $table 	= 'users';
	protected $fillable = [
		'ip_address',
		'username',
		'password',
		'salt',
		'email',
		'activation_code',
		'forgotten_password_code',
		'forgotten_password_time',
		'remember_code',
		'created_on',
		'last_login',
		'active',
		'full_name',
		'phone',
		'account_number',
		'account_name',
		'bank_name',
		'group_id',
		'photo',
		'ktp',
		'kk',
		'address',
		'rt',
		'rw',
		'sub_district',
		'district',
		'province',
		'job',
		'point',
		'user_id',
		'status'
	];
	public $timestamps	= true;

	public function group()
	{
		return $this->belongsTo('Groups');
	}

	public function user()
	{
		return $this->belongsTo('Users');
	}

	// public function users()
	// {
	// 	return $this->hasMany('Users');
	// }

	public function students()
	{
		return $this->hasMany('Students');
	}
}

/* End of file User.php */
/* Location: ./application/models/User.php */
