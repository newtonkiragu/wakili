<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "configurations".
 *
 * @property int $id
 * @property int $doc_id
 * @property string $item
 * @property string $value
 */
class Configurations extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'configurations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['doc_id', 'item', 'value'], 'required'],
            [['doc_id'], 'integer'],
            [['item', 'value'], 'string'],
            [['item', 'value'], 'trim'],
//            [['item'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'doc_id' => 'Doc ID',
            'item' => 'Key',
            'value' => 'Value',
        ];
    }

    public function getDocname() {
        return $this->hasOne(Levelthree::className(), ['id' => 'doc_id']);
    }

}
