<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%program}}`.
 */
class m191027_111250_create_program_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%program}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'description' => $this->string(50),
        ]);

        $this->addForeignKey('fk_student_program', 'student', 'area_of_interest_id', 'program', 'id', 'CASCADE');

        $this->addForeignKey('fk_instructor_program', 'instructor', 'course_id', 'program', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_instructor_program', 'instructor');
        $this->dropForeignKey('fk_student_program', 'student');
        $this->dropTable('{{%program}}');
    }
}
