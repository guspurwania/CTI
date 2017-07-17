<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Eloquent\Model as Eloquent;

class Students extends Eloquent
{
	protected $table 	= 'students';
	protected $fillable = [
		'name',
		'place_of_birth',
		'date_of_birth',
		'gender',
		'program_id',
		'religion',
		'nik',
		'nisn',
		'npwp',
		'nationality',
		'street',
		'village',
		'rt',
		'rw',
		'sub_district',
		'district',
		'province',
		'type_of_stay',
		'transportation',
		'phone',
		'email',
		'status',
		'user_id'
	];
	public $timestamps	= true;

	public function user()
	{
		return $this->belongsTo('Users');
	}

	public function program()
	{
		return $this->belongsTo('Programs');
	}

	public function parents()
	{
		return $this->hasMany('Parents', 'student_id');
	}
}

/* End of file User.php */
/* Location: ./application/models/User.php */
