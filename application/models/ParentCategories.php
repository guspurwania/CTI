<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Eloquent\Model as Eloquent;

class ParentCategories extends Eloquent
{
	protected $table 	= 'parent_categories';
	protected $fillable = [
		'name'
	];
	public $timestamps	= true;

	public function parents()
	{
		return $this->hasMany('Parents');
	}
}

/* End of file Category.php */
/* Location: ./application/models/Category.php */
