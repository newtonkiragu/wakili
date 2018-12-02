<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbregistration`.
 */
class m180720_131400_create_tbregistration_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tbregistration', [
            'id' => $this->primaryKey(),
            'email' => $this->string(50)->notNull()->unique(),
            'phone' => $this->string(16)->notNull()->unique(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'password_hash' => $this->string(255)->notNull(),
            'type' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tbregistration');
    }
}
