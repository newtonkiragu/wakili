<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ads".
 *
 * @property int $id
 * @property string $adname
 * @property string $imagepath
 * @property string $company_name
 * @property string $job_description
 * @property string $qualification
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property string $time
 */
class Ads extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    
    public $fileItem;
    
    public static function tableName()
    {
        return 'ads';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['adname', 'imagepath', 'company_name', 'email', 'phone', 'address'], 'required'],
            [['imagepath', 'time'], 'string'],
            [['adname', 'company_name', 'job_description', 'qualification', 'email', 'phone', 'address'], 'string', 'max' => 1000],
            [['fileItem'], 'file', 'extensions' => 'png,jpg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'adname' => 'Adname',
            'imagepath' => 'Imagepath',
            'company_name' => 'Company Name',
            'job_description' => 'Job Description',
            'qualification' => 'Qualification',
            'email' => 'Email',
            'phone' => 'Phone',
            'address' => 'Address',
            'time' => 'Time',
        ];
    }
}
