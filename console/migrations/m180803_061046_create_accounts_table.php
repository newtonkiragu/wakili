<?php

use yii\db\Migration;

/**
 * Handles the creation of table `accounts`.
 */
class m180803_061046_create_accounts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('accounts', [
            'id' => $this->primaryKey(),
            'userid' => $this->integer()->notNull()->unique(),
            'opening_bal' => $this->string(100)->notNull(),
            'actual_bal' => $this->string(100)->notNull(),
            'available_bal' => $this->string(100)->notNull(),
            'currency' => $this->string(40)->notNull(),
            'created_at' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('accounts');
    }
}
