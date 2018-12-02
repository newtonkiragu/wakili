<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "accounts".
 *
 * @property int $id
 * @property int $userid
 * @property string $opening_bal
 * @property string $actual_bal
 * @property string $available_bal
 * @property string $currency
 * @property string $created_at
 */
class Accounts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'accounts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userid', 'opening_bal', 'actual_bal', 'available_bal', 'currency', 'created_at'], 'required'],
            [['userid'], 'integer'],
            [['opening_bal', 'actual_bal', 'available_bal'], 'string', 'max' => 100],
            [['currency'], 'string', 'max' => 40],
            [['created_at'], 'string', 'max' => 255],
            [['userid'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userid' => 'Userid',
            'opening_bal' => 'Opening Bal',
            'actual_bal' => 'Actual Bal',
            'available_bal' => 'Available Bal',
            'currency' => 'Currency',
            'created_at' => 'Created At',
        ];
    }
    
    public function getCustomer()
    {
        return $this->hasOne(Tbregistration::className(), ['id' => 'userid']);
    }
}
