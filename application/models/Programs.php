<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Eloquent\Model as Eloquent;

class Programs extends Eloquent
{
	protected $table 	= 'programs';
	protected $fillable = [
		'name',
		'description'
	];
	public $timestamps	= true;

	public function students()
	{
		return $this->hasMany('Students');
	}
}

/* End of file Category.php */
/* Location: ./application/models/Category.php */
