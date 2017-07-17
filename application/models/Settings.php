<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Eloquent\Model as Eloquent;

class Settings extends Eloquent
{
	protected $table 	= 'settings';
	protected $fillable = [
		'level',
		'point'
	];
	public $timestamps	= true;
}

/* End of file Category.php */
/* Location: ./application/models/Category.php */
