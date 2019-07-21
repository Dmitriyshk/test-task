<?php

use yii\db\Migration;

/**
 * Class m190721_125240_currencies
 */
class m190721_125240_currencies extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->createTable('currency', [
			'id' => $this->primaryKey(),
			'name' => $this->string(255),
			'code' => $this->string(255),
			'nominal' => $this->integer(),
			'rate' => $this->float(4),
		]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
	    $this->dropTable('currency');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190721_125240_currencies cannot be reverted.\n";

        return false;
    }
    */
}
