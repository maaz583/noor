<?php

use yii\db\Migration;

/**
 * Class m191020_111237_create_table_academic_term
 */
class m191020_111237_create_table_academic_term extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%academic_term}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'start_date' => $this->string(50)->notNull(),
            'end_date' => $this->string(50)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%academic_term}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191020_111237_create_table_academic_term cannot be reverted.\n";

        return false;
    }
    */
}
