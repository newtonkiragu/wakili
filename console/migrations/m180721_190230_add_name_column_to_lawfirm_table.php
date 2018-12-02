<?php

use yii\db\Migration;

/**
 * Handles adding name to table `lawfirm`.
 */
class m180721_190230_add_name_column_to_lawfirm_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('lawfirm', 'name', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('lawfirm', 'name');
    }
}
