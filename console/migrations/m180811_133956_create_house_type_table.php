<?php

use yii\db\Migration;

/**
 * Handles the creation of table `house_type`.
 */
class m180811_133956_create_house_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('house_type', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'service_charge' => $this->string(10),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('house_type');
    }
}
