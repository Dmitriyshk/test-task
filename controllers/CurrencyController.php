<?php
/**
 * Created by PhpStorm.
 * User: HPnettop5
 * Date: 21.07.2019
 * Time: 19:33
 */

namespace app\controllers;
use app\models\Currency;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\VerbFilter;

class CurrencyController extends ActiveController{

	public $modelClass = 'app\models\Currency';

	public function behaviors()
	{
		$behaviors = parent::behaviors();
		$behaviors['authentificator'] = [
			'class' => HttpBearerAuth::className(),
			'except' => ["login","options",'auth']
		];
		$behaviors['verbs'] = [
			'class' => VerbFilter::className(),
			'actions' => [
				'index' => ['get'],
				'view' => ['get'],
				'create' => ['post'],
				'update' => ['put'],
				'delete' => ['delete'],
				'options' => ['options']
			]
		];
		return $behaviors;
	}

}