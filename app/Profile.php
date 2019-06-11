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


	public function setEmailAtributte($value)
	{
		$this->attributes['email'] = strtolower($value);
	}

	public function setPhoneAtributte($value)
	{
		$this->attributes['phone'] = preg_replace("/\D+/", "", $value);
	}

	public function curriculum()
	{
		return $this->hasMany('App\Curriculum');
	}

	public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }
}
