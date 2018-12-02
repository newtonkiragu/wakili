<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subscriptions".
 *
 * @property int $id
 * @property int $userid
 * @property int $prodid
 * @property string $amount
 * @property string $created_at
 * @property string $expires_at
 * @property int $duration
 * @property string $status
 * @property int $level_id
 * @property string $type
 */
class Subscriptions extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'subscriptions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['userid', 'amount', 'created_at', 'expires_at', 'duration'], 'required'],
            [['userid', 'prodid', 'duration', 'level_id'], 'integer'],
            [['created_at', 'expires_at'], 'safe'],
            [['amount'], 'string', 'max' => 100],
            [['status'], 'string', 'max' => 10],
            [['type'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'userid' => 'Userid',
            'prodid' => 'Prodid',
            'amount' => 'Amount',
            'created_at' => 'Created At',
            'expires_at' => 'Expires At',
            'duration' => 'Duration',
            'status' => 'Status',
            'level_id' => 'Level ID',
            'type' => 'Type',
        ];
    }

    public function getCustomer() {
        return $this->hasOne(Tbregistration::className(), ['id' => 'userid']);
    }

    public function getProduct() {

        if ($this->type == "PACKAGES") {
            return $this->hasOne(Packages::className(), ['id' => 'prodid']);
        } else if ($this->level_id == 0) {
            return $this->hasOne(Levelzero::className(), ['id' => 'prodid']);
        } else if ($this->level_id == 1) {
            return $this->hasOne(Levelone::className(), ['id' => 'prodid']);
        } else if ($this->level_id == 2) {
            return $this->hasOne(Leveltwo::className(), ['id' => 'prodid']);
        } else if ($this->level_id == 3) {
            return $this->hasOne(Levelthree::className(), ['id' => 'prodid']);
        }
    }

}
