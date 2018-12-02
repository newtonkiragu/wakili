<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "adscost".
 *
 * @property int $id
 * @property string $time
 * @property string $amount
 */
class Adscost extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'adscost';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['time', 'amount'], 'required'],
            [['amount'], 'string'],
            [['time'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'time' => 'Time (milliseconds)',
            'amount' => 'Amount(KES)',
        ];
    }
}
