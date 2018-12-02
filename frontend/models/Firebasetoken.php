<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "firebasetoken".
 *
 * @property int $id
 * @property string $userid
 * @property string $token
 */
class Firebasetoken extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'firebasetoken';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userid', 'token'], 'required'],
            [['token'], 'string'],
            [['userid'], 'string', 'max' => 10],
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
            'token' => 'Token',
        ];
    }
}
