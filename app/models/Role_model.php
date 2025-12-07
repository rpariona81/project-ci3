<?php

use \Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Carbon;

//https://notes.enovision.net/codeigniter/eloquent-in-codeigniter/how-to-use-the-models

class Role_Model extends MY_Model
{
	protected $table = 't_roles';

	protected $fillable = [
		'rolename',
		'roledisplay',
		'description',
		'level',
		'url_guard'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		
	];

	protected $casts = [
		'row' => 'integer'
	];

	protected $appends = ['roleflag','lock'];

	// Carbon instance fields
	protected $dates = ['created_at', 'updated_at', 'deleted_at', 'updated_at_role'];

	public function getRoleflagAttribute()
	{
		//return date_diff(date_create($this->date_vigency), date_create('now'))->d;
		//https://blog.devgenius.io/how-to-find-the-number-of-days-between-two-dates-in-php-1404748b1e84
		//return date_diff(date_create('now'),date_create($this->date_vigency))->format('%R%a days');return date_diff(date_create('now'),date_create($this->date_vigency))->format('%R%a days');
		if ($this->status > 0) {
			return 'Activo';
		} else {
			return 'Desactivado';
		}
	}

	public static function getListStatusRoles()
	{
		$opcionesStatus = array();
		$opcionesStatus[NULL] = 'Seleccione condición';
		$opcionesStatus[1] = 'Activo';
		$opcionesStatus[0] = 'Desactivado';

		return $opcionesStatus;
	}

	public function getLockAttribute()
	{
		//return date_diff(date_create($this->date_vigency), date_create('now'))->d;
		//https://blog.devgenius.io/how-to-find-the-number-of-days-between-two-dates-in-php-1404748b1e84
		//return date_diff(date_create('now'),date_create($this->date_vigency))->format('%R%a days');return date_diff(date_create('now'),date_create($this->date_vigency))->format('%R%a days');
		if ($this->visible == 1) {
			return 1;
		} else {
			return 0;
		}
	}


}