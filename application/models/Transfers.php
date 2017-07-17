<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Eloquent\Model as Eloquent;

class Transfers extends Eloquent
{
	protected $table 	= 'transfers';
	protected $fillable = [
		'user_id',
		'point_before',
		'total_transfer',
		'point_after',
		'note'
	];
	public $timestamps	= true;

	public function user()
	{
		return $this->belongsTo('Users');
	}
}

/* End of file Category.php */
/* Location: ./application/models/Category.php */
