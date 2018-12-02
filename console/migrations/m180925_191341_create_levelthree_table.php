<?php

use yii\db\Migration;

/**
 * Handles the creation of table `levelthree`.
 */
class m180925_191341_create_levelthree_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('levelthree', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()->unique(),
            'description' => $this->string(200),
            'path' => $this->string(100)->notNull(),
            'monthlyprice' => $this->string(40)->notNull(),
            'onetimeamount' => $this->string(40)->notNull(),
            'annualprice' => $this->string(40)->notNull(),
            'is_terminal' => $this->string(20)->notNull(),
            'level_two_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('levelthree');
    }
}
