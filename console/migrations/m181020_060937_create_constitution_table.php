<?php

use yii\db\Migration;

/**
 * Handles the creation of table `constitution`.
 */
class m181020_060937_create_constitution_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('constitution', [
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
        $this->dropTable('constitution');
    }
}
