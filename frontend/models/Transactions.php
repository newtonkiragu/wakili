<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transactions".
 *
 * @property int $id
 * @property string $phone
 * @property string $ref
 * @property string $date
 * @property string $amount
 * @property string $desc
 * @property int $userid
 * @property string $status
 * @property string $message
 * @property string $checkoutrequestid
 * @property string $merchantid
 */
class Transactions extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'transactions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['date', 'desc', 'message', 'checkoutrequestid', 'merchantid'], 'string'],
            [['userid'], 'integer'],
            [['phone'], 'string', 'max' => 50],
            [['ref'], 'string', 'max' => 20],
            [['amount'], 'string', 'max' => 100],
            [['status'], 'string', 'max' => 40],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'phone' => 'Phone',
            'ref' => 'Ref',
            'date' => 'Date',
            'amount' => 'Amount',
            'desc' => 'Desc',
            'userid' => 'Userid',
            'status' => 'Status',
            'message' => 'Message',
            'checkoutrequestid' => 'Checkoutrequestid',
            'merchantid' => 'Merchantid',
        ];
    }

    public function getName() {
        return $this->hasOne(Tbregistration::className(), ['id' => 'userid']);
    }

}
