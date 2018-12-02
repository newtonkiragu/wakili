<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product`.
 */
class m180803_173643_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()->unique(),
            'description' => $this->string(200),
            'path' => $this->string(100)->notNull(),
            'level_one' => $this->string(40)->notNull(),
            'level_two' => $this->string(40)->notNull(),
            'monthlyprice' => $this->string(40)->notNull(),
            'annualprice' => $this->string(40)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('product');
    }
}
