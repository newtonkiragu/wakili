<?php

use yii\db\Migration;

/**
 * Handles the creation of table `levelone`.
 */
class m180925_121006_create_levelone_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('levelone', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()->unique(),
            'description' => $this->string(200),
            'path' => $this->string(100)->notNull(),
            'monthlyprice' => $this->string(40)->notNull(),
            'annualprice' => $this->string(40)->notNull(),
            'is_terminal' => $this->string(20)->notNull(),
            'level_zero_id' => $this->integer(),
            'benefits' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('levelone');
    }
}
