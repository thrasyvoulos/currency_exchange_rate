<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "currency".
 *
 * @property integer $currencyid
 * @property integer $currencyid2
 * @property string $description
 * @property string $abbreviation
 */
class Currency extends \yii\db\ActiveRecord
{   public $currencyid2;
    public $currency1;
    public $currency2;

    public static $yql_base_url = "http://query.yahooapis.com/v1/public/yql";
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'currency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'abbreviation'], 'required'],
            [['description', 'abbreviation','currencyid2'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'currencyid' => '',
            'currencyid2'=>'',
            'currency1'=>'',
            'currency2'=>'',
            'description' => 'Description',
            'abbreviation' => 'Abbreviation',
        ];
    }

    /**
    * Convert currency
    * @param string from. The base currency
    * @param string to. The currency we want to convert to
    * @param integer rate. The value of rate
    * @return the current rate
    */
    public static function convertCurrency($from, $to, $rate=1)
    {
        $yql_query = 'select * from yahoo.finance.xchange where pair in ("'.$from.$to.'")';
        $yql_query_url = self::$yql_base_url . "?q=" . urlencode($yql_query);
        $yql_query_url .= "&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys";
        $yql_session = file_get_contents($yql_query_url);
        $yql_json =  json_decode($yql_session,true);
        $currency_output = (float) $rate*$yql_json['query']['results']['rate']['Rate'];

        return $currency_output;
    }
}
