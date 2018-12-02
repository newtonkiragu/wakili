<?php

use yii\db\Migration;

/**
 * Handles the creation of table `subscriptions`.
 */
class m180925_192755_create_subscriptions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('subscriptions', [
            'id' => $this->primaryKey(),
            'userid' => $this->integer()->notNull(),
            'prodid' => $this->integer(),
            'amount' => $this->string(100)->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'expires_at' => $this->dateTime()->notNull(),
            'duration' => $this->integer()->notNull(),
            'status' => $this->string(10)->notNull(),
            'level_id' => $this->integer(),
            'type' => $this->string(30),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('subscriptions');
    }
}
