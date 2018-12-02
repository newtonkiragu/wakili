<?php

use yii\db\Migration;

/**
 * Handles the creation of table `transactions`.
 */
class m181010_053002_create_transactions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('transactions', [
            'id' => $this->primaryKey(),
            'phone' => $this->string(50),
            'ref' => $this->string(20),
            'date' => $this->text(),
            'amount' => $this->string(100),
            'desc' => $this->text(),
            'userid' => $this->integer(),
            'status' => $this->string(40),
            'message' => $this->text(),
            'checkoutrequestid' => $this->text(),
            'merchantid' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('transactions');
    }
}
