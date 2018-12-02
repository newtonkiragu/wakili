<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbadvocates".
 *
 * @property int $id
 * @property string $names
 * @property string $practice_no
 * @property string $practice_area
 * @property string $current_law_firm
 * @property string $tel_no
 * @property string $email
 * @property string $town
 */
class Tbadvocates extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbadvocates';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['names', 'practice_no', 'practice_area', 'current_law_firm', 'tel_no', 'email'], 'required'],
            [['names', 'current_law_firm'], 'string', 'max' => 100],
            [['practice_no'], 'string', 'max' => 16],
            [['practice_area'], 'string', 'max' => 40],
            [['tel_no'], 'string', 'max' => 12],
            [['email'], 'string', 'max' => 50],
            [['town'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'names' => 'Names',
            'practice_no' => 'Practice No',
            'practice_area' => 'Practice Area',
            'current_law_firm' => 'Current Law Firm',
            'tel_no' => 'Tel No',
            'email' => 'Email',
            'town' => 'Town',
        ];
    }
}
