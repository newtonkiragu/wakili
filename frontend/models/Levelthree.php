<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "levelthree".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $path
 * @property string $monthlyprice
 * @property string $onetimeamount
 * @property string $annualprice
 * @property string $is_terminal
 * @property int $level_two_id
 */
class Levelthree extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    
    const SCENARIO_UPDATE = 'update';
    
    
    public $fileItem;

    public static function tableName() {
        return 'levelthree';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['name', 'path', 'monthlyprice', 'onetimeamount', 'annualprice', 'is_terminal'], 'required'],
            [['level_two_id'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 200],
            [['path'], 'string', 'max' => 100],
            [['monthlyprice', 'onetimeamount', 'annualprice'], 'string', 'max' => 40],
            [['is_terminal'], 'string', 'max' => 20],
            [['name'], 'unique'],
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
            'monthlyprice' => 'Monthlyprice',
            'onetimeamount' => 'Pay as you go Amount',
            'annualprice' => 'Annualprice',
            'is_terminal' => 'Is Terminal',
            'level_two_id' => 'Level Two ID',
        ];
    }
    
     public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_UPDATE] = ['fileItem'];

        return $scenarios;
    }

}
