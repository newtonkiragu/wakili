<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbadvocates`.
 */
class m180718_055416_create_tbadvocates_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tbadvocates', [
            'id' => $this->primaryKey(),
            'names' => $this->string(100)->notNull(),
            'practice_no' => $this->string(16)->notNull(),
            'practice_area' => $this->string(40)->notNull(),
            'current_law_firm' => $this->string(100)->notNull(),
            'tel_no' => $this->string(12)->notNull(),
            'email' => $this->string(50)->notNull(),
            'town' => $this->string(30),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tbadvocates');
    }
}
