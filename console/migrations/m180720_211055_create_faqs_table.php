<?php

use yii\db\Migration;

/**
 * Handles the creation of table `faqs`.
 */
class m180720_211055_create_faqs_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('faqs', [
            'id' => $this->primaryKey(),
            'title' => $this->string(50)->notNull(),
            'description' => $this->text()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('faqs');
    }
}
