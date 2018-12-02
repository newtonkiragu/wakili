<?php

use yii\db\Migration;

/**
 * Handles adding position to table `ads`.
 */
class m181103_184323_add_position_column_to_ads_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('ads', 'type', $this->string(40)->notNull());
        $this->addColumn('ads', 'content', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('ads', 'type');
        $this->dropColumn('ads', 'content');
    }
}
