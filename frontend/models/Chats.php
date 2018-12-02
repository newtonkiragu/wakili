<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "chats".
 *
 * @property int $id
 * @property string $message
 * @property int $sender
 * @property int $receiver
 * @property string $created_at
 * @property string $identifier
 * @property string $sender_image
 * @property string $receiver_image
 */
class Chats extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chats';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['message', 'sender', 'receiver', 'created_at', 'identifier'], 'required'],
            [['message'], 'string'],
            [['sender', 'receiver'], 'integer'],
            [['created_at', 'sender_image', 'receiver_image'], 'string', 'max' => 50],
            [['identifier'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'message' => 'Message',
            'sender' => 'Sender',
            'receiver' => 'Receiver',
            'created_at' => 'Created At',
            'identifier' => 'Identifier',
            'sender_image' => 'Sender Image',
            'receiver_image' => 'Receiver Image',
        ];
    }
}
