<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "packages".
 *
 * @property int $id
 * @property string $name
 * @property string $benefits
 * @property string $monthly
 * @property string $annualamount
 */
class Packages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'packages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'benefits', 'monthly'], 'required'],
            [['benefits'], 'string'],
            [['name'], 'string', 'max' => 100],
            [['monthly', 'annualamount'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'benefits' => 'Benefits',
            'monthly' => 'Monthly',
            'annualamount' => 'Annualamount',
        ];
    }
}
