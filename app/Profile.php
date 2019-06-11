<?php namespace App;

class Profile extends \Moloquent {

	// status:
	// 	E => Habilitado,
	// 	A => Arquivado,

	public $fillable = [
		'name',
		'email',
		'phone',
		'is_internship',
		'tags[]',
		'stars',
		'areas',
		'status',
		'linkedin',
		'github'
	];


	public function setEmailAttribute($value)
	{
		$this->attributes['email'] = strtolower($value);
	}

	public function setPhoneAttribute($value)
	{
		$this->attributes['phone'] = preg_replace("/\D+/", "", $value);
	}

	public function setIsInternshipAttribute($value)
	{
		$this->attributes['is_internship'] = filter_var($value, FILTER_VALIDATE_BOOLEAN);
	}

	public function setNameAttribute($value)
	{
		$this->attributes['name'] = ucwords($value);
	}

	public function curriculum()
	{
		return $this->hasMany('App\Curriculum');
	}

}
