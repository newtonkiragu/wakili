<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "levelzero".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $path
 * @property string $monthlyprice
 * @property string $annualprice
 * @property string $is_terminal
 * @property int $usertype
 */
class Levelzero extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'levelzero';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'path', 'monthlyprice', 'annualprice', 'is_terminal', 'usertype'], 'required'],
            [['usertype'], 'integer'],
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
            'usertype' => 'Usertype',
        ];
    }
}
