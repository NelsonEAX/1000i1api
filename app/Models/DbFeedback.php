<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 04 Dec 2016 18:10:19 +0000.
 */

namespace App\Models;

//use Reliese\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class DbFeedback
 * 
 * @property int $fb_id
 * @property string $fb_url
 * @property string $fb_phone
 * @property string $fb_name
 * @property string $fb_info
 * @property \Carbon\Carbon $fb_datetime
 *
 * @package App\Models
 */
class DbFeedback extends Eloquent
{
	//Соединение с базой данных
	protected $connection = 'mysql_potolok';
	//Название таблицы
	protected $table = 'db_feedback';
	//Primary Keys
	protected $primaryKey = 'fb_id';
	//Timestamps
	public $timestamps = false;
	
	protected $dates = [
		'fb_datetime'
	];

	protected $fillable = [
		'fb_url',
		'fb_phone',
		'fb_name',
		'fb_info',
		'fb_datetime'
	];
}
