<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 04 Dec 2016 18:10:19 +0000.
 */

namespace App\Models\land_1000i1potolok;

//use Reliese\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class DbSetting
 * 
 * @property int $id
 * @property int $min_price
 * @property int $max_price
 * @property \Carbon\Carbon $last_mod
 * @property string $email
 *
 * @package App\Models
 */
class DbSetting extends Eloquent
{
	//Соединение с базой данных
//	protected $connection = 'mysql_potolok';
//	//Название таблицы
//	protected $table = 'db_feedback';
//	//Primary Keys
//	protected $primaryKey = 'fb_id';
	//Timestamps
	public $timestamps = false;

	protected $casts = [
		'min_price' => 'int',
		'max_price' => 'int'
	];

	protected $dates = [
		'last_mod'
	];

	protected $fillable = [
		'min_price',
		'max_price',
		'last_mod',
		'email'
	];
}
