<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Eloquent\Model as Eloquent;

class Groups extends Eloquent
{
	protected $table 	= 'groups';
	protected $fillable = [
		'name',
		'description'
	];
	public $timestamps	= true;

	public function users()
	{
		return $this->hasMany('Users');
	}
}

/* End of file Category.php */
/* Location: ./application/models/Category.php */
