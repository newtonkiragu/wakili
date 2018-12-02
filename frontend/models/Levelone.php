<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "levelone".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $path
 * @property string $monthlyprice
 * @property string $annualprice
 * @property string $is_terminal
 * @property int $level_zero_id
 * @property string $benefits
 */
class Levelone extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'levelone';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'path', 'monthlyprice', 'annualprice', 'is_terminal'], 'required'],
            [['level_zero_id'], 'integer'],
            [['benefits'], 'string'],
            [['name'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 200],
            [['path'], 'string', 'max' => 100],
            [['monthlyprice', 'annualprice'], 'string', 'max' => 40],
            [['is_terminal'], 'string', 'max' => 20],
            [['name'], 'unique'],
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
            'description' => 'Description',
            'path' => 'Path',
            'monthlyprice' => 'Monthlyprice',
            'annualprice' => 'Annualprice',
            'is_terminal' => 'Is Terminal',
            'level_zero_id' => 'Level Zero ID',
            'benefits' => 'Benefits',
        ];
    }
}
