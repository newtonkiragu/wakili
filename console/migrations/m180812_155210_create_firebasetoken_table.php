<?php

use yii\db\Migration;

/**
 * Handles the creation of table `firebasetoken`.
 */
class m180812_155210_create_firebasetoken_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('firebasetoken', [
            'id' => $this->primaryKey(),
            'userid' => $this->string(10)->notNull(),
            'token' => $this->text()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('firebasetoken');
    }
}
