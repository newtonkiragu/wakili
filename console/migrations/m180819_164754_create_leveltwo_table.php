<?php

use yii\db\Migration;

/**
 * Handles the creation of table `leveltwo`.
 */
class m180819_164754_create_leveltwo_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('leveltwo', [
            'id' => $this->primaryKey(),
            'level_one' => $this->string(30)->notNull(),
            'level_two' => $this->string(30)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('leveltwo');
    }
}
