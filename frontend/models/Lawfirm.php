<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lawfirm".
 *
 * @property int $id
 * @property string $town
 * @property string $building
 * @property string $county
 * @property string $floor
 * @property string $practise_areas
 * @property string $phone
 * @property string $email
 */
class Lawfirm extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lawfirm';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['town', 'building', 'county', 'practise_areas', 'phone', 'email'], 'required'],
            [['town', 'building', 'email'], 'string', 'max' => 50],
            [['county', 'phone'], 'string', 'max' => 20],
            [['floor'], 'string', 'max' => 30],
            [['practise_areas'], 'string', 'max' => 255],
            [['reg_no'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'town' => 'Town',
            'building' => 'Building',
            'county' => 'County',
            'floor' => 'Floor',
            'practise_areas' => 'Practise Areas',
            'phone' => 'Phone',
            'email' => 'Email',
        ];
    }
}
