<?php

use yii\db\Migration;

/**
 * Handles the creation of table `packages`.
 */
class m180925_201215_create_packages_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('packages', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'benefits' => $this->text()->notNull(),
            'monthly' => $this->string(50)->notNull(),
            'annualamount' => $this->string(50),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('packages');
    }
}
