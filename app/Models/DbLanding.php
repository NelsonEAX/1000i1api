<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 04 Dec 2016 18:10:19 +0000.
 */

namespace App\Models;

//use Reliese\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class DbLanding
 * 
 * @property int $land_id
 * @property string $land_pref
 * @property string $land_ya_verif
 * @property string $land_go_verif
 * @property int $land_post
 * @property string $land_geo
 * @property string $land_adres
 * @property string $land_rtrg
 * @property string $land_desc_satin
 * @property string $land_desc_glossy
 * @property string $land_desc_matt
 * @property string $land_desc_multi
 * @property string $land_desc_photo
 * @property string $land_desc_carved
 * @property string $land_desc_tissue
 * @property int $land_2
 * @property int $land_3
 *
 * @package App\Models
 */
class DbLanding extends Eloquent
{
//	protected $table = 'db_landing';
//	protected $primaryKey = 'land_id';
//	public $timestamps = false;

	//Соединение с базой данных
	protected $connection = 'mysql_potolok';
	//Название таблицы
	protected $table = 'db_landing';
	//Primary Keys
	protected $primaryKey = 'land_id';
	//Timestamps
	public $timestamps = false;

	protected $casts = [
		'land_post' => 'int',
		'land_2' => 'int',
		'land_3' => 'int'
	];

	protected $fillable = [
		'land_pref',
		'land_ya_verif',
		'land_go_verif',
		'land_post',
		'land_geo',
		'land_adres',
		'land_rtrg',
		'land_desc_satin',
		'land_desc_glossy',
		'land_desc_matt',
		'land_desc_multi',
		'land_desc_photo',
		'land_desc_carved',
		'land_desc_tissue',
		'land_2',
		'land_3'
	];
}
