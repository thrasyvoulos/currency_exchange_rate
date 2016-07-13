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
}
