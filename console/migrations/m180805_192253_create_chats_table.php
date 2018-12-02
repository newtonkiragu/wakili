<?php

use yii\db\Migration;

/**
 * Handles the creation of table `chats`.
 */
class m180805_192253_create_chats_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('chats', [
            'id' => $this->primaryKey(),
            'message' => $this->text()->notNull(),
            'sender' => $this->integer()->notNull(),
            'receiver' => $this->integer()->notNull(),
            'created_at' => $this->string(50)->notNull(),
            'identifier' => $this->string(20)->notNull(),
            'sender_image' => $this->string(50),
            'receiver_image' => $this->string(50),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('chats');
    }
}
