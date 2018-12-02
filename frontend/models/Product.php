<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $path
 * @property string $level_one
 * @property string $level_two
 * @property string $monthlyprice
 * @property string $annualprice
 */
class Product extends \yii\db\ActiveRecord {

    const SCENARIO_UPDATE = 'update';

    /**
     * {@inheritdoc}
     * 
     */
    public $fileItem;

    public static function tableName() {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['name', 'path', 'level_one', 'level_two', 'monthlyprice', 'annualprice'], 'required'],
            [['name'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 200],
            [['path'], 'string', 'max' => 100],
            [['level_one', 'level_two', 'monthlyprice', 'annualprice'], 'string', 'max' => 40],
            [['name', 'path'], 'unique'],
            [['fileItem'], 'file', 'extensions' => 'docx'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'path' => 'Path',
            'level_one' => 'Level One',
            'level_two' => 'Level Two',
            'monthlyprice' => 'Monthlyprice',
            'annualprice' => 'Annualprice',
        ];
    }

    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_UPDATE] = ['name','fileItem','description','level_one','level_two','monthlyprice','annualprice'];

        return $scenarios;
    }

}
