<?php

use yii\db\Migration;

/**
 * Handles adding position to table `tbregistration`.
 */
class m181104_065436_add_position_column_to_tbregistration_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tbregistration', 'website', $this->string(70));
        $this->addColumn('tbregistration', 'company_name', $this->string(50));
        $this->addColumn('tbregistration', 'company_reg', $this->string(50));
        $this->addColumn('tbregistration', 'location', $this->string(50));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('tbregistration', 'website');
        $this->dropColumn('tbregistration', 'company_name');
        $this->dropColumn('tbregistration', 'company_reg');
        $this->dropColumn('tbregistration', 'location');
    }
}
