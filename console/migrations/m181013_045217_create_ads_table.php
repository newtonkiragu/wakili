<?php

use yii\db\Migration;

/**
 * Handles the creation of table `ads`.
 */
class m181013_045217_create_ads_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ads', [
            'id' => $this->primaryKey(),
            'adname' => $this->string(100)->notNull(),
            'imagepath' => $this->text()->notNull(),
            'company_name' => $this->string(100)->notNull(),
            'job_description' => $this->string(100),
            'qualification' => $this->string(100),
            'email' => $this->string(100)->notNull(),
            'phone' => $this->string(100)->notNull(),
            'address' => $this->string(100)->notNull(),
            'time' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('ads');
    }
}
