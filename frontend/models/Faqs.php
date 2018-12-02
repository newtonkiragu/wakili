<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "faqs".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 */
class Faqs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'faqs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
        ];
    }
}
