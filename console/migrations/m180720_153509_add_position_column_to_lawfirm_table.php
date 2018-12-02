<?php

use yii\db\Migration;

/**
 * Handles adding position to table `lawfirm`.
 */
class m180720_153509_add_position_column_to_lawfirm_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('lawfirm', 'reg_no', $this->string(40)->notNull()->unique());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('lawfirm', 'reg_no');
    }
}
