<?php

use yii\db\Migration;

/**
 * Handles the creation of table `adscost`.
 */
class m181026_142133_create_adscost_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('adscost', [
            'id' => $this->primaryKey(),
            'time' => $this->string(50)->notNull(),
            'amount' => $this->text()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('adscost');
    }
}
