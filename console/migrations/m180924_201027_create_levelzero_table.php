<?php

use yii\db\Migration;

/**
 * Handles the creation of table `levelzero`.
 */
class m180924_201027_create_levelzero_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('levelzero', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()->unique(),
            'description' => $this->string(200),
            'path' => $this->string(100)->notNull(),
            'monthlyprice' => $this->string(40)->notNull(),
            'annualprice' => $this->string(40)->notNull(),
            'is_terminal' => $this->string(20)->notNull(),
            'usertype' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('levelzero');
    }
}
