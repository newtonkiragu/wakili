<?php

use yii\db\Migration;

/**
 * Handles the creation of table `lawfirm`.
 */
class m180720_152847_create_lawfirm_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('lawfirm', [
            'id' => $this->primaryKey(),
            'town' => $this->string(50)->notNull(),
            'building' => $this->string(50)->notNull(),
            'county' => $this->string(20)->notNull(),
            'floor' => $this->string(30),
            'practise_areas' => $this->string(255)->notNull(),
            'phone' => $this->string(20)->notNull(),
            'email' => $this->string(50)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('lawfirm');
    }
}
