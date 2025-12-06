<?php

use \Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Carbon;

//https://notes.enovision.net/codeigniter/eloquent-in-codeigniter/how-to-use-the-models

class User_Model extends MY_Model
{
	protected $table = 't_users';

	protected $fillable = [
		'username',
		'display_name',
		'mobile',
		'email',
		'password',
		'salt',
		'user_type', //rango 1=admin 2=others users
		'remember_token', //varchar
		'email_verified_at', //datetime
		'api_token',
		'created_by',
		'updated_by'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'remember_token',
		'salt',
		'user_type'
	];

	protected $casts = [
		'lock' => 'boolean',
		'status' => 'boolean',
		'row' => 'integer',
		'id' => 'integer'
	];

	protected $appends = ['userflag', 'lock', 'pwd'];

	// Carbon instance fields
	protected $dates = ['created_at', 'updated_at', 'deleted_at', 'updated_at_role'];

	public function getUserflagAttribute()
	{
		//return date_diff(date_create($this->date_vigency), date_create('now'))->d;
		//https://blog.devgenius.io/how-to-find-the-number-of-days-between-two-dates-in-php-1404748b1e84
		//return date_diff(date_create('now'),date_create($this->date_vigency))->format('%R%a days');return date_diff(date_create('now'),date_create($this->date_vigency))->format('%R%a days');
		if ($this->status > 0) {
			return 'Activo';
		} else {
			return 'Suspendido';
		}
	}

	public static function getListStatusUsers()
	{
		$opcionesStatus = array();
		$opcionesStatus[NULL] = 'Seleccione condición';
		$opcionesStatus[1] = 'Activo';
		$opcionesStatus[0] = 'Suspendido';

		return $opcionesStatus;
	}

	public function getLockAttribute()
	{
		//return date_diff(date_create($this->date_vigency), date_create('now'))->d;
		//https://blog.devgenius.io/how-to-find-the-number-of-days-between-two-dates-in-php-1404748b1e84
		//return date_diff(date_create('now'),date_create($this->date_vigency))->format('%R%a days');return date_diff(date_create('now'),date_create($this->date_vigency))->format('%R%a days');
		if ($this->user_type == 1) {
			return 1;
		} else {
			return 0;
		}
	}

	//https://stackoverflow.com/questions/62003963/how-to-save-and-retrieve-base64-encoded-data-using-laravel-model
	public function getPwdAttribute()
	{
		if ($this->salt) {
			return base64_decode($this->salt);
		} else {
			return;
		}
	}

	/*public function setSaltAttribute($value)
	{
		$this->attributes['salt'] = base64_decode($value);
	}*/

}