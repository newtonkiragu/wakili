<?php

use yii\db\Migration;

/**
 * Handles adding firebasetoken to table `tbregistration`.
 */
class m180804_152938_add_firebasetoken_column_to_tbregistration_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tbregistration', 'firebasetoken', $this->string(256));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('tbregistration', 'firebasetoken');
    }
}
