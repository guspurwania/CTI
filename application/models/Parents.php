<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Eloquent\Model as Eloquent;

class Parents extends Eloquent
{
	protected $table 	= 'parents';
	protected $fillable = [
		'nik',
		'name',
		'date_of_birth',
		'education',
		'job',
		'income',
		'parent_category_id',
		'student_id'
	];
	public $timestamps	= true;

	public function student()
	{
		return $this->belongsTo('Students');
	}

	public function parent_category()
	{
		return $this->belongsTo('ParentCategories');
	}
}

/* End of file Category.php */
/* Location: ./application/models/Category.php */
