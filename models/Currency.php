<?php
/**
 * Created by PhpStorm.
 * User: HPnettop5
 * Date: 21.07.2019
 * Time: 18:56
 */

namespace app\models;
use Yii;
use yii\db\ActiveRecord;

/**
 * Class Currency
 * @package app\models
 *
 * @property int $id
 * @property int $nominal
 * @property string $name
 * @property float $rate
 * @property string $code
 */
class Currency extends ActiveRecord {

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'currency';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['name', 'rate', 'nominal', 'code'], 'required'],
			[['name','code'], 'string', 'max' => 255],
			['rate', 'number'],
			['nominal', 'number', 'integerOnly' => true],
		];
	}


	public function attributeLabels() {
		return [
			'id' => 'ID',
			'name' => 'Наименование',
			'rate' => 'Курс к рублю',
		];
	}

}