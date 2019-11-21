<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%instructor}}`.
 */
class m191027_110042_create_instructor_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%instructor}}', [
            'id' => $this->primaryKey(),
            'gender' => $this->string(50)->notNull(),
            'contact' => $this->double()->notNull(),
            'course_id' => $this->integer()->notNull(),
            'ref_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('fk_instructor_user', 'instructor', 'ref_id', 'user', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_instructor_user', 'instructor');
        $this->dropTable('{{%instructor}}');
    }
}
