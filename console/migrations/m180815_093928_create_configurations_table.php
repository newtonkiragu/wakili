<?php

use yii\db\Migration;

/**
 * Handles the creation of table `configurations`.
 */
class m180815_093928_create_configurations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('configurations', [
            'id' => $this->primaryKey(),
            'doc_id' => $this->integer()->notNull(),
            'key' => $this->text()->notNull(),
            'value' => $this->text()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('configurations');
    }
}
