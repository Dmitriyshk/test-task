<?php
/**
 * Created by PhpStorm.
 * User: HPnettop5
 * Date: 21.07.2019
 * Time: 18:26
 */

namespace app\commands;
use app\models\Currency;
use Yii;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\db\Exception;
use yii\httpclient\Client;
use yii\helpers\ArrayHelper;

class CurrencyController extends Controller {

	/**
	 * Обновляет список валют с сайта cbrf
	 */
	public function actionUpdate()
	{
		$transaction = Yii::$app->db->beginTransaction();
		try {
			$client = new Client([
				'responseConfig' => [
					'format' => Client::FORMAT_XML
				]
			]);
			$response = $client->get( 'http://cbr.ru/scripts/XML_daily.asp' )->send();
			$data = $response->getData();
			$currencies = ArrayHelper::index(Currency::find()->all(), 'code');
			foreach($data['Valute'] as $item){
				$currency          = $currencies[$item['CharCode']] ?? new Currency();
				$currency->name    = $item['Name'];
				$currency->nominal = $item['Nominal'];
				$currency->rate    = floatval(str_replace(',','.',$item['Value']));
				$currency->code    = $item['CharCode'];
				if($currency->validate())
					$currency->save();
				else {
					var_dump( $currency->errors );
					return ExitCode::DATAERR;
				}
			}
		}catch(Exception $ex){
			echo 'Error: '.$ex->getMessage();
			$transaction->rollBack();

			return ExitCode::DATAERR;
		}
		$transaction->commit();
		echo '\nInserted: '.count($data['Valute']).' rows\n';
		return ExitCode::OK;
	}
}