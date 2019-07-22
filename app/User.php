<?php namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use DesignMyNight\Mongodb\Auth\User as Authenticatable;

class User extends Authenticatable
{
	use AuthenticableTrait;
	use Notifiable;
	use HasApiTokens;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];
}
