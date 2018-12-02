<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "constitution".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 */
class Constitution extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'constitution';
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
