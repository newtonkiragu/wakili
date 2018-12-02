<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbregistration".
 *
 * @property int $id
 * @property string $email
 * @property string $phone
 * @property int $created_at
 * @property int $updated_at
 * @property string $password_hash
 * @property int $type
 */
class Tbregistration extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbregistration';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'phone', 'created_at', 'updated_at', 'password_hash', 'type'], 'required'],
            [['created_at', 'updated_at', 'type'], 'integer'],
            [['email'], 'string', 'max' => 50],
            [['phone'], 'string', 'max' => 16],
            [['password_hash'], 'string', 'max' => 255],
            [['email'], 'unique'],
            [['phone'], 'unique'],
            [['company_reg','company_name','website','location'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'phone' => 'Phone',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'password_hash' => 'Password Hash',
            'type' => 'Type',
        ];
    }
}
